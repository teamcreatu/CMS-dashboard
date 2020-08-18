<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{url('/cd-admin/dashboard')}}">
                <img src="{{url('public/images/logo.png')}}" alt="logo" class="logo-default" style="height: 30px;" /> 
            </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

             <li class="dropdown dropdown-extended dropdown-notification " onclick="english()" id="opmcm-english">
                <a href="#" class="">
                    English
                </a>
            </li>
            <li class="dropdown dropdown-extended dropdown-notification" onclick="nepali()" id="opmcm-nepali">
                <a href="#" class="">
                    नेपाली
                </a>
            </li>
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    @if(Auth::user()->image_name != NULL)
                    <img alt="" class="img-circle" src="{{url(Request::root().'/public/uploads/profile/'.Auth::user()->image_name)}}" />
                    @else
                    <img alt="" class="img-circle" src="{{url(Request::root().'/public/images/5.jpg')}}" />
                    @endif
                    <span class="username username-hide-on-mobile"> {{Auth::user()->full_name}} </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    <li>
                            {{-- <a href="page_user_profile_1.html">
                                <i class="icon-user"></i> My Profile
                            </a> --}}
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="{{ url('cd-admin/change-password')}}">
                                <i class="fa fa-key"></i> Change Password
                            </a>
                            
                        </li>
                        <li>
                            <a href="{{ url('cd-admin/edit-profile')}}">
                                <i class="fa fa-key"></i> Edit Profile
                            </a>
                            
                        </li>
                        <li>
                            <a href="{{ url('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Log Out 
                        </a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
