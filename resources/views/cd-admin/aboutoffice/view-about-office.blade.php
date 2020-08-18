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
		<span>View About Office</span>
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
					<span class="caption-subject bold uppercase"> View About Office </span>
				</div>
				<div class="btn-group pull-right">
					<a href="#">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Office
							<i class="fa fa-plus"></i>
						</button>
					</a>
				</div>
			</div>

<div align="center">
</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>SN</th>
							<th>Title</th>
							<th>कार्यालयको शीर्षक</th>
							<th>Status</th>
							<th>Lab Tests & Packages</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<td>1</td>
							<td>Title Here</td>
							<td>कार्यालयको शीर्षक</td>
							<td align="center"><img src="#" class="img img-fluid rounded" style="height: 70px; width: 70px;"></td>
							<td>
								<form action="#" method="POST">
									@csrf
								<div class="btn-group">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
									{{-- <button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive --}}
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-left" role="menu">
										<li>
											<button class="btn btn-danger" type="submit">Inactive</button>
											{{-- <button class="btn btn-success" type="submit">Active</button> --}}
										</li>
									</ul>
								</div>
								</form>
							</td>
							<td align="center">
								<a href="#"><button class="btn btn-primary btn-sm">Add Cards</button></a>
								{{-- <a href="#"><button class="btn btn-primary btn-sm">View Packages</button></a> --}}

							</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Actions
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-left" role="menu">
										<li>
											<a href="#">
												<i class="fa fa-eye"></i>View
											</a>
										</li>
										<li>
											<a href="#">
												<i class="fa fa-edit"></i>Edit
											</a>
										</li>
										<li>
											<a data-toggle="modal" href="#delete-modal#">
												<i class="fa fa-trash"></i>Delete
											</a>
										</li>
									</ul>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- delete modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Delete</h4>
			</div>
			<div class="modal-body"> Are you sure want to delete this ? </div>
			<div class="modal-footer">
				<form action="" method="POST">
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
@endsection