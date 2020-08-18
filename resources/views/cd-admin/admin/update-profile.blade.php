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
			<span>Edit Profile</span>
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
				<span class="caption-subject font-dark sbold uppercase">Edit Profile</span>
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
			<form class="form-horizontal" method="post" action="{{route('update-profile')}}" role="form" enctype="multipart/form-data">
			@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Enter User Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="username" placeholder="Enter user name" value="{{$data['user_name']}}">
						</div>
						@if ($errors->has('username'))
							<span class="text-danger">{{ $errors->first('username') }}</span>
							@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Enter Full Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="fullname" placeholder="Enter full name" value="{{$data['full_name']}}">
						</div>
						@if ($errors->has('fullname'))
							<span class="text-danger">{{ $errors->first('fullname') }}</span>
							@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Uplaod Image</label>
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
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
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