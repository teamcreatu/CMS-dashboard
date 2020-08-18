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
			<a href="{{url('cd-admin/view-photo-gallery')}}">View Gallery</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Gallery</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->



<form action="{{route('add-photo-to-gallery',$data['id'])}}" method="POST">
	@csrf
	<div class="row">

		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject font-dark sbold uppercase">Add One Photo to {{$data['title']}}</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-group">
					<label class="control-label">Multiple Images<span class="cd-admin-required">*</span></label>
					<br>
					<div>
						<input type="text" name="image_names" class="form-control" placeholder="Enter Image URL" id="multiple_image" value="{{old('image_names')}}">
					</div>
					<div class="pull-right">
						<a href="#modal-image1" data-toggle="modal">
							<button class="btn btn-default"><i class="fa fa-picture-o"></i> Select Images</button>
						</a>
					</div>
					
					@if ($errors->has('image_names'))
					<span class="text-danger">{{ $errors->first('image_names') }}</span>
					@endif
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->
		</div>
		<button type="submit" class="btn btn-primary" style="margin:auto;">Submit</button>
		<a href="{{url()->previous()}}"><button type="button" class="btn btn-danger">Cancel</button></a>

	</form>
	<div id="modal-image1" class="modal fade bs-modal-lg in" id="large" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;">
						<span aria-hidden="true" >&times;</span>
					</button>                          
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="alert" id="message1" style="display: none"></div>
						<div align="center"><h3>Upload Image</h3></div>
						<form method="POST" id="upload_form1" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<table class="table">
									<tr>
										<td width="40%" align="right"><label>Select File for Upload</label></td>
										<td width="30"><input type="file" name="select_file" id="select_file" /></td>
										<td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
									</tr>
								</table>
							</div>
							<input type="hidden" name="field_name" value="side_logo">
						</form>
						<div id="uploaded_image1" align="center"></div>
						<div class="text-center">
							<img class="" src="https://media0.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" style=" display:none; height: 100px; width: 100px;" id="loader">
						</div>

						<br>

						<div align="center">
							<h3>Select Image</h3>
						</div>
						@foreach($photo as $p)
						<div class="col-md-3">
							<img src="{{Request::root().'/'.$p['image_url']}}" height="150px" width="200px" class="selected{{$p['id']}}" style="border: dotted; margin:auto;" onclick="writemultiplelink{{$p['id']}}()">
							<div class="centered" id="target" hidden>Selected</div>
							<input type="hidden" name="link" id="image_link_modal1{{$p['id']}}" value="{{$p['image_url']}}">
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
			document.getElementById('logo_image').value = link.value;
		}
	</script>
	<script type="text/javascript">
		
		function writemultiplelink{{$p['id']}}()
		{	
			var link = document.getElementById('image_link_modal1{{$p['id']}}');
			var mul = document.getElementById('multiple_image');
			if (mul.value == '') 
			{
				mul.value = link.value;
			}
			else
			{
				mul.value = mul.value + ',' + link.value;
			}

		}
	</script>
	@endforeach
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<script>
		$(document).ready(function(){

			$('#upload_form1').on('submit', function(event){
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
						$("#loader").show();
					},
					success:function(data)
					{
						$('#loader').hide();
						$('#modal-image1').modal('hide');
						$('#message1').css('display', 'block');
						$('#message1').html(data.message);
						$('#message1').addClass(data.class_name);
						$('#uploaded_image1').html(data.uploaded_image);
						$('#multiple_image').append(data.image_url);
					}
				})
			});

		});
	</script>
	@endsection