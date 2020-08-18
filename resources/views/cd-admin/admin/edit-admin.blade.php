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
			<a href="{{url('cd-admin/view-all-admin')}}">View all admin</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit admin</span>
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
				<span class="caption-subject font-dark sbold uppercase">Edit admin</span>
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
			<form class="form-horizontal" method="post" action="{{url('cd-admin/updateAdmin/'.$finalResult['user']['id'])}}" role="form" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group col-md-3">
						<label class="control-label">Enter User Name<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="text" class="form-control" name="username" placeholder="Enter user name" value="{{$finalResult['user']['user_name']}}">
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="control-label">Enter Full Name<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="text" class="form-control" name="fullname" placeholder="Enter full name" value="{{$finalResult['user']['full_name']}}" readonly="">
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="control-label">Enter Email<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{$finalResult['user']['email']}}">
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="control-label">Role<span class="cd-admin-required">*</span></label>
						<div class="">
							<select class="form-control" id="inputUserType3" placeholder="--select--" name="role">

								@foreach($finalResult['role'] as $role)
								<option {{$finalResult['userRole']['role_id'] == $role['id'] ? 'selected' : ''}} value="{{$role['id']}}">{!!$role['name']!!}</option>
								@endforeach
							</select>
						</div>
					</div>
					
					<div class="col-md-12">
						<hr>
					</div>

					<div class="form-group col-md-12 text-center">
						<label class="control-label">Uplaod Image</label>
						<div class="">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 300px; height: 150px;"> </div>
								<div>
									<span class="btn red btn-outline btn-file">
										<span class="fileinput-new"> Select image </span>
										<span class="fileinput-exists"> Change </span>
										<input type="file" name="image_name"> 
									</span>
									<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
								</div>
							</div>
						</div>
						@if ($errors->has('image_name'))
						<span class="text-danger">{{ $errors->first('image_name') }}</span>
						@endif
					</div>



					<!-- status section starts -->
					<div class="col-md-12">
						<hr>
					</div>

					<div class="form-group col-md-12 text-center">
						<label class="control-label">Status<span class="cd-admin-required">*</span></label>
						<div class="">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio"{{$finalResult['user']['active_status'] == 1 ? 'checked' : ''}} name="status" id="optionsRadios25" value="1" checked=""> Active
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio"{{$finalResult['user']['active_status'] == 0 ? 'checked' : ''}} name="status" id="optionsRadios26" value="0" > Inactive
									<span></span>
								</label>
							</div>
						</div>
					</div>
					<!-- status section ends -->
					
					<div class="col-md-12">
						<hr>
					</div>
				</div>

				<div class="form-actions">
					<div class="row">
						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{URL()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>

@endsection