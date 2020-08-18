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
		<span>View Header</span>
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
@if(count($header) != 0)
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase"> View Header</span>
				</div>
				<div class="btn-group pull-right">
					
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>SN</th>
							<th>Name</th>
							<th>Type</th>
							<th>Value</th>
							<th>Main Menu</th>
							<th>Side Menu</th>
							@if(Gate::check('edit-header','header'))
							<th>Actions</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach($header as $c)
						<tr class="odd gradeX">
							<td>{{$loop->iteration}}</td>
							<td>{{$c->name}}</td>
							<td>{{$c->type}}</td>
							<td>
								@if($c->value== 1)
								<span class="badge badge-success">yes</span>
								@else
								<span class="badge badge-danger">no</span>
								@endif
							</td>
							<td>{{$c->show_main_menu}}</td>
							<td>{{$c->show_side_menu}}</td>
							@if(Gate::check('edit-header','header'))
							<td>
								<a href="{{url('cd-admin/editHeader',$c->id)}}">
									<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i>
									</button>								
								</a>
								
							</td>
							@endif
						</tr>

						@endforeach						

					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
@else
<div align="center">
	<a href="{{url('cd-admin/add-header')}}"><button class="btn btn-primary">Add Header</button></a>
</div>
@endif

<!-- view modals -->
@foreach($header as $c)


<!-- delete modal -->

<div class="modal fade" id="delete-modal{{$c->id}}" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Delete</h4>
			</div>
			<div class="modal-body"> Are you sure want to delete this ? </div>
			<div class="modal-footer">
				<form action="{{url('cd-admin/deleteHeader',$c->id)}}" method="POST">
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