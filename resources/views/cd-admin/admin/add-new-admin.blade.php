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
			<span>Add new admin</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add New admin</span>
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
			<form class="form-horizontal" method="post" action="{{url('cd-admin/insertAdmin')}}" role="form" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group col-md-3">
						<label class="control-label">Enter User Name<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="text" class="form-control" name="username" placeholder="Enter user name">
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="control-label">Enter Full Name<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="text" class="form-control" name="fullname" placeholder="Enter full name">
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="control-label">Enter Email<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="email" class="form-control" name="email" placeholder="Enter Email">
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="control-label">Role<span class="cd-admin-required">*</span></label>
						<div class="">
							<select class="form-control" id="inputUserType3" placeholder="--select--" name="role">
								<option selected="" disabled="">Select Admin Role</option>
								@foreach($role as $role)
								<option value="{{$role->id}}">{!!$role->name!!}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="control-label"><span style="color: #fff">*</span></label>
						<input type="text" name="rand_password" class="form-control" style="display: none;" id="rand_passwordview">
					</div>
					<div class="form-group col-md-3">
						<label class="control-label">Enter Password<span class="cd-admin-required">*</span></label>
						<div class="">
							<input type="password" class="form-control" name="password" placeholder="Enter password" id="new_password">
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label"><span style="color: #fff">*</span></label>
						<span class="btn btn-primary" onclick="password_generator(20)" style="display:block;">Generate Password</span>
					</div>
					<div class="form-group col-md-3">
						<label class="control-label"><span style="color: #fff">*</span></label>
						<span class="btn btn-success" onclick="use_password()" id="randpasswordbutton" style="display: none;">Use Generated Password</span>
					</div>

					<div class="col-md-12">
						<hr>
					</div>

					<div class="form-group col-md-12 text-center">
						<label class="control-label">Upload Image</label>
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
					
					<div class="col-md-12">
						<hr>
					</div>

					{{-- <div class="form-group">
						<label class="col-md-3 control-label">Permission</label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								@foreach($permission as $per)
								<label class="mt-radio">
									<input type="radio" name="permission" id="optionsRadios25" value="{{$per->id}}"> {{$per['name']}}
									<span></span>
								</label>
								@endforeach
								<label class="mt-radio">
									<input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked=""> Inactive
									<span></span>
								</label>
							</div>
						</div>
					</div> --}}


					<!-- status section starts -->
					<div class="form-group col-md-12 text-center">
						<label class="control-label">Status<span class="cd-admin-required">*</span></label>
						<div class="">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios25" value="1" checked> Active
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios26" value="0" > Inactive
									<span></span>
								</label>
							</div>
						</div>
					</div>
					<!-- status section ends -->

				</div>

				<div class="col-md-12">
					<hr>
				</div>

				<div class="form-actions">
					<div class="row">
						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="{{URL()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>

<script type="text/javascript">
	function password_generator(len) {
		var length = (len)?(len):(10);
    var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
    var numeric = '0123456789';
    var punctuation = '!@#$%^&*()_+~`|}{[]\:;?><,./-=';
    var password = "";
    var character = "";
    var crunch = true;
    while( password.length<length ) {
    	entity1 = Math.ceil(string.length * Math.random()*Math.random());
    	entity2 = Math.ceil(numeric.length * Math.random()*Math.random());
    	entity3 = Math.ceil(punctuation.length * Math.random()*Math.random());
    	hold = string.charAt( entity1 );
    	hold = (password.length%2==0)?(hold.toUpperCase()):(hold);
    	character += hold;
    	character += numeric.charAt( entity2 );
    	character += punctuation.charAt( entity3 );
    	password = character;
    }
    password=password.split('').sort(function(){return 0.5-Math.random()}).join('');   
    document.getElementById('rand_passwordview').value = password.substr(0,len); 
    document.getElementById('rand_passwordview').style.display = 'block';
    document.getElementById('randpasswordbutton').style.display = 'block';

}
</script>

<script type="text/javascript">
	function use_password()
	{
		password = document.getElementById('rand_passwordview').value;
		document.getElementById('new_password').value = password;
	}
</script>
@endsection