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
    <span>View Member</span>
  </li>
</ul>
</div>
<!-- END PAGE BAR -->
<div style="margin-top: 15px;">
  <a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
</div>
<div class="panel panel-default" style="margin-top: 15px;">
  <div class="panel-heading" align="center"><h3>{{$data->name}}({{$data['name_ne']}})</h3>
  </div>
  <div class="panel-body">
    <div class="container pa-t pa-b">
      <div class="row">
        <div class="preview col-md-6">
          <div class="tab-content">
            <div class="tab-pane active" id="pic" style="border: 1px solid rgba(0,0,0,0.1);text-align: center;">
              @if(isset($data['image_url']))
              <img src="{{url(Request::root().'/'.$data['image_url'])}}" height="400px" width="400px" style="object-fit: contain;" />
              @else
              <img src="{{url(Request::root().'/public/images/noimage.png')}}" height="400px" width="400px" style="object-fit: contain;" />
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
          <div style="height: 400px; overflow-y: auto;">

            <ul class="list-group">
              <li class="list-group-item">
                Section <span class="badge badge-success">{{$data['section']}}({{$data['section_ne']}})</span>
              </li>

              <li class="list-group-item">
                Contact <span class="badge badge-success">{{$data['contact_no']}}</span>
              </li>

              <li class="list-group-item">
                Post <span class="badge badge-success">{{$data['post']}}({{$data['post_ne']}})</span>
              </li>

              <li class="list-group-item">
                Email <span class="badge badge-success">{{$data['email']}}</span>
              </li>
            </ul>

            <div>
              <h3>About Member(In Nepali)</h3>
              <p>{!!$data['summary_ne']!!}</p>
            </div>

            <div>
              <h3>About Member(In English)</h3>
              <p>{!!$data['summary']!!}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection