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
    <div class="col-md-12">
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      <div class="portlet light bordered">
        <div class="portlet-title">
          <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase"> View Carousel </span>
          </div>
          <div class="btn-group pull-right">
            @if(Gate::check('edit-posts','posts') || Gate::check('all','all'))
            <a href="{{route('add-carousel-form')}}">
              <button id="sample_editable_1_new" class="btn sbold green"> Add Carousel
                <i class="fa fa-plus"></i>
              </button>
            </a>
            @endif
          </div>
        </div>

        <div align="center">
        </div>
        <div class="portlet-body">
          <form action="{{route('delete-carousel')}}" method="POST">
            @csrf
            <div id="delete-button" align="right" style="display: none;">
              <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete...</button>
            </div>
            <br>
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
              <thead>
                <tr>
                  <th>Select</th>
                  <th>SN</th>
                  <th>शीर्षक(Title)</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <?php $count = 1 ?>
                  @foreach($carousel as $n)
                  <td>
                    <div class="mt-checkbox-list" align="center" style="margin-left: 25px">
                      <label class="mt-checkbox">
                        <input type="checkbox" value="{{$n->id}}" name="checkbox[]" onchange="checkDelete()" multiple>
                        <span></span>
                      </label>
                    </div>
                  </td>
                  <td>{{$count}}</td>
                  <td>{{$n['title_ne']}}({{$n['title']}})</td>
                  <td align="center"><img src="{{url(Request::root().'/'.$n['image_url'])}}" class="img img-fluid rounded" style="height: 70px; width: 70px;"></td>
                  <td>
                    @if(Gate::check('edit-carousel','carousel') || Gate::check('all','all'))
                    <div class="btn-group">
                      @if($n->status == 'active')
                      <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Active
                        @else
                        <button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Inactive
                          @endif
                          <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-left" role="menu">
                          <li>
                            @if($n->status == 'active')
                            <a class="btn btn-danger"  onclick="changeStatus({{$n['id']}})">Inactive</a>
                            @else
                            <a class="btn btn-success" onclick="changeStatus({{$n['id']}})">Active</a>
                            @endif
                          </li>
                        </ul>
                      </div>
                      @else
                      @if($n->status == 'active')
                      <button class="btn btn-xs green dropdown-toggle">Active
                        @else
                        <button class="btn btn-xs red dropdown-toggle">Inactive
                          @endif
                          @endif

                        </td>
                        <td>
                          <a data-toggle="modal" data-target="#modal-view{{$n->id}}">
                            <button class="label label-sm label-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
                          </a>
                          @if(Gate::check('edit-carousel','carousel') || Gate::check('all','all'))
                          <a class="label label-sm label-success" data-toggle="tooltip" title="Edit" onclick="EditCarousel({{$n['id']}})">
                            <i class="fa fa-edit"></i>
                          </a>
                          {{--   <a data-toggle="modal" href="#delete-modal{{$n['id']}}">
                            <button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                          </a> --}}
                          @endif
                        </td>
                      </tr>
                      <?php $count++ ?>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END EXAMPLE TABLE PORTLET-->
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
                        <div class="form-group">
                          <h4> <label>Carousel Title</label></h4>
                          {{$c->title}}
                        </div>
                        <hr>
                        <div class="form-group">
                          <h4> <label>Carouselको शीर्षक</label></h4>
                          {{$c->title_ne}}
                        </div>
                        <hr>
                        <div class="form-group">
                          <h4><label>Carousel Subtitle</label></h4>
                          {{$c->subtitle}}
                        </div>
                        <hr>
                        <div class="form-group">
                          <h4><label>Carouselको उपशीर्षक</label></h4>
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

              <script type="text/javascript">
                function changeStatus(id) 
                {
                  var url = '{{Request::root()}}'+'/cd-admin/carousel/updatestatus/'+id;
                  window.location.href = url;
                }
              </script>
              <script type="text/javascript">
                function EditCarousel(id) 
                {
                  var url = '{{Request::root()}}'+'/cd-admin/edit-carousel/'+id;
                  window.location.href = url;
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