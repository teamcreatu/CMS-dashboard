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
		<span>View page Category</span>
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
					<span class="caption-subject bold uppercase"> View Page Category </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('edit-page','page') || Gate::check('all','all'))
					<a href="{{url('cd-admin/add-pageCategory')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Page Category
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
							<th>Category name</th>
							<th>Parent Category</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($category as $c)
						<tr class="odd gradeX">
							<td>{{$loop->iteration}}</td>
							<td>{{$c->name}}</td>
							<td>
								@if($c->parent_id == '')
								<span class="badge badge-success">yes</span>
								@else
								<span class="badge badge-danger">no</span>
								@endif
							</td>
							<td>
								@if(Gate::check('edit-widgets','widgets') || Gate::check('all','all'))
								<form action="{{url('cd-admin/update-page-status',$c->id)}}" method="POST">
									@csrf
									<div class="btn-group">
										@if($c->status == 'active')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($c->status == 'active')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									@else
									@if($c->status == 'active')
									<button class="btn btn-xs green dropdown-toggle">Active
										@else
										<button class="btn btn-xs red dropdown-toggle">Inactive
											@endif
											@endif
										</td>

										<td>
											<a data-toggle="modal" href="#view-modal{{$c->id}}">
												<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>														</a>
												@if(Gate::check('edit-widgets','widgets') || Gate::check('all','all'))
												<a href="{{url('cd-admin/edit-pageCategory',$c->id)}}">
													<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>														</a>

													<a data-toggle="modal" href="#delete-modal{{$c->id}}">
														<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>														</a>
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
						@foreach($category as $c)
						<div id="view-modal{{$c->id}}" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title pull-left">{{$c->name}}</h4>
										<p class="modal-title pull-right">status 
											@if($c->status == 'active')
											<span class="badge badge-success">Active</span>
											@else
											<span class="badge badge-danger">Inactive</span>
											@endif
										</p>
									</div>
									<div class="modal-body">
										<div class="panel panel-default">
											<div class="panel-heading">{{$c->name}}</div>
											<div class="panel-body">
												<ul>
													<li>{{$c->name}}</li>
													@if($subcategory = App\PageCategory::where('parent_id',$c->id)->get())
													@include('cd-admin.page-category.subCategoryList',['subcategories' => $subcategory])
													@endif 
												</ul>
											</div>

										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
									</div>
								</div>
							</div>
						</div>


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
										<form action="{{url('cd-admin/delete-page-category',$c->id)}}" method="POST">
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