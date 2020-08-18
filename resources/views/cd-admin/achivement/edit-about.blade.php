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
			<a href="{{url('cd-admin/view-all-about')}}">View all about</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit about</span>
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
				<span class="caption-subject font-dark sbold uppercase">Edit about</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Enter about title</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter about title">
						</div>
					</div>
					<div class="form-group last">
						<label class="control-label col-md-3">Enter about description</label>
						<div class="col-md-6">
							<div name="summernote" id="summernote_1"> </div>
						</div>
					</div>


					<!-- seo section starts -->
					<hr>
					<div class="form-group">
						<label class="col-md-3 control-label">Enter seo title</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter seo title">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Enter seo keywords</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter seo keywords">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Enter seo description</label>
						<div class="col-md-6">
							<textarea class="form-control" rows="5" placeholder="Enter seo description"></textarea>
						</div>
					</div>
					<!-- seo section ends -->

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
							<button type="submit" class="btn btn-primary">Edit</button>
							<button type="button" class="btn btn-danger">Cancel</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>

@endsection