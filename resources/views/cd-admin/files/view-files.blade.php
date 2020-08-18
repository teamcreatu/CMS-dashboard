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
		<span>View Files</span>
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
					<span class="caption-subject bold uppercase"> View Files </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('add-media','media'))
					<a href="{{route('add-files-form')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Files
							<i class="fa fa-plus"></i>
						</button>
					</a>
					@endif
				</div>
			</div>

			<div align="center">
			</div>
			<div class="portlet-body">

				<form action="{{route('delete-files')}}" method="POST">
					@csrf
					<div id="delete-button" align="right" style="display: none;">
						<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete...</button>
					</div>
					<br>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								@if(Gate::check('delete-media','media'))
								<th>Select</th>
								@endif
								<th>SN</th>
								<th>File</th>
								<th>Copy</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd gradeX">
								<?php $count = 1 ?>
								@foreach($file as $r)
								@if(Gate::check('delete-media','media'))
								<td>
									<div class="mt-checkbox-list" align="center" style="margin-left: 25px;">
										<label class="mt-checkbox">
											<input type="checkbox" value="{{$r->id}}" name="checkbox[]" onchange="checkDelete()" multiple>
											<span></span>
										</label>
									</div>
								</td>
								@endif
								<td>{{$count}}</td>
								<td width="5px"><a href="{{url($r->file_url)}}" target="__blank">{{$r->file_title}}</a></td>
								<td align="center">
									<input type="text" name="file_url" id="copy_{{$r->id}}" value="{{$r->file_url}}" class="form-control">
									<a onclick="copyToClipboard('copy_{{ $r->id }}')">
										<i class="fa fa-copy btn btn-primary">Copy URL</i>
									</a>
								</td>
							</tr>
							<?php $count++ ?>
							@endforeach
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- delete modal -->
@foreach($file as $r)
<div class="modal fade" id="delete-modal{{$r['id']}}" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Delete</h4>
			</div>
			<div class="modal-body"> Are you sure want to delete {{$r->file_name}} ? </div>
			<div class="modal-footer">
				<form action="{{route('delete-files',$r->id)}}" method="POST">
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
<script>
	function copyToClipboard(id) {
		document.getElementById(id).select();
		document.execCommand('copy');
	}
</script>

<script type="text/javascript">
	function checkDelete() 
	{
		var data = document.querySelectorAll('input[type="checkbox"]:checked').length;
		if (data > 0) 
		{
			document.getElementById('delete-button').style.display = 'block';
		}
		else
		{
			document.getElementById('delete-button').style.display = 'none';
		}
	}
</script>
@endsection