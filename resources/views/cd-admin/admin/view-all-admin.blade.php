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
	</li>
	<li>
		<span>View all admin</span>
	</li>
</ul>
</div>
<!-- END PAGE BAR -->
@if(Session::has('success'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>INSERTED SUCCESSFULLY!!!</strong> {{ Session::get('message', '') }}
</div>
@elseif(Session::has('failure'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>DELETED SUCCESSFULLY!!!</strong> {{ Session::get('message', '') }}
</div>
@endif

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase"> View All admin </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-users','users'))
					<a href="{{url('cd-admin/add-admin')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add New Admin
							<i class="fa fa-plus"></i>
						</button>
					</a>
					@endif
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>SN</th>
							<th> Name </th>
							<th> Email </th>
							<th> Role </th>
							<th>Status</th>
							<th> Actions </th>
						</tr>
					</thead>
					<tbody>
						@foreach($finalResult as $final)
						<tr class="odd gradeX">
							<td>{{$loop->iteration}}</td>
							<td>{{$final->user_name}}</td>
							<td>{{$final->email}}</td>
							<td>{{$final->role->detail->name}}</td>
							<td>
								@if(Gate::check('edit-users','users'))

								<form action="{{route('update-admin-status',$final['id'])}}" method="POST">
									@csrf
									<div class="btn-group">
										@if($final->active_status == '1')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($final->active_status == '1')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									@else
									@if($final->active_status == '1')
									<button class="btn btn-xs btn-success" type="submit">Active</button>
									@else
									<button class="btn btn-xs btn-danger" type="submit">Inactive</button>
									@endif
									@endif
								</td>
								
								<td>
									<a data-toggle="modal" href="#view-modal{{$final->id}}">
										<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
									</a>
									@if(Gate::check('edit-users','users'))
									<a href="{{url('cd-admin/edit-admin/'.$final->id)}}">
										<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
									</a>
									<a data-toggle="modal" href="#reset-modal{{$final->id}}">
										<button class="label label-sm label-success" data-toggle="tooltip" title="Send Password Reset Link"><i class="fa fa-key"></i></button>
									</a>
									@endif
									@if(Gate::check('delete-users','users'))
									<a data-toggle="modal" href="#delete-modal{{$final->id}}">
										<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
									</a>
									@endif
								</td>
							</tr>
							@endforeach
							
							
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>

	<!-- view modals -->
	@foreach($finalResult as $final)
	<div id="view-modal{{$final->id}}" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title pull-left">{{$final->full_name}}</h4>
					@if($final->active_status == 1)
					<p class="modal-title pull-right">Status 
						<span class="badge badge-success"> Active </span>
					</p>
					@else
					<p class="modal-title pull-right">Status 
						<span class="badge badge-danger"> In-Active </span>
					</p>
					@endif
				</div>
				<div class="modal-body">
					{{-- <img src="{{url('public/images/2.jpg')}}" alt="" class="img-responsive"> --}}
					<ul class="list-group">
						<li class="list-group-item">Name : <span class="badge badge-success">{{$final->full_name}}</span></li>
						<li class="list-group-item">Email: <span class="badge badge-success">{{$final->email}}</span></li>
						<li class="list-group-item">Role: <span class="badge badge-success">{{$final->role->detail->name}}</span></li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach


	<!-- delete modal -->
	@foreach($finalResult as $final)
	<div class="modal fade" id="delete-modal{{$final->id}}" tabindex="-1" role="basic" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<div class="modal-body"> Are you sure want to delete this ? </div>
				<div class="modal-footer">
					<button type="button" class="btn dark btn-outline" data-dismiss="modal">No</button>
					<a href="{{url('cd-admin/deleteAdmin/'.$final->id)}}"  class="btn green">YES</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	@endforeach

	<!-- delete modal -->
	@foreach($finalResult as $final)
	<div class="modal fade" id="reset-modal{{$final->id}}" tabindex="-1" role="basic" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Reset Password</h4>
				</div>
				<form class="form-horizontal" action="{{route('reset-password',$final->id)}}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-4 control-label">New Password<span class="cd-admin-required">*</span></label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password" placeholder="Enter New Password">
								</div>
								@if ($errors->has('password'))
								<span class="text-danger">{{ $errors->first('password') }}</span>
								@endif
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Retype New Password<span class="cd-admin-required">*</span></label>
								<div class="col-md-6">
									<input type="password" class="form-control" placeholder="Re enter Password" name="confirm_password">
								</div>
								@if ($errors->has('confirm_password'))
								<span class="text-danger">{{ $errors->first('confirm_password') }}</span>
								@endif
							</div>
							<hr>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
							<button class="btn green" type="submit">Change Password</button>				
						</div>
					</div>
				</form>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>
	@endforeach

	@endsection