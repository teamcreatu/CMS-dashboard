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
		<span>View Staffs</span>
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
					<span class="caption-subject bold uppercase"> View Staffs </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-staffs','staffs'))
					<a href="{{route('add-members-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Staffs
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
							<th>सदस्यको नाम(Name)</th>
							<th>Image</th>
							<th>पद</th>
							<th>Order Number</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($members as $m)
							<td>{{$count}}</td>
							<td>{{$m['name_ne']}}({{$m['name']}})</td>
							<td align="center">
								@if(isset($m['image_url']))
								<img src="{{url(Request::root().'/'.$m['image_url'])}}" class="img img-fluid rounded" style="height: 70px; width: 70px;">
								@else
								<img src="{{url(Request::root().'/public/images/noimage.png')}}" class="img img-fluid rounded" style="height: 70px; width: 70px;">
								@endif
							</td>
							<td>
								<?php $decode = json_decode($m['category_id']); ?>
								@foreach($category as $c)
								@if(in_array($c['id'],$decode))
								<div class="badge badge-primary">
									{{$c['name']}}
								</div>
								@endif
								@endforeach
							</td>
							<td>
								{{$m['order_no']}}
							</td>
							<td>
								@if(Gate::check('edit-staffs','staffs'))
								@if(Gate::check('edit-category-staffs',$m['id']))
								<form action="{{route('update-members-status',$m['id'])}}" method="POST">
									@csrf
									<div class="btn-group">
										@if($m->status == 'active')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($m->status == 'active')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									@else
									@if($m->status == 'active')
									<button class="btn btn-xs btn-success" type="submit">Active</button>
									@else
									<button class="btn btn-xs btn-danger" type="submit">Inactive</button>
									@endif
									@endif
									@endif
								</td>
								<td>
									<a href="{{route('view-one-member',$m['id'])}}">
										<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>		
									</a>
									@if(Gate::check('edit-staffs','staffs'))
									@if(Gate::check('edit-category-staffs',$m['id']))
									<a href="{{route('edit-members-form',$m['id'])}}">
										<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
									</a>
									@endif
									@if(Gate::check('delete-category-staffs',$m['id']))
									<a data-toggle="modal" href="#delete-modal{{$m['id']}}">
										<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
									</a>
									@endif
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
	<!-- delete modal -->
	@foreach($members as $m)
	<div class="modal fade" id="delete-modal{{$m['id']}}" tabindex="-1" role="basic" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<div class="modal-body"> Are you sure want to delete {{$m->name}} ? </div>
				<div class="modal-footer">
					<form action="{{route('delete-members',$m['id'])}}" method="POST">
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