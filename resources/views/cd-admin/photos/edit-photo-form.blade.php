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
			<span>Edit Photos</span>
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
			<form class="form-horizontal" role="form" action="{{route('edit-photo',$data['id'])}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Photo Title<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="image_title" placeholder="Enter Photo Title" value="{{$data['image_title']}}">
						</div>
						@if ($errors->has('image_title'))
							<span class="text-danger">{{ $errors->first('image_title') }}</span>
							@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">फोटोको शीर्षक <span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="image_title_ne" placeholder="फोटो शीर्षक प्रविष्ट गर्नुहोस्" value="{{$data['image_title_ne']}}">
						</div>
						@if ($errors->has('image_title_ne'))
							<span class="text-danger">{{ $errors->first('image_title_ne') }}</span>
							@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Thumbnail Image<span class="cd-admin-required">*</span></label>
						<br>
						<div class="col-md-6">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
								<div>
									<span class="btn red btn-outline btn-file">
										<span class="fileinput-new"> Select image </span>
										<span class="fileinput-exists"> Change </span>
										<input type="file" name="image_name"> </span>
										<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
									</div>
								</div>
							</div>
							@if ($errors->has('image_name'))
							<span class="text-danger">{{ $errors->first('image_name') }}</span>
							@endif
						</div>

						{{-- <div class="form-group">
							<label class="col-md-3 control-label">Other Images</label>
							<div class="col-md-6">
								<input type="file" name="images[]" multiple class="form-control">
							</div>
							@if ($errors->has('images'))
							<span class="text-danger">{{ $errors->first('images') }}</span>
							@endif
							@if ($errors->has('images.*'))
							<span class="text-danger">{{ $errors->first('images.*') }}</span>
							@endif
						</div>
 --}}
						<div class="form-group">
							<label class="control-label col-md-3">Tags</label>
							<div class="col-md-6">
								<input type="text" class="form-control input-large" name="tags" value="{{$data['tags']}}" data-role="tagsinput"> </div>
								@if ($errors->has('tags'))
							<span class="text-danger">{{ $errors->first('tags') }}</span>
							@endif
							</div>
							<!-- seo section starts -->
							{{-- <hr>
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

 --}}
							<!-- status section starts -->
							<hr>
							<div class="form-group">
								<label class="col-md-3 control-label">Status<span class="cd-admin-required">*</span></label>
								<div class="col-md-6">
									<div class="mt-radio-inline">
										<label class="mt-radio">
											<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo $data->status == 'active' ? 'checked': ''  ?>> Active
											<span></span>
										</label>
										<label class="mt-radio">
											<input type="radio" name="status" id="optionsRadios26" value="inactive" <?php echo $data->status == 'inactive' ?'checked': '' ?>> Inactive
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