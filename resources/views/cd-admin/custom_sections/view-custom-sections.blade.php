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
		<span>View Custom Section</span>
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
					<span class="caption-subject bold uppercase"> View Custom Section </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('edit-widgets','widgets'))
					<a href="{{route('sort-custom-sections')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Sort Custom Sections
							<i class="fa fa-sort"></i>
						</button>
					</a>
					@endif
					@if(Gate::check('add-widgets','widgets'))
					<a href="{{route('add-custom-section-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Custom Section
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
							<th>Custom Section</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($custom as $c)
						<tr class="odd gradeX">
							<td>{{$c['title']}}({{$c['title_ne']}})</td>
							<td>									
								<a href="{{route('view-one-custom-section',$c['id'])}}">
									<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
								</a>
								@if(Gate::check('edit-widgets','widgets'))
								<a data-toggle="modal" href="{{route('edit-custom-section-form',$c['id'])}}">
									<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>								
								</a>
								@endif
								@if(Gate::check('delete-widgets','widgets'))

								<a data-toggle="modal" href="#delete-modal{{$c['id']}}">
									<button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>									
								</a>
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
@foreach($custom as $c)

<div class="modal modal-danger fade" id="delete-modal{{$c['id']}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"> Delete Custom Section</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete {{$c->title}}?</p>
			</div>
			<div class="modal-footer">
				<div align="center">
					<form action="{{route('delete-custom-section',$c['id'])}}" method="POST">
						@csrf
						<button type="submit" class="btn btn-warning">Yes</button>
						<button type="button" class="btn btn-primary " data-dismiss="modal">No</button>
					</form>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@endforeach	
@endsection