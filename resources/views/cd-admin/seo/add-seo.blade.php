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
			<a href="{{url('cd-admin/view-links')}}">View SEO</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add SEO</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add SEO</span>
			</div>
		</div>
		
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{route('add-seo')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">

					<div class="form-group">
						<label class="col-md-3 control-label">SEO Title<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Enter SEO Title" required>
						</div>
						@if ($errors->has('title'))
						<span class="text-danger">{{ $errors->first('title') }}</span>
						@endif
					</div>	
					<div class="form-group">
						<label class="col-md-3 control-label">SEO शीर्षक<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="देवनागरीमा SEO शीर्षक प्रविष्ट गर्नुहोस्" name="title_ne" required>
						</div>
						@if ($errors->has('title_ne'))
						<span class="text-danger">{{ $errors->first('title_ne') }}</span>
						@endif
					</div>	
					<div class="form-group">
						<label class="col-md-3 control-label">SEO Description</label>
						<div class="col-md-6">
							<textarea type="text" class="form-control" placeholder="Enter SEO Description" name="description" ></textarea>
						</div>
						@if ($errors->has('description'))
						<span class="text-danger">{{ $errors->first('description') }}</span>
						@endif
					</div>	

					<div class="form-group">
						<label class="col-md-3 control-label">SEO वर्णन</label>
						<div class="col-md-6">
							<textarea type="text" class="form-control" placeholder="Enter SEO वर्णन" name="description_ne"></textarea>
						</div>
						@if ($errors->has('description_ne'))
						<span class="text-danger">{{ $errors->first('description_ne') }}</span>
						@endif
					</div>	

					<div class="form-group">
						<label class="col-md-3 control-label">SEO Keywords<span class="cd-admin-required" id="remove1" style="display:none;">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter SEO title" name="keywords"  data-role="tagsinput" >
						</div>
						@if ($errors->has('keywords'))
						<span class="text-danger">{{ $errors->first('keywords') }}</span>
						@endif
					</div>	

					<div class="form-group">
						<label class="col-md-3 control-label">SEO Keywords(Nepali)<span class="cd-admin-required" id="remove1" style="display:none;">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter SEO keywords" name="keywords_ne"  data-role="tagsinput" >
						</div>
						@if ($errors->has('keywords_ne'))
						<span class="text-danger">{{ $errors->first('keywords_ne') }}</span>
						@endif
					</div>					
					<!-- status section starts -->
					<hr>

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