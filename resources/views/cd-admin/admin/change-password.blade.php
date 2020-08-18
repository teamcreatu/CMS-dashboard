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
			<span>Change Password</span>
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
				<span class="caption-subject font-dark sbold uppercase">Change Password</span>
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
			<form class="form-horizontal" method="post" action="{{route('change-password')}}" role="form">
			@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Enter Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password" placeholder="Enter New Password" id="new_password">
						</div>
						<div class="col-md-3">
							<input type="text" name="rand_password" class="form-control" style="display: none;" id="rand_passwordview">
							<div class="col-md-4">
							<span class="btn btn-success" onclick="use_password()" id="randpasswordbutton" style="display: none; margin-top: 10px;">Use</span>
							</div>
							<div class="col-md-6">
							<span class="btn btn-primary" onclick="password_generator(20)" style=" margin-top: 10px;">Generate Password</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Re-Enter Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="confirm_password" placeholder="Enter New Password Again" id="new_password1">
						</div>

					</div>

				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="{{URL()->previous()}}"><button type="button" class="btn btn-daner">Cancel</button></a>
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
		document.getElementById('new_password1').value = password;

	}
</script>
@endsection