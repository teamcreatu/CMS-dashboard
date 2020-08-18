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
    <span>View Video</span>
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
          <span class="caption-subject bold uppercase"> View Video </span>
        </div>


        <div class="btn-group pull-right">
          @if(Gate::check('edit-media','media'))
          <a href="{{route('add-videos-form')}}">
            <button id="sample_editable_1_new" class="btn sbold green"> Add Video
              <i class="fa fa-plus"></i>
            </button>
          </a>
          @endif
        </div>
      </div>

      <div class="portlet-body">

        @if(isset($data))
        <h3>Search Results for Keyword:{{$data}}</h3>
        @endif
        @if(count($video) == 0) 
        <h3>Sorry No Results Found <a href="{{url()->Previous()}}"><button class="btn btn-primary">Go Back</button></a></h3>
        @endif

        <form action="{{route('delete-videos')}}" method="POST">

          @csrf
          <div id="delete-button" align="right" style="display: none;">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete...</button>
          </div>
          <br>
          <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
            <thead>
              <tr>
                @if(Gate::check('delete-media','media'))
                <th>Select</th>
                @endif
                <th>SN</th>
                <th>भिडियोको शीर्षक</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr class="odd gradeX">
                <?php $count = 1 ?>
                @foreach($video as $v)
                @if(Gate::check('delete-media','media'))
                <td align="center">
                  <div class="mt-checkbox-list" align="center" style="margin-left: 25px;">
                    <label class="mt-checkbox">
                      <input type="checkbox" value="{{$v->id}}" name="checkbox[]" onchange="checkDelete()" multiple>
                      <span></span>
                    </label>
                  </div>
                </td>
                @endif
                <td>{{$count}}</td>
                <td>{{$v['video_title_ne']}}</td>
                <td>
                 <a class="label label-sm label-success btn btn-primary" onclick="ViewVideo({{$v['id']}})" data-toggle="tooltip" title="View">
                   <i class="fa fa-eye"></i>
                 </a>
               {{--  <a href="{{route('view-one-video',$v['id'])}}">
                  <button class="label label-sm label-success" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button>
                </a> --}}
               {{--  @if(Gate::check('edit-media','media'))
                <a data-toggle="modal" href="#delete-modal{{$v['id']}}">
                  <button class="label label-sm label-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                </a>
                @endif --}}
              </td>
            </tr>
            <?php $count++ ?>
            @endforeach
          </tbody>
        </table>
      </form>
    </div>
  </div>
  <!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- delete modal -->
@foreach($video as $v)
<div class="modal fade" id="delete-modal{{$v['id']}}" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body"> Are you sure want to delete {{$v->name}} ? </div>
      <div class="modal-footer">
        <form action="{{route('delete-videos',$v['id'])}}" method="POST">
          @csrf
          <button type="button" class="btn dark btn-outline" data-dismiss="modal">NO</button>
          <button class="btn green" type="submit">YES</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endforeach

<script type="text/javascript">
  function ViewVideo(id) 
  {
    var url = '{{Request::root()}}'+'/cd-admin/view-one-video/'+id;
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