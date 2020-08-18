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
			<a href="{{url('cd-admin/view-custom-widgets')}}">View Custom Widgets</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Custom Widgets</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('add-custom-widgets')}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Add Custom Widgets</span>
				</div>
			</div>
			@if(Session::has('danger'))
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Please Add At Least One Widget</strong>
			</div>
			@endif
			<div class="portlet-body form">
				<div class="form-body">
					<div class="portlet-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Custom Widget Title<span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" placeholder="Enter Custom Widget Title" value="{{old('title')}}">
							</div>
							@if ($errors->has('title'))
							<span class="text-danger">{{ $errors->first('title') }}</span>
							@endif
						</div>
						<br>
						<div class="form-group">
							<label class="col-md-3 control-label">Custom Widgetको शीर्षक <span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title_ne" placeholder="Custom Widget प्रविष्ट गर्नुहोस्" value="{{old('title_ne')}}">
							</div>
							@if ($errors->has('title_ne'))
							<span class="text-danger">{{ $errors->first('title_ne') }}</span>
							@endif
						</div>
						<br>
						{{-- <div class="col-md-12" align="center">
							<a href="#modal-members" data-toggle="modal">
								<span><button class="btn btn-primary" onclick="openWidget()">Add Widget</button></span>
							</a>
						</div> --}}
						<br>
						<br>
						<div class="row">
							<div id="dynamicInput">

							</div>
						</div>
						<div class="pull-right" id="addWidgetButton">
							<span class="btn btn-success" value="Add another text input" onClick="addInput('dynamicInput');">Add Widgets</span>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="col-md-3 control-label">Status <span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<div class="mt-radio-inline">
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo old('status') == 'active'?'checked':''  ?> checked> Active
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="status" id="optionsRadios26" value="inactive" <?php echo old('status') == 'inactive'?'checked':'' ?>> Inactive
									<span></span>
								</label>
							</div>
						</div>
						@if ($errors->has('status'))
						<span class="text-danger">{{ $errors->first('status') }}</span>
						@endif
					</div>						
				</div>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
	<button type="submit" class="btn btn-btn-primary" style="margin-left: 504px;">Submit</button>
	<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

</form>
@for($i= 0;$i<=10;$i++)
<div id="modal-image{{$i}}" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">    
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
					<span aria-hidden="true" >&times;</span>
				</button>                        
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs"id="tabContent">
					<li class="active"><a href="#member-widgets{{$i}}" data-toggle="tab">Staffs Widgets</a></li>
					<li><a href="#staff-categories{{$i}}" data-toggle="tab">Staffs Category</a></li>
					<li><a href="#posts{{$i}}" data-toggle="tab">Posts</a></li>
					<li><a href="#custom-widgets{{$i}}" data-toggle="tab">Custom Widgets</a></li>
					<li><a href="#contact-us{{$i}}" data-toggle="tab">Contact Us Widget</a></li>
				</ul>
				<div class="row tab-content">
					<div class="tab-pane active" id="member-widgets{{$i}}">
						<div align="center">
							<h2>Staffs Widgets</h2>
						</div>
						<h4>Demo</h4>
						<div class="col-md-3" style="margin: 10px; border: 2px solid lightblue; height:215px;width:200px;">
							<div class="col-md-3">
								<div class="footer-person-title">
									<h4 class="h4-fsc">Member Widget</h4>
								</div>
								<div class="footer-person-image">
									<img src="{{Request::root().'/'.'public/images/noimage.png'}}" alt="" class="img img-fluid rounded" style="height: 70px; width: 70px;">
								</div>
								<div class="footer-person-detail">
									<h6 class="h6-fsc">Member Name</h6>
									<p class="p-fsc">
										Category Name
									</p>
								</div>
							</div>
						</div>
						
						<form id="upload_image_form{{$i}}" >
							{{ csrf_field() }}
							<div class="form-group">
								<label class="col-md-3 control-label" align="center">Select A Member</label>
								<div class="col-md-6">
									<select name="member_name" class="form-control" id="member_name{{$i}}">
										<option selected disabled>Select One Member</option>
										@foreach($members as $m)
										<option value="{{$m['id']}}">{{$m['name']}}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('member_name'))
								<span class="text-danger">{{ $errors->first('member_name') }}</span>
								@endif
							</div>
							<input type="submit" name="upload" id="upload" class="btn btn-primary" value="Search" align="center"></td>
						</form>

						<div style="clear: both" class="alert" id="messagephoto{{$i}}" style="display: none"></div>
						<div id="uploaded_image_photo{{$i}}" align="center"></div>

					</div>
					<div class="tab-pane" id="staff-categories{{$i}}">
						<div align="center" style="clear: both;">
							<h2>Staff Categories</h2>
						</div>		
						<?php $count = 1 ?>
						@foreach($category as $sc)
						<div class="col-md-12 opmcm-menu-url" onclick="selectcategories{{$sc['id']}}({{$i}})" data-dismiss="modal">
							<p><b>{{$count}})</b>{{$sc['name']}}({{$sc['name_ne']}})</p>
						</div>
						<?php $count++ ?>
						<input type="hidden" name="link" id="widget_linkcategory{{$sc['id']}}" value="{{'staffscategory/'.$sc['id']}}">
						@endforeach
					</div>
					<div class="tab-pane" id="posts{{$i}}">
						<div align="center" style="clear: both;">
							<h2>Posts</h2>
						</div>		
						<?php $count = 1 ?>
						@foreach($posts as $p)
						<div class="col-md-12 opmcm-menu-url" onclick="selectposts{{$p['id']}}({{$i}})" data-dismiss="modal">
							<p><b>{{$count}})</b>{{$p['title']}}({{$p['title_ne']}})</p>
						</div>
						<?php $count++ ?>
						<input type="hidden" name="link" id="widget_linknew{{$p['id']}}" value="{{'postswidgets/'.$p['id']}}">
						@endforeach
					</div>
					<div class="tab-pane " id="custom-widgets{{$i}}">
						<div align="center" style="clear: both;">
							<h2>Custom Widgets</h2>
						</div>		
						<?php $count = 1 ?>
						@foreach($make_widgets as $m)
						<div class="col-md-12 opmcm-menu-url" onclick="selectmakewidgets{{$m['id']}}({{$i}})" data-dismiss="modal">
							<p><b>{{$count}})</b>{{$m['title']}}({{$m['title_ne']}})</p>
							<input type="hidden" name="link" id="widget_linkmake{{$m['id']}}" value="{{'madecustomwidgets/'.$m['id']}}">
						</div>
						<?php $count++ ?>
						@endforeach
					</div>
					<div class="tab-pane " id="contact-us{{$i}}">
						<div style="clear: both;">
							<div align="center">
								<h2>Contact Us Widget</h2>
							</div>
							<div class="col-md-3" style="margin: 10px; border: 2px solid lightblue; height:auto;width:auto;" onclick="select({{$i}})" data-dismiss="modal">
								<div class="row">
									<div class="col-md-6 home-contact-left">
										<h4 class="h4-fsc">Contact details</h4>
										<p class="p-fsc">Contact us anytime</p>
									</div>

									<div class="col-md-6 home-contact-right">
										<p class="p-fsc">In case of difficulty contact in</p>
										<h4 class="h4-fsc">{{$contact['emergency_contact']}}</h4>
									</div>
								</div>

								<div class="home-contact-card">
									{!!$contact['description']!!}
								</div>
								<input type="hidden" name="link" id="contact_link" value="contactus">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
			</div>
		</div>
	</div>
</div>
@endfor

<script type="text/javascript">
	var counter = 0;
	var limit = 3;
	function addInput(divName){
		if (counter == limit)  {
			alert("You have reached the limit of adding " + counter + " inputs");
			document.getElementById('addWidgetButton').style.display ="none";
		}
		else {
			var newdiv = document.createElement('div');
			newdiv.setAttribute("id",'one'+counter);
			newdiv.innerHTML+='<div class="form-group">';
			newdiv.innerHTML+='<label class="col-md-3 control-label">Widgets<span class="cd-admin-required">*</span></label>';
			newdiv.innerHTML+='<div class="col-md-6">';
			newdiv.innerHTML+='<input type="text" name="widgets[]" value="" id="choose_widget'+counter+'" class="form-control" required>';
			newdiv.innerHTML+='<div class="col-md-1">';
			newdiv.innerHTML+='<a href="#modal-image'+ counter +'" data-toggle="modal"><span class="btn btn-primary">Choose</span></a>';
			newdiv.innerHTML+='</div>';
			newdiv.innerHTML+='</div>';
			newdiv.innerHTML+='</div>';
			newdiv.innerHTML+='</div>';
			newdiv.innerHTML+='<div align="center">';
			newdiv.innerHTML+='<span class="btn btn-danger" id="remove_button" onclick="deleteInput('+counter+')">Delete</span>';
			newdiv.innerHTML+='</div>';
			document.getElementById(divName).appendChild(newdiv);
			counter++;
		}
	}

	function deleteInput(i) {
		var input= document.getElementById('one'+i);
		input.parentNode.removeChild(input);
	}
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
{{-- @foreach($members as $m)
<script type="text/javascript">
	function select{{$m['id']}}(i)
	{ 
		var link = document.getElementById('widget_link{{$m['id']}}');
		document.getElementById('modal-image'+i).style.display ="none";
		document.getElementById('choose_widget'+i).value = link.value;
	}
</script>
@endforeach --}}
<script type="text/javascript">
	function select(i)
	{ 
		var link = document.getElementById('contact_link');
		document.getElementById('choose_widget'+i).value = link.value;
	}
</script>
@foreach($posts as $p)
<script type="text/javascript">
	function selectposts{{$p['id']}}(i)
	{ 
		var link = document.getElementById('widget_linknew{{$p['id']}}');
		document.getElementById('modal-image'+i).style.display ="none";
		document.getElementById('choose_widget'+i).value = link.value;
	}
</script>
@endforeach

@foreach($make_widgets as $m)
<script type="text/javascript">
	function selectmakewidgets{{$m['id']}}(i)
	{ 
		var link = document.getElementById('widget_linkmake{{$m['id']}}');
		document.getElementById('modal-image'+i).style.display ="none";
		document.getElementById('choose_widget'+i).value = link.value;
	}
</script>
@endforeach
@foreach($category as $sc)
<script type="text/javascript">
	function selectcategories{{$sc['id']}}(i)
	{ 
		var link = document.getElementById('widget_linkcategory{{$sc['id']}}');
		document.getElementById('choose_widget'+i).value = link.value;
	}
</script>
@endforeach

{{-- 		<script type="text/javascript">
	function openWidget() 
	{
		var x = document.getElementById("widget");
		if (x.style.display === "none") 
		{
			x.style.display = "block";

		} else 
		{

		}
	}

	function add() {
		var x = document.getElementById("widget");
		if(x.style.display === "none")
		{
			x.style.display ="block";
		}
		else
		{
			var newdiv =document.createElement('div');
			newdiv.innerHTML = document.getElementById("widget").outerHTML;
			document.getElementById('clone').appendChild(newdiv);
		}

	}
	function remove() {
		var newdiv =document.createElement('div');
		newdiv.innerHTML = document.getElementById("widget").remove() ;
	}


</script> --}}


<script type="text/javascript">
	function selectMemberCategories(widget_id,category_id,member_id) {
		var link = document.getElementById('widget_linkmembercategory'+category_id);
		document.getElementById('modal-image'+widget_id).style.display ="none";
		document.getElementById('choose_widget'+widget_id).value = link.value;
	}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

@for($i=0;$i<=10;$i++)
<script>

	$('#upload_image_form{{$i}}').on('submit', function(event){
		event.preventDefault();

		name = $('#member_name{{$i}}').val();
		widget = {{$i}};
		$.ajax({
			url:'{{route('search-members-dynamic')}}',
			type:"GET",
			data:{
				"_token": "{{ csrf_token() }}",
				member_name:name,
				widget_no:{{$i}},
			},
			success:function(data)
			{
				var url = '{{Request::root()}}'+'/'+data.image_url;
				$('#messagephoto'+{{$i}}).css('display','block');
				$('#messagephoto'+{{$i}}).html(data.message);
				$('#messagephoto'+{{$i}}).addClass(data.class_name);
				$('#uploaded_image_photo'+{{$i}}).html(data.uploaded_image);
				$('#addLinkEng'+{{$i}}).summernote('insertImage',url);
			}
		});
	});
</script>
@endfor
@endsection