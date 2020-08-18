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
        <span>View Footer</span>
    </li>
</ul>
</div>
<!-- END PAGE BAR -->
@if(isset($footer))
<a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
<div class="panel">
   <div class="pull-right">
    @if(Gate::check('edit-footer','footer'))
    <a href="{{route('edit-footer-form',$footer['id'])}}"><button class="btn btn-primary">Edit Footer</button></a>
    @endif
</div>
<div class="panel-heading" align="center"><h3>Footer</h3>
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
                    @if(strpos($f['url'],'contact') !== False)
                    <div>                       
                        <div id="contact">
                        </div>
                        <br>
                    </div>
                    @endif
                    @if(strpos($f['url'],'spokesperson') !== False)
                    <div>  
                        <input type="hidden" id="spokesperson_url{{$key}}" value="{{$f['url']}}">
                        <div id="spokesperson{{$key1}}{{$key}}">
                        </div>
                    </div>
                    @endif
                    @if(strpos($f['url'],'posts') !== False)
                    <div>  
                        <input type="hidden" id="post_url{{$key}}" value="{{$f['url']}}">
                        <div id="post{{$key1}}{{$key}}">
                        </div>
                    </div>
                    @endif
                    @if(strpos($f['url'],'madecustomwidgets') !== False)
                    <div>  
                        <input type="hidden" id="made_url{{$key}}" value="{{$f['url']}}">
                        <div id="madecustomwidgets{{$key1}}{{$key}}">
                        </div>
                    </div>
                    @endif
                    @if(strpos($f['url'],'memberscategorywidgets') !== False)
                    <div>  
                        <input type="hidden" id="memberscategorywidgets{{$key}}" value="{{$f['url']}}">
                        <div id="memberscategorywidgets{{$key1}}{{$key}}">
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
@if(Gate::check('add-footer','footer'))
<div align="center">
    <a href="{{route('add-footer-form')}}"><button class="btn btn-primary">Add Footer</button></a>
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
        var url = "{{Request::root().'/'.$f['url']}}"+'/nep';
        $.ajax({
            url: url,
            success: function(result){
                $("#spokesperson{{$key1}}{{$key}}").html(result)
            }});

    })
</script>
@endif
@if(strpos($f['url'],'post') !== false)
<script type="text/javascript">
    $(document).ready(function(){
        var url = "{{Request::root().'/'.$f['url']}}"+'/nep';
        $.ajax({
            url: url,
            success: function(result){
                $("#post{{$key1}}{{$key}}").html(result)
            }});

    })
</script>
@endif

@if(strpos($f['url'],'madecustomwidgets') !== false)
<script type="text/javascript">
    $(document).ready(function(){
        var url = "{{Request::root().'/'.$f['url']}}"+'/nep';
        $.ajax({
            url: url,
            success: function(result){
                $("#madecustomwidgets{{$key1}}{{$key}}").html(result)
            }});

    })
</script>
@endif
@if(strpos($f['url'],'memberscategorywidgets') !== false)
<script type="text/javascript">
    $(document).ready(function(){
        var url = "{{Request::root().'/'.$f['url']}}"+'/nep';
        $.ajax({
            url: url,
            success: function(result){
                $("#memberscategorywidgets{{$key1}}{{$key}}").html(result)
            }});

    })
</script>
@endif
@if(strpos($f['url'],'contactus') !== false)
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url: "{{Request::root()}}"+'/'+"contactus/np",
            success: function(result){
                $("#contact").html(result)
            }});
    })
</script>
@endif
@endforeach
@endforeach
@endsection