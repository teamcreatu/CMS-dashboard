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
		<span>View Menu</span>
	</li>
</ul>
</div>
<!-- END PAGE BAR -->

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase"> View Menu </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('edit-header','header'))
					<a href="{{url('cd-admin/sort-mainMenu')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Sort Main Menu
							<i class="fa fa-plus"></i>
						</button>
					</a>
					<a href="{{url('cd-admin/sort-sideMenu')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Sort Side Menu
							<i class="fa fa-plus"></i>
						</button>
					</a>
					@endif
					@if(Gate::check('add-header','header'))
					<a href="{{url('cd-admin/add-mainMenu')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Menu
							<i class="fa fa-plus"></i>
						</button>
					</a>
					
					@endif
				</div>
			</div>

			<div align="center">
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>SN</th>
							<th>शीर्षक</th>
							<th>Title</th>
							<th>Menu Type</th>
							<th>Priority</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($menu as $e)
							<td>{{$count}}</td>
							<td>{{$e['menu_name_ne']}}</td>
							<td>{!!$e['menu_name']!!}</td>
							<td>{{$e['menu_type']}}</td>
							<td>{{$e['priority_no']}}</td>
							<td>
								@if(Gate::check('edit-header','header'))
								<form action="{{url('cd-admin/update-menu-status',$e->id)}}" method="POST">
									@csrf
									<div class="btn-group">
										@if($e->active_status == 'active')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($e->active_status == 'active')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									@else
									@if($e->active_status == 'active')
									<button class="btn btn-xs green dropdown-toggle">Active
										@else
										<button class="btn btn-xs red dropdown-toggle">Inactive
											@endif
											@endif
										</td>
										<td>
											<a href="{{url('cd-admin/view-one-menu',$e['id'])}}">
												<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>								
											</a>
											@if(Gate::check('edit-header','header'))
											<a href="{{url('cd-admin/edit-mainMenu',$e['id'])}}">
												<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>											
											</a>
											@endif
											@if(Gate::check('delete-header','header'))
											<a data-toggle="modal" href="#delete-modal{{$e['id']}}">
												<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>	
											</a>
											@endif
										</td>
									</tr>
									<?php $count++ ?>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- delete modal -->
@foreach($menu as $e)
<div class="modal fade" id="delete-modal{{$e['id']}}" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Delete</h4>
			</div>
			<div class="modal-body"> Are you sure want to delete {{$e->file_name}} ? </div>
			<div class="modal-footer">
				<form action="{{url('cd-admin/delete-mainMenu',$e['id'])}}" method="POST">
					@csrf
					<button type="button" class="btn dark btn-outline" data-dismiss="modal">NO</button>
					<button class="btn green" type="submit">YES</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@endforeach
@endsection