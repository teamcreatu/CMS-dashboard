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
			<a href="{{url('cd-admin/view-member-category')}}">View Link Category</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Link Category</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Link Category</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{route('add-links-category')}}" method="POST">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Category Name<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" placeholder="Enter Category Name" value="{{old('name')}}">
						</div>
						@if ($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">श्रेणीको नाम<small style="color: red">(देवानगिरिमा)</small><span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name_ne" placeholder=" श्रेणीको नाम प्रविष्ट गर्नुहोस्" value="{{old('name_ne')}}">
						</div>
						@if ($errors->has('name_ne'))
						<span class="text-danger">{{ $errors->first('name_ne') }}</span>
						@endif
					</div>
					<!-- status section starts -->
					<hr>
					<div class="form-group">
						<label class="col-md-3 control-label">Status<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo old('status') == 'active' ?'checked':'' ?>> Active
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios26" value="inactive" <?php echo old('status') == 'inactive' ?'checked':'' ?>> Inactive
									<span></span>
								</label>
							</div>
						</div>
						@if ($errors->has('status'))
						<span class="text-danger">{{ $errors->first('status') }}</span>
						@endif
					</div>
					<!-- status section ends -->

				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">Submit</button>
							<a href="{{url()->previous()}}"><button type="button" class="btn default">Cancel</button></a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>

@endsection