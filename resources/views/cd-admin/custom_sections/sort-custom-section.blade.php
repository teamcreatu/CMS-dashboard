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
		<span>View Sections</span>
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
					<span class="caption-subject bold uppercase"> View Sections </span>
				</div>
				
			</div>

			<div align="center">
			</div>
			<div class="portlet-body">
				<ul class="sortable" class="list-group" >
					@foreach($section as $key=>$s)
					<li class="list-group-item <?php echo $key == 0 ?'active':'' ?>" id="{{$s['id']}}">{{$s['title']}}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
	$(function() {
		$(".sortable").sortable({
			stop: function() {
				$.map($(this).find('li'), function(el) {
					var id = el.id;
					var sorting = $(el).index();
					$.ajax({
						url: '{{Request::root()}}'+'/cd-admin/update-section-sort',
						type: 'GET',
						data: {
							id: id,
							sorting: sorting
						},
					});
				});
			}
		});
	});
</script>
@endsection