@extends('cd-admin.admin-master')

<!-- page content -->
@section('content')

<!-- BEGIN PAGE BAR -->
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title" align="center">Welcome {{Auth::user()->full_name}} , You are adding content to the Creatu CMS .</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
        <?php $header = App\Header::where('deleted_at',NULL)->get()->first(); ?>

	<img src="{{url(Request::root().'/'.$setting['logo_image'])}}" class="img-fluid" height="500" width="100%" style="object-fit: contain; opacity:0.5">
</div>
<div class="clearfix"></div>
<!-- END DASHBOARD STATS 1-->

@endsection