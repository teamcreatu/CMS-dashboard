@extends('cd-admin.admin-master')

<!-- page content -->
@section('content')

<!-- BEGIN PAGE BAR -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="{{url('cd-admin/dashboard')}}">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="{{url('cd-admin/view-photo-gallery')}}">View Gallery</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Gallery</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->




<form action="{{route('add-photo-gallery')}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Add Gallery</span>
				</div>
			</div>
			@if ($errors->has('title_ne'))
			<span class="text-danger">{{ $errors->first('title_ne') }}Please Open the Nepali Tab</span>
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
				<div class="row">
					<div class="col-md-6">
						<div class="form-body">
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div class="portlet-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Title<span class="cd-admin-required">*</span></label>
											<div>
												<input type="text" class="form-control" name="title" placeholder="Enter Event Title" value="{{old('title')}}">
											</div>
											@if ($errors->has('title'))
											<span class="text-danger">{{ $errors->first('title') }}</span>
											@endif
										</div>

									</div>
								</div>

								<div class="tab-pane" id="tab_2">
									<div class="portlet-body">
										<div class="form-group">
											<label class=" control-label">फोटोको शीर्षक<span class="cd-admin-required">*</span></label>
											<div>
												<input type="text" class="form-control" name="title_ne" placeholder="फोटो शीर्षक प्रविष्ट गर्नुहोस्" value="{{old('title_ne')}}">
											</div>
											@if ($errors->has('title_ne'))
											<span class="text-danger">{{ $errors->first('title_ne') }}</span>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-body">	
							<div class="form-group">
								<label class="control-label">Image<span class="cd-admin-required">*</span></label>
								<br>
								<div>
									<input type="text" name="image_name" class="form-control" placeholder="Enter Image URL" id="logo_image" value="{{old('image_name')}}">
								</div>
								<div class="pull-right">
									<a href="#modal-image" data-toggle="modal">
										<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Image</button>
									</a>
								</div>

								@if ($errors->has('image_name'))
								<span class="text-danger">{{ $errors->first('image_name') }}</span>
								@endif
							</div>
							<div class="form-group">
								<label class="control-label">Multiple Images</label>
								<br>
								<div>
									<input type="text" name="image_names" class="form-control" placeholder="Enter Image URL" id="multiple_image" value="{{old('image_names')}}">
								</div>
								<div class="pull-right">
									<a href="#modal-image1" data-toggle="modal">
										<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Images</button>
									</a>
								</div>

								@if ($errors->has('image_names'))
								<span class="text-danger">{{ $errors->first('image_names') }}</span>
								@endif
							</div>
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
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
		</div>
		<div class="text-center">
			<button type="submit" class="btn btn-primary" style="margin:auto;">Submit</button>
			<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>
		</div>
	</form>

	<div id="modal-image" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
						<span aria-hidden="true" >&times;</span>
					</button>        	                  
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
				<div class="modal-body">
					<ul class="nav nav-tabs"id="tabContent">
						<li class="active"><a href="#select_image" data-toggle="tab">Select Image</a></li>
						<li><a href="#upload_image" data-toggle="tab">Upload Image</a></li>
					</ul>
					<div class="row tab-content">
						<div class="tab-pane active" id="select_image">
							<div align="center">
								<h3>Select Image</h3>
							</div>
							@foreach($photo as $p)
							<div class="col-md-3">
								<img src="{{Request::root().'/'.$p['image_url']}}" height="150px" width="200px" class="selected{{$p['id']}}" style="border: dotted; margin:auto;" onclick="writemultiplelink{{$p['id']}}()">
								<span class="centered" id="target{{$p['id']}}" style="display: none; position: absolute; top:50%; left: 50%; transform: translate(-50%,-50%); color: #fff;background: green;padding: 10px;"><i class="fa fa-check"></i></span>
								<input type="hidden" name="link" id="image_link_modal1{{$p['id']}}" value="{{$p['image_url']}}">
							</div>
							@endforeach
						</div>
						<div class="tab-pane" id="upload_image">

							<br />
							<h3 align="center">Upload Images</h3>
							<br />

							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Select Image</h3>
								</div>
								<div class="panel-body">
									<form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
										@csrf
									</form>
								</div>
							</div>
							<br />
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Uploaded Image</h3>
								</div>

								<div class="panel-body" id="uploaded_image_multiple" >

								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<script type="text/javascript">
		$( document ).ready(function() {
			load_images();
		});
		Dropzone.options.imageUpload = {
			maxFilesize:10,
			acceptedFiles: ".jpeg,.jpg,.png,.gif"
		};

		Dropzone.options.dropzoneForm = {
			autoProcessQueue : true,
			acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
			parallelUploads: 100,

			init:function(){
				var submitButton = document.querySelector("#submit-all");
				myDropzone = this;

				this.on("complete", function(){
					if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
					{
						var _this = this;
						_this.removeAllFiles();
					}

					load_images();
				});

			}
		};

		load_images();

		function load_images()
		{

			$.ajax({
				url:"{{ route('dropzone.fetch') }}",
				success:function(data)
				{	
					$('#modal-image1').modal('hide');
					$('#uploaded_image_multiple').html(data.output);
					$('#multiple_image').val(data.url);
				}
			})
		}

		$(document).on('click', '.remove_image', function(){
			var name = $(this).attr('id');
			$.ajax({
				url:"{{ route('dropzone.delete') }}",
				data:{name : name},
				success:function(data){

					load_images();
				}
			})
		});



	</script>

	@foreach($photo as $p)
	<script type="text/javascript">
		function writelink{{$p['id']}}()
		{	
			var link = document.getElementById('image_link_modal{{$p['id']}}');
			document.getElementById('logo_image').value = link.value;
		}
	</script>
	<script type="text/javascript">

		function writemultiplelink{{$p['id']}}()
		{	
			var link = document.getElementById('image_link_modal1{{$p['id']}}');
			var mul = document.getElementById('multiple_image');
			document.getElementById('target{{$p['id']}}').style.display="block";
			if (mul.value == '') 
			{
				mul.value = link.value;
			}
			else
			{
				mul.value = mul.value + ',' + link.value;
			}

		}
	</script>

	@endforeach

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
						$('#multiple_image').append(data.image_url);
					}
				})
			});

		});
	</script>
	@endsection