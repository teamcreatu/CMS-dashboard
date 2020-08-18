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
        <span>View Page Detail</span>
    </li>
</ul>
</div>
<!-- END PAGE BAR -->
<a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
<div class="panel">
    <div class="panel-heading" align="center"><h3>{{$data->title}}({{$data->title_ne}})</h3>
    </div>
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="preview col-md-6">
                    <div class="tab-content">
                      <div class="tab-pane active" id="pic"><img src="{{url(Request::root().'/'.$data->image_url)}}" height="200px" width="200px"/>
                      </div>
                  </div>
              </div>
              <div class="col-md-6" >
                <div class="product-detail-detail">
                    <h2>Description(In English)</h2>
                    <p>{!!$data->description!!}</p>
                </div>
            </div>
        </div>
    </div>
    <div class=" col-md-11 container">
        <h3><i></i>Description(In Nepali)</h3>
        <p>{!!$data['description_np']!!}</p>
    </div>
    <div class="col-md-4">
        <h3>Tags</h3>
        <?php $tags = explode(',',$data->tags); ?>
        @foreach($tags as $key => $t)
        @if($key%2 == 0)
            <span class="badge badge-primary">{{$t}}</span>
        @else
            <span class="badge badge-warning">{{$t}}</span>
        @endif
        @endforeach
    </div>
    <div class="col-md-4">
        <h3>Created At</h3>
       <?php $date = Carbon\Carbon::parse($data->created_at)->format('Y-m-d') ?>
       {{$date}}
    </div>
</div>
</div>

@endsection