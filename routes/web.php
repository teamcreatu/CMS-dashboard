<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('error', function () {
    return view('error.error');
});

// Route::get('/page/{slug}/en','frontend\FrontendController@viewEnglishPage');
// Route::get('/page/{slug}/np','frontend\FrontendController@viewNepaliPage');
// Route::get('/page/{slug}/ne','frontend\FrontendController@viewNepaliPage');
Route::get('/',function(){
    return redirect('/cd-admin/login');
});
//Widgets
Route::get('/spokesperson/{id}/nep','backend\WidgetsController@spokespersonNepali');
Route::get('/spokesperson/{id}/eng','backend\WidgetsController@spokespersonEnglish');
Route::get('/memberscategorywidgets/{member_id}/{category_id}/nep','backend\WidgetsController@MembersCategoryWidgetsNepali');
Route::get('/memberscategorywidgets/{member_id}/{category_id}/eng','backend\WidgetsController@MembersCategoryWidgetsEnglish');
Route::get('/contactus/{language}','backend\WidgetsController@contactus');
Route::get('/postswidgets/{id}/eng','backend\WidgetsController@postEnglish');
Route::get('/postswidgets/{id}/nep','backend\WidgetsController@postNepali');
Route::get('/staffscategory/{id}/eng','backend\WidgetsController@staffCategoryEnglish');
Route::get('/staffscategory/{id}/nep','backend\WidgetsController@staffCategoryNepali');
Route::get('/madecustomwidgets/{id}/eng','backend\WidgetsController@customWidgetsEnglish');
Route::get('/madecustomwidgets/{id}/nep','backend\WidgetsController@customWidgetsNepali');
Route::get('/cd-admin/resetpasswordform/{email}','backend\AdminController@ResetPasswordForm')->name('reset-password-form');
Route::post('/cd-admin/resetpassword/{id}','backend\AdminController@ResetPassword')->name('reset-password');

Auth::routes(['register' => false]);

Route::get('/cd-admin/home', 'HomeController@index')->name('home');

Route::get('/page','frontend\FrontendController@Page');
Route::group(['middleware'=>'auth'], function(){
// backend

    Route::get('/cd-admin/dashboard', function () {
        return view('cd-admin.dashboard.dashboard');
    });

//admin

    Route::get('/cd-admin/add-admin','backend\AdminController@addAdmin');
    Route::get('/cd-admin/view-all-admin','backend\AdminController@viewAdmin');
    Route::get('/cd-admin/edit-admin','backend\AdminController@editAdmin');
    Route::post('/cd-admin/insertAdmin','backend\AdminController@insertAdmin');
    Route::get('cd-admin/deleteAdmin/{id}','backend\AdminController@deleteAdmin');
    Route::get('cd-admin/resetpassword/{id}','backend\AdminController@sendPasswordLink');
    Route::get('cd-admin/edit-admin/{id}','backend\AdminController@editAdmin');
    Route::post('/cd-admin/updateAdmin/{id}','backend\AdminController@updateAdmin');
    Route::get('cd-admin/change-password','backend\AdminController@changePasswordForm');
    Route::POST('cd-admin/change-password','backend\AdminController@changePassword')->name('change-password');
    Route::get('cd-admin/edit-profile','backend\AdminController@editProfileForm')->name('update-profile-form');
    Route::post('cd-admin/edit-profile','backend\AdminController@editProfile')->name('update-profile');
    Route::post('cd-admin/update-admin/status/{id}','backend\AdminController@updateStatus')->name('update-admin-status');
    //Role and Permission
    Route::get('/cd-admin/add-role','backend\RoleController@addRole');
    Route::get('/cd-admin/view-all-role','backend\RoleController@viewRole');
    Route::get('/cd-admin/edit-role/{id}','backend\RoleController@editRole');
    Route::post('/cd-admin/insertRole','backend\RoleController@insertRole');
    Route::get('cd-admin/deleteRole/{id}','backend\RoleController@deleteRole');
    Route::post('/cd-admin/updateRole/{id}','backend\RoleController@updateRole');

// Route::get('/cd-admin/add-admin',function(){
//     return view('cd-admin.admin.add-new-admin');
// });
// Route::get('/cd-admin/view-all-admin',function(){
//     return view('cd-admin.admin.view-all-admin');
// });
// Route::get('/cd-admin/edit-admin',function(){
//     return view('cd-admin.admin.edit-admin');
// });


//about
    Route::get('/cd-admin/add-about',function(){
        return view('cd-admin.about.add-new-about');
    });
    Route::get('/cd-admin/view-all-about',function(){
        return view('cd-admin.about.view-all-about');
    });
    Route::get('/cd-admin/edit-about',function(){
        return view('cd-admin.about.edit-about');
    });


//blog
    Route::get('/cd-admin/add-blog',function(){
        return view('cd-admin.blog.add-new-about');
    });
    Route::get('/cd-admin/view-all-blog',function(){
        return view('cd-admin.blog.view-all-about');
    });
    Route::get('/cd-admin/edit-blog',function(){
        return view('cd-admin.blog.edit-about');
    });


//achivement

    Route::get('/cd-admin/add-achivement',function(){
        return view('cd-admin.achivement.add-new-about');
    });
    Route::get('/cd-admin/view-all-achivement',function(){
        return view('cd-admin.achivement.view-all-about');
    });
    Route::get('/cd-admin/edit-achivement',function(){
        return view('cd-admin.achivement.edit-about');
    });


//category
    Route::get('/cd-admin/add-category',function(){
        return view('cd-admin.category.add-new-about');
    });
    Route::get('/cd-admin/view-all-category',function(){
        return view('cd-admin.category.view-all-about');
    });
    Route::get('/cd-admin/edit-category',function(){
        return view('cd-admin.category.edit-about');
    });


//sub-category
    Route::get('/cd-admin/add-sub-category',function(){
        return view('cd-admin.sub-category.add-new-about');
    });
    Route::get('/cd-admin/view-all-sub-category',function(){
        return view('cd-admin.sub-category.view-all-about');
    });
    Route::get('/cd-admin/edit-sub-category',function(){
        return view('cd-admin.sub-category.edit-about');
    });

//portfolio

    Route::get('/cd-admin/add-portfolio',function(){
        return view('cd-admin.portfolio.add-new-about');
    });
    Route::get('/cd-admin/view-all-portfolio',function(){
        return view('cd-admin.portfolio.view-all-about');
    });
    Route::get('/cd-admin/edit-portfolio',function(){
        return view('cd-admin.portfolio.edit-about');
    });


//team

    Route::get('/cd-admin/add-team',function(){
        return view('cd-admin.team.add-new-about');
    });
    Route::get('/cd-admin/view-all-team',function(){
        return view('cd-admin.team.view-all-about');
    });
    Route::get('/cd-admin/edit-team',function(){
        return view('cd-admin.team.edit-about');
    });


//creatu-testimonial

    Route::get('/cd-admin/add-creatu-testimonial',function(){
        return view('cd-admin.creatu-testimonial.add-new-about');
    });
    Route::get('/cd-admin/view-all-creatu-testimonial',function(){
        return view('cd-admin.creatu-testimonial.view-all-about');
    });
    Route::get('/cd-admin/edit-creatu-testimonial',function(){
        return view('cd-admin.creatu-testimonial.edit-about');
    });

//About Office
    Route::get('/cd-admin/add-about-office','backend\AboutOfficeController@addAboutOfficeForm');
    Route::get('/cd-admin/view-about-office','backend\AboutOfficeController@viewAboutOffice');
    Route::get('/cd-admin/add-about-office-card','backend\AboutOfficeController@add-about-office-card');


//Photos
    Route::get('/cd-admin/add-photos','backend\PhotosController@addPhotoForm')->name('add-photos-form');
    Route::post('/cd-admin/add-photos','backend\PhotosController@addPhoto')->name('add-photos');
    Route::get('/cd-admin/view-photos','backend\PhotosController@viewPhotos')->name('view-photos');
// Route::post('/cd-admin/photos/updatestatus/{id}','backend\PhotosController@updateStatus')->name('update-photo-status');
// Route::get('/cd-admin/photos/edit/{id}','backend\PhotosController@editPhotoForm')->name('edit-photo-form');
// Route::post('/cd-admin/photos/edit/{id}','backend\PhotosController@editPhoto')->name('edit-photo');
    Route::post('/cd-admin/delete/photo/','backend\PhotosController@deletePhoto')->name('delete-photo');
    Route::get('/cd-admin/search/photo','backend\PhotosController@search')->name('search');
    Route::post('/cd-admin/add-photo-dynamic','backend\PhotosController@addPhotoDynamic')->name('add-photo-dynamic');
    // Route::post('/cd-admin/add-photo-dynamic-multiple','backend\PhotosController@addMultiplePhotoDynamic')->name('add-photo-dynamic-multiple');
    Route::post('/cd-admin/add-photo-dynamic-multiple','backend\PhotosController@upload')->name('dropzone.upload');
    
    Route::get('dropzone/fetch', 'backend\PhotosController@fetch')->name('dropzone.fetch');

    Route::get('dropzone/delete', 'backend\PhotosController@delete')->name('dropzone.delete');
    Route::get('dropzone/remove','backend\PhotosController@remove')->name('dropzone.remove');

//Resource Category
    Route::get('/cd-admin/add-resource-category','backend\ResourceCategoryController@addResourceCategoryForm')->name('add-resource-category-form');
    Route::get('/cd-admin/view-resource-category','backend\ResourceCategoryController@viewResourceCategory')->name('view-resource-category');
    Route::get('/cd-admin/edit-resource-category','backend\ResourceCategoryController@editResourceCategoryForm')->name('edit-resource-category-form');
    Route::post('/cd-admin/add-resource-category','backend\ResourceCategoryController@addResourceCategory')->name('add-resource-category');
    Route::post('/cd-admin/resource/category/updatestatus/{id}','backend\ResourceCategoryController@updateStatus')->name('update-resource-category-status');
    Route::post('/cd-admin/edit-resource-category/{id}','backend\ResourceCategoryController@editResourceCategory')->name('edit-resource-category');
    Route::post('/cd-admin/delete-resource-category/{id}','backend\ResourceCategoryController@deleteResourceCategory')->name('delete-resource-category');


//Resource 
    Route::get('/cd-admin/add-resource','backend\ResourceController@addResourceForm')->name('add-resource-form');
    Route::get('/cd-admin/view-resource','backend\ResourceController@viewResource')->name('view-resource');
    Route::get('/cd-admin/edit-resource/{id}','backend\ResourceController@editResourceForm')->name('edit-resource-form');
    Route::post('/cd-admin/add-resource','backend\ResourceController@addResource')->name('add-resource');
    Route::post('/cd-admin/resource/updatestatus/{id}','backend\ResourceController@updateStatus')->name('update-resource-status');
    Route::post('/cd-admin/edit-resource/{id}','backend\ResourceController@editResource')->name('edit-resource');
    Route::post('/cd-admin/resource/delete/{id}','backend\ResourceController@deleteResource')->name('delete-resource');

//Carousel
    Route::get('/cd-admin/add-carousel','backend\CarouselController@addCarouselForm')->name('add-carousel-form');
    Route::get('/cd-admin/view-carousel','backend\CarouselController@viewCarousel')->name('view-carousel');
    Route::get('/cd-admin/edit-carousel/{id}','backend\CarouselController@editCarouselForm')->name('edit-carousel-form');
    Route::post('/cd-admin/add-carousel','backend\CarouselController@addCarousel')->name('add-carousel');
    Route::post('/cd-admin/edit-carousel/{id}','backend\CarouselController@editCarousel')->name('edit-carousel');
    Route::get('/cd-admin/carousel/updatestatus/{id}','backend\CarouselController@updateStatus')->name('update-carousel-status');
    Route::post('/cd-admin/carousel/delete','backend\CarouselController@deleteCarousel')->name('delete-carousel');



//Posts Category
    Route::get('/cd-admin/add-posts-category','backend\PostsCategoryController@addPostsCategoryForm')->name('add-posts-category-form');
    Route::get('/cd-admin/view-posts-category','backend\PostsCategoryController@viewPostsCategory')->name('view-posts-category');
    Route::post('/cd-admin/add-posts-category','backend\PostsCategoryController@addPostsCategory')->name('add-posts-category');
    Route::post('/cd-admin/edit-posts-category/{id}','backend\PostsCategoryController@editPostsCategory')->name('edit-posts-category');
    Route::post('/cd-admin/delete/PostsCategory/{id}','backend\PostsCategoryController@deletePostsCategory')->name('delete-posts-category');
    Route::post('/cd-admin/posts-category/updatestatus/{id}','backend\PostsCategoryController@updateStatus')->name('update-posts-category-status');

//Events Category
    Route::get('/cd-admin/add-events-category','backend\EventsCategoryController@addEventsCategoryForm')->name('add-events-category-form');
    Route::get('/cd-admin/view-events-category','backend\EventsCategoryController@viewEventsCategory')->name('view-events-category');
    Route::post('/cd-admin/add-events-category','backend\EventsCategoryController@addEventsCategory')->name('add-events-category');
    Route::post('/cd-admin/edit-events-category/{id}','backend\EventsCategoryController@editEventsCategory')->name('edit-events-category');
    Route::post('/cd-admin/delete/eventscategory/{id}','backend\EventsCategoryController@deleteEventsCategory')->name('delete-events-category');
    Route::post('/cd-admin/event-category/updatestatus/{id}','backend\EventsCategoryController@updateStatus')->name('update-events-category-status');


//Events
    Route::get('/cd-admin/add-events','backend\EventsController@addEventsForm')->name('add-events-form');
    Route::get('/cd-admin/view-events','backend\EventsController@viewEvents')->name('view-events');
    Route::get('/cd-admin/edit-events/{id}','backend\EventsController@editEventsForm')->name('edit-events-form');
    Route::post('/cd-admin/add-events','backend\EventsController@addEvents')->name('add-events');
    Route::post('/cd-admin/edit-events/{id}','backend\EventsController@editEvents')->name('edit-events');
    Route::post('/cd-admin/delete/events/{id}','backend\EventsController@deleteEvents')->name('delete-events');
    Route::post('/cd-admin/events/updatestatus/{id}','backend\EventsController@updateStatus')->name('update-events-status');
    Route::get('/cd-admin/events/view/{id}','backend\EventsController@viewOneEvent')->name('view-one-event');


//Posts
    Route::get('cd-admin/add-posts','backend\PostsController@addPostForm')->name('add-posts-form');
    Route::get('cd-admin/view-posts','backend\PostsController@viewPost')->name('view-posts');
    Route::get('cd-admin/edit-posts/{id}','backend\PostsController@editPostForm')->name('edit-posts-form');
    Route::post('cd-admin/add-posts','backend\PostsController@addPost')->name('add-posts');
    Route::post('cd-admin/edit-posts/{id}','backend\PostsController@editPost')->name('edit-posts');
    Route::post('cd-admin/posts/updatestatus/{id}','backend\PostsController@updateStatus')->name('update-posts-status');
    Route::get('cd-admin/posts/view/{id}','backend\PostsController@viewOnePost')->name('view-one-posts');
    Route::post('cd-admin/posts/delete/{id}','backend\PostsController@deletePost')->name('delete-posts');
    Route::post('cd-admin/posts/update/show/status/{id}','backend\PostsController@updatePostsShowStatus')->name('update-show-posts-status');

//Member Category
    Route::get('/cd-admin/add-members-category','backend\MembersCategoryController@addMembersCategoryForm')->name('add-members-category-form');
    Route::get('/cd-admin/view-members-category','backend\MembersCategoryController@viewMembersCategory')->name('view-members-category');
    Route::post('/cd-admin/add-members-category','backend\MembersCategoryController@addMembersCategory')->name('add-members-category');
    Route::post('/cd-admin/edit-members-category/{id}','backend\MembersCategoryController@editMembersCategory')->name('edit-members-category');
    Route::post('/cd-admin/delete/memberscategory/{id}','backend\MembersCategoryController@deleteMembersCategory')->name('delete-members-category');
    Route::post('/cd-admin/memberscategory/updatestatus/{id}','backend\MembersCategoryController@updateStatus')->name('update-members-category-status');

//Members
    Route::get('/cd-admin/add-members','backend\MembersController@addMembersForm')->name('add-members-form');
    Route::get('/cd-admin/view-members','backend\MembersController@viewMembers')->name('view-members');
    Route::get('/cd-admin/edit-members/{id}','backend\MembersController@editMembersForm')->name('edit-members-form');
    Route::post('/cd-admin/add-members','backend\MembersController@addMembers')->name('add-members');
    Route::post('/cd-admin/edit-members/{id}','backend\MembersController@editMembers')->name('edit-members');
    Route::post('/cd-admin/delete/members/{id}','backend\MembersController@deleteMembers')->name('delete-members');
    Route::post('/cd-admin/members/updatestatus/{id}','backend\MembersController@updateStatus')->name('update-members-status');
    Route::get('/cd-admin/members/view/{id}','backend\MembersController@viewOneMember')->name('view-one-member');
    Route::get('/cd-admin/search-member-dynamic','backend\MembersController@searchMember')->name('search-members-dynamic');

//Videos
    Route::get('/cd-admin/add-video','backend\VideosController@addVideoForm')->name('add-videos-form');
    Route::post('/cd-admin/add-video','backend\VideosController@addVideo')->name('add-videos');
    Route::get('/cd-admin/view-video','backend\VideosController@viewVideo')->name('view-videos');
    Route::get('/cd-admin/view-one-video/{id}','backend\VideosController@viewOneVideo')->name('view-one-video');
    Route::post('/cd-admin/delete/video','backend\VideosController@deleteVideo')->name('delete-videos');
    Route::get('/cd-admin/search/video','backend\VideosController@searchVideo')->name('search-video');
    Route::post('/cd-admin/add-video-dynamic','backend\VideosController@addVideoDynamic')->name('add-videos-dynamic');

//Photo Gallery
    Route::get('/cd-admin/add-photo-gallery','backend\PhotoGalleryController@addPhotoGalleryForm')->name('add-photo-gallery-form');
    Route::post('/cd-admin/add-photo-gallery','backend\PhotoGalleryController@addPhotoGallery')->name('add-photo-gallery');
    Route::get('/cd-admin/view-photo-gallery','backend\PhotoGalleryController@viewPhotoGallery')->name('view-photo-gallery');
    Route::get('/cd-admin/view/one-photo-gallery/{id}','backend\PhotoGalleryController@viewOnePhotoGallery')->name('view-one-photo-gallery');
    Route::get('/cd-admin/edit-photo-gallery/{id}','backend\PhotoGalleryController@editPhotoGalleryForm')->name('edit-photo-gallery-form');
    Route::post('/cd-admin/edit-photo-gallery/{id}','backend\PhotoGalleryController@editPhotoGallery')->name('edit-photo-gallery');
    Route::post('/cd-admin/delete/photo-gallery/{id}','backend\PhotoGalleryController@deletePhotoGallery')->name('delete-photo-gallery');
    Route::get('/cd-admin/update/add-new-photo/{id}','backend\PhotoGalleryController@addAnotherPhotoForm')->name('add-photo-to-gallery-form');
    Route::post('/cd-admin/update/add-new-photo/{id}','backend\PhotoGalleryController@addAnotherPhoto')->name('add-photo-to-gallery');
    Route::post('/cd-admin/delete/one-photo-gallery/{id}','backend\PhotoGalleryController@deleteOnePhotoFromGallery')->name('delete-one-photo-gallery');
//Video Gallery
    Route::get('/cd-admin/add-video-gallery','backend\VideoGalleryController@addVideoGalleryForm')->name('add-video-gallery-form');
    Route::post('/cd-admin/add-video-gallery','backend\VideoGalleryController@addVideoGallery')->name('add-video-gallery');
    Route::get('/cd-admin/view-video-gallery','backend\VideoGalleryController@viewVideoGallery')->name('view-video-gallery');
    Route::get('/cd-admin/view/one-video-gallery/{id}','backend\VideoGalleryController@viewOneVideoGallery')->name('view-one-video-gallery');
    Route::get('/cd-admin/edit-video-gallery/{id}','backend\VideoGalleryController@editVideoGalleryForm')->name('edit-video-gallery-form');
    Route::post('/cd-admin/edit-video-gallery/{id}','backend\VideoGalleryController@editVideoGallery')->name('edit-video-gallery');
    Route::post('/cd-admin/delete/video-gallery/{id}','backend\VideoGalleryController@deleteVideoGallery')->name('delete-video-gallery');
    Route::post('/cd-admin/update/video-gallery/{id}','backend\VideoGalleryController@updateStatus')->name('update-video-gallery-status');
    Route::post('/cd-admin/delete/video-gallery/{id}','backend\VideoGalleryController@deleteVideoGallery')->name('delete-video-gallery');


//pageCategory
    Route::get('/cd-admin/add-pageCategory','backend\PageController@addPageCategory');
    Route::post('/cd-admin/insert-pageCategory','backend\PageController@insertPageCategory');
    Route::post('/cd-admin/update-pageCategory/{key}','backend\PageController@updatePageCategory');
    Route::get('/cd-admin/view-all-pageCategory','backend\PageController@viewPageCategory');
    Route::get('/cd-admin/edit-pageCategory/{key}','backend\PageController@editPageCategory');
    Route::post('cd-admin/update-page-status/{key}','backend\PageController@updatePageStatus');
    Route::post('cd-admin/delete-page-category/{key}','backend\PageController@deletedPageCategory');

//pageDetail
    Route::get('/cd-admin/add-pageDetail','backend\PageDetailController@addPageDetail');
    Route::post('/cd-admin/insert-pageDetail','backend\PageDetailController@insertPageDetail');
    Route::post('/cd-admin/update-pageDetail/{key}','backend\PageDetailController@updatePageDetail');
    Route::get('/cd-admin/view-all-pageDetail','backend\PageDetailController@viewPageDetail');
    Route::get('/cd-admin/edit-pageDetail/{key}','backend\PageDetailController@editPageDetail');
    Route::post('cd-admin/update-pageDetail-status/{key}','backend\PageDetailController@updatePageStatus');
    Route::post('cd-admin/delete-page-Detail/{key}','backend\PageDetailController@deletedPageDetail');
    Route::get('cd-admin/view-one-page/{key}','backend\PageDetailController@viewOnePage');
//menu
    Route::get('/cd-admin/add-mainMenu','backend\MenuController@addMainMenu');
    Route::post('/cd-admin/insert-mainMenu','backend\MenuController@insertMainMenu');
    Route::get('/cd-admin/view-all-mainMenu','backend\MenuController@viewMainMenu');
    Route::get('/cd-admin/edit-mainMenu/{id}','backend\MenuController@editMainMenu');
    Route::post('/cd-admin/update-mainMenu/{key}','backend\MenuController@updateMainMenu');
    Route::post('cd-admin/update-menu-status/{key}','backend\MenuController@updateStatus');
    Route::get('/cd-admin/view-one-menu/{id}','backend\MenuController@viewOneMenu');
    Route::post('cd-admin/delete-mainMenu/{key}','backend\MenuController@deleteMainMenu');
    Route::get('/cd-admin/sort-mainMenu','backend\MenuController@sortMainMenu');
    Route::post('/cd-admin/update-sort','backend\MenuController@updateSort');
    Route::get('/cd-admin/sort-sideMenu','backend\MenuController@sortSideMenu');
    Route::post('/cd-admin/update-sidemenusort','backend\MenuController@updateSideMenuSort');
//Quotes
    Route::get('/cd-admin/add-quotes','backend\QuotesController@addQuotesForm')->name('add-quotes-form');
    Route::post('/cd-admin/add-quotes','backend\QuotesController@addQuotes')->name('add-quotes');
    Route::get('/cd-admin/edit-quotes/{id}','backend\QuotesController@editQuotesForm')->name('edit-quotes-form');
    Route::post('/cd-admin/edit-quotes/{id}','backend\QuotesController@editQuotes')->name('edit-quotes');
    Route::get('/cd-admin/view-quotes','backend\QuotesController@viewQuotes')->name('view-quotes');
    Route::post('/cd-admin/quotes/updateStatus/{id}','backend\QuotesController@updateStatus')->name('update-quotes-status');
    Route::post('/cd-admin/quotes/delete/{id}','backend\QuotesController@deleteQuotes')->name('delete-quotes');

//Contact Us
    Route::get('/cd-admin/add-contact-us','backend\ContactUsController@addContactUsForm')->name('add-contact-us-form');
    Route::post('/cd-admin/add-contact-us','backend\ContactUsController@addContactUs')->name('add-contact-us');
    Route::get('/cd-admin/edit-contact-us/{id}','backend\ContactUsController@editContactUsForm')->name('edit-contact-us-form');
    Route::post('/cd-admin/edit-contact-us/{id}','backend\ContactUsController@editContactUs')->name('edit-contact-us');
    Route::get('/cd-admin/view-contact-us','backend\ContactUsController@viewContactUs')->name('view-contact-us');
    Route::post('/cd-admin/contact-us/updateStatus/{id}','backend\ContactUsController@updateStatus')->name('update-contact-us-status');
    Route::post('/cd-admin/contact-us/delete/{id}','backend\ContactUsController@deleteContactUs')->name('delete-contact-us');

//Settings
    Route::get('/cd-admin/add-settings','backend\SettingsController@addSettingsForm')->name('add-settings-form');
    Route::post('/cd-admin/add-settings','backend\SettingsController@addSettings')->name('add-settings');
    Route::get('/cd-admin/view-settings','backend\SettingsController@viewSettings')->name('view-settings');
    Route::post('/cd-admin/update/settings/{id}','backend\SettingsController@editSettings')->name('edit-settings');

    //header
    Route::get('cd-admin/add-header','backend\HeaderController@addHeader');
    Route::get('/cd-admin/view-all-header','backend\HeaderController@viewHeader');
    Route::get('/cd-admin/editHeader/{id}','backend\HeaderController@editHeader');
    Route::post('/cd-admin/insertHeader','backend\HeaderController@insertHeader');
    Route::post('/cd-admin/updateHeader/{id}','backend\HeaderController@updateHeader');
    Route::post('cd-admin/deleteHeader/{id}','backend\HeaderController@deletedHeader');
//Custom Widgets
    Route::get('/cd-admin/add-custom-widgets','backend\WidgetsController@addCustomWidgetsForm')->name('add-custom-widgets-form');
    Route::post('/cd-admin/add-custom-widgets','backend\WidgetsController@addCustomWidgets')->name('add-custom-widgets');
    Route::get('/cd-admin/view-custom-widgets','backend\WidgetsController@viewCustomWidgets')->name('view-custom-widgets');
    Route::get('/cd-admin/edit-custom-widgets/{id}','backend\WidgetsController@editCustomWidgetsForm')->name('edit-custom-widgets-form');
    Route::post('/cd-admin/edit-custom-widgets/{id}','backend\WidgetsController@editCustomWidgets')->name('edit-custom-widgets');
    Route::post('/cd-admin/delete/widget/{id}','backend\WidgetsController@deleteOneWidget')->name('delete-one-widget');
    Route::post('/cd-admin/delete/custom/widget/{id}','backend\WidgetsController@deleteCustomWidget')->name('delete-custom-widget');

//Default Widgets
    Route::get('/cd-admin/view-default-member-widgets/','backend\WidgetsController@viewMemberWidgets')->name('view-member-widgets');
    Route::get('/cd-admin/view-one-member-widget/{id}','backend\WidgetsController@viewOneMemberWidget')->name('view-one-member-widget');


//Page Sidebar
    Route::get('/cd-admin/add-page-sidebar','backend\PageSidebarController@addPageSidebarForm')->name('add-page-sidebar-form');
    Route::post('/cd-admin/add-page-sidebar','backend\PageSidebarController@addPageSidebar')->name('add-page-sidebar');
    Route::get('/cd-admin/edit-page-sidebar/{id}','backend\PageSidebarController@editPageSidebarForm')->name('edit-page-sidebar-form');
    Route::post('/cd-admin/edit-page-sidebar/{id}','backend\PageSidebarController@editPageSidebar')->name('edit-page-sidebar');
    Route::get('/cd-admin/view-page-sidebar','backend\PageSidebarController@viewPageSidebar')->name('view-page-sidebar');


//Footer
    Route::get('/cd-admin/add-footer','backend\FooterController@addFooterForm')->name('add-footer-form');
    Route::get('/cd-admin/edit-footer/{id}','backend\FooterController@editFooterForm')->name('edit-footer-form');
    Route::post('/cd-admin/add-footer','backend\FooterController@addFooter')->name('add-footer');
    Route::post('/cd-admin/edit-footer/{id}','backend\FooterController@editFooter')->name('edit-footer');
    Route::get('/cd-admin/view-footer','backend\FooterController@viewFooter')->name('view-footer');


//File 
    Route::get('/cd-admin/add-files','backend\FilesController@addFileForm')->name('add-files-form');
    Route::post('/cd-admin/add-files','backend\FilesController@addFile')->name('add-files');
    Route::get('/cd-admin/view-files','backend\FilesController@viewFile')->name('view-files');
    Route::post('/cd-admin/delete-files/','backend\FilesController@deleteFile')->name('delete-files');
    Route::post('/cd-admin/add-files-dynamic','backend\FilesController@addFileDynamic')->name('add-files-dynamic');
    Route::post('/cd-admin/add-post-files-dynamic','backend\FilesController@addFilePostDynamic')->name('add-post-files-dynamic');



//Features
    Route::get('/cd-admin/add-features','backend\FeaturesController@addFeatureForm')->name('add-feature-form');
    Route::post('/cd-admin/add-features','backend\FeaturesController@addFeature')->name('add-feature');
    Route::get('/cd-admin/edit-features/{id}','backend\FeaturesController@editFeatureForm')->name('edit-feature-form');
    Route::post('/cd-admin/edit-features/{id}','backend\FeaturesController@editFeature')->name('edit-feature');
    Route::get('/cd-admin/view-features','backend\FeaturesController@viewFeature')->name('view-feature');
    Route::post('/cd-admin/update-feature-status/{id}','backend\FeaturesController@updateStatus')->name('update-feature-status');
    Route::post('/cd-admin/delete-feature/{id}','backend\FeaturesController@deleteFeature')->name('delete-feature');

//Department
    Route::get('/cd-admin/add-department','backend\DepartmentController@addDepartmentForm')->name('add-department-form');
    Route::post('/cd-admin/add-department','backend\DepartmentController@addDepartment')->name('add-department');
    Route::get('/cd-admin/edit-department/{id}','backend\DepartmentController@editDepartmentForm')->name('edit-department-form');
    Route::post('/cd-admin/edit-department/{id}','backend\DepartmentController@editDepartment')->name('edit-department');
    Route::get('/cd-admin/view-department','backend\DepartmentController@viewDepartment')->name('view-department');
    Route::post('/cd-admin/update-department-status/{id}','backend\DepartmentController@updateStatus')->name('update-department-status');
    Route::post('/cd-admin/delete-department/{id}','backend\DepartmentController@deleteDepartment')->name('delete-department');

//Popup
    Route::get('/cd-admin/add-popup','backend\PopupController@addPopupForm')->name('add-popup-form');
    Route::post('/cd-admin/add-popup','backend\PopupController@addPopup')->name('add-popup');
    Route::get('/cd-admin/view-popup','backend\PopupController@viewPopup')->name('view-popup');
    Route::get('/cd-admin/update/popup/{id}','backend\PopupController@editPopupForm')->name('edit-popup-form');
    Route::post('/cd-admin/update/popup/{id}','backend\PopupController@editPopup')->name('edit-popup');
    Route::post('/cd-admin/delete/popup/{id}','backend\PopupController@deletePopup')->name('delete-popup');
    Route::post('/cd-admin/update/popupstatus/{id}','backend\PopupController@updateStatus')->name('update-popup-status');



//Custom Section
    Route::get('/cd-admin/add-custom-section','backend\SectionsController@addCustomSectionForm')->name('add-custom-section-form');
    Route::post('/cd-admin/add-custom-section','backend\SectionsController@addCustomSection')->name('add-custom-section');
    Route::get('/cd-admin/view-custom-section','backend\SectionsController@viewCustomSection')->name('view-custom-section');
    Route::get('/cd-admin/edit-custom-section/{id}','backend\SectionsController@editCustomSectionForm')->name('edit-custom-section-form');
    Route::post('/cd-admin/edit-custom-section/{id}','backend\SectionsController@editCustomSection')->name('edit-custom-section');
    Route::post('/cd-admin/delete/section/{id}','backend\SectionsController@deleteOneSection')->name('delete-one-section');
    Route::post('/cd-admin/delete/custom/section/{id}','backend\SectionsController@deleteCustomSection')->name('delete-custom-section');
    Route::get('/cd-admin/view-one-custom-section/{id}','backend\SectionsController@viewOneCustomSection')->name('view-one-custom-section');
    Route::get('/cd-admin/sort-custom-sections','backend\SectionsController@sortCustomSection')->name('sort-custom-sections');
    Route::get('/cd-admin/update-section-sort','backend\SectionsController@sortSection');

    //Links Category
    
    Route::get('/cd-admin/add-links-category','Backend\LinksCategoryController@addLinksCategoryForm')->name('add-links-category-form');
    Route::get('/cd-admin/view-links-category','Backend\LinksCategoryController@viewLinksCategory')->name('view-links-category');
    Route::post('/cd-admin/add-links-category','Backend\LinksCategoryController@addLinksCategory')->name('add-links-category');
    Route::post('/cd-admin/edit-links-category/{id}','Backend\LinksCategoryController@editLinksCategory')->name('edit-links-category');
    Route::post('/cd-admin/delete/linkscategory/{id}','Backend\LinksCategoryController@deleteLinksCategory')->name('delete-links-category');
    Route::post('/cd-admin/linkscategory/updatestatus/{id}','Backend\LinksCategoryController@updateStatus')->name('update-links-category-status');

//Links
    Route::get('/cd-admin/view-links','backend\LinksController@viewLinks')->name('view-links');
    Route::get('/cd-admin/add-links','backend\LinksController@addLinksForm')->name('add-links-form');
    Route::post('/cd-admin/add-links','backend\LinksController@addLinks')->name('add-links');
    Route::get('/cd-admin/edit-links/{id}','backend\LinksController@editLinksForm')->name('edit-links-form');
    Route::post('/cd-admin/edit-links/{id}','backend\LinksController@editLinks')->name('edit-links');
    Route::post('/cd-admin/delete-links/{id}','backend\LinksController@deleteLinks')->name('delete-links');
    Route::post('/cd-admin/update-link-status/{id}','backend\LinksController@updateStatus')->name('update-links-status');

//Make Widgets
    Route::get('/cd-admin/add-make-widget','backend\MakeWidgetsController@addMakeWidgetForm')->name('add-make-widget-form');
    Route::post('/cd-admin/add-make-widget','backend\MakeWidgetsController@addMakeWidget')->name('add-make-widget');
    Route::get('/cd-admin/view-make-widgets','backend\MakeWidgetsController@viewMakeWidgets')->name('view-make-widgets');
    Route::post('/cd-admin/update-make-widgets-status/{id}','backend\MakeWidgetsController@updateStatus')->name('update-make-widgets-status');
    Route::get('/cd-admin/edit-make-widgets/{id}','backend\MakeWidgetsController@editMakeWidgetsForm')->name('edit-make-widgets-form');
    Route::post('/cd-admin/edit-make-widgets/{id}','backend\MakeWidgetsController@editMakeWidgets')->name('edit-make-widgets');
    Route::post('/cd-admin/delete-make-widgets/{id}','backend\MakeWidgetsController@deleteMakeWidgets')->name('delete-make-widgets');

//Default Sections Title
    Route::get('/cd-admin/view-default-section-title','backend\DefaultSectionsController@viewDefaultSectionTitle')->name('view-default-section-title'); 
    Route::post('/cd-admin/edit-default-section-title/{id}','backend\DefaultSectionsController@editDefaultSectionTitle')->name('edit-default-section-title'); 
//SEO
    Route::get('/cd-admin/add-seo','backend\SeoController@addSeoForm')->name('add-seo-form');
    Route::post('/cd-admin/add-seo','backend\SeoController@addSeo')->name('add-seo');
    Route::get('/cd-admin/edit-seo/{id}','backend\SeoController@editSeoForm')->name('edit-seo-form');
    Route::post('/cd-admin/edit-seo/{id}','backend\SeoController@editSeo')->name('edit-seo');
    Route::get('/cd-admin/view-seo','backend\SeoController@viewSeo')->name('view-seo');


    Route::get('cd-admin/session',function()
    {
        dd(session()->all());
    });
    Route::get('cd-admin/change-session/{lang}',function($lang)
    {
        session()->put('language',$lang);
    })->name('change-session');});
