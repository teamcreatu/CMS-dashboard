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
			<a href="{{url('cd-admin/view-photos')}}">View Photos</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Photos</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Photos</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{route('add-photos')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Thumbnail Images(Multiple)<span class="cd-admin-required">*</span></label>
						<br>
						<div class="col-md-6">
							<input type="file" name="image_name[]" multiple required>
						</div>
						@if ($errors->has('image_name'))
						<span class="text-danger">{{ $errors->first('image_name') }}</span>
						@endif
						@if ($errors->has('image_name.*'))
						<span class="text-danger">{{ $errors->first('image_name.*') }}</span>
						@endif
					</div>

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

			{{-- <form id="fileupload" action="{{route('add-photos')}}" method="POST" enctype="multipart/form-data">
				
				<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
				<div class="row fileupload-buttonbar">
					<div class="col-lg-7">
						<!-- The fileinput-button span is used to style the file input field as button -->
						<span class="btn green fileinput-button">
							<i class="fa fa-plus"></i>
							<span> Add files... </span>
							<input type="file" name="files[]" multiple=""> </span>
							<button type="submit" class="btn blue start">
								<i class="fa fa-upload"></i>
								<span> Start upload </span>
							</button>
							<button type="reset" class="btn warning cancel">
								<i class="fa fa-ban-circle"></i>
								<span> Cancel upload </span>
							</button>
							<button type="button" class="btn red delete">
								<i class="fa fa-trash"></i>
								<span> Delete </span>
							</button>
							<input type="checkbox" class="toggle">
							<!-- The global file processing state -->
							<span class="fileupload-process"> </span>
						</div>
						<!-- The global progress information -->
						<div class="col-lg-5 fileupload-progress fade">
							<!-- The global progress bar -->
							<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								<div class="progress-bar progress-bar-success" style="width:0%;"> </div>
							</div>
							<!-- The extended global progress information -->
							<div class="progress-extended"> &nbsp; </div>
						</div>
					</div>
					<!-- The table listing the files available for upload/download -->
					<table role="presentation" class="table table-striped clearfix">
						<tbody class="files"> </tbody>
					</table>
				</form>
			</div> --}}
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>

	@endsection