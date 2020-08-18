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
			<a href="{{url('cd-admin/view-photos')}}">View Documents</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Documents</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Documents</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{route('add-resource')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Under Category<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							@if(old('category'))
							<select class="mt-multiselect btn btn-default " name="category[]" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true">
								@foreach($category as $c)
								@if(in_array($c['id'],old('category')))
								<option value="{{$c['id']}}" selected>{{$c['name']}}</option>
								@else
								<option value="{{$c['id']}}">{{$c['name']}}</option>
								@endif
								@endforeach
							</select>
							@else
							<select class="mt-multiselect btn btn-default " name="category[]" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true">
								@foreach($category as $c)
								<option value="{{$c['id']}}">{{$c['name']}}</option>
								@endforeach
							</select>
							@endif
							@if ($errors->has('category'))
							<span class="text-danger">{{ $errors->first('category') }}</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">File Title<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="file_name" placeholder="Enter File Title" value="{{old('file_name')}}">
						</div>
						@if ($errors->has('file_name'))
						<span class="text-danger">{{ $errors->first('file_name') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">शीर्षक<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="file_name_ne" placeholder="फाईलको शीर्षक प्रविष्ट गर्नुहोस्" value="{{old('file_name_ne')}}">
						</div>
						@if ($errors->has('file_name_ne'))
						<span class="text-danger">{{ $errors->first('file_name_ne') }}</span>
						@endif
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">File<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" name="file" class="form-control" placeholder="Enter File URL" id="file" value="{{old('file')}}">
						</div>
						<div class="">
							<a href="#modal-image" data-toggle="modal">
								<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select File</button>
							</a>
						</div>
						@if ($errors->has('file'))
						<span class="text-danger">{{ $errors->first('tags') }}</span>
						@endif
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
						<hr>
						<div class="form-group">
							<label class="col-md-3 control-label">Status<span class="cd-admin-required">*</span></label>
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
	<div id="modal-image" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
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
								<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loader">
							</div>
						</form>
						<div id="uploaded_image" align="center"></div>
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
			document.getElementById('file').value = link.value;
		}
	</script>
	@endforeach

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<script>
		$(document).ready(function(){

			$('#upload_form').on('submit', function(event){
				event.preventDefault();
				$.ajax({
					url:"{{ route('add-files-dynamic') }}",
					method:"POST",
					data:new FormData(this),
					dataType:'JSON',
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function(){
						$("#loader").show();
					},

					success:function(data)
					{
						$('#loader').hide();
						$('#message').css('display', 'block');
						$('#message').html(data.message);
						$('#message').addClass(data.class_name);
						$('#uploaded_image').html(data.uploaded_image);
						$('#file').val(data.image_url);
					}
				})
			});

		});
	</script>
	@endsection