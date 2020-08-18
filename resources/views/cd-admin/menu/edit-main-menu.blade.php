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
			<a href="{{url('cd-admin/view-all-mainMenu')}}">View Menu</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit Menu</span>
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
				<span class="caption-subject font-dark sbold uppercase">Edit Menu</span>
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
			<form class="form-horizontal" role="form" action="{{url('cd-admin/update-mainMenu/'.$menu->id)}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">


					<div class="form-group">
						<label class="col-md-3 control-label">Menu Type<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="menu_type" id="optionsRadios25" value="main_menu" required onClick="addSideMenu()" id="radio_button"{{ ($menu->menu_type == 'main_menu') ? 'checked' : ''}}> Main Menu
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="menu_type" id="optionsRadios26" value="side_menu" required onClick="addSideMenu()" id="radio_button"{{ ($menu->menu_type == 'side_menu') ? 'checked' : ''}}> Side Menu
									<span></span>
								</label>
							</div>
						</div>
						@if ($errors->has('menu_type'))
						<span class="text-danger">{{ $errors->first('menu_type') }}</span>
						@endif
					</div>

					<div class="form-group" id="side_menu_category" <?php echo $menu->menu_type == 'side_menu' ?'style="display:block;"':'style="display:none;"' ?>>
						<label class="col-md-3 control-label">Side Menu Category<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<select class="form-control" name="side_menu_category" id="parent_category">
								<option disabled selected>Select One</option>
								@if($menu->is_parent == 'yes')
								<option value="parent" selected>Parent SideBar</option>
								@else
								<option value="parent">Parent SideBar</option>
								@endif
								@foreach($side_menu as $side)
								@if($side['id'] == $menu['parent_id'])
								<option value="{{$side['id']}}" selected>{{$side['menu_name']}}</option>
								@else
								<option value="{{$side['id']}}">{{$side['menu_name']}}</option>
								@endif
								@endforeach
							</select>
						</div>
						@if ($errors->has('side_menu_category'))
						<span class="text-danger">{{ $errors->first('side_menu_category') }}</span>
						@endif
					</div>

					<div class="form-group" id="main_menu_category" <?php echo $menu->menu_type == 'main_menu' ?'style="display:block;"':'style="display:none;"' ?>>
						<label class="col-md-3 control-label">Main Menu Category<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<select class="form-control" name="main_menu_category" id="main_parent_category" required>
								<option value="parent" selected>Parent Menu</option>
								@foreach($main_menu as $main)
								<option value="{{$main['id']}}">{{$main['menu_name']}}</option>
								@endforeach
							</select>
						</div>
						@if ($errors->has('main_menu_category'))
						<span class="text-danger">{{ $errors->first('main_menu_category') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Enter Menu Name<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter name" name="name" value="{{$menu->menu_name}}" required>
						</div>
						@if ($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"> शीर्षक <span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name_ne" placeholder=" शीर्षक प्रविष्ट गर्नुहोस्" value="{{$menu->menu_name_ne}}">
						</div>
						@if ($errors->has('name_ne'))
						<span class="text-danger">{{ $errors->first('name_ne') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Priority Number</label>
						<div class="col-md-6">
							<input type="number" class="form-control" placeholder="Enter Number" name="priority_no"  value="{{$menu->priority_no}}">
						</div>
						@if ($errors->has('priority_no'))
						<span class="text-danger">{{ $errors->first('priority_no') }}</span>
						@endif
					</div>

					{{-- <div class="form-group">
						<label class="col-md-3 control-label">Image</label>
						<div class="col-md-6">
							<input type="text" name="image_name" class="form-control" placeholder="Enter Image URL" id="image" value="{{$menu->icon}}">
						</div>
						<div class="">
							<a href="#modal-image" data-toggle="modal">
								<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Image</button>
							</a>
							<a href="{{route('add-photos-form')}}">
								<span class="btn btn-success" > 
									Upload Image
								</span>
							</a>
						</div>
					</div> --}}
					<div class="form-group" id="remove_4">
						<label class="col-md-3 control-label">Add</label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="add" id="optionsRadios25" id="post_status" value="page_url" required onclick="showPage()" <?php echo strpos($menu->page_url,'page/') !== false || $menu->page_url == NULL ?'checked':'' ?> checked> Page URL
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="add" id="optionsRadios26" id="post_status" value="post_category" required onclick="showPost()" <?php echo strpos($menu->page_url,'posts/') !== false ?'checked':'' ?>> Post Category
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="add" id="optionsRadios26" id="post_status" value="document_category" required onclick="showDocuments()" <?php echo strpos($menu->page_url,'downloads/') !== false ?'checked':'' ?>> Documents Category
									<span></span>
								</label>
							</div>
						</div>
						@if ($errors->has('status'))
						<span class="text-danger">{{ $errors->first('status') }}</span>
						@endif
					</div>
					<div class="form-group" id="remove_0" <?php echo strpos($menu->page_url,'page/') !== false || $menu->page_url == NULL || $menu->url_type == 'custom'?'style="display:block;"':'style="display:none;"' ?>>
						<label class="col-md-3 control-label">URL Type</label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="url_type" id="optionsRadios25" id="url_type" value="custom" required  onclick="showUrlModal()" <?php echo $menu->url_type == 'custom' ?'checked':'' ?>> Custom
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="url_type" id="optionsRadios26" id="url_type" value="from_pages" required onclick="showUrlModal()"  <?php echo $menu->url_type == 'from_pages' ?'checked':'' ?>> From Pages
									<span></span>
								</label>
							</div>
						</div>
						@if ($errors->has('status'))
						<span class="text-danger">{{ $errors->first('status') }}</span>
						@endif
					</div>
					<div class="form-group" id="remove_1"  <?php echo strpos($menu->page_url,'page/') !== false || $menu->page_url == NULL || $menu->url_type == 'custom' ?'style="display:block;"':'style="display:none;"' ?>>
						<label class="col-md-3 control-label">Page Url</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="url" placeholder="Enter Url" name="page_url"  value="{{$menu->page_url}}">
						</div>
						<div id="remove_url_select" <?php echo $menu->url_type != 'custom'?'style="display:block;"':'style="display:none;"' ?>>
							<a href="#modal-url" data-toggle="modal">
								<button class="btn btn-default"><i class="fa fa-list-ol"></i> Select Url</button>
							</a>
						</div>
						@if ($errors->has('page_url'))
						<span class="text-danger">{{ $errors->first('page_url') }}</span>
						@endif
					</div>

					<div class="form-group" id="remove_3" <?php echo strpos($menu->page_url,'posts/') !== false ?'style="display:block;"':'style="display:none;"' ?>>
						<?php 
						function tag_contents($string, $tag_open, $tag_close)
						{

							foreach (explode($tag_open, $string) as $key => $value) 
							{
								if(strpos($value, $tag_close) !== FALSE)
								{
									$result[] = substr($value, 0, strpos($value, $tag_close));
								}
								else
								{
									$result[] = NULL;
								}
							}
							return $result;
						}

						$slug = tag_contents($menu->page_url,'posts/','/en');

						?>
						<label class="col-md-3 control-label">Post Category<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<select class="form-control" name="post_category">
								<option selected disabled>Select One</option>
								<optgroup label="Post Category">
									@if(strpos($menu->page_url,'posts/') !== false)
									@foreach($post_category as $pc)
									@if($pc['slug'] == $slug[1])
									<option value={{"posts/".$pc['slug']}} selected>{{$pc['name']}}</option>	
									@else
									<option value={{"posts/".$pc['slug']}}>{{$pc['name']}}</option>	
									@endif
									@endforeach
									@else
									@foreach($post_category as $pc)
									<option value={{"posts/".$pc['slug']}}>{{$pc['name']}}</option>	
									@endforeach
									@endif
								</optgroup>

							</optgroup>

						</select>
					</div>
					@if ($errors->has('post_category'))
					<span class="text-danger">{{ $errors->first('post_category') }}</span>
					@endif
				</div>
				<div class="form-group" id="remove_5" <?php echo strpos($menu->page_url,'downloads/') !== false ?'style="display:block;"':'style="display:none;"' ?>>
					<label class="col-md-3 control-label">Documents Category<span class="cd-admin-required">*</span></label>
					<div class="col-md-6">
						<?php $doc = tag_contents($menu->page_url,'downloads/','/en'); ?>
						<select class="form-control" name="document_category">
							<option selected disabled>Select One</option>
							<optgroup label="Resource Category">
								@if(strpos($menu->page_url,'downloads/') !== false)
								@foreach($resource_category as $rc)
								@if($rc['slug'] == $doc[1])
								<option value={{"downloads/".$rc['slug']}} selected>{{$rc['name']}}</option>	
								@else
								<option value={{"downloads/".$rc['slug']}}>{{$rc['name']}}</option>	
								@endif
								@endforeach
								@else
								@foreach($resource_category as $rc)
								<option value={{"downloads/".$rc['slug']}}>{{$rc['name']}}</option>	
								@endforeach
								@endif
							</optgroup>
						</optgroup>

					</select>
				</div>
				@if ($errors->has('post_category'))
				<span class="text-danger">{{ $errors->first('post_category') }}</span>
				@endif
			</div>

			<!-- status section starts -->
			<hr>
			<div class="form-group">
				<label class="col-md-3 control-label">Status<span class="cd-admin-required">*</span></label>
				<div class="col-md-6">
					<div class="mt-radio-inline">
						<label class="mt-radio">
							<input type="radio" name="status" id="optionsRadios25" value="active" required {{ ($menu->active_status == 'active') ? 'checked' : ''}}> Active
							<span></span>
						</label>
						<label class="mt-radio">
							<input type="radio" name="status" id="optionsRadios26" value="inactive" required{{ ($menu->active_status == 'inactive') ? 'checked' : ''}}> Inactive
							<span></span>
						</label>
					</div>
				</div>
				@if ($errors->has('status'))
				<span class="text-danger">{{ $errors->first('status') }}</span>
				@endif
			</div>
			<!-- status section ends -->

		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
<!-- END SAMPLE FORM PORTLET-->
</div>


<div id="modal-url" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">	                  
			</div>
			<div class="modal-body">
				<div class="row">
					@foreach($page as $p)
					<div class="col-md-12 opmcm-menu-url">
						<h4 onclick="write{{$p['id']}}()" data-dismiss="modal">{{$loop->iteration}} ) {{$p['title']}}{{$p['title_ne']}}</h4>
						<input type="hidden" name="link" id="url_link_modal{{$p['id']}}" value="page/{{$p['slug']}}/en">
					</div>
					@endforeach
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-url-ne" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">	                  
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<h4 style=" margin:auto;" onclick="writenp000()" data-dismiss="modal"> NULL</h4>
						<input type="hidden" name="link" id="url_link_modal_ne000" value="Empty">
					</div>
					@foreach($page as $p)
					<div class="col-md-12 opmcm-menu-url">
						<h4 onclick="writenp{{$p['id']}}()" data-dismiss="modal">{{$loop->iteration}} ) {{$p['title']}}{{$p['title_ne']}}</h4>
						<input type="hidden" name="link" id="url_link_modal_ne{{$p['id']}}" value="page/{{$p['slug']}}/np">
					</div>
					@endforeach
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
			</div>
		</div>
	</div>
</div>

@foreach($photo as $p)
<script type="text/javascript">
	function writelink{{$p['id']}}()
	{	
		var link = document.getElementById('image_link_modal{{$p['id']}}');
		document.getElementById('image').value = link.value;
	}
</script>
@endforeach

@foreach($page as $p)
<script type="text/javascript">
	function write{{$p['id']}}()
	{	
		var link = document.getElementById('url_link_modal{{$p['id']}}');
		document.getElementById('url').value = link.value;
	}
</script>
@endforeach
{{-- <script type="text/javascript">
	function write000()
	{	
		var link = document.getElementById('url_link_modal000');
		document.getElementById('url').value = link.value;
	}
</script>
<script type="text/javascript">
	function writenp000()
	{	
		var link = document.getElementById('url_link_modal_ne000');
		document.getElementById('url_ne').value = link.value;
	}
</script> --}}
@foreach($page as $p)
<script type="text/javascript">
	function writenp{{$p['id']}}()
	{	
		var link = document.getElementById('url_link_modal_ne{{$p['id']}}');
		document.getElementById('url_ne').value = link.value;
	}
</script>

@endforeach

<script type="text/javascript">
	function addSideMenu() 
	{
		menu_type = $("input:radio[name=menu_type]:checked").val();
		side_parent = document.getElementById('parent_category').value;
		if(menu_type == 'side_menu')
		{
			document.getElementById('side_menu_category').style.display = "block";
			// if(side_parent == 'parent')
			// {
			// 	document.getElementById('remove_4').style.display = "none";
			// 	document.getElementById('remove_0').style.display = "none";
			// 	document.getElementById('remove_1').style.display = "none";
			// 	document.getElementById('remove_2').style.display = "none";
			// }
			// else
			// {
			// 	document.getElementById('remove_0').style.display = "block";
			// 	document.getElementById('remove_1').style.display = "block";
			// 	document.getElementById('remove_2').style.display = "block";
			// 	document.getElementById('remove_4').style.display = "block";

			// }
			document.getElementById('main_menu_category').style.display = "none";

		}
		else
		{
			document.getElementById('side_menu_category').style.display = "none";
			document.getElementById('main_menu_category').style.display = "block";
			document.getElementById('remove_0').style.display = "block";
			document.getElementById('remove_1').style.display = "block";
			// document.getElementById('remove_2').style.display = "block";
			document.getElementById('remove_4').style.display = "block";
			if(menu_type == 'main_menu')
			{
				document.getElementById('side_menu_category').style.display = "none";
			}
		}
	}
</script>


<script type="text/javascript">
	function showPost() {
		post = $("input:radio[name=add]:checked").val();
		if(post == 'post_category')
		{
			document.getElementById('remove_0').style.display = "none";
			document.getElementById('remove_1').style.display = "none";
				// document.getElementById('remove_2').style.display = "block";
				document.getElementById('remove_3').style.display = "block";
				document.getElementById('remove_5').style.display = "none";

			}
			else
			{
				document.getElementById('remove_0').style.display = "none";
				document.getElementById('remove_1').style.display = "none";
				// document.getElementById('remove_2').style.display = "none";
				document.getElementById('remove_3').style.display = "none";
				document.getElementById('remove_5').style.display = "none";

			}
		}
	</script>
	<script type="text/javascript">
		function showPage() {
			page = $("input:radio[name=add]:checked").val();
			if(page == 'page_url')
			{
				document.getElementById('remove_0').style.display = "block";
				document.getElementById('remove_1').style.display = "block";
			// document.getElementById('remove_2').style.display = "block";
			document.getElementById('remove_3').style.display = "none";
			document.getElementById('remove_5').style.display = "none";

		}
		else
		{
			document.getElementById('remove_0').style.display = "none";
			document.getElementById('remove_1').style.display = "none";
			// document.getElementById('remove_2').style.display = "none";
			document.getElementById('remove_3').style.display = "block";
			document.getElementById('remove_5').style.display = "none";
		}
	}
</script>
<script type="text/javascript">
	function showDocuments() {
		post = $("input:radio[name=add]:checked").val();
		if(post == 'document_category')
		{
			document.getElementById('remove_0').style.display = "none";
			document.getElementById('remove_1').style.display = "none";
			// document.getElementById('remove_2').style.display = "none";
			document.getElementById('remove_3').style.display = "none";
			document.getElementById('remove_5').style.display = "block";
		}
		else
		{
			document.getElementById('remove_0').style.display = "block";
			document.getElementById('remove_1').style.display = "block";
			// document.getElementById('remove_2').style.display = "block";
			document.getElementById('remove_3').style.display = "block";
			document.getElementById('remove_5').style.display = "none";

		}
	}
</script>
<script type="text/javascript">
	function showUrlModal() {
		url_type = $("input:radio[name=url_type]:checked").val();
		if(url_type == 'custom')
		{
			document.getElementById('remove_url_select').style.display = "none";
			document.getElementById('remove_url_select_1').style.display = "none";
		}
		else
		{
			document.getElementById('remove_url_select').style.display = "block";
			document.getElementById('remove_url_select_1').style.display = "block";
		}
	}
</script>
@endsection