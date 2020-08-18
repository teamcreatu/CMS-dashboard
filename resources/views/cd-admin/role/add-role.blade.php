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
			<a href="{{url('cd-admin/view-all-role')}}">View all Role</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add new Role</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add New Role</span>
			</div>
		</div>
		@if($errors->any())
		<div class="alert alert-danger">
			@foreach($errors->all() as $e)
			<li>{{$e}}</li>
			@endforeach
		</div>
		@endif
		<div class="portlet-body form">
			<form class="form-horizontal" method="post" action="{{url('cd-admin/insertRole')}}" role="form">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Role Name<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" placeholder="Enter name">
						</div>
					</div>

					@foreach($permission as $key=>$p)
					<div class="">
						@if($p->name == 'staffs')
						<div class="form-group">
							<label class="col-md-3 control-label">{{ucfirst($p['name'])}}</label>
							<div class="col-md-6">

								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="create{{$p['name']}}" id="optionsRadios25" value="create"  <?php echo old($p['name']) == 'create'?'checked':''  ?> onclick="{{$p['name']}}checkbox{{$p['name']}}();" multiple id="{{$p['name']}}"> Create
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="edit{{$p['name']}}" id="optionsRadios26" value="edit"  <?php echo old('status') == 'edit'?'checked':'' ?> onclick="{{$p['name']}}checkbox{{$p['name']}}();" multiple id="{{$p['name']}}"> Edit
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="delete{{$p['name']}}" id="optionsRadios26" value="delete"  <?php echo old($p['name']) == 'delete'?'checked':'' ?> onclick="{{$p['name']}}checkbox{{$p['name']}}();" multiple id="{{$p['name']}}"> Delete
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="all{{$p['name']}}" id="optionsRadios26" value="all"  <?php echo old('status') == 'all'?'checked':'' ?> onclick="{{$p['name']}}btnSearch_Click{{$p['name']}}();" multiple id="{{$p['name']}}"> All
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="none{{$p['name']}}" id="optionsRadios26" value="none"  <?php echo old('status') == 'none'?'checked':'' ?> onclick="{{$p['name']}}btnSearch_Click{{$p['name']}}();" checked multiple id="{{$p['name']}}"> None
										<span></span>
									</label>
								</div>
							</div>
							<div id="staffs" style="display: none; clear:both;">
								<label class="col-md-3 control-label">{{ucfirst($p['name'])}}'s Categories</label>
								<div class="col-md-6">
									<select class="mt-multiselect btn btn-default form-control" name="mode{{$p['name']}}[]" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">
										@foreach($memcat as $mc)
										<option value="{{$mc['id']}}">{{$mc['name']}}</option>
										@endforeach
									</select>
									<input type="hidden" name="mode[]" value="none">
								</div>
							</div>
						</div>

						@elseif($p->name == 'documents')
						<div class="form-group">
							<label class="col-md-3 control-label">{{ucfirst($p['name'])}}</label>
							<div class="col-md-6">

								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="create{{$p['name']}}" id="optionsRadios25" value="create"  <?php echo old($p['name']) == 'create'?'checked':''  ?> onclick="{{$p['name']}}checkbox{{$p['name']}}();" multiple id="{{$p['name']}}"> Create
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="edit{{$p['name']}}" id="optionsRadios26" value="edit"  <?php echo old('status') == 'edit'?'checked':'' ?> onclick="{{$p['name']}}checkbox{{$p['name']}}();" multiple id="{{$p['name']}}"> Edit
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="delete{{$p['name']}}" id="optionsRadios26" value="delete"  <?php echo old($p['name']) == 'delete'?'checked':'' ?> onclick="{{$p['name']}}checkbox{{$p['name']}}();" multiple id="{{$p['name']}}"> Delete
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="all{{$p['name']}}" id="optionsRadios26" value="all"  <?php echo old('status') == 'all'?'checked':'' ?> onclick="{{$p['name']}}btnSearch_Click{{$p['name']}}();" multiple id="{{$p['name']}}"> All
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="none{{$p['name']}}" id="optionsRadios26" value="none"  <?php echo old('status') == 'none'?'checked':'' ?> onclick="{{$p['name']}}btnSearch_Click{{$p['name']}}();" checked multiple id="{{$p['name']}}"> None
										<span></span>
									</label>
								</div>
							</div>
							<hr>
							<div id="documents" style="display: none; clear: both;">
								<label class="col-md-3 control-label">{{ucfirst($p['name'])}}'s Categories</label>
								<div class="col-md-6">
									<select class="mt-multiselect btn btn-default form-control" name="mode{{$p['name']}}[]" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">
										@foreach($rescat as $rc)
										<option value="{{$rc['id']}}">{{$rc['name']}}</option>
										@endforeach
									</select>
									<input type="hidden" name="mode[]" value="none">
								</div>
							</div>
						</div>


						@elseif($p->name == 'post')
						<div class="form-group">
							<label class="col-md-3 control-label">{{ucfirst($p['name'])}}</label>
							<div class="col-md-6">

								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="create{{$p['name']}}" id="optionsRadios25" value="create"  <?php echo old($p['name']) == 'create'?'checked':''  ?> onclick="{{$p['name']}}checkbox{{$p['name']}}('create');" multiple id="{{$p['name']}}"> Create
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="edit{{$p['name']}}" id="optionsRadios26" value="edit"  <?php echo old('status') == 'edit'?'checked':'' ?> onclick="{{$p['name']}}checkbox{{$p['name']}}('edit');" multiple id="{{$p['name']}}"> Edit
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="delete{{$p['name']}}" id="optionsRadios26" value="delete"  <?php echo old($p['name']) == 'delete'?'checked':'' ?> onclick="{{$p['name']}}checkbox{{$p['name']}}('delete');" multiple id="{{$p['name']}}"> Delete
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="all{{$p['name']}}" id="optionsRadios26" value="all"  <?php echo old('status') == 'all'?'checked':'' ?> onclick="{{$p['name']}}btnSearch_Click{{$p['name']}}();" multiple id="{{$p['name']}}"> All
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="none{{$p['name']}}" id="optionsRadios26" value="none"  <?php echo old('status') == 'none'?'checked':'' ?> onclick="{{$p['name']}}btnSearch_Click{{$p['name']}}();" checked multiple id="{{$p['name']}}"> None
										<span></span>
									</label>
								</div>
							</div>

							<div id="post" style="display: none; clear: both;">
								<label class="col-md-3 control-label" >{{ucfirst($p['name'])}}'s Categories</label>
								<div class="col-md-6">
									<select class="mt-multiselect btn btn-default form-control" name="mode{{$p['name']}}[]" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">

										@foreach($newcat as $ec)
										<option value="{{$ec['id']}}">{{$ec['name']}}</option>
										@endforeach
									</select>
									<input type="hidden" name="mode[]" value="none">
								</div>
							</div>
						</div>
						@else

						<div class="form-group">
							<label class="col-md-3 control-label">{{ucfirst($p['name'])}}</label>
							<div class="col-md-6">

								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="create{{$p['name']}}" id="optionsRadios25" value="create"  <?php echo old($p['name']) == 'create'?'checked':''  ?> onclick="checkbox{{$p['name']}}('create');" multiple id="{{$p['name']}}"> Create
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="edit{{$p['name']}}" id="optionsRadios26" value="edit"  <?php echo old('status') == 'edit'?'checked':'' ?> onclick="checkbox{{$p['name']}}('edit');" multiple id="{{$p['name']}}"> Edit
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="checkbox" name="{{$p['name']}}[]" id="delete{{$p['name']}}" id="optionsRadios26" value="delete"  <?php echo old($p['name']) == 'delete'?'checked':'' ?> onclick="checkbox{{$p['name']}}('delete');" multiple id="{{$p['name']}}"> Delete
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="all{{$p['name']}}" id="optionsRadios26" value="all"  <?php echo old('status') == 'all'?'checked':'' ?> onclick="btnSearch_Click{{$p['name']}}();" multiple id="{{$p['name']}}"> All
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="{{$p['name']}}_radio" id="none{{$p['name']}}" id="optionsRadios26" value="none"  <?php echo old('status') == 'none'?'checked':'' ?> onclick="btnSearch_Click{{$p['name']}}();" checked multiple id="{{$p['name']}}"> None
										<span></span>
									</label>
								</div>
							</div>
						</div>
						@endif
					</div>
					@endforeach

					<!-- status section starts -->

					<!-- status section ends -->

				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green">Submit</button>
							<a href="{{URL()->previous()}}"><button type="button" class="btn default">Cancel</button></a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
	function staffscheckboxstaffs() 
	{
		var checkedValue = []
		var checkboxes =$('input[name=staffs]:checked');
		for (var i = 0; i < checkboxes.length; i++) {
			checkedValue.push(checkboxes[i].value)
		}
		if($('input[name=staffs]').checked = true)
		{
			document.getElementById("allstaffs").checked=false;
			document.getElementById("nonestaffs").checked=false;
			document.getElementById("staffs").style.display ="block";
		}
		
		if(checkedValue.includes('create') && checkedValue.includes('edit') && checkedValue.includes('delete'))
		{
			document.getElementById("createstaffs").checked=false;
			document.getElementById("editstaffs").checked=false;
			document.getElementById("deletestaffs").checked=false;
			document.getElementById("allstaffs").checked=true;
			document.getElementById("staffs").style.display ="block";


		}
		if(checkedValue.includes('create') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("allstaffs").checked=false;
			document.getElementById("nonestaffs").checked=false;
			document.getElementById("staffs").style.display ="block";
		}
		if(checkedValue.includes('edit') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("allstaffs").checked=false;
			document.getElementById("nonestaffs").checked=false;
			document.getElementById("staffs").style.display ="block";
		}
		if(checkedValue.includes('delete') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{

			document.getElementById("allstaffs").checked=false;
			document.getElementById("nonestaffs").checked=false;
			document.getElementById("staffs").style.display ="block";
		}

		
	}
	function staffsbtnSearch_Clickstaffs() {
		var radio =$('input[name=staffs_radio]:checked').val();
		if(radio == 'all')
		{
			document.getElementById("staffs").style.display ="block";
		}
		else
		{
			document.getElementById("staffs").style.display ="none";
		}
		document.getElementById("createstaffs").checked=false;
		document.getElementById("editstaffs").checked=false;
		document.getElementById("deletestaffs").checked=false;
	}

	function documentscheckboxdocuments() 
	{
		var checkedValue = []
		var checkboxes =$('input[name=documents]:checked');
		for (var i = 0; i < checkboxes.length; i++) {
			checkedValue.push(checkboxes[i].value)
		}
		if($('input[name=documents]').checked = true)
		{
			document.getElementById("alldocuments").checked=false;
			document.getElementById("nonedocuments").checked=false;
			document.getElementById("documents").style.display ="block";
		}
		
		if(checkedValue.includes('create') && checkedValue.includes('edit') && checkedValue.includes('delete'))
		{
			document.getElementById("createdocuments").checked=false;
			document.getElementById("editdocuments").checked=false;
			document.getElementById("deletedocuments").checked=false;
			document.getElementById("alldocuments").checked=true;
			document.getElementById("documents").style.display ="block";


		}
		if(checkedValue.includes('create') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("alldocuments").checked=false;
			document.getElementById("nonedocuments").checked=false;
			document.getElementById("documents").style.display ="block";
		}
		if(checkedValue.includes('edit') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("alldocuments").checked=false;
			document.getElementById("nonedocuments").checked=false;
			document.getElementById("documents").style.display ="block";
		}
		if(checkedValue.includes('delete') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{

			document.getElementById("alldocuments").checked=false;
			document.getElementById("nonedocuments").checked=false;
			document.getElementById("documents").style.display ="block";
		}

		
	}
	function documentsbtnSearch_Clickdocuments() {
		var radio =$('input[name=documents_radio]:checked').val();
		if(radio == 'all')
		{
			document.getElementById("documents").style.display ="block";
		}
		else
		{
			document.getElementById("documents").style.display ="none";
		}
		document.getElementById("createdocuments").checked=false;
		document.getElementById("editdocuments").checked=false;
		document.getElementById("deletedocuments").checked=false;
	}

	function postcheckboxpost() 
	{
		var checkedValue = []
		var checkboxes =$('input[name=post]:checked');
		for (var i = 0; i < checkboxes.length; i++) {
			checkedValue.push(checkboxes[i].value)
		}
		if($('input[name=post]').checked = true)
		{
			document.getElementById("allpost").checked=false;
			document.getElementById("nonepost").checked=false;
			document.getElementById("post").style.display ="block";
		}
		
		if(checkedValue.includes('create') && checkedValue.includes('edit') && checkedValue.includes('delete'))
		{
			document.getElementById("createpost").checked=false;
			document.getElementById("editpost").checked=false;
			document.getElementById("deletepost").checked=false;
			document.getElementById("allpost").checked=true;
			document.getElementById("post").style.display ="block";


		}
		if(checkedValue.includes('create') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("allpost").checked=false;
			document.getElementById("nonepost").checked=false;
			document.getElementById("post").style.display ="block";
		}
		if(checkedValue.includes('edit') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("allpost").checked=false;
			document.getElementById("nonepost").checked=false;
			document.getElementById("post").style.display ="block";
		}
		if(checkedValue.includes('delete') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{

			document.getElementById("allpost").checked=false;
			document.getElementById("nonepost").checked=false;
			document.getElementById("post").style.display ="block";
		}

		
	}
	function postbtnSearch_Clickpost() {
		var radio =$('input[name=post_radio]:checked').val();
		if(radio == 'all')
		{
			document.getElementById("post").style.display ="block";
		}
		else
		{
			document.getElementById("post").style.display ="none";
		}
		document.getElementById("createpost").checked=false;
		document.getElementById("editpost").checked=false;
		document.getElementById("deletepost").checked=false;
	}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@foreach($permission as $p)
<script type="text/javascript">
	function checkbox{{$p['name']}}(name)
	{
		var checkedValue = []
		var checkboxes =$('input[name="{{$p['name']}}[]"]:checked');
		for (var i = 0; i < checkboxes.length; i++) {
			checkedValue.push(checkboxes[i].value)
		}
		if($('input[name="{{$p['name']}}][]"').checked = true)
		{
			document.getElementById("all{{$p['name']}}").checked=false;
			document.getElementById("none{{$p['name']}}").checked=false;
		}
		
		if(checkedValue.includes('create') && checkedValue.includes('edit') && checkedValue.includes('delete'))
		{
			document.getElementById("create{{$p['name']}}").checked=false;
			document.getElementById("edit{{$p['name']}}").checked=false;
			document.getElementById("delete{{$p['name']}}").checked=false;
			document.getElementById("all{{$p['name']}}").checked=true;

		}
		if(checkedValue.includes('create') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("all{{$p['name']}}").checked=false;
			document.getElementById("none{{$p['name']}}").checked=false;
		}
		if(checkedValue.includes('edit') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("all{{$p['name']}}").checked=false;
			document.getElementById("none{{$p['name']}}").checked=false;
		}
		if(checkedValue.includes('delete') && !checkedValue.includes('edit') && !checkedValue.includes('delete'))
		{
			document.getElementById("all{{$p['name']}}").checked=false;
			document.getElementById("none{{$p['name']}}").checked=false;
		}

	}

	function btnSearch_Click{{$p['name']}}() {
		document.getElementById("create{{$p['name']}}").checked=false;
		document.getElementById("edit{{$p['name']}}").checked=false;
		document.getElementById("delete{{$p['name']}}").checked=false;
	}
</script>
@endforeach

@endsection