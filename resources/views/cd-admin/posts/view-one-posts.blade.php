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
        <li>
            <span>View Posts</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<div style="margin-top: 15px;">
    <a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
</div>

<div class="panel panel-default" style="margin-top: 15px;">
    <div class="panel-heading" align="center"><h3>{{$data['title']}}({{$data['title_ne']}})</h3>
    </div>
    <div class="panel-body">
        <div class="container pa-t pa-b">
            <div class="row">
                <div class="preview col-md-12">
                    <div class="tab-content" style="text-align: center; ">
                        <div class="tab-pane active" id="pic">
                            <img src="{{Request::root().'/'.$data['image_url']}}" height="400px" width="400px" style="object-fit: contain;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 pa-b" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <h4>Summary(In English)</h4>
                <p>{!!$data['summary']!!}</p>
                <hr>
                <h4>Description(In English)</h4>
                <p>{!!$data['description']!!}</p>
            </div>
            <div class="col-md-6 pa-b" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <h4>Summary(In Nepali)</h4>
                <p>{!!$data['summary_ne']!!}</p>
                <hr>
                <h4>Description(In Nepali)</h4>
                <p>{!!$data['description_ne']!!}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h4>Tags</h4>
                <?php $tags = explode(',',$data->tags); ?>
                @foreach($tags as $key => $t)
                @if($key%2 == 0)
                <span class="badge badge-primary">{{$t}}</span>
                @else
                <span class="badge badge-warning">{{$t}}</span>
                @endif
                @endforeach
            </div>
            <div class="col-md-6">
                <h4>Created At</h4>
                <?php $date = Carbon\Carbon::parse($data->created_at)->format('Y-m-d') ?>
                {{$date}}
            </div>
        </div>
    </div>
</div>
@endsection