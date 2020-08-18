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
		<span>View All Page</span>
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
					<span class="caption-subject bold uppercase"> View All Page </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-page','page'))
					<a href="{{url('cd-admin/add-pageDetail')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Page
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
							<th>शीर्षक(Title)</th>
							<th>Published Date</th>
							<th>Author</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							@foreach($page as $key=>$e)
							<td>{{$key + 1}}</td>
							<td>{{$e['title_ne']}}({{$e['title']}})</td>
							<td>
								{{$e['created_at_nep']}}
							</td>
							<td>
								@foreach($users as $u)
								@if($u['id'] == $e['created_by'])
								{{$u['full_name']}}
								@endif
								@endforeach
							</td>
							<td>
								<a href="{{url('cd-admin/view-one-page',$e['id'])}}">
									<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>						
								</a>
								@if(Gate::check('edit-page','page'))
								<a href="{{url('cd-admin/edit-pageDetail',$e['id'])}}">
									<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>					
								</a>
								@endif
								@if($e->title != 'Home')
								@if(Gate::check('delete-page','page'))
								<a data-toggle="modal" href="#delete-modal{{$e['id']}}">
									<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>			
								</a>
								@endif
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
<!-- delete modal -->
@foreach($page as $e)
<div class="modal fade" id="delete-modal{{$e['id']}}" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Delete</h4>
			</div>
			<div class="modal-body"> Are you sure want to delete {{$e->file_name}} ? </div>
			<div class="modal-footer">
				<form action="{{url('cd-admin/delete-page-Detail',$e['id'])}}" method="POST">
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