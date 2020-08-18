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
		<li>
			<a href="{{url('cd-admin/view-all-about')}}">View About Office</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add About Office</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<div class="row">

	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-settings font-dark"></i>
				<span class="caption-subject font-dark sbold uppercase">Add About Office</span>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="table-responsive">
				<form method="post" id="dynamic_form">
					<span id="result"></span>
					<table class="table table-bordered table-striped" id="user_table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" align="right">&nbsp;</td>
								<td>
									@csrf
									<input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
								</td>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>

@endsection