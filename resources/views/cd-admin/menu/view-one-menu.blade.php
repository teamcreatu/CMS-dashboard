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
        <span>View Menu Detail</span>
    </li>
</ul>
</div>
<!-- END PAGE BAR -->
<a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
<div class="panel">
    <div class="panel-heading" align="center"><h3>{{$menu['menu_name']}}({{$menu['menu_name_ne']}})</h3>
    </div>
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="preview col-md-6">
                    <div class="tab-content">
                      <div class="tab-pane active" id="pic"><img src="{{Request::root().'/'.$menu['icon']}}" height="200px" width="200px"/>
                      </div>
                  </div>
              </div>
              <div class="col-md-6" >
              <h3><b>Detail</b></h3>
                <div class="product-detail-detail">
                    <h4>Menu Type : {!!$menu['menu_type']!!} </h4>
                    
                </div>
                <div class="product-detail-detail">
                    <h4>Priority No : {!!$menu['priority_no']!!}</h4>
                </div>
                <div class="product-detail-detail">
                    <h4>created By : {!!$user['user_name']!!}</h4>
                </div>
                <div class="product-detail-detail">
                    <h4>updated By : {!!$user_updated['user_name']!!}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection