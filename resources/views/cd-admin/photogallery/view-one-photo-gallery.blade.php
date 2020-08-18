@extends('cd-admin.admin-master')
@section('content')
<section class="content">
  <!-- BEGIN PAGE BAR -->
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <a href="{{url('cd-admin/dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
      </li>
      <li>
        <a href="{{url('cd-admin/view-photo-gallery')}}">View Photo Gallery</a>
        <i class="fa fa-circle"></i>
      </li>
    </ul>
  </div>
  <!-- END PAGE BAR -->
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header text text-center">
          <div class="pull-left">
            <a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
            {{-- @if(Gate::check('edit-photogallery','photogallery') || Gate::check('all','all')) --}}
            <a href="{{route('add-photo-to-gallery-form',$data['id'])}}"><button class="btn btn-primary"><i class="fa fa-plus"></i>Add Photo</button></a>
          </div>
          <div class="pull-right">
            <a href="{{route('edit-photo-gallery-form',$data['id'])}}"><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></a>
          </div>
          {{-- @endif --}}
          <div style="padding-top: 15px;margin-bottom: 30px;clear: both;">
            <h4>{{$data['title']}}({{$data['title_ne']}})</h4>
          </div>
        </div>
        <div class="box-body">
          @foreach($finalphoto as $key=>$p)
          <div class="col-md-4" id="status">
            <div class="gallery-image">
              <img id="img" class="img-fluid" src="{{Request::root().'/'.$p}}" style="opacity: 0.5; height: 200px; width: 500px;">
            </div>
            <div class="carousel-caption">
              @if(Gate::check('edit-news','news') || Gate::check('all','all'))
              <button class="btn btn-danger pull-left"  data-toggle="modal" data-target="#modal-danger{{$key}}"><i class="fa fa-trash"></i></button>
              @endif
              <div class="pull-right">
                <input type="text" id="copy_{{ $key }}" name="image_name" value="{{$p}}" class="form-control" style="">
                <button value="copy" onclick="copyToClipboard('copy_{{ $key }}')" class="btn btn-primary">Copy!</button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- css of album -->
<style type="text/css">

  .container{
    width: calc(48% - 6px);
    overflow:hidden;
    height: fit-content;
    margin:3px;
    padding: 0;
    display:block;
    position:relative;
    float:left;
  }
  #img{
    width: 1200px;
    height: 300px;
    transition-duration: .3s;
    max-width: 100%;
    display:block;
    overflow:hidden;
    cursor:pointer;
  }


  @media only screen and (max-width: 900px) {
    .container {
      width: calc(50% - 6px);
    }
  }
  @media only screen and (max-width: 400px) {
    .container {
      width: 100%;
    }
  }
</style>
@foreach($finalphoto as $key=>$p)
<div class="modal modal-danger fade" id="modal-danger{{$key}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"> Delete Image</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this Image?</p>
        </div>
        <div class="modal-footer">
          <div align="center">
            <form action="{{route('delete-one-photo-gallery',$data['id'])}}" method="POST">
              @csrf
              <input type="hidden" name="image" value="{{$p}}">
              <button type="submit" class="btn btn-warning">Yes</button>
              <button type="button" class="btn btn-primary " data-dismiss="modal">No</button>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  @endforeach
  <script>
    function copyToClipboard(id) {
      document.getElementById(id).select();
      document.execCommand('copy');
    }
  </script>
  @endsection