<!--BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
            </li>
            <li class="nav-item {{Request::url() == url('cd-admin/dashboard') ?'active':''}}">
                <a href="{{url('cd-admin/dashboard')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <div style="display: none;" class="eng">
                        <span class="title opmcm-en">Dashboard</span>
                    </div>
                    <div style="display: none;" class="nep">
                        <span class="title opmcm-ne">ड्यास-बोअर्ड</span>
                    </div>
                </a>
            </li>
            @if(Gate::check('users','users') || Gate::check('all','all') || Gate::check('users','users') || Gate::check('media','media') || Gate::check('setting','setting')||Gate::check('rolesAndpermission','rolesAndpermission'))
            <li class="heading">
                <h3 class="uppercase opmcm-en eng"  style="display: none; margin: 0px!important; font-size: 14px; color: #708096"> Configuration</h3>
                <h3 class="uppercase opmcm-ne nep" style="display: none; margin: 0px!important; font-size: 14px; color: #708096"> कन्फिगरेसन</h3>
            </li>
            
            @endif
            @if(Gate::check('rolesAndpermission','rolesAndpermission') || Gate::check('all','all') )
            <li class="nav-item {{Request::url() == url('cd-admin/view-all-role') ?'active':''}}">
                <a href="{{url('cd-admin/view-all-role')}}" class="nav-link nav-toggle">
                    <i class="fa fa-group"></i>
                    <div style="display: none;" class="eng">
                        <span class="title opmcm-en">Role And Permission</span>
                    </div>
                    <div style="display: none;" class="nep">
                        <span class="title opmcm-ne">भूमिका र अनुमति</span>
                    </div>
                </a>
            </li>
            @endif

            @if(Gate::check('users','users') || Gate::check('all','all') )
            <li class="nav-item {{Request::url() == url('cd-admin/view-all-admin') ?'active':''}}">
                <a href="{{url('cd-admin/view-all-admin')}}" class="nav-link nav-toggle">
                    <i class="fa fa-group"></i>
                    <div style="display: none;" class="eng">
                        <span class="title opmcm-en">Admin</span>
                    </div>
                    <div style="display: none;" class="nep">
                        <span class="title opmcm-ne">प्रशासन</span>
                    </div>
                </a>
            </li>
            @endif
            @if(Gate::check('media','media') || Gate::check('all','all') )
            <li class="nav-item {{Request::url() == route('view-photos') || Request::url() == route('view-videos') || Request::url() == route('view-files') ?'active':''}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-list-ol"></i>
                    <div style="display: none;" class="eng">
                        <span class="title opmcm-en">Media</span>
                    </div>
                    <div style="display: none;" class="nep">
                        <span class="title opmcm-ne">मिडिया</span>
                    </div>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{Request::url() == route('view-photos') ?'active':''}}">
                        <a href="{{route('view-photos')}}" class="nav-link">
                            <i class="fa fa-eye"></i>
                            <div style="display: none;" class="eng">
                                <span class="title opmcm-en">Photos</span>
                            </div>
                            <div style="display: none;" class="nep">
                                <span class="title opmcm-ne">फोटोहरू</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item {{Request::url() == route('view-videos') ?'active':''}}">
                        <a href="{{route('view-videos')}}" class="nav-link">
                            <i class="fa fa-eye"></i>
                            <div style="display: none;" class="eng">
                                <span class="title opmcm-en">Videos</span>
                            </div>
                            <div style="display: none;" class="nep">
                                <span class="title opmcm-ne">भिडियोहरू</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item {{Request::url() == route('view-files') ?'active':''}}">
                        <a href="{{route('view-files')}}" class="nav-link">
                            <i class="fa fa-eye"></i>
                            <div style="display: none;" class="eng">
                                <span class="title opmcm-en">Files</span>
                            </div>
                            <div style="display: none;" class="nep">
                                <span class="title opmcm-ne">फाईलहरू</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(Gate::check('setting','setting') || Gate::check('all','all') )
            <li class="nav-item {{Request::url() == url('cd-admin/view-settings') ?'active':''}}">
                <a href="{{url('cd-admin/view-settings')}}" class="nav-link nav-toggle">
                    <i class="fa fa-group"></i>
                    <div style="display: none;" class="eng">
                        <span class="title opmcm-en">Settings</span>
                    </div>
                    <div style="display: none;" class="nep">
                        <span class="title opmcm-ne">सेटिंग्स</span>
                    </div>
                </a>
            </li>
            <li class="nav-item {{Request::url() == url('cd-admin/view-seo') ?'active':''}}">
                <a href="{{url('cd-admin/view-seo')}}" class="nav-link nav-toggle">
                    <i class="fa fa-globe"></i>
                    <div style="display: none;" class="eng">
                        <span class="title opmcm-en">SEO</span>
                    </div>
                    <div style="display: none;" class="nep">
                        <span class="title opmcm-ne">एसईओ</span>
                    </div>
                </a>
            </li>
            @endif

            @if(Gate::check('staffs','staffs') || Gate::check('all','all') || Gate::check('event','event') || Gate::check('documents','documents') || Gate::check('post','post') || Gate::check('contactus','contactus') || Gate::check('quotes','quotes') || Gate::check('photogallery','photogallery') || Gate::check('videogallery','videogallery') || Gate::check('carousel','carousel'))
            <li class="heading">
                <h3 class="uppercase opmcm-en eng"  style="display: none; margin: 0px!important; font-size: 14px; color: #708096">Content Management</h3>
                <h3 class="uppercase opmcm-ne nep" style="display: none; margin: 0px!important; font-size: 14px; color: #708096">सामग्री व्यवस्थापन</h3>
            </li>
            @endif

            @if(Gate::check('staffs','staffs') || Gate::check('all','all') )
            <li class="nav-item {{Request::url() == route('view-members-category') || Request::url() == route('view-members') ?'active':''}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-list-ol"></i>
                    <div style="display: none;" class="eng">
                        <span class="title opmcm-en">Staffs</span>
                    </div>
                    <div style="display: none;" class="nep">
                        <span class="title opmcm-ne">कर्मचारीहरु</span>
                    </div>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{Request::url() == route('view-members-category') ?'active':''}}">
                        <a href="{{route('view-members-category')}}" class="nav-link">
                            <i class="fa fa-eye"></i>
                            <div style="display: none;" class="eng">
                                <span class="title opmcm-en">Category</span>
                            </div>
                            <div style="display: none;" class="nep">
                                <span class="title opmcm-ne">कोटि</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item {{Request::url() == route('view-members') ?'active':''}}">
                        <a href="{{route('view-members')}}" class="nav-link">
                            <i class="fa fa-eye"></i>
                            <div style="display: none;" class="eng">
                                <span class="title opmcm-en">Staffs</span>
                            </div>
                            <div style="display: none;" class="nep">
                                <span class="title opmcm-ne">कर्मचारीहरु</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
{{--   @if(Gate::check('event','event') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-events-category') || Request::url() == route('view-events') ?'active':''}}">
<a href="javascript:;" class="nav-link nav-toggle">
<i class="fa fa-list-ol"></i>
<span class="title opmcm-en">Events</span>
<span class="title opmcm-ne">घटनाहरू</span>
<span class="arrow"></span>
</a>
<ul class="sub-menu">
<li class="nav-item{{Request::url() == route('view-events-category') ?'active':''}}">
<a href="{{route('view-events-category')}}" class="nav-link">
<i class="fa fa-eye"></i>
<span class="title opmcm-en">Category</span>
<span class="title opmcm-ne">कोटि</span>
</a>
</li>
<li class="nav-item {{Request::url() == route('view-events') ?'active':''}}">
<a href="{{route('view-events')}}" class="nav-link">
<i class="fa fa-eye"></i>
<span class="title opmcm-en">Events</span>
<span class="title opmcm-ne">घटनाहरू</span>
</a>
</li>
</ul>
</li>
@endif --}}
@if(Gate::check('documents','documents') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-resource-category') || Request::url() == route('view-resource') ?'active':''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Documents</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">कागजात</span>
        </div>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::url() == route('view-resource-category') ?'active':''}}">
            <a href="{{route('view-resource-category')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <span class="title opmcm-en">Category</span>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">कोटि</span>
                </div>
            </a>
        </li>
        <li class="nav-item {{Request::url() == route('view-resource') ?'active':''}}">
            <a href="{{route('view-resource')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Documents</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">कागजात</span>
                </div>
            </a>
        </li>
        @if(Gate::check('add-documents','documents'))
        <li class="nav-item {{Request::url() == route('add-resource-form') ?'active':''}}">
            <a href="{{route('add-resource-form')}}" class="nav-link">
                <i class="fa fa-plus"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Add Documents</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">कागजातहरू थप्नुहोस्</span>
                </div>
            </a>
        </li>
        @endif
    </ul>
</li>
@endif

@if(Gate::check('post','post') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-posts-category') || Request::url() == route('view-posts') ?'active':''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Posts</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">पोष्टहरू</span>
        </div>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::url() == route('view-posts-category') ?'active':''}}">
            <a href="{{route('view-posts-category')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Category</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">कोटि</span>
                </div>
            </a>
        </li>
        <li class="nav-item {{Request::url() == route('view-posts') ?'active':''}}">
            <a href="{{route('view-posts')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Posts</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">पोष्टहरू</span>
                </div>
            </a>
        </li>
        @if(Gate::check('edit-posts','posts') || Gate::check('all','all'))
        <li class="nav-item {{Request::url() == route('add-posts-form') ?'active':''}}">
            <a href="{{route('add-posts-form')}}" class="nav-link">
                <i class="fa fa-plus"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Add Posts</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">पोष्टहरू थप्नुहोस्</span>
                </div>
            </a>
        </li>
        @endif
    </ul>
</li>
@endif

@if(Gate::check('contactus','contactus') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-contact-us') ?'active':''}}">
    <a href="{{route('view-contact-us')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Contact Us</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">हामीलाई सम्पर्क गर्नुहोस</span>
        </div>
    </a>
</li>
@endif

<li class="nav-item {{Request::url() == route('view-photo-gallery') ?'active':''}}">
    <a href="{{route('view-photo-gallery')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Photo Gallery</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">तस्बिर पुस्तिका</span>
        </div>
    </a>
</li>

<li class="nav-item {{Request::url() == route('view-video-gallery') ?'active':''}}">
    <a href="{{route('view-video-gallery')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Video Gallery</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">भिडियो ग्यालरी</span>
        </div>
    </a>
</li>

<li class="nav-item {{Request::url() == route('view-carousel') ?'active':''}}">
    <a href="{{route('view-carousel')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Carousel</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">काराउजेल</span>
        </div>
    </a>
</li>

@if(Gate::check('links','links') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-links') ?'active':''}}">
    <a href="{{route('view-links')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Links</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">लिंकहरू</span>
        </div>
    </a>
</li>
@endif

<li class="nav-item {{Request::url() == route('view-popup') ?'active':''}}">
    <a href="{{route('view-popup')}}" class="nav-link">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">PopUp</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">पपअप</span>
        </div>
    </a>
</li>
@if(Gate::check('widgets','widgets') || Gate::check('page','page') || Gate::check('header','header') || Gate::check('sidebar','sidebar') || Gate::check('footer','footer'))
<li class="heading">
    <h3 class="uppercase opmcm-en eng"  style="display: none; margin: 0px!important; font-size: 14px; color: #708096">Component Management</h3>
    <h3 class="uppercase opmcm-ne nep" style="display: none; margin: 0px!important; font-size: 14px; color: #708096">घटक व्यवस्थापन</h3>
</li>
@endif
@if(Gate::check('widgets','widgets') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-custom-widgets') ?'active':''}}">
    <a href="{{route('view-custom-widgets')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Widgets</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">विजेटहरू</span>
        </div>
    </a>
</li>
<li class="nav-item {{Request::url() == route('view-make-widgets') ?'active':''}}">
    <a href="{{route('view-make-widgets')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Make Widgets</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">विजेटहरू बनाउनुहोस्</span>
        </div>
    </a>
</li>
<li class="nav-item {{Request::url() == route('view-custom-section') ?'active':''}}">
    <a href="{{route('view-custom-section')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Section</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">खण्ड</span>
        </div>
    </a>
</li>
<li class="nav-item {{Request::url() == route('view-default-section-title') ?'active':''}}">
    <a href="{{route('view-default-section-title')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Default Sections Title</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">पूर्वनिर्धारित सेक्सन शीर्षक</span>
        </div>
    </a>
</li>
@endif

@if(Gate::check('page','page') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == url('cd-admin/view-all-pageCategory') || Request::url() == url('cd-admin/view-all-pageDetail') ?'active':''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Page</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">पृष्ठ</span>
        </div>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::url() == url('cd-admin/view-all-pageCategory') ?'active':''}}">
            <a href="{{url('cd-admin/add-pageDetail')}}" class="nav-link">
                <i class="fa fa-plus"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Add Page</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">पृष्ठ थप्नुहोस्</span>
                </div>
            </a>
        </li>
        <li class="nav-item {{Request::url() == url('cd-admin/view-all-pageDetail') ?'active':''}}">
            <a href="{{url('cd-admin/view-all-pageDetail')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">All Pages</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">सबै पृष्ठहरू</span>
                </div>
            </a>
        </li>
    </ul>
</li>
@endif

@if(Gate::check('header','header') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == url('cd-admin/view-all-header') || Request::url() == url('cd-admin/view-all-mainMenu') || Request::url() == route('view-feature') || Request::url() == route('view-popup') || Request::url() == route('view-department')?'active':''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Header</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">हेडर</span>
        </div>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{Request::url() == url('cd-admin/view-all-header') ?'active':''}}">
            <a href="{{url('cd-admin/view-all-header')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Header</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">हेडर</span>
                </div>
            </a>
        </li>
        <li class="nav-item {{Request::url() == url('cd-admin/view-all-mainMenu') ?'active':''}}">
            <a href="{{url('cd-admin/view-all-mainMenu')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Menu</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">मेनू</span>
                </div>
            </a>
        </li>
        <li class="nav-item {{Request::url() == route('view-feature') ?'active':''}}">
            <a href="{{route('view-feature')}}" class="nav-link">
                <i class="fa fa-eye"></i>
                <div style="display: none;" class="eng">
                    <span class="title opmcm-en">Features</span>
                </div>
                <div style="display: none;" class="nep">
                    <span class="title opmcm-ne">विशेषताहरु</span>
                </div>
            </a>
        </li>
    </ul>
</li>
@endif

{{--   @if(Gate::check('sidebar','sidebar') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-page-sidebar') ?'active':''}}">
<a href="{{route('view-page-sidebar')}}" class="nav-link nav-toggle">
<i class="fa fa-list-ol"></i>
<span class="title opmcm-en">Page Sidebar</span>
<span class="title opmcm-ne">पृष्ठ साइडबार</span>
</a>
</li>
@endif --}}

@if(Gate::check('footer','footer') || Gate::check('all','all') )
<li class="nav-item {{Request::url() == route('view-footer') ?'active':''}}">
    <a href="{{route('view-footer')}}" class="nav-link nav-toggle">
        <i class="fa fa-list-ol"></i>
        <div style="display: none;" class="eng">
            <span class="title opmcm-en">Footer</span>
        </div>
        <div style="display: none;" class="nep">
            <span class="title opmcm-ne">फुटर</span>
        </div>
    </a>
</li>
@endif

<!-- END SIDEBAR MENU -->
<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR