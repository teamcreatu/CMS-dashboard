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
			<a href="{{url('cd-admin/view-carousel')}}">View Carousel</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit Carousel</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('edit-carousel',$data['id'])}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Edit Carousel</span>
				</div>
			</div>
			@if ($errors->has('title_ne'))
			<span class="text-danger">{{ $errors->first('title_ne') }}</span>
			@endif
			<br>
			@if ($errors->has('subtitle_ne'))
			<span class="text-danger">{{ $errors->first('subtitle_ne') }}</span>
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
											<label class="col-md-3 control-label">Title</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="title" placeholder="Enter Carousel Title" value="{{$data['title']}}">
											</div>
											@if ($errors->has('title'))
											<span class="text-danger">{{ $errors->first('title') }}</span>
											@endif
										</div>
										<br><br>
										<div class="form-group">
											<label class="col-md-3 control-label">Subtitle</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="{{$data['subtitle']}}">
											</div>
											@if ($errors->has('subtitle'))
											<span class="text-danger">{{ $errors->first('subtitle') }}</span>
											@endif
										</div>
										<br>
									</div>
								</div>

								<div class="tab-pane" id="tab_2">
									<div class="portlet-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Carouselको शीर्षक</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="title_ne" placeholder="फोटो शीर्षक प्रविष्ट गर्नुहोस्" value="{{$data['title_ne']}}">
											</div>
											@if ($errors->has('title_ne'))
											<span class="text-danger">{{ $errors->first('title_ne') }}</span>
											@endif
										</div>
										<br>
										<div class="form-group">
											<label class="col-md-3 control-label">Carouselको उपशीर्षक</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="subtitle_ne" placeholder="Carouselको उपशीर्षक प्रविष्ट गर्नुहोस्" value="{{$data['subtitle_ne']}}">
											</div>
											@if ($errors->has('image_title_ne'))
											<span class="text-danger">{{ $errors->first('subtitle_ne') }}</span>
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
								<label class="col-md-3 control-label">Image<span class="cd-admin-required">*</span></label>
								<div class="col-md-6">
									<input type="text" name="image_name" class="form-control" placeholder="Enter Image URL" id="logo_image"value="{{$data['image_url']}}">
								</div>
								<div class="col-md-3">
									<a href="#modal-image" data-toggle="modal">
										<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Image</button>
									</a>
								</div>
								@if ($errors->has('image_name'))
								<span class="text-danger">{{ $errors->first('image_name') }}</span>
								@endif
							</div>
							<br><br>
							<div class="form-group">
								<label class="col-md-3 control-label">Status <span class="cd-admin-required">*</span></label>
								<div class="col-md-6">
									<div class="mt-radio-inline" style="padding: 0;">
										<label class="mt-radio">
											<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo $data['status'] == 'active'?'checked':''  ?>> Active
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
						</div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
		</div>
		<button type="submit" class="btn btn-btn-primary" style="margin-left: 504px;">Submit</button>
		<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

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
	@foreach($photo as $p)
	<script type="text/javascript">
		function writelink{{$p['id']}}()
		{	
			var link = document.getElementById('image_link_modal{{$p['id']}}');
			document.getElementById('logo_image').value = link.value;
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
	@endsection