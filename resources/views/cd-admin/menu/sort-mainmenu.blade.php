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
		<span>View Menu</span>
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
					<span class="caption-subject bold uppercase"> View Menu </span>
				</div>
				<div class="btn-group pull-right">
					@if(Gate::check('edit-header','header') || Gate::check('all','all'))
					<a href="{{url('cd-admin/sort-mainMenu')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Sort MainMenu
							<i class="fa fa-plus"></i>
						</button>
					</a>
					<a href="{{url('cd-admin/sort-sideMenu')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Sort Side Menu
							<i class="fa fa-plus"></i>
						</button>
					</a>
					<a href="{{url('cd-admin/add-mainMenu')}}">
						<button id="sample_editable_1_new" class="btn sbold green"> Add Menu
							<i class="fa fa-plus"></i>
						</button>
					</a>

					
					@endif
				</div>
			</div>

			<div align="center">
			</div>
			<div class="portlet-body">
				<div class="dd" id="nestable_list_1">
					<ol class="dd-list">
						@foreach($menu as $fsm)
						<li class="dd-item" data-id="{{$fsm['id']}}">
							<div class="dd-handle"> {{$fsm['menu_name_ne']}} </div>
							@if(count($fsm->categories) > 0)
								@if(!empty($fsm->categories))
                                    @include('cd-admin.menu.child-category-view', [ 'category' => $fsm])
                                @endif
							@endif
						</li>
						@endforeach
					</ol>
				</div>
				<form action="{{url('/cd-admin/update-sort')}}" method="POST">
					@csrf
					<div style="display: none;">
						<textarea id=nestable_list_1_output name="sort" rows="10" cols="100"></textarea>
					</div>
					<button class="btn btn-submit" type="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{url('public/cd-admin/assets/pages/scripts/ui-nestable.min.js')}}" type="text/javascript"></script>
@endsection