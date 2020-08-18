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
			<a href="{{url('cd-admin/view-videos')}}">View Videos</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Videos</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Videos</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{route('add-videos')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Title</label>
						<br>
						<div class="col-md-6">
							<input type="text" name="title" class="form-control" value="{{old('title')}}">
						</div>
						@if ($errors->has('title'))
						<span class="text-danger">{{ $errors->first('title') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Video<span class="cd-admin-required">*</span></label>
						<br>
						<div class="col-md-6">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
								<div>
									<span class="btn red btn-outline btn-file">
										<span class="fileinput-new"> Select Video </span>
										<span class="fileinput-exists"> Change </span>
										<input type="file" name="video_name"> </span>
										<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
									</div>
								</div>
							</div>
							@if ($errors->has('video_name'))
							<span class="text-danger">{{ $errors->first('video_name') }}</span>
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
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>

	@endsection