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
			<a href="{{url('cd-admin/view-all-creatu-testimonial')}}">View all Creatu Testimonial</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit Creatu Testimonial</span>
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
				<span class="caption-subject font-dark sbold uppercase">Edit Creatu Testimonial</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Enter title</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter title">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Enter description</label>
						<div class="col-md-6">
							<div>
								<textarea name="description" id="summernote_1"></textarea>
							 </div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Designation</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter Designation" name="designation" value="{{old('designation')}}">
						</div>
					</div>


					<!-- status section starts -->
					<hr>
					<div class="form-group">
						<label class="col-md-3 control-label">Status</label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked=""> Active
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> Inactive
									<span></span>
								</label>
							</div>
						</div>
					</div>
					<!-- status section ends -->

				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">Update</button>
							<button type="button" class="btn default">Cancel</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>

@endsection