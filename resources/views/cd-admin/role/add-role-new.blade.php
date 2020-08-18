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
			<a href="{{url('cd-admin/view-all-role')}}">View all Role</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add new Role</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add New Role</span>
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
			<form class="form-horizontal" method="post" action="{{url('cd-admin/insertRole')}}" role="form">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Role Name<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" placeholder="Enter name">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Roles</label>
						<div class="col-md-6">
							<div class="input-group">
								<div class="icheck-inline">
									@foreach($permission as $key=>$p)
									<label>
										@if($p['name'] == 'all')
										<input type="checkbox" name="check" class="icheck all" value="{{$p['id']}}" id="all" onclick="checkall()"> {{$p['name']}} 
										@else
										<input type="checkbox" name="check" class="icheck all" value="{{$p['id']}}"> {{$p['name']}} 
										@endif
									</label>
									@if($key%3 == 2)
									<br>
									@endif
									@endforeach
								</div>
							</div>
						</div>
					</div>

					@foreach($permission1 as $p1)


					@endforeach
					<!-- status section starts -->

					<!-- status section ends -->

				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
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
	function checkall() {
		alert('here');
		document.getElementByClassName('all').checked = true;
	}
</script>
@endsection