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
		<span>View Department</span>
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
					<span class="caption-subject bold uppercase"> View Department</span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('edit-header','header') || Gate::check('all','all'))
					<a href="{{url('cd-admin/add-department')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Department
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
							<th>Title</th>
							<th>Link</th>
							<th>Image</th>
							<th>Status</th>
							@if(Gate::check('edit-header','header') || Gate::check('all','all'))
							<th>Actions</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach($department as $f)
						<tr class="odd gradeX">
							<td>{{$loop->iteration}}</td>
							<td>{{$f['title']}}</td>
							<td>{{$f['link_url']}}</td>
							<td align="center">
								<img src="{{url(Request::root().'/public/uploads/department/'.$f['image_name'])}}" class="img img-fluid rounded" style="height: 70px; width: 70px;">
							</td>
							<td>
								@if(Gate::check('edit-header','header') || Gate::check('all','all'))
								<form action="{{route('update-department-status',$f['id'])}}" method="POST">
									@csrf
									<div class="btn-group">
										@if($f['status'] == 'active')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($f['status'] == 'active')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									@else
									@if($f['status'] == 'active')
									<button class="btn btn-xs green ">Active
										@else
										<button class="btn btn-xs red ">Inactive
											@endif
											@endif
										</td>
										@if(Gate::check('edit-header','header') || Gate::check('all','all'))
										<td>
											<a href="{{url('cd-admin/edit-department',$f->id)}}">
												<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>	
											</a>
											<a data-toggle="modal" href="#delete-modal{{$f->id}}">
												<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>	
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

			<!-- view modals -->
			@foreach($department as $f)


			<!-- delete modal -->

			<div class="modal fade" id="delete-modal{{$f->id}}" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Delete</h4>
						</div>
						<div class="modal-body"> Are you sure want to delete this ? </div>
						<div class="modal-footer">
							<form action="{{url('cd-admin/delete-department',$f->id)}}" method="POST">
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