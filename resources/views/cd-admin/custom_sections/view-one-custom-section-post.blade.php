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
    <span>View Custom Section</span>
  </li>
</ul>
</div>
<!-- END PAGE BAR -->
<a href="{{url()->previous()}}"><button class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back</button></a>
<div class="panel panel-default">
  <div class="panel-heading" align="center"><h3></h3>
  </div>
  <div class="panel-body">
   @if($custom['view_type'] == 'list')
   <div class="scroll-div">
    <div class="container">

      <div class="page-title">
        <h3 class="h3-fsc">{{$custom['title']}}</h3>
      </div>
      <div id="owl-home-latestupdate" class="owl-carousel">
        @foreach($post as $l)
        <div class="item">
          <a href="{{url('post-detail/'.$l['slug'].'/'.$language)}}">
            <div class="row home-latest-updates-card">
              <div class="col-md-2">
                <?php
                $fulldate = new DateTime($l['created_at']);
                $date = $fulldate->format('Y-m-d');
                $time = $fulldate->format('h:m A');
                ?>
                <h6 class="h6-fsc"><i class="far fa-calendar-alt"></i> {{$date}}</h6>
                <p class="p-fsc"><i class="far fa-clock"></i> {{$time}}</p>
              </div>

              <div class="col-md-10">
                <h4 class="h4-fsc">
                 @if($language == 'en')
                 {{str_limit($l['title'],50,$end = '...')}}
                 @else
                 {{str_limit($l['title_ne'],50,$end = '...')}}
                 @endif  
               </h4>
             </div>
           </div>
         </a>
       </div>
       @endforeach
     </div>
   </div>
 </div>




 <script type="text/javascript">

  $(document).ready(function() {

    $("#owl-home-latestupdate").owlCarousel({

      items : 1,
      itemsDesktop : [1199,1],
      itemsDesktopSmall : [979,1],
      itemsTablet : [899,1],
      itemsMobile : [599,1],
      stopOnHover: false,
      pagination: false,
      navigation: true,
      autoplay: 2000,
      rewindNav: true,
      rewindSpeed: 2000

    });

  });

</script>
@else
<div class="scroll-div">
  <div class="container-fluid">
    <div class="container">

      <div class="page-title">
        <h3 class="h3-fsc">{{$custom['title']}}</h3>
      </div>

      <div class="row">
        <div id="owl-home-events" class="owl-carousel">

          @foreach($post as $e)

          <div class="item">

            <a href="{{url('post-detail/'.$e['slug'].'/'.$language)}}">
              <div class="home-events-card">
                <div class="home-events-image">
                  <img src="{{Request::root().'/'.$e['image_url']}}" alt="{{$e['title']}}" class="img-fluid">
                </div>

                <div class="home-events-justify">
                  <div class="home-events-content">
                    <?php
                    $fulldate = new DateTime($e['created_at']);
                    $date = $fulldate->format('Y-m-d');
                    $time = $fulldate->format('h:m A');
                    ?>
                    <p class="p-fsc"><span>{{$date}}</span></p>
                    <h5 class="h5-fsc">
                      @if($language == 'en')
                      {{str_limit($e['title'],50,$end = '...')}}
                      @else
                      {{str_limit($e['title_ne'],50,$end = '...')}}
                      @endif
                    </h5>
                  </div>
                </div>

                <hr>


                <div class="container-fluid home-events-link pa-0">
                  <div class="row">
                    <div class="col-md-8 home-events-link-text">
                      <p class="p-fsc">View Event Detail</p>
                    </div>
                    <div class="col-md-4 home-news-link-arrow">
                      <p class="p-fsc"><i class="fas fa-arrow-right"></i></p>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>

          @endforeach

        </div>
      </div>
    </div>
  </div>
  <!-- home events ends -->
</div>




<script type="text/javascript">

  $(document).ready(function() {

    $("#owl-home-events").owlCarousel({

      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,2],
      itemsTablet : [899,1],
      itemsMobile : [599,1],
      stopOnHover: false,
      pagination: false,
      navigation: true,
      autoplay: 2000,
      rewindNav: true,
      rewindSpeed: 2000

    });

  });

</script>
@endif
</div>
</div>
</div>
</div>
</div>
@endsection