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
			<a href="{{url('cd-admin/view-make-widgets')}}">View Made Widgets</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Make Widgets</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('add-make-widget')}}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Add Make Widgets</span>
				</div>
			</div>
			@if ($errors->has('title_ne'))
			<span class="text-danger">{{ $errors->first('title_ne') }}Please Open the Nepali Tab</span>
			@endif
			<br>
			@if ($errors->has('summary_ne'))
			<span class="text-danger">{{ $errors->first('summary_ne') }}Please Open the Nepali Tab</span>
			@endif
			<br>
			@if ($errors->has('description_ne'))
			<span class="text-danger">{{ $errors->first('description_ne') }}Please Open the Nepali Tab</span>
			@endif
			<div class="portlet-body form">
				<div class="tabbable-line tabbable-custom-profile">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_1" data-toggle="tab">English </a>
						</li>
						<li>
							<a href="#tab_2" data-toggle="tab"> Nepali </a>
						</li>
					</ul>
				</div>
				<div class="form-body">
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<div class="portlet-body">
								
								<div class="form-group">
									<label class="col-md-3 control-label">Title<span class="cd-admin-required">*</span></label>
									<div>
										<input type="text" class="form-control" name="title" placeholder="Enter Post Title" value="{{old('title')}}">
									</div>
									@if ($errors->has('title'))
									<span class="text-danger">{{ $errors->first('title') }}</span>
									@endif
								</div>
								
								<div class="form-group">
									<label class=" control-label">Description<span class="cd-admin-required">*</span></label>
									<div>
										<textarea type="text" class="form-control summernote" name="description" id="addLinkEng" id="addImage">{!!old('description')!!}</textarea>
									</div>
									@if ($errors->has('description'))
									<span class="text-danger">{{ $errors->first('description') }}</span>
									@endif
								</div>
								<a href="#modal-file" data-toggle="modal">
									<span class="btn btn-primary" >Add Files</span>
								</a>
								<a href="#modal-image" data-toggle="modal">
									<span class="btn btn-primary" >Add Images</span>
								</a>
								{{-- <a href="#modal-videos" data-toggle="modal">
									<span class="btn btn-primary" >Add Videos</span>
								</a> --}}
								<br>

								<div id="test"></div>
								<div class="form-group">
									<label class=" control-label">Featured Image</label>
									<br>
									<div class="">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
											<div>
												<span class="btn red btn-outline btn-file">
													<span class="fileinput-new"> Select image </span>
													<span class="fileinput-exists"> Change </span>
													<input type="file" name="image_name"> </span>
													<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
												</div>
											</div>
										</div>
										@if ($errors->has('image_name'))
										<span class="text-danger">{{ $errors->first('image_name') }}</span>
										@endif
									</div>
									<br>
									
									
									
									<div class="form-group">
										<label class="control-label">Status <span class="cd-admin-required">*</span></label>
										<div>
											<div class="mt-radio-inline">
												<label class="mt-radio">
													<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo old('status') == 'active'?'checked':'' ?> checked> Active
													<span></span>
												</label>
												<label class="mt-radio">
													<input type="radio" name="status" id="optionsRadios26" value="inactive" <?php echo old('status') == 'inactive'?'checked':'' ?>> Inactive
													<span></span>
												</label>
											</div>
										</div>
										@if ($errors->has('status'))
										<span class="text-danger">{{ $errors->first('status') }}</span>
										@endif
									</div>
								</div>
							</div>

							<div class="tab-pane" id="tab_2">
								<div class="portlet-body">
									<div class="form-group">
										<label class=" control-label">शीर्षक<span class="cd-admin-required">*</span></label>
										<div>
											<input type="text" class="form-control" name="title_ne" placeholder=" शीर्षक प्रविष्ट गर्नुहोस्" value="{{old('title_ne')}}">
										</div>
										@if ($errors->has('title_ne'))
										<span class="text-danger">{{ $errors->first('title_ne') }}</span>
										@endif
									</div>
									
									<div class="form-group">
										<label class="control-label">बिबरण<span class="cd-admin-required">*</span></label>
										<div>
											<textarea type="text" class="form-control summernote" name="description_ne" id="addLinkNep" id="addImageNep">{!!old('description_ne')!!}</textarea>
										</div>
										@if ($errors->has('description_ne'))
										<span class="text-danger">{{ $errors->first('description_ne') }}</span>
										@endif
									</div>
									<a href="#modal-file1" data-toggle="modal">
										<span class="btn btn-primary" >Add Files</span>
									</a>
									<a href="#modal-image1" data-toggle="modal">
										<span class="btn btn-primary" >Add Images</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END SAMPLE FORM PORTLET-->
			</div>
			<button type="submit" class="btn btn-primary" style="margin:auto;">Submit</button>
			<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

		</form>

		<div id="modal-file" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
							<span aria-hidden="true" >&times;</span>
						</button>        	
						
					</div>
					<div class="modal-body">
						<div class="alert" id="messagefile" style="display: none"></div>
						<div align="center"><h3>Upload File</h3></div>
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
										<td width="30%" align="left"></td>
									</tr>
								</table>
							</div>
							<input type="hidden" name="field_name" value="logo_image">
						</form>
						<br>

						<div align="center">
							<h3>Select File</h3>
						</div>
						<?php $count = 1 ?>
						@foreach($file as $p)
						<div class="col-md-12 opmcm-menu-url" onclick="writelink{{$p['id']}}()" data-dismiss="modal">
							<p><b>{{$count}})</b>{{$p['file_title']}}({{$p['file_title_ne']}})</p>
							<input type="hidden" name="link" id="image_link_modal{{$p['id']}}" value="{{$p['file_url']}}">
						</div>
						<?php $count++ ?>
						@endforeach
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-file1" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
							<span aria-hidden="true" >&times;</span>
						</button>        	                  
					</div>
					<div class="modal-body">
						<div class="alert" id="messagefile1" style="display: none"></div>
						<div align="center"><h3>Upload File</h3></div>
						<form method="POST" id="upload_form1" enctype="multipart/form-data">
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
										<td width="30%" align="left"></td>
									</tr>
								</table>
							</div>
							<input type="hidden" name="field_name" value="logo_image">
						</form>
						<br>

						<div align="center">
							<h3>Select File</h3>
						</div>
						<?php $count = 1 ?>
						@foreach($file as $p)
						<div class="col-md-12 opmcm-menu-url" onclick="writelinknep{{$p['id']}}()" data-dismiss="modal">
							<p><b>{{$count}})</b>{{$p['file_title']}}({{$p['file_title_ne']}})</p>
							<input type="hidden" name="link" id="image_link_modalnep{{$p['id']}}" value="{{$p['file_url']}}">
						</div>
						<?php $count++ ?>
						@endforeach
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
					</div>
				</div>
			</div>
		</div>



		{{-- Image Modals --}}



		<div id="modal-image" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
							<span aria-hidden="true" >&times;</span>
						</button>        	                  
					</div>
					<div class="modal-body">
						<div class="alert" id="messagephoto" style="display: none"></div>
						<div class="row">
							<div align="center"><h3>Upload Image</h3></div>
							<form method="POST" id="upload_image_form" enctype="multipart/form-data">
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
							</form>
							<div id="uploaded_image_photo" align="center"></div>

							<br>

							<div align="center">
								<h3>Select Image</h3>
							</div>
							@foreach($photo as $p)
							<div class="col-md-3">
								<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="addPhoto{{$p['id']}}()" data-dismiss="modal">
								<input type="hidden" name="link" id="image_modal{{$p['id']}}" value="{{$p['image_url']}}">
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
					<div class="modal-body">
						<div class="alert" id="messagephoto1" style="display: none"></div>
						<div class="row">
							<div align="center"><h3>Upload Image</h3></div>
							<form method="POST" id="upload_image_form1" enctype="multipart/form-data">
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
							</form>
							<div id="uploaded_image_photo1" align="center"></div>

							<br>

							<div align="center">
								<h3>Select Image</h3>
							</div>
							@foreach($photo as $p)
							<div class="col-md-3">
								<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="addPhotonep{{$p['id']}}()" data-dismiss="modal">
								<input type="hidden" name="link" id="image_modal1nep{{$p['id']}}" value="{{$p['image_url']}}">
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

		{{-- Video Modals  --}}

		<div id="modal-videos" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
							<span aria-hidden="true" >&times;</span>
						</button>        	                  
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="alert" id="message" style="display: none"></div>
							<div align="center"><h3>Upload Video</h3></div>
							<form method="POST" id="upload_video_form" enctype="multipart/form-data">
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
											<td width="30%" align="left"></td>
										</tr>
									</table>
								</div>
								<input type="hidden" name="field_name" value="logo_image">
							</form>

							<br>

							<div id="uploaded_video" align="center"></div>
							<div align="center">
								<h3>Select Video</h3>
							</div>
							@foreach($video as $v)
							<div class="col-md-3">
								<video width="250" height="200" controls>
									<source src="{{Request::root().'/'.$v['video_url']}}">
									</video>
									<div align="center">
										<span class="btn btn-success" onclick="addVideo{{$v['id']}}()" data-dismiss="modal" style="margin:auto;">Select</span>
										<input type="hidden" name="link" id="video_modal{{$v['id']}}" value="{{$v['video_url']}}">
									</div>
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

			<div id="modal-videos1" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
								<span aria-hidden="true" >&times;</span>
							</button>        	                  
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="alert" id="messagevideo1" style="display: none"></div>
								<div align="center"><h3>Upload Video</h3></div>
								<form method="POST" id="upload_video_form1" enctype="multipart/form-data">
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
												<td width="30%" align="left"></td>
											</tr>
										</table>
									</div>
									<input type="hidden" name="field_name" value="logo_image">
								</form>

								<br>

								<div id="uploaded_video1" align="center"></div>
								<div align="center">
									<h3>Select Video</h3>
								</div>
								@foreach($video as $v)
								<div class="col-md-3">
									<video width="250" height="200" controls>
										<source src="{{Request::root().'/'.$v['video_url']}}">
										</video>
										<div align="center">
											<span class="btn btn-success" onclick="addVideonep{{$v['id']}}()" data-dismiss="modal" style="margin:auto;">Select</span>
											<input type="hidden" name="link" id="video_modal1{{$v['id']}}" value="{{$v['video_url']}}">
										</div>
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


				@foreach($file as $p)
				<script type="text/javascript">
					function writelink{{$p['id']}}()
					{	
						var link = document.getElementById('image_link_modal{{$p['id']}}');
						$('#addLinkEng').summernote('createLink', {
							text: '{{$p['file_title']}}',
							url: '{{Request()->root()}}'+'/'+link.value,
							isNewWindow: true
						});
					}
				</script>
				<script type="text/javascript">
					function writelinknep{{$p['id']}}()
					{	
						var link = document.getElementById('image_link_modalnep{{$p['id']}}');
						$('#addLinkNep').summernote('createLink', {
							text: '{{$p['file_title']}}',
							url: '{{Request()->root()}}'+'/'+link.value,
							isNewWindow: true
						});
					}
				</script>
				@endforeach

				@foreach($photo as $ph)
				<script type="text/javascript">
					function addPhoto{{$ph['id']}}()
					{	
						var link = document.getElementById('image_modal{{$ph['id']}}');
						$('#addLinkEng').summernote('insertImage','{{Request::root()}}'+'/'+link.value);

					}
				</script>
				<script type="text/javascript">
					function addPhotonep{{$ph['id']}}()
					{	
						var link = document.getElementById('image_modal1nep{{$ph['id']}}');
						$('#addLinkNep').summernote('insertImage','{{Request::root()}}'+'/'+link.value);

					}
				</script>
				@endforeach

					{{-- @foreach($video as $vi)
					<script type="text/javascript">
						function addVideo{{$vi['id']}}()
						{	
							var link = document.getElementById('video_modal{{$vi['id']}}');
							video = '<video width="320" height="240" controls><source src="'+'{{Request::root()}}'+link.value+'"></video>';
							$('#test').html(video);
						}
					</script>
					<script type="text/javascript">
						function addVideonep{{$vi['id']}}()
						{	
							var link = document.getElementById('video_modal1{{$ph['id']}}');
							alert(link.value);
							$('#addLinkNep').summernote('insertImage','{{Request::root()}}'+'/'+link.value);

						}
					</script>
					@endforeach --}}
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

					<script>
						$(document).ready(function(){

							$('#upload_form').on('submit', function(event){
								event.preventDefault();
								$.ajax({
									url:"{{ route('add-post-files-dynamic') }}",
									method:"POST",
									data:new FormData(this),
									dataType:'JSON',
									contentType: false,
									cache: false,
									processData: false,
									success:function(data)
									{
										$('#messagefile').css('display', 'block');
										$('#messagefile').html(data.message);
										$('#messagefile').addClass(data.class_name);
										$('#uploaded_image').html(data.uploaded_image);
										$('#addLinkEng').summernote('createLink', {
											text: data.title,
											url: data.image_url,
											isNewWindow: true
										});
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
									url:"{{ route('add-post-files-dynamic') }}",
									method:"POST",
									data:new FormData(this),
									dataType:'JSON',
									contentType: false,
									cache: false,
									processData: false,
									success:function(data)
									{
										$('#messagefile1').css('display', 'block');
										$('#messagefile1').html(data.message);
										$('#messagefile1').addClass(data.class_name);
										$('#addLinkNep').summernote('createLink', {
											text: data.title,
											url: data.image_url,
											isNewWindow: true
										});
									}
								})
							});

						});
					</script>


					{{-- Image Scripts --}}
					<script>
						$(document).ready(function(){

							$('#upload_image_form').on('submit', function(event){
								event.preventDefault();
								$.ajax({
									url:"{{ route('add-photo-dynamic') }}",
									method:"POST",
									data:new FormData(this),
									dataType:'JSON',
									contentType: false,
									cache: false,
									processData: false,
									success:function(data)
									{
										var url = '{{Request::root()}}'+'/'+data.image_url;
										$('#messagephoto').css('display','block');
										$('#messagephoto').html(data.message);
										$('#messagephoto').addClass(data.class_name);
										$('#uploaded_image_photo').html(data.uploaded_image);
										$('#addLinkEng').summernote('insertImage',url);
									}
								})
							});

						});
					</script>
					<script>
						$(document).ready(function(){

							$('#upload_image_form1').on('submit', function(event){
								event.preventDefault();
								$.ajax({
									url:"{{ route('add-photo-dynamic') }}",
									method:"POST",
									data:new FormData(this),
									dataType:'JSON',
									contentType: false,
									cache: false,
									processData: false,
									success:function(data)
									{
										var url = '{{Request::root()}}'+'/'+data.image_url;
										$('#messagephoto1').css('display', 'block');
										$('#messagephoto1').html(data.message);
										$('#messagephoto1').addClass(data.class_name);
										$('#uploaded_image_photo1').html(data.uploaded_image);
										$('#addLinkNep').summernote('insertImage',url);
									}
								})
							});

						});
					</script>
					{{-- Video Scripts	 --}}

					<script>
						$(document).ready(function(){

							$('#upload_video_form').on('submit', function(event){
								event.preventDefault();
								$.ajax({
									url:"{{ route('add-videos-dynamic') }}",
									method:"POST",
									data:new FormData(this),
									dataType:'JSON',
									contentType: false,
									cache: false,
									processData: false,
									success:function(data)
									{
										$('#message').css('display', 'block');
										$('#message').html(data.message);
										$('#message').addClass(data.class_name);
										$('#uploaded_image').html(data.uploaded_image);
										$('#video_url').val(data.image_url);
									}
								})
							});

						});
					</script>

					<script>
						$(document).ready(function(){

							$('#upload_video_form1').on('submit', function(event){
								event.preventDefault();
								$.ajax({
									url:"{{ route('add-videos-dynamic') }}",
									method:"POST",
									data:new FormData(this),
									dataType:'JSON',
									contentType: false,
									cache: false,
									processData: false,
									success:function(data)
									{
										$('#messagevideo1').css('display', 'block');
										$('#messagevideo1').html(data.message);
										$('#messagevideo1').addClass(data.class_name);
										$('#uploaded_video1').html(data.uploaded_image);
										$('#video_url1').val(data.image_url);
									}
								})
							});

						});
					</script>

			 {{-- $video = $('<iframe>')
            .attr('frameborder', 0)
            .attr('src', '//www.youtube.com/embed/' + youtubeId)
            .attr('width', '640').attr('height', '360'); --}}
            @endsection
