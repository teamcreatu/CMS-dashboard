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
			<a href="{{url('cd-admin/view-settings')}}">View Settings</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Settings</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->




<div class="row">

	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-settings font-dark"></i>
				<span class="caption-subject font-dark sbold uppercase">Add Settings</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form action="{{route('add-settings')}}" method="POST">
				@csrf
				<div class="form-body">
					<div class="form-group col-md-12">
						<label class=" control-label">Website Name<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="text" name="name" class="form-control" placeholder="Enter Website Name" value="{{old('name')}}">
						</div>
						@if ($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
						@endif
					</div>

					<div class="form-group col-md-6">
						<label class=" control-label">Website Logo<span class="cd-admin-required">*</span></label>
						<br>
						
						<div class="">
							<input type="text" name="logo_image" class="form-control" placeholder="Enter Image URL" id="logo_image" value="{{old('logo_image')}}">
						</div>
						<div class="">
							<a href="#modal-image" data-toggle="modal">
								<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Image</button>
							</a>
						</div>
						@if ($errors->has('logo_image'))
						<span class="text-danger">{{ $errors->first('logo_image') }}</span>
						@endif
					</div>


				{{-- 	<div class="form-group">
						<label class=" control-label">Website Logo Nepali<span class="cd-admin-required">*</span></label>
						<br>
						
						<div class="">
							<input type="text" name="logo_image_ne" class="form-control" placeholder="Enter Image URL" id="logo_image_ne" value="{{old('logo_image_ne')}}">
						</div>
						<div class="">
							<a href="#modal-image2" data-toggle="modal">
								<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Image</button>
							</a>
						</div>
						@if ($errors->has('logo_image_ne'))
						<span class="text-danger">{{ $errors->first('logo_image_ne') }}</span>
						@endif
					</div> --}}

					<div class="form-group col-md-6">
						<label class=" control-label">Side Logo</label>
						<br>
						<div class="">
							<input type="text" name="side_logo" class="form-control" placeholder="Enter Image URL" id="side_logo" value="{{old('side_logo')}}">
						</div>
						<div class="">
							<a href="#modal-image1" data-toggle="modal">
								<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Image</button>
							</a>
						</div>
						@if ($errors->has('side_logo'))
						<span class="text-danger">{{ $errors->first('side_logo') }}</span>
						@endif
					</div>
					<div class="col-md-3"></div>
					<div class="form-group col-md-6">
						<label class="col-md-12 pa-0 control-label">Flag</label>
						<div class="col-md-8 pa-0">
							<input type="text" name="flag" class="form-control" placeholder="Enter Flag URL" id="flag" value="{{old('flag')}}">
						</div>
						<div class="col-md-4 pa-0">
							<a href="#modal-image2" data-toggle="modal">
								<button class="btn btn-success" style="width: 100%;"><i class="fa fa-picture-o"></i> Select Flag</button>
							</a>
						</div>
						@if ($errors->has('logo_image'))
						<span class="text-danger">{{ $errors->first('logo_image') }}</span>
						@endif
					</div>
					<div class="form-group col-md-6">
						<label class=" control-label">Logo Text(English)</label>
						<br>
						<div class="">
							<textarea type="text" name="logo_text" class="form-control summernote" placeholder="Enter Image URL" id="logo_text" value="{{old('logo_text')}}">{!!old('logo_text')!!}</textarea>
						</div>
						@if ($errors->has('logo_text'))
						<span class="text-danger">{{ $errors->first('logo_text') }}</span>
						@endif
					</div>
					<br>	
					<div class="form-group col-md-6">
						<label class=" control-label">Logo Text(Nepali)</label>
						<br>
						<div class="">
							<textarea type="text" name="logo_text_ne" class="form-control summernote" placeholder="Enter Image URL" id="logo_text_ne" value="{{old('logo_text_ne')}}">{!!old('logo_text_ne')!!}</textarea>
						</div>
						@if ($errors->has('logo_text_ne'))
						<span class="text-danger">{{ $errors->first('logo_text_ne') }}</span>
						@endif
					</div>
					{{-- <hr>
						<h2><p align="center">Embed URL</p></h2>
						<div class="form-group">
							<label class=" control-label">Embed URL Link</label>
							<br>
							<div class="">
								<input type="url" name="embed_url" class="form-control" placeholder="Enter URL to Embed" value="{{old('embed_url')}}">
							</div>
							@if ($errors->has('embed_url'))
							<span class="text-danger">{{ $errors->first('embed_url') }}</span>
							@endif
						</div> --}}
						<hr>

						<button type="submit" class="btn btn-primary" style="margin-left: 504px;">Submit</button>
						<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

					</form>
					<br>		
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
		</div>


		<div id="modal-image" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">	                  
					</div>
					<div class="modal-body">
						<div class="alert" id="message" style="display: none"></div>
						<div class="row">
							<div align="center"><h3>Upload Image</h3></div>
							<form method="POST" id="upload_form" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="form-group">
									<table class="table">
										<tr>
											<td width="40%" align="right"><label>Select File for Upload</label></td>
											<td width="30"><input type="file" name="select_file" id="select_file" /></td>
											<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
										</tr>
										<tr>
											<td width="40%" align="right"></td>
											<td width="30"><span class="text-muted">jpg, png, gif</span></td>
											<td width="30%" align="left"></td>
										</tr>
									</table>
								</div>
								<input type="hidden" name="field_name" value="logo_image">
								<div class="text-center">
									<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loader">
								</div>

							</form>
							<div id="uploaded_image" align="center"></div>

							<br>

							<div align="center">
								<h3>Select Image</h3>
							</div>
							@foreach($photo as $p)
							<div class="col-md-3">
								<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="writelink{{$p['id']}}()" data-dismiss="modal">
								<input type="hidden" name="link" id="image_link_modal{{$p['id']}}" value="{{$p['image_url']}}">
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

		<div id="modal-image1" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">	 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
						<span aria-hidden="true" >&times;</span>
					</button>                     
					</div>
					<div class="alert" id="message1" style="display: none"></div>
					<div class="modal-body">
						<div class="row">
							<div align="center"><h3>Upload Image</h3></div>
							<form method="POST" id="upload_form1" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="form-group">
									<table class="table">
										<tr>
											<td width="40%" align="right"><label>Select File for Upload</label></td>
											<td width="30"><input type="file" name="select_file" id="select_file" /></td>
											<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
										</tr>
									</table>
								</div>
								<input type="hidden" name="field_name" value="side_logo">
								<div class="text-center">
									<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loader1">
								</div>

							</form>
							<div id="uploaded_image1" align="center"></div>

							<br>

							<div align="center">
								<h3>Select Image</h3>
							</div>
							@foreach($photo as $p)
							<div class="col-md-3">
								<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="writesidelogolink{{$p['id']}}()" data-dismiss="modal">
								<input type="hidden" name="link" id="image_link_modalnew{{$p['id']}}" value="{{$p['image_url']}}">
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
		<div id="modal-image2" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
						<span aria-hidden="true" >&times;</span>
					</button>    	                  
					</div>
					<div class="modal-body">
						<div class="alert" id="message2" style="display: none"></div>
						<div class="row">
							<div align="center"><h3>Upload Image</h3></div>
							<form method="POST" id="upload_form2" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="form-group">
									<table class="table">
										<tr>
											<td width="40%" align="right"><label>Select File for Upload</label></td>
											<td width="30"><input type="file" name="select_file" id="select_file" /></td>
											<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
										</tr>
										<tr>
											<td width="40%" align="right"></td>
											<td width="30"><span class="text-muted">jpg, png, gif</span></td>
											<td width="30%" align="left"></td>
										</tr>
									</table>
								</div>
								<input type="hidden" name="field_name" value="logo_image">
								<div class="text-center">
									<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loader2">
								</div>

							</form>
							<div id="uploaded_image2" align="center"></div>

							<br>

							<div align="center">
								<h3>Select Image</h3>
							</div>
							@foreach($photo as $p)
							<div class="col-md-3">
								<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="writelinknep{{$p['id']}}()" data-dismiss="modal">
								<input type="hidden" name="link" id="image_link_modalnaya{{$p['id']}}" value="{{$p['image_url']}}">
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
		@foreach($photo as $p)
		<script type="text/javascript">
			function writelink{{$p['id']}}()
			{	
				var link = document.getElementById('image_link_modal{{$p['id']}}');
				document.getElementById('logo_image').value = link.value;
			}

		</script>

		<script type="text/javascript">
			function writelinknep{{$p['id']}}()
			{	
				var link = document.getElementById('image_link_modalnaya{{$p['id']}}');
				document.getElementById('flag').value = link.value;
			}

		</script>
		<script type="text/javascript">
			function writesidelogolink{{$p['id']}}()
			{	
				var link = document.getElementById('image_link_modalnew{{$p['id']}}');
				document.getElementById('side_logo').value = link.value;
			}
		</script>
		@endforeach

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<script>
			$(document).ready(function(){

				$('#upload_form').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-photo-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loader").show();
						},
						success:function(data)
						{
							$('#loader').hide();
							$('#modal-image').modal('hide');
							$('#message').css('display', 'block');
							$('#message').html(data.message);
							$('#message').addClass(data.class_name);
							$('#uploaded_image').html(data.uploaded_image);
							$('#logo_image').val(data.image_url);
							$('#script').html(data.script);
						}
					})
				});

			});
		</script>

		<script>
			$(document).ready(function(){

				$('#upload_form1').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-photo-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loader1").show();
						},

						success:function(data)
						{
							$('#loader1').hide();
							$('#modal-image1').modal('hide');
							$('#message1').css('display', 'block');
							$('#message1').html(data.message);
							$('#message1').addClass(data.class_name);
							$('#uploaded_image1').html(data.uploaded_image);
							$('#side_logo').val(data.image_url);
						}
					})
				});

			});
		</script>

		<script>
			$(document).ready(function(){

				$('#upload_form2').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-photo-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loader2").show();
						},

						success:function(data)
						{
							$('#loader2').hide();
							$('#modal-image2').modal('hide');
							$('#message2').css('display', 'block');
							$('#message2').html(data.message);
							$('#message2').addClass(data.class_name);
							$('#uploaded_image2').html(data.uploaded_image);
							$('#flag').val(data.image_url);
						}
					})
				});

			});
		</script>
		@endsection