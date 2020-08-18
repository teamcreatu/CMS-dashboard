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
				{{-- <div class="btn-group pull-right">
					<a href="{{route('add-news-category-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add News Categories
							<i class="fa fa-plus"></i>
						</button>
					</a>
				</div> --}}
			</div>

			<div align="center">
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>Member Name(सदस्यको नाम)</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($members as $m)
						<tr class="odd gradeX">
							<td>{{$m->name}}({{$m->name_ne}})</td>
							<td>
								<a href="{{route('view-one-member-widget',$m['id'])}}">
									<button class="label label-sm label-success" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
								</a>
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
@endsection