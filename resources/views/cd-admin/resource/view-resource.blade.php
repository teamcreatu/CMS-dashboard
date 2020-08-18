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
		<span>View Documents</span>
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
					<span class="caption-subject bold uppercase"> View Documents </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-documents','documents'))
					<a href="{{route('add-resource-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Documents
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
							<th>Title</th>
							<th>शीर्षक</th>
							<th>Category</th>
							<th>Status</th>
							<th>Publish Date</th>
							<th>Author</th>
							@if(Gate::check('edit-documents','documents'))
							<th>Actions</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($resource as $r)
							<td>{{$count}}</td>
							<td>{{$r->file_name}}</td>
							<td>{{$r->file_name_ne}}</td>
							<?php $decode = json_decode($r['category_id']); ?>
							<td>
								@foreach($category as $c)
								@if(in_array($c['id'],$decode))
								<div class="badge badge-primary">
									{{$c['name']}}
								</div>
								@endif
								@endforeach
							</td>
							<td>
								@if(Gate::check('edit-documents','documents'))
								@if(Gate::check('edit-category-documents',$r['id']))
								<form action="{{route('update-resource-status',$r['id'])}}" method="POST">
									@csrf
									<div class="btn-group">
										@if($r->status == 'active')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($r->status == 'active')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									@else
									@if($r->status == 'active')
									<button class="btn btn-xs green dropdown-toggle">Active
										@else
										<button class="btn btn-xs red dropdown-toggle">Inactive
											@endif
											@endif
											@endif
										</td>
										<td>
											{{$r['created_at_nep']}}
										</td>
										<td>
											@foreach($users as $u)
											@if($u['id'] == $r['created_by'])
											{{$u['full_name']}}
											@endif
											@endforeach
										</td>
										@if(Gate::check('edit-documents','documents'))
										<td>
											@if(Gate::check('edit-category-documents',$r['id']))
											<a data-toggle="modal" href="{{route('edit-resource-form',$r['id'])}}">
												<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>	
											</a>
											@endif
											@if(Gate::check('delete-category-documents',$r['id']))
											<a data-toggle="modal" href="#delete-modal{{$r['id']}}">
												<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>	
											</a>
											@endif
										</td>
										@endif
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
			<!-- delete modal -->
			@foreach($resource as $r)
			<div class="modal fade" id="delete-modal{{$r['id']}}" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Delete</h4>
						</div>
						<div class="modal-body"> Are you sure want to delete {{$r->file_name}} ? </div>
						<div class="modal-footer">
							<form action="{{route('delete-resource',$r['id'])}}" method="POST">
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