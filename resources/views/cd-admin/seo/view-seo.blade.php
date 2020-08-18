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
		<span>View SEO</span>
	</li>
</ul>
</div>
<!-- END PAGE BAR -->
@if(count($seo) != 0)
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase"> View SEO </span>
				</div>
				{{-- <div class="btn-group pull-right">
					@if(Gate::check('edit-documents','documents') || Gate::check('all','all'))
					<a href="{{route('add-resource-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Documents
							<i class="fa fa-plus"></i>
						</button>
					</a>
					@endif
				</div> --}}
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
							<th>Keywords</th>
							<th>Keywords(Nepali)</th>
							<th>Author</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($seo as $s)
							<td>{{$count}}</td>
							<td>{{$s->title}}</td>
							<td>{{$s->title_ne}}</td>
							<?php $decode = explode(',',$s['keywords']); ?>
							<td>	
								@foreach($decode as $d)
								<span class="badge badge-primary">{{$d}}</span>
								@endforeach
							</td>
							<?php $decode1 = explode(',',$s['keywords_ne']); ?>
							<td>
								@foreach($decode1 as $d1)
								<span class="badge badge-secondary">{{$d1}}</span>
								@endforeach
							</td>
							<td>
								@foreach($users as $u)
								@if($u['id'] == $s['created_by'])
								{{$u['full_name']}}
								@endif
								@endforeach
							</td>

							<td>
								<a data-toggle="modal" href="#view-modal{{$s['id']}}">
									<button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>	
								</a>
								<a data-toggle="modal" href="{{route('edit-seo-form',$s['id'])}}">
									<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></button>	
								</a>
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
@else
<div align="center">
	<a href="{{route('add-seo-form')}}"><button class="btn btn-primary">Add SEO</button></a>
</div>
@endif
<!-- delete modal -->
@foreach($seo as $s)
<div class="modal fade" id="view-modal{{$s['id']}}" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">View SEO</h4>
			</div>
			<div class="modal-body">
				<div align="center">
					<h2>
						{{$s['title']}}({{$s['title_ne']}})
					</h2>
				</div>
				<div align="center">
					<h4>Description</h4>
				</div>
				<p>{!!$s['description']!!}</p>
				<div align="center">
					<h4>Description(Nepali)</h4>
				</div>
				<p>{!!$s['description_ne']!!}</p>
				<div align="center">
					<h4>Keywords</h4>
				</div>
				<?php $newdecode = explode(',',$s['keywords']) ?>
				<p>
					@foreach($newdecode as $d1)
					<span class="badge badge-primary">{{$d1}}</span>
					@endforeach
				</p>
				<div align="center">
					<h4>Keywords(Nepali)</h4>
				</div>
				<?php $newdecode1 = explode(',',$s['keywords_ne']) ?>
				<p>
					@foreach($newdecode1 as $d2)
					<span class="badge badge-primary">{{$d2}}</span>
					@endforeach
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@endforeach

@endsection