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
		<span>View Custom Widgets</span>
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
					<span class="caption-subject bold uppercase"> View Custom Widgets </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-widgets','widgets'))
					<a href="{{route('add-custom-widgets-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Custom Widgets
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
							<th>Custom Widget(कस्टम विजेट)</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($custom as $c)
						<tr class="odd gradeX">
							<td>{{$c['name']}}({{$c['name_ne']}})</td>
							<td>									
								<a data-toggle="modal" href="#modal-view{{$c['id']}}">
									<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
								</a>
								@if(Gate::check('edit-widgets','widgets'))
								<a data-toggle="modal" href="{{route('edit-custom-widgets-form',$c['id'])}}">
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
<div class="modal modal-default fade" id="modal-view{{$c['id']}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" align="center">View Custom Widget</h4>
				</div>
				<div class="modal-body">
					<div class="form-group ">
						<h4 align="center"> <label>Custom Widget Title</label></h4>
						{{$c->name}}({{$c['name_ne']}})
					</div>
					<hr>
					<h4 align="center">Widgets</h4>
					@if($widgets[$c['id']])
					<?php $count = 1 ?>
					@foreach($widgets[$c['id']] as $w)
					<h5 align="center">{{$count}}).{{$w['title']}}({{$w['title_ne']}})</h5>
					<a href="{{Request::root().'/'.$w['url'].'/nep'}}"><button class="btn btn-default">Click to View this Widget</button></a>
					<?php $count ++?>
					@endforeach
					@else
					No Widgets Added
					@endif
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

	<div class="modal modal-danger fade" id="delete-modal{{$c['id']}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"> Delete Custom Widget</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete {{$c->name}}?</p>
					</div>
					<div class="modal-footer">
						<div align="center">
							<form action="{{route('delete-custom-widget',$c['id'])}}" method="POST">
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