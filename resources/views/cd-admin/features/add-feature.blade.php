@extends('cd-admin.admin-master')

<!-- page content -->
@section('content')

<style>
	select{
		font-family: fontAwesome
	}
</style>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="{{url('cd-admin/dashboard')}}">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="{{url('cd-admin/view-features')}}">View Feature</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Add Feature</span>
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
				<span class="caption-subject font-dark sbold uppercase">Add Feature</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="{{route('add-feature')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Feature Title<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title" placeholder="Enter Feature Name" value="{{old('title')}}">
						</div>
						@if ($errors->has('title'))
						<span class="text-danger">{{ $errors->first('title') }}</span>
						@endif
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Feature Link<span class="cd-admin-required">*</span></label>
						<div class="col-md-6">
							<input type="url" class="form-control" name="feature_url" placeholder="Enter Feature URL" value="{{old('feature_url')}}">
						</div>
						@if ($errors->has('feature_url'))
						<span class="text-danger">{{ $errors->first('feature_url') }}</span>
						@endif
					</div>

				{{-- 	<div class="form-group">
						<label class="col-md-3 control-label">Image<span class="cd-admin-required">*</span></label>
						<br>
						<div class="col-md-6">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
								<div>
									<span class="btn red btn-outline btn-file">
										<span class="fileinput-new"> Select image </span>
										<span class="fileinput-exists"> Change </span>
										<input type="file" name="image_name"> </span>
										<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
									</div>
								</div>
							</div>
							@if ($errors->has('image_name'))
							<span class="text-danger">{{ $errors->first('image_name') }}</span>
							@endif
						</div> --}}

						<div class="form-group">
							<label class="col-md-3 control-label">Featured Icon<span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-file-alt" checked> <i class="fas fa-file-alt"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-file-pdf"> <i class="fas fa-file-pdf"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-file-word"> <i class="fas fa-file-word"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-file-image"> <i class="fas fa-file-image"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-file-audio"> <i class="fas fa-file-audio"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fa-file-archive"> <i class="fas fa-file-archive"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-bell"> <i class="fas fa-bell"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-bookmark"> <i class="fas fa-bookmark"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-bullhorn"> <i class="fas fa-bullhorn"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-bullseye"> <i class="fas fa-bullseye"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-camera"> <i class="fas fa-camera"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-calendar-alt"> <i class="fas fa-calendar-alt"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-cloud"> <i class="fas fa-cloud"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-cog"> <i class="fas fa-cog"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-address-book"> <i class="fas fa-address-book"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-biking"> <i class="fas fa-biking"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-power-off"> <i class="fas fa-power-off"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-portrait"> <i class="fas fa-portrait"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-smile"> <i class="fas fa-smile"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-user"> <i class="fas fa-user"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-user-check"> <i class="fas fa-user-check"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-user-cog"> <i class="fas fa-user-cog"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-exclamation"> <i class="fas fa-exclamation"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-comment"> <i class="fas fa-comment"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-envelope"> <i class="fas fa-envelope"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-microphone"> <i class="fas fa-microphone"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-mobile-alt"> <i class="fas fa-mobile-alt"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-phone"> <i class="fas fa-phone"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-paper-plane"> <i class="fas fa-paper-plane"></i>
										<span></span>
									</label>

									<label class="mt-radio">
										<input type="radio" name="fa_icon" id="optionsRadios28" value="fas fa-wifi"> <i class="fas fa-wifi"></i>
										<span></span>
									</label>
								</div>
							</div>
						</div>



						<!-- status section starts -->
						<hr>
						<div class="form-group">
							<label class="col-md-3 control-label">Status<span class="cd-admin-required">*</span></label>
							<div class="col-md-6">
								<div class="mt-radio-inline">
									<label class="mt-radio">
										<input type="radio" name="status" id="optionsRadios25" value="active" <?php echo old('status') == 'active' ?'checked':'' ?> checked> Active
										<span></span>
									</label>
									<label class="mt-radio">
										<input type="radio" name="status" id="optionsRadios26" value="inactive" <?php echo old('status') == 'inactive' ?'checked':'' ?>> Inactive
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
						@foreach($photo as $p)
						<div class="col-md-3">
							<img src="{{url(Request::root().'/'.$p['image_url'])}}" height="150px" width="200px" style="border: dotted; margin:auto;" onclick="writelink{{$p['id']}}()" data-dismiss="modal">
							<input type="hidden" name="link" id="image_link_modal{{$p['id']}}" value="{{$p['image_url']}}">
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
	@endsection