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
		<span>View Quotes</span>
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
					<span class="caption-subject bold uppercase"> View Quotes </span>
				</div>
				<div class="btn-group pull-right">
					{{-- @if(Gate::check('edit-quotes','quotes') || Gate::check('all','all')) --}}
					<a href="{{route('add-quotes-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Quotes
							<i class="fa fa-plus"></i>
						</button>
					</a>
					{{-- @endif --}}
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
							<th>Image</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($quotes as $q)
							<td>{{$count}}</td>
							<td>{{$q['title']}}</td>
							<td align="center"><img src="{{Request::root().'/'.$q['image_url']}}" class="img img-fluid rounded" style="height: 70px; width: 70px;"></td>
							<td>
								{{-- @if(Gate::check('edit-news','news') || Gate::check('all','all')) --}}
								<form action="{{route('update-quotes-status',$q['id'])}}" method="POST">
									@csrf
									<div class="btn-group">
										@if($q->status == 'active')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($q->status == 'active')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									{{-- @else
									@if($q->status == 'active')
									<button class="btn btn-xs green dropdown-toggle">Active
										@else
										<button class="btn btn-xs red dropdown-toggle">Inactive
											@endif
											@endif --}}
										</td>
										<td>
											<a data-toggle="modal" href="#modal-view{{$q['id']}}">
												<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>											
											</a>
											@if(Gate::check('edit-news','news') || Gate::check('all','all'))
											<a href="{{route('edit-quotes-form',$q['id'])}}">
												<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>											
											</a>
											<a data-toggle="modal" href="#delete-modal{{$q['id']}}">
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
			<!-- delete modal -->
			@foreach($quotes as $q)
			<div class="modal fade" id="delete-modal{{$q['id']}}" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Delete</h4>
						</div>
						<div class="modal-body"> Are you sure want to delete {{$q->name}} ? </div>
						<div class="modal-footer">
							<form action="{{route('delete-quotes',$q['id'])}}" method="POST">
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

			<div class="modal modal-default fade" id="modal-view{{$q->id}}">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" align="center">View Quotes</h4>
							</div>
							<div class="modal-body">
								@csrf
								<div class="form-group ">
									<h4 align="center"> <label>Quotes Title</label></h4>
									{{$q['title']}}({{$q['title_ne']}})
								</div>
								<hr>
								<div class="form-group ">
									<h4 align="center"><label>Summary(In English)</label></h4>
									{{$q['summary']}}
								</div>
								<hr>
								<div class="form-group ">
									<h4 align="center"><label>Summary(In Nepali)</label></h4>
									{{$q['summary_ne']}}
								</div>
							</div>
							<div class="modal-footer">
								<div class="pull-right">
									<button type="button" class="btn btn-primary " data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				@endforeach
				@endsection