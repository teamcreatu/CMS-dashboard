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
		<span>View Default Sections Title</span>
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
					<span class="caption-subject bold uppercase"> View Default Section Title </span>
				</div>
			</div>

			<div align="center">
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th></th>
							<th>SN</th>
							<th>Section Name</th>
							<th>Section Title</th>
							<th>Section Title Nepali</th>
							<th>Section Subtitle</th>
							<th>Section Subtitle Nepali</th>
							@if(Gate::check('edit-widgets','widgets'))
							<th>Actions</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<?php $count = 1 ?>
							@foreach($data as $d)
							<td></td>
							<td>{{$count}}</td>
							<td>{{$d->name}}</td>
							<td data-toggle="tooltip" title="{{$d['title']}}">{{$d->title}}</td>
							<td data-toggle="tooltip" title="{{$d['title_ne']}}">{{$d->title_ne}}</td>	
							<td data-toggle="tooltip" title="{{$d['subtitle']}}">{{$d->subtitle}}</td>
							<td data-toggle="tooltip" title="{{$d['subtitle_ne']}}">{{$d->subtitle_ne}}</td>
							<td>
								@if(Gate::check('edit-widgets','widgets'))
								<a data-toggle="modal" href="#modal-edit{{$d['id']}}">
									<button class="label label-sm label-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i>
									</button>													
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
@foreach($data as $d)
{{-- Edit Modal --}}
<div class="modal fade" id="modal-edit{{$d['id']}}" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Edit {{$d['name']}}</h4>
			</div>
			<form class="form-horizontal" action="{{route('edit-default-section-title',$d['id'])}}" method="POST">
				@csrf
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Section Title</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" placeholder="Enter Section Title" value="{{$d['title']}}">
							</div>
							@if ($errors->has('title'))
							<span class="text-danger">{{ $errors->first('title') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Section Title(Nepali)</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title_ne" placeholder=" Enter Section Title Nepali" value="{{$d['title_ne']}}">
							</div>
							@if ($errors->has('title_ne'))
							<span class="text-danger">{{ $errors->first('title_ne') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Section Subtitle</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle Text" value="{{$d['subtitle']}}">
							</div>
							@if ($errors->has('subtitle'))
							<span class="text-danger">{{ $errors->first('subtitle') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Section Subtitle(Nepali)</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="subtitle_ne" placeholder=" Enter Subtitle Text(Nepali)" value="{{$d['subtitle_ne']}}">
							</div>
							@if ($errors->has('subtitle_ne'))
							<span class="text-danger">{{ $errors->first('subtitle_ne') }}</span>
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
@endsection