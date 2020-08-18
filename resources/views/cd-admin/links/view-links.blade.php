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
		<span>View Links</span>
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
					<span class="caption-subject bold uppercase"> View Links </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('edit-links','links') || Gate::check('all','all'))
					<a href="{{route('add-links-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Links
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
							<th>Category Name</th>
							<th>श्रेणीको नाम</th>
							<th>Status</th>
							@if(Gate::check('edit-links','links') || Gate::check('all','all'))
							<th>Actions</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($links as $c)
							<td>{{$count}}</td>
							<td>{{$c->title}}</td>
							<td>{{$c->title_ne}}</td>
							<td>
								@if(Gate::check('edit-links','links') || Gate::check('all','all'))
								<form action="{{route('update-links-status',$c['id'])}}" method="POST">
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
									<button class="btn btn-xs green ">Active
										@else
										<button class="btn btn-xs red ">Inactive
											@endif
											@endif
										</td>
										@if(Gate::check('edit-event','event') || Gate::check('all','all'))
										<td>
											<a data-toggle="modal" href="#modal-edit{{$c['id']}}">
												<button class="label label-sm label-success" data-toggle="tooltip" title="Edit">
													<i class="fa fa-edit"></i>
												</button>
											</a>
											<a data-toggle="modal" href="#delete-modal{{$c['id']}}">
												<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete">
													<i class="fa fa-trash"></i>
												</button>				
											</a>
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
			@foreach($links as $c)
			<div class="modal fade" id="delete-modal{{$c['id']}}" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Delete</h4>
						</div>
						<div class="modal-body"> Are you sure want to delete {{$c->title}} ? </div>
						<div class="modal-footer">
							<form action="{{route('delete-links',$c['id'])}}" method="POST">
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


			{{-- Edit Modal --}}
			<div class="modal fade" id="modal-edit{{$c['id']}}" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Edit {{$c['name']}}</h4>
						</div>
						<form class="form-horizontal" action="{{route('edit-links',$c['id'])}}" method="POST">
							@csrf
							<div class="modal-body">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-4 control-label">Links Category<span class="cd-admin-required">*</span></label>
										<div class="col-md-6">
											<select name="links_category" class="form-control" id="links_category" onClick="checkParent()">
												<option value="parent" <?php echo $c['parent_id'] == 0 ?'selected':'' ?>>Parent Link</option>
												@foreach($links_category as $lc)
												@if($lc['id'] == $c['parent_id'])
												<option value="{{$lc['id']}}" selected>{{$lc['title']}}</option>
												@else
												<option value="{{$lc['id']}}">{{$lc['title']}}</option>
												@endif
												@endforeach
											</select>
										</div>
										@if ($errors->has('links_category'))
										<span class="text-danger">{{ $errors->first('links_category') }}</span>
										@endif
									</div>	
									<div class="form-group">
										<label class="col-md-4 control-label">Title<span class="cd-admin-required">*</span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="title" placeholder="Enter Category Name" value="{{$c['title']}}">
										</div>
										@if ($errors->has('title'))
										<span class="text-danger">{{ $errors->first('title') }}</span>
										@endif
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">शीर्षक<span class="cd-admin-required">*</span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="title_ne" placeholder=" शीर्षक प्रविष्ट गर्नुहोस्" value="{{$c['title_ne']}}">
										</div>
										@if ($errors->has('title_ne'))
										<span class="text-danger">{{ $errors->first('title_ne') }}</span>
										@endif
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Link Url<span class="cd-admin-required" id="remove1" style="display:none;">*</span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="link_url" placeholder=" Enter Link Url" value="{{$c['link_url']}}">
										</div>
										@if ($errors->has('link_url'))
										<span class="text-danger">{{ $errors->first('link_url') }}</span>
										@endif
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Priority No.<span class="cd-admin-required">*</span></label>
										<div class="col-md-6">
											<input type="number" class="form-control" placeholder="Enter Priority No." name="priority_no" required value= {{$c['priority_no']}}>
										</div>
										@if ($errors->has('link_url'))
										<span class="text-danger">{{ $errors->first('link_url') }}</span>
										@endif
									</div>	
									<hr>
									<div class="form-group">
										<label class="col-md-4 control-label">Status<span class="cd-admin-required">*</span></label>
										<div class="col-md-6">
											<div class="mt-radio-inline">
												<label class="mt-radio">
													<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo $c['status'] == 'active' ?'checked':'' ?>> Active
													<span></span>
												</label>
												<label class="mt-radio">
													<input type="radio" name="status" id="optionsRadios26" value="inactive" <?php echo $c['status'] == 'inactive' ?'checked':'' ?>> Inactive
													<span></span>
												</label>
											</div>
										</div>
										@if ($errors->has('status'))
										<span class="text-danger">{{ $errors->first('status') }}</span>
										@endif
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
									<button class="btn green" type="submit">Update</button>				
								</div>
							</div>
						</form>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			</div>
			@endforeach

			<script type="text/javascript">
				function checkParent() 
				{
					links_category = document.getElementById('links_category').value;
					if (links_category == 'parent')
					{
						document.getElementById('remove1').style.display="none";
					}
					else
					{
						document.getElementById('remove1').style.display="inline-block";
					}
				}
			</script>
			@endsection