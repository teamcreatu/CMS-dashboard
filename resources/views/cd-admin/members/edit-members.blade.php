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
			<a href="{{url('cd-admin/view-members')}}">View Staffs</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit Staffs</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('edit-members',$data['id'])}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Edit Staffs</span>
				</div>
			</div>
			@if ($errors->has('name_ne'))
			<span class="text-danger">{{ $errors->first('name_ne') }}Please Open the Nepali Tab</span>
			<br>
			@endif
			
			@if ($errors->has('post_ne'))
			<span class="text-danger">{{ $errors->first('post_ne') }}Please Open the Nepali Tab</span>
			<br>
			@endif

			@if ($errors->has('section_ne'))
			<span class="text-danger">{{ $errors->first('section_ne') }}Please Open the Nepali Tab</span>
			<br>

			@endif
			@if ($errors->has('summary_ne'))
			<span class="text-danger">{{ $errors->first('summary_ne') }}Please Open the Nepali Tab</span>
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
										<div class="form-group col-md-12">
											<label class=" control-label">Name<span class="cd-admin-required">*</span></label>
											<div>
												<input type="text" class="form-control" name="name" placeholder="Enter Member Name" value="{{$data['name']}}">
											</div>
											@if ($errors->has('name'))
											<span class="text-danger">{{ $errors->first('name') }}</span>
											@endif
										</div>
										
										<div class="form-group col-md-6" id="remove2" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display:block;"':'style="display:none;"' ?>>
											<label class="control-label">From-To Date</label>
											<div>
												<textarea type="text" class="form-control" name="from_to" style="height: 35px;">{{$data['from_to']}}</textarea>
											</div>
											@if ($errors->has('from_to'))
											<span class="text-danger">{{ $errors->first('from_to') }}</span>
											@endif
										</div>

										<div class="form-group col-md-6">
											<label class=" control-label">Post<span class="cd-admin-required">*</span></label>
											<div>
												<input type="text" class="form-control" name="post" placeholder="Enter Post" value="{{$data['post']}}" required>
											</div>
											@if ($errors->has('post'))
											<span class="text-danger">{{ $errors->first('post') }}</span>
											@endif
										</div>

										<div class="form-group col-md-6" id="remove10" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display: none;"':'style="display: block;"' ?>>
											<label class=" control-label">Section</label>
											<div>
												<input type="text" class="form-control" name="section" placeholder="Enter Section" value="{{$data['section']}}">
											</div>
											@if ($errors->has('section'))
											<span class="text-danger">{{ $errors->first('section') }}</span>
											@endif
										</div>

										<div class="col-md-12">
											<hr>	
										</div>

										<div class="form-group col-md-12" id="remove7" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display: none;"':'style="display: block;' ?>>
											<label class=" control-label">Summary</label>
											<div>
												<textarea type="text" class="form-control summernote" name="summary" placeholder="Write Something about the staff">{{$data['summary']}}</textarea>
											</div>
											@if ($errors->has('summary'))
											<span class="text-danger">{{ $errors->first('summary') }}</span>
											@endif
										</div>

										<div class="form-group col-md-12">
											<label class=" control-label">Bio</label>
											<div>
												<textarea type="text" class="form-control summernote" name="bio" placeholder="Write Something about the staff">{{$data['bio']}}</textarea>
											</div>
											@if ($errors->has('bio'))
											<span class="text-danger">{{ $errors->first('bio') }}</span>
											@endif
										</div>
										
									</div>
								</div>

								<div class="tab-pane" id="tab_2">
									<div class="portlet-body">
										<div class="form-group col-md-12">
											<label class=" control-label">सदस्यको नाम<span class="cd-admin-required">*</span></label>
											<div>
												<input type="text" class="form-control" name="name_ne" placeholder="फोटो शीर्षक प्रविष्ट गर्नुहोस्" value="{{$data['name_ne']}}">
											</div>
											@if ($errors->has('name_ne'))
											<span class="text-danger">{{ $errors->first('name_ne') }}</span>
											@endif
										</div>

										<div class="form-group col-md-6" id="remove6" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display: none;"':'style="display: block;"' ?>>
											<label class=" control-label">Section</label>
											<div>
												<input type="text" class="form-control" name="section_ne" placeholder="Enter Section(देवानगिरिमा)" value="{{$data['section_ne']}}">
											</div>
											@if ($errors->has('section_ne'))
											<span class="text-danger">{{ $errors->first('section_ne') }}</span>
											@endif
										</div>

										<div class="form-group col-md-6" >
											<label class=" control-label">पोष्ट<span class="cd-admin-required">*</span></label>
											<div>
												<input type="text" class="form-control" name="post_ne" placeholder="Enter Post(देवानगिरिमा)" value="{{$data['post_ne']}}">
											</div>
											@if ($errors->has('post_ne'))
											<span class="text-danger">{{ $errors->first('post_ne') }}</span>
											@endif
										</div>
										<div class="form-group col-md-4" id="remove3" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display:block;"':'style="display:none;' ?>>
											<label class="control-label">From-To Date Nepali</label>
											<div>
												<textarea type="text" class="form-control" name="from_to_ne" style="height: 35px;">{{$data['from_to_ne']}}</textarea>
											</div>
											@if ($errors->has('from_to_ne'))
											<span class="text-danger">{{ $errors->first('from_to_ne') }}</span>
											@endif
										</div>
										<div class="form-group col-md-12" id="remove5" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display: none;"':'style="display: block;' ?>>
											<label class=" control-label">Summary(In Nepali)</label>
											<div>
												<textarea type="text" class="form-control summernote" name="summary_ne" placeholder="Write Something about the staff">{{$data['summary_ne']}}</textarea>
											</div>
											@if ($errors->has('summary_ne'))
											<span class="text-danger">{{ $errors->first('summary_ne') }}</span>
											@endif
										</div>
										<div class="form-group col-md-12">
											<label class=" control-label">Bio(In Nepali)</label>
											<div>
												<textarea type="text" class="form-control summernote" name="bio_ne" placeholder="Write Something about the staff">{{$data['bio_ne']}}</textarea>
											</div>
											@if ($errors->has('bio_ne'))
											<span class="text-danger">{{ $errors->first('bio_ne') }}</span>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-body">
							<div class="form-group col-md-6">
								<label class="control-label">Is Ex-PrimeMinister <span class="cd-admin-required">*</span></label>
								<div>
									<div class="mt-radio-inline">
										<label class="mt-radio" style="margin-bottom: 0;">
											<input type="radio" name="is_expm" id="optionsRadios25" value="yes" <?php echo $data['is_expm'] == 'yes'?'checked':'' ?>  onclick="checkPM()"> Yes 
											<span></span>
										</label>
										<label class="mt-radio" style="margin-bottom: 0;">
											<input type="radio" name="is_expm" id="optionsRadios26" value="no" <?php echo $data['is_expm'] == 'no'?'checked':'' ?> onclick="checkPM()"> No
											<span></span>
										</label>
									</div>
								</div>
								@if ($errors->has('is_expm'))
								<span class="text-danger">{{ $errors->first('is_expm') }}</span>
								@endif
							</div>

							<div class="form-group col-md-6">
								<label class="control-label">Is Former Chief Secretary <span class="cd-admin-required">*</span></label>
								<div>
									<div class="mt-radio-inline">
										<label class="mt-radio" style="margin-bottom: 0;">
											<input type="radio" name="is_excs" id="optionsRadios25" value="yes" <?php echo $data['is_excs'] == 'yes'?'checked':'' ?>  onclick="checkCS()"> Yes 
											<span></span>
										</label>
										<label class="mt-radio" style="margin-bottom: 0;">
											<input type="radio" name="is_excs" id="optionsRadios26" value="no" <?php echo $data['is_excs'] == 'no'?'checked':'' ?> onclick="checkCS()"> No
											<span></span>
										</label>
									</div>
								</div>
								@if ($errors->has('is_excs'))
								<span class="text-danger">{{ $errors->first('is_excs') }}</span>
								@endif
							</div>

							<div class="form-group col-md-12">
								<label class="control-label">Under Category<span class="cd-admin-required">*</span></label>
								<div>
									<?php $decode = json_decode($data['category_id']); ?>
									<select class="mt-multiselect btn btn-default " name="category[]" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true">
										@foreach($category as $rc)
										@if(in_array($rc['id'],$decode))
										<option value="{{$rc['id']}}" selected>{{$rc['name']}}</option>
										@else
										<option value="{{$rc['id']}}">{{$rc['name']}}</option>
										@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group col-md-6" id="remove9" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display: none;"':'style="display: block;' ?>>
								<label class=" control-label">Email Address</label>
								<div>
									<input type="email" class="form-control" name="email" placeholder="Enter Email Address" value="{{$data['email']}}">
								</div>
								@if ($errors->has('email'))
								<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>

							<div class="form-group col-md-6" id="remove8" <?php echo $data['is_excs'] == 'yes' || $data['is_expm'] == 'yes' ?'style="display: none;"':'style="display: block;' ?>>
								<label class=" control-label">Contact Number</label>
								<div>
									<input type="number" class="form-control" name="contact_no" placeholder="Enter Contact Number" value="{{$data['contact_no']}}">
								</div>
								@if ($errors->has('contact_no'))
								<span class="text-danger">{{ $errors->first('contact_no') }}</span>
								@endif
							</div>

							<div class="form-group col-md-3">
								<label class=" control-label">Order<span class="cd-admin-required">*</span></label>
								<div>
									<input type="number" class="form-control" name="order" placeholder="Enter Order Number" value="{{$data['order_no']}}">
								</div>
								@if ($errors->has('order'))
								<span class="text-danger">{{ $errors->first('order') }}</span>
								@endif
							</div>

							<div class="form-group col-md-9">
								<label class="col-md-12 pa-0 control-label">Image</label>
								<div class="col-md-8 pa-0">
									<input type="text" name="image_name" class="form-control" placeholder="Enter Image URL" id="logo_image" value="{{$data['image_url']}}">
								</div>
								<div class="col-md-4 pa-0">
									<a href="#modal-image" data-toggle="modal">
										<button class="btn btn-success" style="width: 100%;"><i class="fa fa-picture-o"></i> Select Image</button>
									</a>
								</div>

								@if ($errors->has('image_name'))
								<span class="text-danger">{{ $errors->first('image_name') }}</span>
								@endif
							</div>

							<div class="col-md-12">
								<hr>
							</div>

							<div class="form-group col-md-12 text-center">
								<label class="control-label">Status <span class="cd-admin-required">*</span></label>
								<div>
									<div class="mt-radio-inline">
										<label class="mt-radio">
											<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo $data['status'] == 'active'?'checked':'' ?>> Active
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

							<div class="col-md-12">
								<hr>
							</div>

							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary" style="margin:auto;">Submit</button>
								<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
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

	<script type="text/javascript">
		function checkPM() 
		{
			menu_type = $("input:radio[name=is_expm]:checked").val();
			if (menu_type == 'yes') 
			{
				document.getElementById('remove2').style.display="block";
				document.getElementById('remove3').style.display="block";
				document.getElementById('remove5').style.display="none";
				document.getElementById('remove6').style.display="none";
				document.getElementById('remove7').style.display="none";
				document.getElementById('remove8').style.display="none";
				document.getElementById('remove9').style.display="none";
				document.getElementById('remove10').style.display="none";
			}
			else
			{
				document.getElementById('remove2').style.display="none";
				document.getElementById('remove3').style.display="none";
				document.getElementById('remove5').style.display="block";
				document.getElementById('remove6').style.display="block";
				document.getElementById('remove7').style.display="block";
				document.getElementById('remove8').style.display="block";
				document.getElementById('remove9').style.display="block";
				document.getElementById('remove10').style.display="block";
			}
		}
	</script>

	<script type="text/javascript">
		function checkCS() 
		{
			menu_type = $("input:radio[name=is_excs]:checked").val();
			if (menu_type == 'yes') 
			{
				document.getElementById('remove2').style.display="block";
				document.getElementById('remove3').style.display="block";
				document.getElementById('remove5').style.display="none";
				document.getElementById('remove6').style.display="none";
				document.getElementById('remove7').style.display="none";
				document.getElementById('remove8').style.display="none";
				document.getElementById('remove9').style.display="none";
				document.getElementById('remove10').style.display="none";
			}
			else
			{
				document.getElementById('remove2').style.display="none";
				document.getElementById('remove3').style.display="none";
				document.getElementById('remove5').style.display="block";
				document.getElementById('remove6').style.display="block";
				document.getElementById('remove7').style.display="block";
				document.getElementById('remove8').style.display="block";
				document.getElementById('remove9').style.display="block";
				document.getElementById('remove10').style.display="block";
			}
		}
	</script>
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
	@endsection