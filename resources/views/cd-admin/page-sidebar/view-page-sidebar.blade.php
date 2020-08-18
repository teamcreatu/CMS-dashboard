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
        <span>View Page Sidebar</span>
    </li>
</ul>
</div>
<!-- END PAGE BAR -->
@if(isset($sidebar))
<a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
<div class="panel">
   <div class="pull-right">
    @if(Gate::check('edit-sidebar','sidebar') || Gate::check('all','all'))
    <a href="{{route('edit-page-sidebar-form',$sidebar['id'])}}"><button class="btn btn-primary">Edit PageSidebar</button></a>
    @endif
</div>
<div class="panel-heading" align="center"><h3>Page Sidebar</h3>
</div>
<div class="panel-body">
    <div class="container">
        <div class="row">
            @foreach($finalArray as $key1=>$final)
            <div class=" col-md-3">
            </div>
            <div class="col-md-6" >
                <h3>{{$final['name']}}({{$final['name_ne']}})</h3>
                @foreach($final['widgets'] as $key=>$f)
                <div class="product-detail-detail">
                    @if(strpos($f['url'],'contact'))
                    <div>                       
                        <div id="contact" style="clear:both;">

                        </div>
                        <br>
                    </div>
                    @endif
                    @if(strpos($f['url'],'spokesperson'))
                    <div>  
                        <input type="hidden" id="spokesperson_url{{$key}}" value="{{$f['url']}}">
                        <div id="spokesperson{{$key1}}{{$key}}" style="clear: both;">
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="col-md-3">
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@else
@if(Gate::check('edit-sidebar','sidebar') || Gate::check('all','all'))
<div align="center">
    <a href="{{route('add-page-sidebar-form')}}"><button class="btn btn-primary">Add SideBar</button></a>
</div>
@endif
@endif
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@foreach($finalArray as $key1=>$final)
@foreach($final['widgets'] as $key=>$f)
@if(strpos($f['url'],'spokesperson') !== false)
<script type="text/javascript">
    $(document).ready(function(){
        var url = "{{$f['url']}}"+'/nep';
        $.ajax({
            url: url,
            success: function(result){
                $("#spokesperson{{$key1}}{{$key}}").html(result)
            }});

    })
</script>
@endif
@if(strpos($f['url'],'contactus') !== false)
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url: "/git/opmcm/contactus/nep",
            success: function(result){
                $("#contact").html(result)
            }});
    })
</script>
@endif
@endforeach
@endforeach
@endsection