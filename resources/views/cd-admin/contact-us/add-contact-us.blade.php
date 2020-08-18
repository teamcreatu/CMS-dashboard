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
			<a href="{{url('cd-admin/view-contact-us')}}">View Contact Us</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Contact Us</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('add-contact-us')}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Add Contact Us</span>
				</div>
			</div>
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
									<label class="control-label">Description<span class="cd-admin-required">*</span></label>
									<br>
									<div>
										<textarea type="text" class="form-control summernote" name="description" placeholder="Enter Description">{!!old('description')!!}</textarea>
									</div>
									@if ($errors->has('description'))
									<span class="text-danger">{{ $errors->first('description') }}</span>
									@endif
								</div>
								<div class="form-group">
									<label class="control-label">Facebook Page Link</label>
									<br>
									<div>
										<input type="url" class="form-control" name="fb_link" placeholder="Enter Facebook Page Link" value="{{old('fb_link')}}">
									</div>
									@if ($errors->has('fb_link'))
									<span class="text-danger">{{ $errors->first('fb_link') }}</span>
									@endif
								</div>
								<div class="form-group">
									<label class="control-label">Twitter Page Link</label>
									<br>
									<div>
										<input type="url" class="form-control" name="tw_link" placeholder="Enter Twitter Page Link"  value="{{old('tw_link')}}">
									</div>
									@if ($errors->has('tw_link'))
									<span class="text-danger">{{ $errors->first('tw_link') }}</span>
									@endif
								</div>
								<div class="form-group">
									<label class="control-label">Instagram Page Link</label>
									<br>
									<div>
										<input type="url" class="form-control" name="insta_link" placeholder="Enter Instagram Page Link"  value="{{old('insta_link')}}">
									</div>
									@if ($errors->has('insta_link'))
									<span class="text-danger">{{ $errors->first('insta_link') }}</span>
									@endif
								</div>
								<div class="form-group">
									<label class="control-label">Email Address</label>
									<br>
									<div>
										<input type="email" class="form-control" name="email_id" placeholder="Enter Video Title"  value="{{old('email_id')}}">
									</div>
									@if ($errors->has('email_id'))
									<span class="text-danger">{{ $errors->first('email_id') }}</span>
									@endif
								</div>
								<div class="form-group"> 
									<label class="control-label">Emergency Contact</label>
									<br>
									<div>
										<input type="number" class="form-control" name="emergency_contact" placeholder="Enter Emergency Contact" value="{{old('emergency_contact')}}">
									</div>
									@if ($errors->has('emergency_contact'))
									<span class="text-danger">{{ $errors->first('emergency_contact') }}</span>
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

						<div class="tab-pane" id="tab_2">
							<div class="portlet-body">
								<div class="form-group">
									<label class=" control-label">वर्णन<small>(देवानगिरिमा)</small><span class="cd-admin-required">*</span></label>
									<div>
										<textarea type="text" class="form-control summernote" name="description_ne" placeholder="वर्णन">{!!old('description_ne')!!}</textarea>
									</div>
									@if ($errors->has('description_ne'))
									<span class="text-danger">{{ $errors->first('description_ne') }}</span>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
		</div>
		<button type="submit" class="btn btn-btn-primary" style="margin:auto;">Submit</button>
		<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

	</form>
	@endsection