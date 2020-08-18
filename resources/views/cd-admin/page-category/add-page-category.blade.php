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
			<a href="{{url('cd-admin/view-all-pageCategory')}}">View page category</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add page category</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Page Category</span>
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
			<form class="form-horizontal" role="form" action="{{url('cd-admin/insert-pageCategory')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">

					<div class="form-group">
						<label class="col-md-3 control-label">Enter Page Category Name<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter page category name" name="name" required>
						</div>
						@if ($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"> शीर्षक <small>(देवानगिरिमा)</small><span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title_ne" placeholder=" शीर्षक प्रविष्ट गर्नुहोस्" value="{{old('image_title_ne')}}">
						</div>
						@if ($errors->has('title_ne'))
						<span class="text-danger">{{ $errors->first('title_ne') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Parent Category<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<select class="bs-select form-control" data-live-search="true" data-size="8" name="parent_category" required>
								<option  selected="" value="NULL">Default</option>
								@foreach($category as $c)
								<option value="{{$c->id}}">{{$c->name}}</option>
								@endforeach
							</select>
						</div>
						@if ($errors->has('parent_category'))
						<span class="text-danger">{{ $errors->first('parent_category') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Image</label>
						<br>
						<div class="col-md-6">
							<input type="text" name="image_name" class="form-control" placeholder="Enter Image URL" id="image" value="{{old('image_name')}}">
						</div>
						<div class="col-md-1">
							<a href="#modal-image" data-toggle="modal">
								<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Image</button>
							</a>
						</div>
						<div align="right">
										<a href="{{route('add-photos-form')}}">
											<span class="btn btn-success" style="margin-right: 22px;"> 
												Upload Image
											</span>
										</a>
									</div>
						@if ($errors->has('image_name'))
						<span class="text-danger">{{ $errors->first('image_name') }}</span>
						@endif
					</div>


					<!-- status section starts -->
					<hr>
					<div class="form-group">
						<label class="col-md-3 control-label">Status<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios25" value="active" required checked> Active
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios26" value="inactive" required> Inactive
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
<div id="modal-image" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">	                  
				</div>
				<div class="modal-body">
					<div class="row">
						@foreach($photo as $p)
						<div class="col-md-3" data-dismiss="modal">
							<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="writelink{{$p['id']}}()">
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
			document.getElementById('image').value = link.value;
		}
	</script>
	@endforeach
@endsection