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
			<a href="{{url('cd-admin/view-video-gallery')}}">View Video Gallery</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Video Gallery</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('add-video-gallery')}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Add Video Gallery</span>
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
												<input type="text" class="form-control" name="title" placeholder="Enter Video Title" value="{{old('title')}}">
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
											<label class=" control-label">भिडियोको शीर्षक<span class="cd-admin-required">*</span></label>
											<div>
												<input type="text" class="form-control" name="title_ne" placeholder="भिडियोको शीर्षक प्रविष्ट गर्नुहोस्" value="{{old('title_ne')}}">
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
							<div class="portlet-body">
								<div class="form-group">
									<label class="control-label">Video<span class="cd-admin-required">*</span></label>
									<br>
									<div>
										<input type="text" name="video_name" class="form-control" placeholder="Enter Video URL" id="video_url" value="{{old('video_name')}}">
									</div>
									<div class="pull-right">
										<a href="#modal-image" data-toggle="modal">
											<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Video</button>
										</a>
									</div>
									@if ($errors->has('video_name'))
									<span class="text-danger">{{ $errors->first('video_name') }}</span>
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
					<div class="row">
						<div class="alert" id="message" style="display: none"></div>
						<div align="center"><h3>Upload Video</h3></div>
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

						<div id="uploaded_image" align="center"></div>
						<div align="center">
							<h3>Select Video</h3>
						</div>
						@foreach($video as $v)
						<div class="col-md-3">
							<video width="250" height="200" controls>
								<source src="{{Request::root().'/'.$v['video_url']}}">
								</video>
								<div align="center">
									<span class="btn btn-success" onclick="writelink{{$v['id']}}()" data-dismiss="modal" style="margin:auto;">Select</span>
									<input type="hidden" name="link" id="image_link_modal{{$v['id']}}" value="{{$v['video_url']}}">
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
		@foreach($video as $v)
		<script type="text/javascript">
			function writelink{{$v['id']}}()
			{	
				var link = document.getElementById('image_link_modal{{$v['id']}}');
				document.getElementById('video_url').value = link.value;
			}
		</script>
		<script type="text/javascript">

			function writemultiplelink{{$v['id']}}()
			{	
				var link = document.getElementById('image_link_modal1{{$v['id']}}');
				var mul = document.getElementById('multiple_image');
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<script>
			$(document).ready(function(){

				$('#upload_form').on('submit', function(event){
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

		@endsection