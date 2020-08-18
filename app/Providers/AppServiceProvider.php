<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use App\Menu;
use App\Header;
use App\Setting;
use App\Footer;
use App\CustomWidgets;
use App\Widgets;
use Request;
use App\Contact;
use App\Features;
use App\Popup;
use App\Seo;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $url = urldecode(Request()->url());
        if(substr($url,0,strlen(Request::root())) == Request::root() && !Request::is('/'))
        {
            $url = substr($url,strlen(Request::root().'/'));
        }
        $page_urls = Menu::where('page_url',$url)->orWhere('page_url_ne',$url)->get()->first();
        $is_homepage = NULL;
        if(Request()->url() == Request()->root().'/en' || Request()->url() == Request()->root().'/np' || Request()->url() == Request()->root() || Request()->url() == Request()->root().'/ne')
        {
            $is_homepage = 1;
        }
        else
        {
            $is_homepage = 0;
        }
        if($page_urls == NULL)
        {
            if(Request::is('/'))
            {
                $page_urls['page_url'] = $url.'/en';
                $page_urls['page_url_ne'] = $url;
            }
            elseif($url == 'en')
            {
                $page_urls['page_url'] = Request::root().'/en';
                $page_urls['page_url_ne'] = Request::root();
            }
            elseif(strpos($url,'search/') !== false)
            {
                $request = Request()->all();
                $page_urls['page_url'] = Request::root().'/search/en'.'?query='.$request['query'];
                $page_urls['page_url_ne'] = Request::root().'/search/np'.'?query='.$request['query'];
            }
            else
            {
                $newurl = substr(urldecode(Request()->url()),0,-3);
                $page_urls['page_url'] = $newurl.'/en';
                $page_urls['page_url_ne'] = $newurl.'/np';
            }
        }
        else
        {
            $page_urls['page_url'] = Request::root().'/'.$page_urls['page_url'];
            $page_urls['page_url_ne'] = Request::root().'/'.$page_urls['page_url_ne'];
        }
        $lang = substr($url,-2);
        if($lang != 'np' && $lang != 'en')
        {
            $lang = 'np';
        }
        $finalSideMenu = [];
        $side_menu = Menu::where('menu_type','side_menu')->where('deleted_at',NULL)->where('active_status','active')->where('is_parent','yes')->orderBy('priority_no','asc')->get(); 
        foreach($side_menu as $key=>$s)
        {
            $finalSideMenu[$key]['parent_menu'] = $s; 
            $finalSideMenu[$key]['sub_menu'] = Menu::where('menu_type','side_menu')->where('deleted_at',NULL)->where('active_status','active')->where('is_parent',NULL)->where('parent_id',$s['id'])->orderBy('priority_no','asc')->get();
        }
        $header = Header::where('deleted_at',NULL)->where('value',1)->orderBy('id','desc')->get()->first();
        $setting = Setting::orderBy('id','desc')->get()->first();
        $popup = Popup::where('deleted_at',NUll)->where('status','active')->get();
        $footer = Footer::where('deleted_at',NULL)->orderBy('id','desc')->get()->first();
        $features = Features::where('deleted_at',NULL)->where('status','active')->get();
        $custom_widget = json_decode($footer['custom_widget_id']);
        $seo = Seo::get()->first();
        $finalArray = [];
        if(isset($footer))
        {
            $count = 1;
            foreach($custom_widget as $key=>$c)
            {
                $widgets = Widgets::where('deleted_at',NULL)->where('custom_widget_id',$c->custom_widget_id)->get();
                foreach($widgets as $w)
                {
                    $finalArray[$count] = $w;
                $count++;
                }
                $count++;
            }
        }
        $new_menu = Menu::where('menu_type','main_menu')->where('deleted_at',NULL)->where('active_status','active')->where('parent_id',0)->orderBy('priority_no','asc')->get();
        $contact = Contact::where('deleted_at',NULL)->get()->first();
        View::share('contact',$contact);
        $finalArray = array_slice(array_unique($finalArray),0,4);
        View::share('features',$features);
        View::share('lang',$lang);
        View::share('page_urls',$page_urls);
        View::share('finalArray',$finalArray);
        View::share('finalSideMenu',$finalSideMenu);
        View::share('new_menu',$new_menu);
        View::share('header',$header);
        View::share('setting',$setting);
        View::share('popup',$popup);
        View::share('seo',$seo);
        View::share('is_homepage',$is_homepage);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
