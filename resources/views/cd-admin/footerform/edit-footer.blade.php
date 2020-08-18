@extends('cd-admin.admin-master')

<!-- page content -->
@section('content')

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="{{url('cd-admin/dashboard')}}">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="{{url('cd-admin/view-footer')}}">View Footer</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit Footer</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->

<form action="{{route('edit-footer-form',$footer['id'])}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Edit Footer</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="portlet-body">
						
						<div class="row">
							@foreach($final as $key=>$w)
							<div id="one{{$key}}"><div></div><br><div class="col-md-6"></div><div class="form-group"></div><label class="col-md-3 control-label">Select Footer<span class="cd-admin-required">*</span></label><div class="col-md-6"></div><select class="form-control" name="custom_widget_title[]"><option disabled="" selected="">Select Widget</option>
								@foreach($custom_widget as $c)
								@if($c['id'] == $w->custom_widget_id)
								<option value="{{$c['id']}}" selected>{{$c['name']}}</option>
								@else
								<option value="{{$c['id']}}">{{$c['name']}}</option>
								@endif
							@endforeach</select>
							<span class="btn btn-danger" id="remove_button" onClick="deleteInput({{$key}})">Delete</span>
						</div>
						@endforeach
						<div id="dynamicInput">

						</div>
					</div>
					<div class="pull-right">
						<span class="btn btn-success" value="Add another text input" onClick="addInput('dynamicInput');">Add Widgets</span>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>
<button type="submit" class="btn btn-primary" style="margin-left: 504px;">Submit</button>
</form>
@foreach($final as $key => $w)
<div class="modal modal-danger fade" id="delete-modal{{$key}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"> Delete Widget</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this Widget?</p>
				</div>
				<div class="modal-footer">
					<div align="center">
						<form action="{{route('delete-one-widget',$w->custom_widget_id)}}" method="POST">
							@csrf
							<button type="submit" class="btn btn-warning">Yes</button>
							<button type="button" class="btn btn-primary " data-dismiss="modal">No</button>
						</form>
					</div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	@endforeach
	
	<script type="text/javascript">

		counter = {{count($final)}}; 
		var limit = 10;
		function addInput(divName){
			if (counter == limit)  {
				alert("You have reached the limit of adding " + counter + " inputs");
			}
			else {
				var newdiv = document.createElement('div');
				newdiv.setAttribute("id",'one'+counter);
				newdiv.innerHTML='<div>';
				newdiv.innerHTML+='<br>';
				newdiv.innerHTML+='<div class="col-md-6">';
				newdiv.innerHTML+='<div class="form-group">';
				newdiv.innerHTML+='<label class="col-md-3 control-label">Select Footer</label>';
				newdiv.innerHTML+='<div class="col-md-6">';
				newdiv.innerHTML+='<select class="form-control" name="custom_widget_title[]"><option disabled selected>Select Widget</option>@foreach($custom_widget as $c)<option value="{{$c['id']}}">{{$c['name']}}</option>@endforeach</select>';
				newdiv.innerHTML+='<div align="center">';
				newdiv.innerHTML+='<span class="btn btn-danger" id="remove_button" onclick="deleteInput('+counter+')">Delete</span>';
				newdiv.innerHTML+='</div>';
				newdiv.innerHTML+='</div>';
				document.getElementById(divName).appendChild(newdiv);
				counter++;			
			}
		}

		function deleteInput(i) {
			var input= document.getElementById('one'+i);
			input.parentNode.removeChild(input);
		}
	</script>
</script>
</script>
@endsection