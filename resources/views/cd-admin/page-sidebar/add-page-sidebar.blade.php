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
			<a href="{{route('view-page-sidebar')}}">View Page Sidebar</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Page Sidebar</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('add-page-sidebar')}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Add Page Sidebar</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="portlet-body">
						<div class="row">
							<div id="dynamicInput">
								<div id="one1"><div></div><br><div class="col-md-6"></div><div class="form-group"></div><label class="col-md-3 control-label">Select Page Sidebar<span class="cd-admin-required">*</span></label><div class="col-md-6"></div><select class="form-control" name="custom_widget_title[]"><option disabled="" selected="">Select Widget</option>
								@foreach($custom_widget as $c)
							<option value="{{$c['id']}}">{{$c['name']}}</option>
								@endforeach</select><div align="center"></div><span class="btn btn-danger" id="remove_button" onclick="deleteInput(1)">Delete</span></div>
							</div>
							<div class="pull-right">
								<span class="btn btn-success" value="Add another text input" onClick="addInput('dynamicInput');">Add Widgets</span>
							</div>
						</div>
						<br>						
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
		</div>
		<button type="submit" class="btn btn-primary" style="margin-left: 504px;">Submit</button>
		<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

	</form>

	<script type="text/javascript">
		var counter = 2;
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
				newdiv.innerHTML+='<label class="col-md-3 control-label">Select Page Sidebar</label>';
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