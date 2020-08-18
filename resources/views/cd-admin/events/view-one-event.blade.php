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
        <span>View Events</span>
    </li>
</ul>
</div>
<!-- END PAGE BAR -->
<a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
<div class="panel panel-default">
    <div class="panel-heading" align="center"><h3>{{$data->title}}({{$data['title_ne']}})</h3>
    </div>
    <div class="panel-body">
        <div class="container pa-t pa-b">
            <div class="row">
                <div class="preview col-md-6">
                    <div class="tab-content">
                      <div class="tab-pane active" id="pic"><img src="{{url(Request::root().'/'.$data['image_url'])}}" height="400px" width="400px"/></div>
                  </div>
              </div>
              <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <div class="product-detail-detail">
                    <h2>Description(In English)</h2>
                    <p>{!!$data['description']!!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container pa-b" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
        <h3><i></i>Description(In Nepali)</h3>
        <p>{!!$data['description_ne']!!}</p>
    </div>
</div>
</div>
</div>
</div>
@endsection