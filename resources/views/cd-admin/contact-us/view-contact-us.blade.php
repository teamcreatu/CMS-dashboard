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
			<span>View Contact Us</span>
		</li>
	</ul>
</div>
<!-- END PAGE BAR -->

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			@if(isset($contact))
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase"> View Contact Us </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('edit-contactus','contactus') || Gate::check('all','all'))
					<a href="{{route('edit-contact-us-form',$contact['id'])}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Edit Contact Us
							<i class="fa fa-plus"></i>
						</button>
					</a>
					@endif
				</div>
			</div>

			<div align="center">
			</div>
			<div class="portlet-body">
				<div align="center">
					<h1>Contact Us</h1>
				</div>
				<div class="row">
					<div class="col-md-6" style="text-align: center;">
						<h3>In English</h3>
						{!!$contact['description']!!}
					</div>
					<div class="col-md-6" style="text-align: center;">
						<h3>In Nepali</h3>
						{!!$contact['description_ne']!!}
					</div>
				</div>

				<hr>

				@if(isset($contact['fb_link']) OR isset($contact['tw_link']) OR isset($contact['email_id']))
				<div align="center">
					<h2>Other Contact Links</h2>
				</div>
				
				<div style="text-align: center;">
					@if(isset($contact['fb_link']))
					<a href="{{$contact['fb_link']}}"><button class="btn btn-primary"> Facebook Page</button></a>
					@endif

					@if(isset($contact['insta_link']))
					<a href="{{$contact['insta_link']}}"><button class="btn btn-default"> Instagram Page</button></a>
					@endif

					@if(isset($contact['tw_link']))
					<a href="{{$contact['tw_link']}}"><button class="btn btn-warning">Twitter Page</button></a>
					@endif

					@if(isset($contact['email_id']))
					<button class="btn btn-success"><span class="fa fa-envelope"></span> Email Id:{{$contact['email_id']}}</button>
					@endif
				</div>

				@endif
			</div>
			@else
			@if(Gate::check('edit-contactus','contactus') || Gate::check('all','all'))
			<div align="center">
				<a href="{{route('add-contact-us-form')}}"><button class="btn btn-primary">Add Contact Us</button></a>
			</div>
			@endif
			@endif
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- delete modal -->

@endsection