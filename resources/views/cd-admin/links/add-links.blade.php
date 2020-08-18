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
			<a href="{{url('cd-admin/view-links')}}">View Links</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Links</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Links</span>
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
			<form class="form-horizontal" role="form" action="{{route('add-links')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">

					<div class="form-group">
						<label class="col-md-3 control-label">Links Category<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<select name="links_category" class="form-control" id="links_category" onClick="checkParent()">
								<option value="parent" selected>Parent Link</option>
								@foreach($links_category as $lc)
									<option value="{{$lc['id']}}">{{$lc['title']}}</option>
								@endforeach
							</select>
						</div>
						@if ($errors->has('links_category'))
						<span class="text-danger">{{ $errors->first('links_category') }}</span>
						@endif
					</div>	
					<div class="form-group">
						<label class="col-md-3 control-label">Title<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter title" name="title" required>
						</div>
						@if ($errors->has('title'))
						<span class="text-danger">{{ $errors->first('title') }}</span>
						@endif
					</div>	

					<div class="form-group">
						<label class="col-md-3 control-label">शीर्षक<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="देवनागरीमा लिंक शीर्षक प्रविष्ट गर्नुहोस्" name="title_ne" required>
						</div>
						@if ($errors->has('title_ne'))
						<span class="text-danger">{{ $errors->first('title_ne') }}</span>
						@endif
					</div>	
					<div class="form-group">
						<label class="col-md-3 control-label">Link URL<span class="cd-admin-required" id="remove1" style="display:none;">*</span></label>
						<div class="col-md-6">
							<input type="url" class="form-control" placeholder="Enter Link URL" name="link_url" >
							<small class="cd-admin-required">Please Enter Full URL</small>
						</div>
						@if ($errors->has('link_url'))
						<span class="text-danger">{{ $errors->first('link_url') }}</span>
						@endif
					</div>					

					<div class="form-group">
						<label class="col-md-3 control-label">Priority No.<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="number" class="form-control" placeholder="Enter Priority No." name="priority_no" required value="{{old('priority_no')}}">
						</div>
						@if ($errors->has('link_url'))
						<span class="text-danger">{{ $errors->first('link_url') }}</span>
						@endif
					</div>	
					<!-- status section starts -->
					<hr>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Status<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios25" value="active" required> Active
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

<script type="text/javascript">
	function checkParent() 
	{
		links_category = document.getElementById('links_category').value;
		if (links_category == 'parent')
		{
			document.getElementById('remove1').style.display="none";
		}
		else
		{
			document.getElementById('remove1').style.display="inline-block";
		}
	}
</script>

@endsection