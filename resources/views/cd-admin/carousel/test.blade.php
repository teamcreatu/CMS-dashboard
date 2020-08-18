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
        <a href="{{url('cd-admin/view-photos')}}">View Carousel</a>
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
            @if(Gate::check('edit-carousel','carousel') || Gate::check('all','all'))        
            <a href="{{route('add-carousel-form')}}"><button class="btn btn-primary">Add Carousel</button></a>
            @endif
          </div>
          <div class="pull-right">
            <form action="{{route('search')}}" method="get">
              <input type="text" name="searchterm" class="form-control" placeholder="Enter Search Term">
              <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>  
          </div>
          <div>
            <h3 class="box-title"><h2>View Carousel</h2></h3><br><br>
          </div>
          @foreach($carousel as $c)
          <div class="container" id="status">
            <div class="gallery-image">
              <a href="#">
                <img id="img" class="img-fluid" src="{{url(Request::root().'/'.$c['image_url'])}}" style="opacity: 0.5; height: 300px; width: 669px;" alt="{{$c['title']}}">
              </a>
            </div>
            <div class="carousel-caption">
                @if(Gate::check('edit-carousel','carousel') || Gate::check('all','all')) 
              <a href="{{route('edit-carousel-form',$c['id'])}}"><button class="btn btn-warning" style="margin-right: 50px;">Edit Carousel</button></a>
              @endif
              <h4 class="h3-responsive" style="color: black;">{{$c['title']}}
              </h4> 
                @if(Gate::check('edit-carousel','carousel') || Gate::check('all','all'))        
              <form action="{{route('update-carousel-status',$c['id'])}}" method="POST">
                @csrf
                <div class="btn-group pull-right">
                  @if($c->status == 'active')
                  <button type="button" class="btn btn-success">Active</button>
                  @else
                  <button type="button" class="btn btn-danger">Inactive</button>
                  @endif
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu" role="menu" style="min-width: 0px;">
                    <li>
                      @if($c->status == 'active')
                      <button class="btn btn-danger" type="submit">Inactive</button>
                      @else
                      <button class="btn btn-success" type="submit">Active</button>
                      @endif
                    </li>
                  </div>
                </div> 
              </form>
              @else
              <div class="btn-group pull-right">
                @if($c->status == 'active')
                  <button type="button" class="btn btn-success">Active</button>
                  @else
                  <button type="button" class="btn btn-danger">Inactive</button>
                  @endif
              </div>
              @endif
              <div>
                @if(Gate::check('edit-carousel','carousel') || Gate::check('all','all'))        
                <button class="btn btn-danger pull-left"  data-toggle="modal" data-target="#modal-danger{{$c->id}}"><i class="fa fa-trash"></i></button>
               
                @endif
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-view{{$c->id}}"><i class="fa fa-eye"></i> View</button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div align="center">{{ $carousel->links() }}</div>
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
@foreach($carousel as $c)
<div class="modal modal-danger fade" id="modal-danger{{$c->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"> Delete Carousel</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete {{$c->title}}?</p>
        </div>
        <div class="modal-footer">
          <div align="center">
            <form action="{{route('delete-carousel',$c['id'])}}" method="POST">
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
    <div class="modal modal-default fade" id="modal-view{{$c->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" align="center">View Carousel</h4>
            </div>
            <div class="modal-body">
              <form action="#" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                 <h4 align="center"> <label>Carousel Title</label></h4>
                 {{$c->title}}
               </div>
               <hr>
                <div class="form-group ">
                 <h4 align="center"> <label>Carouselको शीर्षक</label></h4>
                 {{$c->title_ne}}
               </div>
               <hr>
               <div class="form-group ">
                <h4 align="center"><label>Carousel Subtitle</label></h4>
                {{$c->subtitle}}
              </div>
               <hr>
               <div class="form-group ">
                <h4 align="center"><label>Carouselको उपशीर्षक</label></h4>
                {{$c->subtitle_ne}}
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