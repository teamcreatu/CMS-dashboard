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
			<a href="{{url('cd-admin/view-custom-section')}}">View Custom Sections</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit Custom Sections</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('edit-custom-section',$data['id'])}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Edit Custom Section</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="portlet-body">
						<div class="form-group">
							<label class="col-md-3 control-label"> Section Title<span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" placeholder="Enter  Section Title" value="{{$data['title']}}">
							</div>
							@if ($errors->has('title'))
							<span class="text-danger">{{ $errors->first('title') }}</span>
							@endif
						</div>
						<br>
						<div class="form-group">
							<label class="col-md-3 control-label"> Section शीर्षक <span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title_ne" placeholder=" Section प्रविष्ट गर्नुहोस्" value="{{$data['title_ne']}}">
							</div>
							@if ($errors->has('title_ne'))
							<span class="text-danger">{{ $errors->first('title_ne') }}</span>
							@endif
						</div>

						<br>
						<div class="form-group">
							<label class="col-md-3 control-label"> Section Background Color </label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="background_color" placeholder="Please Enter the color code without #" value="{{$data['background_color']}}">
							</div>
							@if ($errors->has('background_color'))
							<span class="text-danger">{{ $errors->first('background_color') }}</span>
							@endif
						</div>
						<br>
						<div class="form-group">
							<label class="col-md-3 control-label"> Priority Number  <span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="priority_no" placeholder="Please Enter the priority number" value="{{$data['priority_no']}}">
							</div>
							@if ($errors->has('priority_no'))
							<span class="text-danger">{{ $errors->first('priority_no') }}</span>
							@endif
						</div>
						<br>
						<div class="form-group">
							<label class="col-md-3 control-label">Content Type <span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="radio" name="content_type" id="optionsRadios25" value="page" <?php echo $data['content_type'] == 'page'?'checked':''  ?>  onclick="addPage()"> Page
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="content_type" id="optionsRadios26" value="post" <?php echo $data['content_type'] == 'post'?'checked':'' ?> onclick="addPage()"> Post
										<span></span>
									</label>
								</div>
							</div>
							@if ($errors->has('content_type'))
							<span class="text-danger">{{ $errors->first('content_type') }}</span>
							@endif
						</div>
						{{-- <div class="col-md-12" align="center">
							<a href="#modal-members" data-toggle="modal">
								<span><button class="btn btn-primary" onclick="openWidget()">Add Widget</button></span>
							</a>
						</div> --}}
						<br>
						<br>
						<div class="row" id="remove_0" <?php echo $data['content_type'] == 'page'?'style="display: block;"':'style="display: none;"' ?>>
							@foreach($links as $key=>$l)
							<div id="one{{$key}}"><div></div><br><div class="form-group"></div><label class="col-md-3 control-label"> Headline<span class="cd-admin-required">*</span></label><div class="col-md-6"></div><input type="text" class="form-control" name="headline[]" placeholder="Headline प्रविष्ट गर्नुहोस्" value="{{$l['headline']}}"><br><div class="col-md-6"></div><div class="form-group"></div><label class="col-md-3 control-label">Link<span class="cd-admin-required">*</span></label><div class="col-md-6"></div><input type="text" name="links[]" id="choose_widget{{$key}}" class="form-control" value="{{$l['links']}}"><div class="col-md-1"></div><a href="#modal-image{{$key}}" data-toggle="modal"><span class="btn btn-primary">Choose</span></a><div align="center"></div><a data-toggle="modal" href="#delete-modal{{$l['id']}}"><span class="btn btn-danger" id="remove_button">Delete</span></a></div>

							<input type="hidden" name="widget_id[]" value="{{$l['id']}}">

							@endforeach
							<div id="dynamicInput">

							</div>
						</div>
						<div class="pull-right" id="remove_1" <?php echo $data['content_type'] == 'page'?'style="display: block;"':'style="display: none;"'?>>
							<span class="btn btn-success" value="Add another text input" onClick="addInput('dynamicInput');">Add Section</span>
						</div>
					</div>
					<br>
					<div class="form-group" id="remove_2" <?php echo $data['content_type'] == 'post'?'style="display: block;"':'style="display: none;"' ?>>
						<label class="col-md-3 control-label">View Type <span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="view_type" id="optionsRadios25" value="list" <?php echo $data['view_type'] == 'list'?'checked':''  ?> checked> List View
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="view_type" id="optionsRadios26" value="card" <?php echo $data['view_type'] == 'card'?'checked':'' ?>> Card View
									<span></span>
								</label>
							</div>
						</div>
						@if ($errors->has('view_type'))
						<span class="text-danger">{{ $errors->first('view_type') }}</span>
						@endif
					</div>
					<br>
					<div class="form-group" id="remove_3" <?php echo $data['content_type'] == 'post'?'style="display: block;"':'style="display: none;"' ?>>
						<hr>
						<label class="col-md-3 control-label">Post Category<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<select class="form-control" name="post_category">
								<option selected disabled>Select One</option>
								<optgroup label="Post Category">
									@foreach($post_category as $pc)
									@if($pc['id'] == $data['category_id'])
									<option value={{$pc['id']}} selected>{{$pc['name']}}</option>	
									@else
									<option value={{$pc['id']}}>{{$pc['name']}}</option>	
									@endif
									@endforeach
								</optgroup>
							</optgroup>

						</select>
					</div>
					@if ($errors->has('post_category'))
					<span class="text-danger">{{ $errors->first('post_category') }}</span>
					@endif
				</div>
				<br>
				<hr>
				<div class="form-group">
					<label class="col-md-3 control-label">Status <span class="cd-admin-required">*</span></label>
					<div class="col-md-6">
						<div class="mt-radio-inline">
							<label class="mt-radio">
								<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo $data['status'] == 'active'?'checked':''  ?> checked> Active
								<span></span>
							</label>
							<label class="mt-radio">
								<input type="radio" name="status" id="optionsRadios26" value="inactive" <?php echo $data['status'] == 'inactive'?'checked':'' ?>> Inactive
								<span></span>
							</label>
						</div>
					</div>
					@if ($errors->has('status'))
					<span class="text-danger">{{ $errors->first('status') }}</span>
					@endif
				</div>
				<br>					
			</div>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>
<button type="submit" class="btn btn-btn-primary" style="margin-left: 504px;">Submit</button>
<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

</form>

@foreach($links as $l)
<div class="modal modal-danger fade" id="delete-modal{{$l['id']}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"> Delete Section</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete {{$l->headline}}?</p>
				</div>
				<div class="modal-footer">
					<div align="center">
						<form action="{{route('delete-one-section',$l['id'])}}" method="POST">
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
	@for($i= 0;$i<=10;$i++)
	<div id="modal-image{{$i}}" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">	 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
						<span aria-hidden="true" >&times;</span>
					</button>                         
				</div>
				<div class="modal-body">
					<div class="row">
						@foreach($page as $p)
						<div class="col-md-12 opmcm-menu-url">
							<h4 onclick="select{{$p['id']}}({{$i}})" data-dismiss="modal">{{$loop->iteration}} ) {{$p['title']}}{{$p['title_ne']}}</h4>
							<input type="hidden" name="link" id="section_link{{$p['id']}}" value="page/{{$p['slug']}}/en">
						</div>
						@endforeach
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
				</div>
			</div>
		</div>
	</div>
	@endfor

	<script type="text/javascript">
		counter = {{count($links)}}; 
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
				newdiv.innerHTML+='<div class="form-group">';
				newdiv.innerHTML+='<label class="col-md-3 control-label"> Headline<span class="cd-admin-required">*</span></label>';
				newdiv.innerHTML+='<div class="col-md-6">';
				newdiv.innerHTML+='<input type="text" class="form-control" name="headline[]" placeholder="Headline प्रविष्ट गर्नुहोस्">';
				newdiv.innerHTML+='</div>';
				newdiv.innerHTML+='</div>';
				newdiv.innerHTML+='<br>';
				newdiv.innerHTML+='</div>';
				newdiv.innerHTML+='<div class="col-md-6">';
				newdiv.innerHTML+='<div class="form-group">';
				newdiv.innerHTML+='<label class="col-md-3 control-label">Link<span class="cd-admin-required">*</span></label>';
				newdiv.innerHTML+='<div class="col-md-6">';
				newdiv.innerHTML+='<input type="text" name="links[]" value="" id="choose_widget'+counter+'" class="form-control">';
				newdiv.innerHTML+='<div class="col-md-1">';
				newdiv.innerHTML+='<a href="#modal-image'+ counter +'" data-toggle="modal"><span class="btn btn-primary">Choose</span></a>';
				newdiv.innerHTML+='</div>';
				newdiv.innerHTML+='</div>';
				newdiv.innerHTML+='</div>';
				newdiv.innerHTML+='</div>';
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
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	@foreach($page as $p)
	<script type="text/javascript">
		function select{{$p['id']}}(i)
		{ 
			var link = document.getElementById('section_link{{$p['id']}}');
			document.getElementById('modal-image{{$p['id']}}').style.display ="none";
			document.getElementById('choose_widget'+i).value = link.value;
		}
	</script>
	@endforeach
	<script type="text/javascript">
		function addPage() 
		{
			menu_type = $("input:radio[name=content_type]:checked").val();
			if(menu_type == 'page')
			{
				document.getElementById('remove_0').style.display = "block";
				document.getElementById('remove_1').style.display = "block";
				document.getElementById('remove_2').style.display = "none";
				document.getElementById('remove_3').style.display = "none";

			}
			else
			{
				document.getElementById('remove_0').style.display = "none";
				document.getElementById('remove_1').style.display = "none";
				document.getElementById('remove_2').style.display = "block";
				document.getElementById('remove_3').style.display = "block";

			}
		}
	</script>

	@endsection