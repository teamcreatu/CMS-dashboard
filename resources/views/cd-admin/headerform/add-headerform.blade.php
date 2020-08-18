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
			<a href="{{url('cd-admin/view-all-header')}}">View Header</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Header</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Header</span>
			</div>
		</div>
		@if($errors->any())
		<div class="alert alert-danger">
			@foreach($errors->all() as $e)
			<li>{{$e}}</li>
			@endforeach
		</div>
		@endif
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{url('cd-admin/insertHeader')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">

					<div class="form-group">
						<label class="col-md-3 control-label">Name<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter name" name="name" required>
						</div>
						@if ($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Type<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter" name="type" required>
						</div>
						@if ($errors->has('type'))
						<span class="text-danger">{{ $errors->first('type') }}</span>
						@endif
					</div>
					<br>
					
						<div class="form-group">
							<label class="control-label col-md-3">Color Picker(Upper Menu)</label>
							<div class="col-md-6">
								<input type="text" class="colorpicker-rgba form-control" name="color_picker_upper" value="rgba(255,255,255,1)" data-color-format="rgba" /> 
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Color Picker(Lower Menu)</label>
							<div class="col-md-6">
								<input type="text" class="colorpicker-rgba form-control" name="color_picker_lower" value="rgba(255,255,255,1)" data-color-format="rgba" /> 
							</div>
						</div>
						<!-- status section starts -->
						<hr>
						<div class="form-group">
							<label class="col-md-3 control-label">Show Main Menu<span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="radio" name="show_main_menu" id="optionsRadios25" value="show" required checked> Show
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="show_main_menu" id="optionsRadios26" value="hide" required> Hide
										<span></span>
									</label>
								</div>
							</div>
							@if ($errors->has('show_main_menu'))
							<span class="text-danger">{{ $errors->first('show_main_menu') }}</span>
							@endif
						</div>


						<div class="form-group">
							<label class="col-md-3 control-label">Show Side Menu<span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="radio" name="show_side_menu" id="optionsRadios25" value="show" required checked> Show
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="show_side_menu" id="optionsRadios26" value="hide" required> Hide
										<span></span>
									</label>
								</div>
							</div>
							@if ($errors->has('status'))
							<span class="text-danger">{{ $errors->first('status') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Value<span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="radio" name="value" id="optionsRadios25" value="1" required checked> Active
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="value" id="optionsRadios26" value="0" required> Inactive
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
								<button type="submit" class="btn btn-primary">Submit</button>
								<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>

	@endsection