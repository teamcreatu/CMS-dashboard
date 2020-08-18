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
        <a href="{{url('cd-admin/view-photos')}}">View Photos</a>
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
            @if(Gate::check('add-media','media'))
            <a href="{{route('add-photos-form')}}"><button class="btn btn-primary"> <i class="fa fa-plus"></i> Add Photos</button></a>
            @endif
          </div>
          {{--  <div class="pull-right">
            <form action="{{route('search')}}" method="get">
              <input type="text" name="searchterm" class="form-control" placeholder="Enter Search Term">
              <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>  
          </div> --}}
          <div>
            <h3 class="box-title"><h2>View Photos</h2></h3><br><br>
          </div>
          {{--  @if(isset($data))
            <h3>Search Results for Keyword:{{$data}}</h3>
            @endif
            @if(count($photos) == 0) 
            <h3>Sorry No Results Found <a href="{{url()->Previous()}}"><button class="btn btn-primary">Go Back</button></a></h3>
            @endif --}}
            <form method="POST" action="{{route('delete-photo')}}">
              @csrf
              <div id="delete-button" align="right" style="display: none; position: relative; bottom: 75px; margin-bottom: -34px;">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete...</button>
              </div>
              <br>
              @foreach($photos as $p)
              <div class="col-md-3" id="status">
                <div class="gallery-image" style="margin-bottom: 30px;">
                  <a href="{{Request::root().'/'.$p['image_url']}}">
                    <img id="img" class="img-fluid" src="{{Request::root().'/'.$p['image_url']}}" style="opacity: 0.5; height: 200px; width: 500px;object-fit: cover;" alt="{{$p['image_url']}}">
                  </a>
                </div>
                <div class="carousel-caption"> 
                  <h4 class="h3-responsive" style="color: black;">{{$p['image_title_ne']}}
                  </h4>         
              <!-- <div class="pull-right">
                <input type="text" id="copy_{{ $p->id }}" name="image_name" value="{{$p->image_url}}" class="form-control" style="">
                <button value="copy" onclick="copyToClipboard('copy_{{ $p->id }}')" class="btn btn-primary">Copy!</button>
              </div> -->
            </div>

            <div class="dashboard-image-checkbox">
              @if(Gate::check('delete-media','media'))
              <div class="mt-checkbox-list" align="center">
                <label class="mt-checkbox">
                  <input type="checkbox" value="{{$p->id}}" name="checkbox[]" onchange="checkDelete()" multiple>
                  <span></span>
                </label>
              </div>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        <div align="center" class="col-md-12">{{ $photos->links() }}</div>
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
@foreach($photos as $p)
<div class="modal modal-danger fade" id="modal-danger{{$p->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"> Delete Photo</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete {{$p->image_title}}?</p>
        </div>
        <div class="modal-footer">
          <div align="center">
            <form action="{{route('delete-photo',$p['id'])}}" method="POST">
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
                <hr>
                <div class="form-group ">
                  <h4 align="center"><label>Photo Tags</label></h4>
                  @foreach(explode(',',$p['tags']) as $tag)
                  <span class="badge badge-success">{{$tag}}</span>
                  @endforeach
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

      <script type="text/javascript">
        function checkDelete() 
        {
          var data = document.querySelectorAll('input[type="checkbox"]:checked').length;
          if (data > 0) 
          {
            document.getElementById('delete-button').style.display = 'block';
          }
          else
          {
            document.getElementById('delete-button').style.display = 'none';
          }
        }
      </script>
      @endsection