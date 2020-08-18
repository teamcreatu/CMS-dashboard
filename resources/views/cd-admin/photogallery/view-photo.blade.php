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
          <div class="pull-left" style="margin-top: 15px;">
            {{-- @if(Gate::check('edit-photogallery','photogallery') || Gate::check('all','all')) --}}
            <a href="{{route('add-photo-gallery-form')}}"><button class="btn btn-primary">Add Photo Gallery</button></a>
            {{-- @endif --}}
          </div>
          {{--           <div class="pull-right">
            <form action="{{route('search')}}" method="get">
              <input type="text" name="searchterm" class="form-control" placeholder="Enter Search Term">
              <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>  
          </div> --}}
          <div style="text-align: center;margin-top: 30px;margin-bottom: 30px;clear: both;">
            <h3>Album List</h3>
          </div>
          <div class="row">
            @foreach($photo as $p)
            <div class="col-md-3" id="status">
              <div class="gallery-image">
                <a href="#">
                  <img id="img" class="img-fluid" src="{{Request::root().'/'.$p['image_url']}}" style="opacity: 0.5; height: 200px; width: 500px;" alt="{{$p['image_url']}}">
                </a>
              </div>
              <div class="carousel-caption"> 
                <h4 class="h3-responsive" style="color: black;">{{str_limit($p['title_ne'],$end=50)}}
                </h4>         

                <div>
                  <button class="btn btn-danger pull-left"  data-toggle="modal" data-target="#modal-danger{{$p->id}}"><i class="fa fa-trash"></i></button>
                  <a href="{{route('view-one-photo-gallery',$p['id'])}}"><button class="btn btn-primary"><i class="fa fa-eye"></i> View This Album</button></a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div align="center">{{ $photo->links() }}</div>
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
@foreach($photo as $p)
<div class="modal modal-danger fade" id="modal-danger{{$p->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"> Delete Photo</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete {{$p->title_ne}}?</p>
        </div>
        <div class="modal-footer">
          <div align="center">
            <form action="{{route('delete-photo-gallery',$p['id'])}}" method="POST">
              @csrf
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

  {{-- <div class="modal modal-default fade" id="updatetitle{{$p->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" align="center">Update Album Title</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="POST"  enctype="multipart/form-data">
              @csrf
              <div class="form-group ">
                <label>Image Title:</label>
                <input type="text" class="form-control" name="image_title" value="{{$p->image_title}}">
                <!-- /.input group -->
              </div>
              <div class="form-group ">
                <label>फोटोको शीर्षक <small>(देवानगिरिमा)</small>:</label>
                <input type="text" class="form-control" name="image_title" value="{{$p->image_title_ne}}">
                <!-- /.input group -->
              </div>
            </div>
            <div class="modal-footer">
              <div class="pull-left">
                <button class="btn btn-primary" type="submit">Update Title</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div> --}}
    <div class="modal modal-default fade" id="modal-view{{$p->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" align="center">View Photos</h4>
            </div>
            <div class="modal-body">
              <form action="#" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                 <h4 align="center"> <label>Image Title</label></h4>
                 {{$p->image_title}}
               </div>
               <hr>
               <div class="form-group ">
                <h4 align="center"><label>फोटोको शीर्षक <small>(देवानगिरिमा)</small></label></h4>
                {{$p->image_title_ne}}
              </div>
            </div>
            <div class="modal-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-primary " data-dismiss="modal">Close</button>
              </div>
            </div>
          </form>
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