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
			<a href="{{url('cd-admin/view-all-pageDetail')}}">View page Detail</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add page Detail</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Page Detail</span>
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
			<form class="form-horizontal" role="form" action="{{url('cd-admin/insert-pageDetail')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Enter Title<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Enter page category name" name="title" id="title" required onchange="changeurl(this.value)">
						</div>
						@if ($errors->has('title'))
						<span class="text-danger">{{ $errors->first('title') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"> शीर्षक<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title_ne" placeholder=" शीर्षक प्रविष्ट गर्नुहोस्" value="{{old('title_ne')}}">
						</div>
						@if ($errors->has('title_ne'))
						<span class="text-danger">{{ $errors->first('title_ne') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label class="col-md-3  control-label">Description<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<textarea type="text" class="form-control summernote" name="description" id="summernote-1" id="description_eng" id="addLinkEng"></textarea>
						</div>
						<div class="col-md-3">
							<div>
								<select class="form-control" id="section_english">
									<option selected disabled>Select Section</option>
									<optgroup label="Default Sections">
										@foreach($default_page as $dp)
										<option value="{{$dp['value']}}">{{$dp->name}}</option>
										@endforeach
									</optgroup>
									@if(count($member_category) != 0)
									<optgroup label="Staffs">
										@foreach($member_category as $s)
										<option value="staff{{$s['id']}}">{{$s['name']}}'s Staffs</option>
										@endforeach
									</optgroup>
									@endif
									@if(count($members) != 0)
									<optgroup label="Staffs Detail">
										@foreach($members as $m)
										<option value="staff-detail{{$m['id']}}">{{$m['name']}}'s Detail</option>
										@endforeach
									</optgroup>
									@endif
									@if(count($member_category) != 0)
									<optgroup label="Teams">
										@foreach($member_category as $mc)
										<option value="staff-team{{$mc['id']}}">{{$mc['name']}}'s Team</option>
										@endforeach
									</optgroup>
									@endif
									@if(count($resource_category) != 0)
									<optgroup label="Documents">
										@foreach($resource_category as $rc)
										<option value="downloads{{$rc['id']}}">{{$rc['name']}}'s Documents</option>
										@endforeach
									</optgroup>
									@endif
									<optgroup label="Media">
										<option value="video-gallery">Video Gallery</option>
										<option value="photo-gallery">Photo Gallery</option>
										<option value="quotes">Quotes</option>
										<option value="speeches">Speeches</option>
										<option value="carousel">Carousel</option>
										<option value="event-list">Events List</option>
										<option value="posts-list">Posts List</option>
									</optgroup>
									@if(count($custom_sections) != 0)
									<optgroup label="Custom Sections">
										@foreach($custom_sections as $cs)
										<option value="custom-{{$cs['id']}}">{{$cs['title']}}</option>
										@endforeach
									</optgroup>
									@endif
								</select>
							</div>
							<a><span class="btn btn-success" onClick="addEnglishSection()">Add Section</span></a>
							<div style="display: none;" id="display_eng">
								<input type="text" id="section_eng_id" name="section_id" value="" class="form-control">
								<span value="copy" onclick="copyToClipboard('section_eng_id')" class="btn btn-primary">Copy!</span>
							</div>
							<div align="center" style="margin-top: 10px;">
								<a href="#modal-file" data-toggle="modal">
									<span class="btn btn-primary" >Add Files</span>
								</a>
								<a href="#modal-image" data-toggle="modal">
									<span class="btn btn-primary" >Add Images</span>
								</a>

							</div>
						</div>
						@if ($errors->has('description'))
						<span class="text-danger">{{ $errors->first('description') }}</span>
						@endif
					</div>

					<div class="form-group">
						<div class="col-md-6" align="center" style="margin-left: 270px;">
							<input type="checkbox" name="same_content" value="same" id="same_content" onclick="checkSame()" checked>Same Content In Nepali
						</div>
					</div>

					<div class="form-group" id="DescriptionNep" style="display: none;">
						<label class=" col-md-3 control-label"> वर्णन <span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<textarea type="text" class="form-control summernote" id="summernote" name="description_np" id="description_nep" height="10" id="addLinkNep">{{old('description_np')}}</textarea>
						</div>
						<div class="col-md-3">
							<div>
								<select class="form-control" id="section_nepali">
									<option selected disabled>Select Section</option>
									<optgroup label="Default Sections">
										@foreach($default_page as $dp)
										<option value="{{$dp['value']}}">{{$dp->name}}</option>
										@endforeach
									</optgroup>
									@if(count($member_category) != 0)
									<optgroup label="Staffs">
										@foreach($member_category as $s)
										<option value="staff{{$s['id']}}">{{$s['name']}}'s Staffs</option>
										@endforeach
									</optgroup>
									@endif
									@if(count($members) != 0)
									<optgroup label="Staffs Detail">
										@foreach($members as $m)
										<option value="staff-detail{{$m['id']}}">{{$m['name']}}'s Detail</option>
										@endforeach
									</optgroup>
									@endif
									@if(count($member_category) != 0)
									<optgroup label="Teams">
										@foreach($member_category as $mc)
										<option value="staff-team{{$mc['id']}}">{{$mc['name']}}'s Team</option>
										@endforeach
									</optgroup>
									@endif
									@if(count($resource_category) != 0)
									<optgroup label="Documents">
										@foreach($resource_category as $rc)
										<option value="downloads{{$rc['id']}}">{{$rc['name']}}'s Documents</option>
										@endforeach
									</optgroup>
									@endif
									<optgroup label="Media">
										<option value="video-gallery">Video Gallery</option>
										<option value="photo-gallery">Photo Gallery</option>
										<option value="quotes">Quotes</option>
										<option value="speeches">Speeches</option>
										<option value="carousel">Carousel</option>
										<option value="event-list">Events List</option>
										<option value="posts-list">Posts List</option>
									</optgroup>
									@if(count($custom_sections) != 0)
									<optgroup label="Custom Sections">
										@foreach($custom_sections as $cs)
										<option value="custom-{{$cs['id']}}">{{$cs['title']}}</option>
										@endforeach
									</optgroup>
									@endif
								</select>
							</div>
							<a ><span class="btn btn-success" onClick="addNepali()">Add Section</span></a>
							<div id="display_ne" style="display:none;">
								<input type="text" id="section_nep_id" name="section_id" value="" class="form-control">
								<span value="copy" onclick="copyToClipboard('section_nep_id')" class="btn btn-primary">Copy!</span>
							</div>

							<div align="center" style="margin-top: 10px;">
								<a href="#modal-file1" data-toggle="modal">
									<span class="btn btn-primary" >Add Files</span>
								</a>
								<a href="#modal-image1" data-toggle="modal">
									<span class="btn btn-primary" >Add Images</span>
								</a>
{{-- <a href="#modal-videos1" data-toggle="modal">
<span class="btn btn-primary" >Add Videos</span>
</a> --}}
</div>
</div>
@if ($errors->has('description_ne'))
<span class="text-danger">{{ $errors->first('description_ne') }}</span>
@endif
</div>
</div>		
<div class="form-group">
	<label class="control-label col-md-3">Tags</label>
	<div class="col-md-6">
		<input type="text" class="form-control input-large" name="tags" value="{{old('tags')}}" data-role="tagsinput"> </div>
		@if ($errors->has('tags'))
		<span class="text-danger">{{ $errors->first('tags') }}</span>
		@endif
	</div>
	<div class="form-group">
		<label class="control-label col-md-3">Publish Date</label>
		<?php $date = Carbon\Carbon::parse(Carbon\Carbon::now('Asia/kathmandu'));?>
		<?php $newDate = Bsdate::eng_to_nep($date->year,$date->month,$date->day); 
		?>
		<div class=" col-md-6 ">
			<input type="text" class="form-control date-picker-nepali single" data-single="true" name="published_date" value="{{$newDate['year']}}-{{$newDate['month']}}-{{$newDate['date']}}">
		</div>
		@if ($errors->has('published_date'))
		<span class="text-danger">{{ $errors->first('published_date') }}</span>
		@endif
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Page URL</label>
		<div class="col-md-6 input-group">
			<span class="input-group-addon">{{Request::root().'/page/'}}</span>
			<input type="text" class="form-control" name="url" id="slug" value="{{old('url')}}">
			<span class="input-group-addon">{{'/en'}}</span>
		</div>
		@if ($errors->has('url'))
		<span class="text-danger">{{ $errors->first('url') }}</span>
		@endif
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	function slugify(text)
	{
		return text.toString().toLowerCase()
		.replace(/\s+/g, '-')          
		.replace(/[^\w\-]+/g, '')       
		.replace(/\-\-+/g, '-')         
		.replace(/^-+/, '')             
		.replace(/-+$/, '');           
	}
</script>
<script type="text/javascript">
	function changeurl(title) 
	{ 
		data = slugify(title);
		document.getElementById('slug').value = data;
	}
</script>

<script type="text/javascript">

	function addEnglishSection()
	{
		english = document.getElementById('section_english').value;
		if (english == "Select Section" || english == null) 
		{
			alert('Please Select One Section');
		}
		else
		{
			var selection = document.getSelection();
			var cursorPos = selection.anchorOffset;
			var oldContent = selection.anchorNode.nodeValue;
			var toInsert = "[[[section[[["+english+"]]]section]]]";
			document.getElementById('section_eng_id').value = toInsert;
			document.getElementById('display_eng').style.display = "block";
			var newContent = oldContent.substring(0, cursorPos) + toInsert + oldContent.substring(cursorPos);
			selection.anchorNode.nodeValue = newContent;
			var insert = document.getElementById('summernote-1').value;
			var newinsert = insert+toInsert;
			document.getElementById('summernote-1').value = newinsert;

		}
	}

</script>

<script type="text/javascript">
	function addNepali()
	{
		var selectedText = ''; 
		nepali = document.getElementById('section_nepali').value;
		if (nepali == "Select Section" || nepali == null) 
		{
			alert('Please Select One Section');
		}
		else
		{
			var selection = document.getSelection();
			var cursorPos = selection.anchorOffset;
			var oldContent = selection.anchorNode.nodeValue;
			var toInsert = "[[[section[[["+nepali+"]]]section]]]";
			document.getElementById('section_nep_id').value = toInsert;
			document.getElementById('display_ne').style.display = "block";
			var newContent = oldContent.substring(0, cursorPos) + toInsert + oldContent.substring(cursorPos);
			selection.anchorNode.nodeValue = newContent;
			var insert = document.getElementById('summernote').value;
			var newinsert = insert+toInsert;
			document.getElementById('summernote').value = newinsert;

		}
	}
</script>
<script>
	function copyToClipboard(id) {
		document.getElementById(id).select();
		document.execCommand('copy');
	}
</script>

<script type="text/javascript">
	function checkSame() {
		data = $("#same_content").is(":checked");
		if(data == true)
		{
			document.getElementById('DescriptionNep').style.display="none";
		}
		else
		{
			document.getElementById('DescriptionNep').style.display = "block";
		}
	}
</script>

<div id="modal-file" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
					<span aria-hidden="true" >&times;</span>
				</button>        	                  
			</div>
			<div class="modal-body">
				<div class="alert" id="messagefile" style="display: none" style="color: red;"></div>
				<div align="center"><h3>Upload File</h3></div>
				<form method="POST" id="upload_form" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<table class="table">
							<tr>
								<td width="40%" align="right"><label>Select File for Upload</label></td>
								<td width="30"><input type="file" name="select_file" id="select_file" /></td>
								<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
							</tr>
							<tr>
								<td width="40%" align="right"></td>
								<td width="30%" align="left"></td>
							</tr>
						</table>
					</div>
					<input type="hidden" name="field_name" value="logo_image">
					<div class="text-center">
						<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loaderfile">
					</div>


				</form>
				<br>

				<div align="center">
					<h3>Select File</h3>
				</div>
				<?php $count = 1 ?>
				@foreach($file as $p)
				<div class="col-md-12 opmcm-menu-url" onclick="writelink{{$p['id']}}()" data-dismiss="modal">
					<p><b>{{$count}})</b>{{$p['file_title']}}({{$p['file_title_ne']}})</p>
					<input type="hidden" name="link" id="image_link_modal{{$p['id']}}" value="{{$p['file_url']}}">
				</div>
				<?php $count++ ?>
				@endforeach
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-file1" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
					<span aria-hidden="true" >&times;</span>
				</button>        	                  
			</div>
			<div class="modal-body">
				<div class="alert" id="messagefile1" style="display: none"></div>
				<div align="center"><h3>Upload File</h3></div>
				<form method="POST" id="upload_form1" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<table class="table">
							<tr>
								<td width="40%" align="right"><label>Select File for Upload</label></td>
								<td width="30"><input type="file" name="select_file" id="select_file" /></td>
								<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
							</tr>
							<tr>
								<td width="40%" align="right"></td>
								<td width="30%" align="left"></td>
							</tr>
						</table>
					</div>
					<input type="hidden" name="field_name" value="logo_image">
					<div class="text-center">
						<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loaderfile1">
					</div>

				</form>
				<br>

				<div align="center">
					<h3>Select File</h3>
				</div>
				<?php $count = 1 ?>
				@foreach($file as $p)
				<div class="col-md-12 opmcm-menu-url" onclick="writelinknep{{$p['id']}}()" data-dismiss="modal">
					<p><b>{{$count}})</b>{{$p['file_title']}}({{$p['file_title_ne']}})</p>
					<input type="hidden" name="link" id="image_link_modalnep{{$p['id']}}" value="{{$p['file_url']}}">
				</div>
				<?php $count++ ?>
				@endforeach
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
			</div>
		</div>
	</div>
</div>



{{-- Image Modals --}}



<div id="modal-image" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
					<span aria-hidden="true" >&times;</span>
				</button>        	                  
			</div>
			<div class="modal-body">
				<div class="alert" id="messagephoto" style="display: none"></div>
				<div class="row">
					<div align="center"><h3>Upload Image</h3></div>
					<form method="POST" id="upload_image_form" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<table class="table">
								<tr>
									<td width="40%" align="right"><label>Select File for Upload</label></td>
									<td width="30"><input type="file" name="select_file" id="select_file" /></td>
									<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
								</tr>
								<tr>
									<td width="40%" align="right"></td>
									<td width="30"><span class="text-muted">jpg, png, gif</span></td>
									<td width="30%" align="left"></td>
								</tr>
							</table>
						</div>
						<input type="hidden" name="field_name" value="logo_image">
						<div class="text-center">
							<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loaderimage">
						</div>

					</form>
					<div id="uploaded_image_photo" align="center"></div>

					<br>

					<div align="center">
						<h3>Select Image</h3>
					</div>
					@foreach($photo as $p)
					<div class="col-md-3">
						<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="addPhoto{{$p['id']}}()" data-dismiss="modal">
						<input type="hidden" name="link" id="image_modal{{$p['id']}}" value="{{$p['image_url']}}">
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
<div id="modal-image1" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
					<span aria-hidden="true" >&times;</span>
				</button>        	                  
			</div>
			<div class="modal-body">
				<div class="alert" id="messagephoto1" style="display: none"></div>
				<div class="row">
					<div align="center"><h3>Upload Image</h3></div>
					<form method="POST" id="upload_image_form1" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<table class="table">
								<tr>
									<td width="40%" align="right"><label>Select File for Upload</label></td>
									<td width="30"><input type="file" name="select_file" id="select_file" /></td>
									<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
								</tr>
								<tr>
									<td width="40%" align="right"></td>
									<td width="30"><span class="text-muted">jpg, png, gif</span></td>
									<td width="30%" align="left"></td>
								</tr>
							</table>
						</div>
						<input type="hidden" name="field_name" value="logo_image">
						<div class="text-center">
							<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loaderimage1">
						</div>

					</form>
					<div id="uploaded_image_photo1" align="center"></div>

					<br>

					<div align="center">
						<h3>Select Image</h3>
					</div>
					@foreach($photo as $p)
					<div class="col-md-3">
						<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="addPhotonep{{$p['id']}}()" data-dismiss="modal">
						<input type="hidden" name="link" id="image_modal1nep{{$p['id']}}" value="{{$p['image_url']}}">
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

{{-- Video Modals  --}}

<div id="modal-videos" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
					<span aria-hidden="true" >&times;</span>
				</button>        	                  
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="alert" id="message" style="display: none"></div>
					<div align="center"><h3>Upload Video</h3></div>
					<form method="POST" id="upload_video_form" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<table class="table">
								<tr>
									<td width="40%" align="right"><label>Select File for Upload</label></td>
									<td width="30"><input type="file" name="select_file" id="select_file" /></td>
									<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
								</tr>
								<tr>
									<td width="40%" align="right"></td>
									<td width="30%" align="left"></td>
								</tr>
							</table>
						</div>
						<input type="hidden" name="field_name" value="logo_image">
						<div class="text-center">
							<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loadervideo">
						</div>

					</form>

					<br>

					<div id="uploaded_video" align="center"></div>
					<div align="center">
						<h3>Select Video</h3>
					</div>
					@foreach($video as $v)
					<div class="col-md-3">
						<video width="250" height="200" controls>
							<source src="{{Request::root().'/'.$v['video_url']}}">
							</video>
							<div align="center">
								<span class="btn btn-success" onclick="addVideo{{$v['id']}}()" data-dismiss="modal" style="margin:auto;">Select</span>
								<input type="hidden" name="link" id="video_modal{{$v['id']}}" value="{{$v['video_url']}}">
							</div>
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

	<div id="modal-videos1" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
						<span aria-hidden="true" >&times;</span>
					</button>        	                  
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="alert" id="messagevideo1" style="display: none"></div>
						<div align="center"><h3>Upload Video</h3></div>
						<form method="POST" id="upload_video_form1" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<table class="table">
									<tr>
										<td width="40%" align="right"><label>Select File for Upload</label></td>
										<td width="30"><input type="file" name="select_file" id="select_file" /></td>
										<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
									</tr>
									<tr>
										<td width="40%" align="right"></td>
										<td width="30%" align="left"></td>
									</tr>
								</table>
							</div>
							<input type="hidden" name="field_name" value="logo_image">
							<div class="text-center">
								<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loadervideo1">
							</div>

						</form>

						<br>

						<div id="uploaded_video1" align="center"></div>
						<div align="center">
							<h3>Select Video</h3>
						</div>
						@foreach($video as $v)
						<div class="col-md-3">
							<video width="250" height="200" controls>
								<source src="{{Request::root().'/'.$v['video_url']}}">
								</video>
								<div align="center">
									<span class="btn btn-success" onclick="addVideonep{{$v['id']}}()" data-dismiss="modal" style="margin:auto;">Select</span>
									<input type="hidden" name="link" id="video_modal1{{$v['id']}}" value="{{$v['video_url']}}">
								</div>
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


		@foreach($file as $p)
		<script type="text/javascript">
			function writelink{{$p['id']}}()
			{	
				var link = document.getElementById('image_link_modal{{$p['id']}}');
				$('#summernote-1').summernote('createLink', {
					text: '{{$p['file_title']}}',
					url: '{{Request()->root()}}'+'/'+link.value,
					isNewWindow: true
				});
			}
		</script>
		<script type="text/javascript">
			function writelinknep{{$p['id']}}()
			{	
				var link = document.getElementById('image_link_modalnep{{$p['id']}}');
				$('#summernote').summernote('createLink', {
					text: '{{$p['file_title']}}',
					url: '{{Request()->root()}}'+'/'+link.value,
					isNewWindow: true
				});
			}
		</script>
		@endforeach

		@foreach($photo as $ph)
		<script type="text/javascript">
			function addPhoto{{$ph['id']}}()
			{	
				var link = document.getElementById('image_modal{{$ph['id']}}');
				$('#summernote-1').summernote('insertImage','{{Request::root()}}'+'/'+link.value);

			}
		</script>
		<script type="text/javascript">
			function addPhotonep{{$ph['id']}}()
			{	
				var link = document.getElementById('image_modal1nep{{$ph['id']}}');
				$('#summernote').summernote('insertImage','{{Request::root()}}'+'/'+link.value);

			}
		</script>
		@endforeach

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<script>
			$(document).ready(function(){

				$('#upload_form').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-post-files-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loaderfile").show();
						},

						success:function(data)
						{
							$('#loaderfile').hide();
							$('#modal-file').modal('hide');
							$('#messagefile').css('display', 'block');
							$('#messagefile').html(data.message);
							$('#messagefile').addClass(data.class_name);
							$('#uploaded_image').html(data.uploaded_image);
							$('#summernote-1').summernote('createLink', {
								text: data.title,
								url: data.image_url,
								isNewWindow: true
							});
						}
					})
				});

			});
		</script>
		<script>
			$(document).ready(function(){

				$('#upload_form1').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-post-files-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loaderfile1").show();
						},

						success:function(data)
						{
							$('#loaderfile1').hide();
							$('#modal-file1').modal('hide');
							$('#messagefile1').css('display', 'block');
							$('#messagefile1').html(data.message);
							$('#messagefile1').addClass(data.class_name);
							$('#summernote').summernote('createLink', {
								text: data.title,
								url: data.image_url,
								isNewWindow: true
							});
						}
					})
				});

			});
		</script>


		{{-- Image Scripts --}}
		<script>
			$(document).ready(function(){

				$('#upload_image_form').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-photo-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loaderimage").show();
						},

						success:function(data)
						{
							$('#loaderimage').hide();
							$('#modal-image').modal('hide');
							var url = '{{Request::root()}}'+'/'+data.image_url;
							$('#messagephoto').css('display','block');
							$('#messagephoto').html(data.message);
							$('#messagephoto').addClass(data.class_name);
							$('#uploaded_image_photo').html(data.uploaded_image);
							$('#summernote-1').summernote('insertImage',url);
						}
					})
				});

			});
		</script>
		<script>
			$(document).ready(function(){

				$('#upload_image_form1').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-photo-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loaderimage1").show();
						},

						success:function(data)
						{
							$('#loaderimage1').hide();
							$('#modal-image1').modal('hide');
							var url = '{{Request::root()}}'+'/'+data.image_url;
							$('#messagephoto1').css('display', 'block');
							$('#messagephoto1').html(data.message);
							$('#messagephoto1').addClass(data.class_name);
							$('#uploaded_image_photo1').html(data.uploaded_image);
							$('#summernote').summernote('insertImage',url);
						}
					})
				});

			});
		</script>
		{{-- Video Scripts	 --}}

		<script>
			$(document).ready(function(){

				$('#upload_video_form').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-videos-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loadervideo").show();
						},

						success:function(data)
						{
							$('#loadervideo').hide();
							$('#modal-videos').modal('hide');
							$('#message').css('display', 'block');
							$('#message').html(data.message);
							$('#message').addClass(data.class_name);
							$('#uploaded_image').html(data.uploaded_image);
							$('#video_url').val(data.image_url);
						}
					})
				});

			});
		</script>

		<script>
			$(document).ready(function(){

				$('#upload_video_form1').on('submit', function(event){
					event.preventDefault();
					$.ajax({
						url:"{{ route('add-videos-dynamic') }}",
						method:"POST",
						data:new FormData(this),
						dataType:'JSON',
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#loadervideo1").show();
						},

						success:function(data)
						{
							$('#loadervideo1').hide();
							$('#modal-videos1').modal('hide');
							$('#messagevideo1').css('display', 'block');
							$('#messagevideo1').html(data.message);
							$('#messagevideo1').addClass(data.class_name);
							$('#uploaded_video1').html(data.uploaded_image);
							$('#video_url1').val(data.image_url);
						}
					})
				});

			});
		</script>

		@endsection