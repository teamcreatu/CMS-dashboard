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
		<span>View all Role</span>
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
					<span class="caption-subject bold uppercase"> View All Role </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-rolesAndpermission','rolesAndpermission'))

					<a href="{{url('cd-admin/add-role')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add New Role
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
							<th> Actions </th>
						</tr>
					</thead>
					<tbody>
						@foreach($role as $final)
						<tr class="odd gradeX">
							<td>{{$loop->iteration}}</td>
							<td>{{$final->name}}</td>
							
							
							<td>
								<a data-toggle="modal" href="#view-modal{{$final->id}}">
									<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>	
								</a>
								@if(Gate::check('edit-rolesAndpermission','rolesAndpermission'))
								<a href="{{url('cd-admin/edit-role/'.$final->id)}}">
									<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>				
								</a>
								@endif
								@if(Gate::check('delete-rolesAndpermission','rolesAndpermission'))
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
@foreach($role as $final)
<?php $per = App\RolePermission::where('role_id',$final['id'])->get()->first();
$dec = json_decode($per['mode']);	
?>

<div id="view-modal{{$final->id}}" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pull-left">{{$final->name}}</h4>

			</div>
			<div class="modal-body">

				<h4 class="">Name : {{$final->name}}</h4>

				<h4 class="">Permissions </h4>

				<ul class="list-group">
					@foreach($dec as $key=>$d)
					<li class="list-group-item">
						{{$d->name}} : 
						<span class="badge badge-success"> {{$d->mode}} </span>
					</li>
					@endforeach
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
@foreach($role as $final)
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
				<a href="{{url('cd-admin/deleteRole/'.$final->id)}}"  class="btn green">YES</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@endforeach

<!-- delete modal -->


@endsection