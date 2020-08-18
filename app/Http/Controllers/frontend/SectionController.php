<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Members;
use App\MembersCategory;
use App\News;
use App\Carousel;
use App\Events;
use App\ResourceCategory;
use App\Resource;
use App\EventsCategory;
use App\Quotes;
use App\VideoGallery;
use App\PhotoGallery;
use App\Department;
use App\Posts;
class SectionController extends Controller
{
    public function carouselSection()
    {
        $carousel = Carousel::where('deleted_at',NULL)->where('status','active')->get();
        $language = 'ne';
    	return view('section.carousel',compact('carousel','language'));
    }

    public function postsSection()
    {
        $news = Posts::where('deleted_at',NULL)->where('status','active')->get();
        $language = 'ne';
    	return view('section.news',compact('news','language'));
    }

    public function eventSection()
    {
        $events = Events::where('deleted_at',NULL)->where('status','active')->get();
        $language = 'ne';
    	return view('section.event',compact('events','language'));
    }

    public function latestUpdatedSection()
    {
        $latest = Posts::where('deleted_at',NULL)->where('status','active')->orderBy('id','desc')->get()->take(3);
        $language = 'ne';
    	return view('section.latestupdated',compact('latest','language'));
    }

    public function informationSection()
    {
        $dep = Department::where('deleted_at',NULL)->get()->take(4);
        $language = 'ne';
    	return view('section.information',compact('dep','language'));
    }

    public function memberSection()
    {
        $data = Members::where('deleted_at',NULL)->where('status','active')->take(1)->first();
        $data1 = Members::where('deleted_at',NULL)->where('status','active')->skip(1)->take(1)->first();
        $language = 'ne';
    	return view('section.member',compact('data','data1','language'));
    }

    public function governmentSection()
    {
    	return view('section.government');
    }

    public function ministerSection()
    {
        return view('section.minister');
    }

    public function primeMinisterTeamSection()
    {
        return view('section.prime-minister-team');
    }

    public function primeMinisterFormerSection()
    {
        $former = MembersCategory::where('deleted_at',NULL)->where('name','Former Prime Ministers')->get()->first();
        $minister = Members::where('deleted_at',NULL)->where('status','active')->where('category_id',$former['id'])->get();
        $language = 'ne';
        return view('section.prime-minister-former',compact('former','minister','language'));
    }


    public function allStaffSection()
    {
        $staff = Members::where('deleted_at',NULL)->where('status','active')->get();
            $category_name = MembersCategory::where('deleted_at',NULL)->where('status','active')->get();
            $html = view('section.allstaffs',compact('staff','category_name','language'))->render();
    }
    public function cabinetSection()
    {
        return view('section.cabinet');  
    }

    public function propertyDetailSection()
    {
        return view('section.property-detail');
    }

    public function cabinetDecisionSection()
    {
        return view('section.cabinet-decision');
    }

    public function cabinetSamitiSection()
    {
        return view('section.cabinet-samiti');
    }

    public function samitiDecisionSection()
    {
        return view('section.samiti-decisions');
    }

    public function secretaryDecisionSection()
    {
       return view('section.secretary-decisions');
    }

    public function exCsSection()
    {
       return view('section.ex-cs');
    }

}

