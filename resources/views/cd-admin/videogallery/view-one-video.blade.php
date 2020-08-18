@extends('cd-admin.admin-master')
@section('title')
View Video |Aarya
@endsection
@section('content')

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{url('cd-admin/dashboard')}}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="{{url('cd-admin/view-video')}}">View Video</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>View One Video</span>
    </li>
  </ul>
</div>
<!-- END PAGE BAR -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
      <a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
      <div class="box-header text text-center">
        <h1 class="box-title"><h2>{{$video['title']}}({{$video['title_ne']}})</h2></h1> 
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-12" align="center">
            <video height="600" width="600" controls>
              <source src="{{Request::root().'/'.$video['video_url']}}">
              </video>
            </div>
            
            <div class="col-md-12">
              <div align="center">
                <input type="text" id="copy_{{ $video->id }}" name="image_name" value="{{$video->video_url}}">
                <button value="copy" onclick="copyToClipboard('copy_{{ $video->id }}')" class="btn btn-primary">Copy!</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
      }
    </script>
    @endsection