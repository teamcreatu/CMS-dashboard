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
		<span>View Posts</span>
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
					<span class="caption-subject bold uppercase"> View Posts </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-post','post'))
					<a href="{{route('add-posts-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Posts
							<i class="fa fa-plus"></i>
						</button>
					</a>
					@endif
				</div>
			</div>

			<div align="center">
				@foreach($category as $c)
				<a class="badge badge-primary" onclick="searchCategory('{{$c['name']}}')">
					{{$c['name']}}
				</a>
				@endforeach
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>SN</th>
							<th>शीर्षक(Title)</th>
							<th>Category</th>
							<th>Status</th>
							<th>Show</th>
							<th>Publish Date</th>
							<th>Author</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($posts as $n)
							<td>{{$count}}</td>
							<td>{{$n['title_ne']}}({{$n['title']}})</td>
							<?php $decode = json_decode($n['category_id']); ?>
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
								@if(Gate::check('edit-post','post'))
								<form action="{{route('update-posts-status',$n['id'])}}" method="POST">
									@csrf
									@if(Gate::check('edit-category-post',$n['id']))
									<div class="btn-group">
										@if($n->status == 'active')
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
											@else
											<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
												@endif
												<i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-left" role="menu">
												<li>
													@if($n->status == 'active')
													<button class="btn btn-danger" type="submit">Inactive</button>
													@else
													<button class="btn btn-success" type="submit">Active</button>
													@endif
												</li>
											</ul>
										</div>
									</form>
									@else
									@if($n->status == 'active')
									<button class="btn btn-xs green dropdown-toggle">Active
										@else
										<button class="btn btn-xs red dropdown-toggle">Inactive
											@endif
											@endif
											@endif

										</td>
										<td>
											@if(Gate::check('edit-post','post'))
											<form action="{{route('update-show-posts-status',$n['id'])}}" method="POST">
												@if(Gate::check('edit-category-post',$n['id']))
												@csrf
												<div class="btn-group">
													@if($n->show_latest_updated == 'yes')
													<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Yes
														@else
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">No
															@endif
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<li>
																@if($n->show_latest_updated == 'yes')
																<button class="btn btn-danger" type="submit">No</button>
																@else
																<button class="btn btn-success" type="submit">Yes</button>
																@endif
															</li>
														</ul>
													</div>
												</form>
												@else
												@if($n->show_latest_updated == 'yes')
												<button class="btn btn-xs green dropdown-toggle">Yes
													@else
													<button class="btn btn-xs red dropdown-toggle">No
														@endif
														@endif
														@endif

													</td>
													<td>
														{{$n['created_at_nep']}}
													</td>
													<td>
														@foreach($users as $u)
														@if($u['id'] == $n['created_by'])
														{{$u['full_name']}}
														@endif
														@endforeach
													</td>
													<td>
														<a href="{{route('view-one-posts',$n['id'])}}">
															<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
														</a>
														@if(Gate::check('edit-post','post'))
														@if(Gate::check('edit-category-post',$n['id']))
														<a href="{{route('edit-posts-form',$n['id'])}}">
															<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>	
														</a>
														@endif
														@if(Gate::check('delete-category-post',$n['id']))
														<a data-toggle="modal" href="#delete-modal{{$n['id']}}">
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
						@foreach($posts as $n)
						<div class="modal fade" id="delete-modal{{$n['id']}}" tabindex="-1" role="basic" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
										<h4 class="modal-title">Delete</h4>
									</div>
									<div class="modal-body"> Are you sure want to delete {{$n['title']}} ? </div>
									<div class="modal-footer">
										<form action="{{route('delete-posts',$n['id'])}}" method="POST">
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

						<script type="text/javascript">
							
							function searchCategory(name) {
								$('#sample_1_filter label input[type=search]').val(name).trigger($.Event("keyup", { keyCode: 13 }));
							}
						</script>

						@endsection