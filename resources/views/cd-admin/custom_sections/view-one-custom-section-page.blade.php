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
    <span>View Custom Section</span>
  </li>
</ul>
</div>
<!-- END PAGE BAR -->
<a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
<div class="panel panel-default">
  <div class="panel-heading" align="center"><h3></h3>
  </div>
  <div class="panel-body">
   @if($custom['content_type'] == 'page')
   @foreach($finalSection as $key=>$fs)
   @if($fs['link_type'] == 'internal')
   {!!$fs['description']!!}
   <br>
   @else
   {{$fs['link']}}
   <br>
   @endif
   @endforeach
   @endif
 </div>
</div>
</div>
</div>
</div>
@endsection