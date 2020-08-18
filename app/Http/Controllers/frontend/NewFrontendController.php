<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\PhotoGallery;
use App\Quotes;
use App\VideoGallery;
use App\Events;
use App\Members;
use App\Menu;
use App\MembersCategory;
use App\PostsCategory;
use App\ResourceCategory;
use App\EventsCategory;
use App\Resource;
use App\Posts;
use Carbon\Carbon;
class NewFrontendController extends Controller
{

	public function menuPage($menu_name,$language)
	{
		$postcat = PostsCategory::where('slug',$menu_name)->get()->first();
		$posts = Posts::where('deleted_at',NULL)->orderBy('id','desc')->where('created_at','<',Carbon::now('Asia/kathmandu'))->get();
		$post=[];
		foreach($posts as $p)
		{	
			if(in_array($postcat['id'],json_decode($p['category_id'])))
			{
				$post[] = $p;
			}
		}
		return view('home.menu_page',compact('post','language','postcat'));
	}

	public function downloadPage($down_page,$language)
	{
		$downloads = ResourceCategory::where('slug',$down_page)->get()->first();
		$resource = Resource::where('deleted_at',NULL)->where('created_at','<',Carbon::now('Asia/Kathmandu'))->orderBy('id','desc')->get();
		$down = [];
		foreach($resource as $r)
		{	
			if(in_array($downloads['id'],json_decode($r['category_id'])))
			{
				$down[] = $r;
			}
		}
		return view('home.downloads',compact('downloads','language','down'));
	}
	public function newsDetail($slug,$language='np')
	{
		$data = Posts::where('deleted_at',NULL)->where('slug',$slug)->get()->first();
		$random = Posts::where('deleted_at',NULL)->where('id','!=',$data['id'])->where('status','active')->take(3)->get();
		return view('news.news-detail',compact('data','random','language'));
	}

	public function newsList($language)
	{
		$news = Posts::where('deleted_at',NULL)->where('status','active')->where()->orderBy('id','desc')->paginate(9);
		return view('news.news-list',compact('news','language'));
	}

	public function albumList($language)
	{
		$albums = PhotoGallery::where('deleted_at',NULL)->where('status','active')->paginate(9);
		return view('office.album-list',compact('albums','language')); 
	}

	public function albumDynamic($slug,$language)
	{
		$album = PhotoGallery::where('slug',$slug)->firstOrFail();
		$finalgallery = explode(',',$album['image_urls']);
		return view('office.album-dynamic',compact('finalgallery','language'));
	}

	public function pmQuotes($language)
	{
		$quotes = Quotes::where('deleted_at',NULL)->where('status','active')->get();
		return view('office.pm-quotes',compact('quotes','language'));
	}

	public function pmSpeeches($language)
	{
		$videos = VideoGallery::where('deleted_at',NULL)->where('status','active')->get();
		return view('office.pm-speeches',compact('videos','language'));
	}

	public function eventsList($language)
	{
		$events = Events::where('deleted_at',NULL)->where('status','active')->get();
		return view('events.events-list',compact('events','language'));
	}

	public function eventDetail($slug,$language)
	{
		$data = Events::where('deleted_at',NULL)->where('status','active')->where('slug',$slug)->get()->first();
		$random = Events::where('deleted_at',NULL)->where('id','!=',$data['id'])->where('status','active')->take(3)->get();
		return view('events.events-detail',compact('data','language','random'));
	}

	public function memberDetail($slug,$language)
	{
		$members = Members::where('deleted_at',NULL)->where('status','active')->where('slug',$slug)->get()->first();
		return view('prime-minister.prime-minister',compact('members','language'));
	}

	public function contacts()
	{
		$category = MembersCategory::where('deleted_at',NULL)->orderBy('order_no','asc')->take(1)->get()->first();
		$category1 = MembersCategory::where('deleted_at',NULL)->orderBy('order_no','asc')->skip(1)->take(1)->get()->first();
		$category2 = MembersCategory::where('deleted_at',NULL)->orderBy('order_no','asc')->skip(2)->take(1)->get()->first();
		$category3 = MembersCategory::where('deleted_at',NULL)->orderBy('order_no','asc')->skip(3)->take(1)->get()->first();
		$final = [];
		$member = Members::where('deleted_at',NULL)->where('is_expm','no')->where('is_excs','no')->get();
		$value = 0;
		$priority1 = [];
		$priority2 = [];
		$priority3 = [];
		foreach($member as $key=>$m)
		{
			$decode = json_decode($m['category_id']);
			if(in_array($category['id'],$decode))
			{
				$id[$key] = $m['id'];
			}
			if(in_array($category1['id'],$decode))
			{
				if($value == 0)
				{
					$priority1[$key] = $m;
					$id[$key] = $m['id'];
				}
				$value++;
			}
			if(in_array($category2['id'],$decode))
			{
				$priority2[$key] = $m;
				$id[$key] = $m['id'];
			}
			if(in_array($category3['id'],$decode))
			{
				$priority3[$key] = $m;
				$id[$key] = $m['id'];
			}
		}
		$language = 'np';
		$allstaffs = Members::where('deleted_at',NULL)->where('is_expm','no')->whereNotIn('id',$id)->where('is_excs','no')->get();
		return view('contact.contact',compact('priority1','priority2','priority3','allstaffs','language'));
	}

	public function formerPm()
	{
		$prime = Members::where('deleted_at',NULL)->where('status','active')->where('is_expm','yes')->orderBy('order_no','desc')->get();
		return view('prime-minister.prime-minister-former',compact('prime'));
	}

	public function formerPmDetail($slug,$language)
	{
		$prime = Members::where('slug',$slug)->get()->first();
		$primeall = Members::where('deleted_at',NULL)->where('status','active')->where('is_expm','yes')->orderBy('order_no','desc')->get();
		return view('prime-minister.prime-minister-former-detail',compact('prime','primeall','language'));
	}

	public function formerCsDetail($slug,$language)
	{
		$cs = Members::where('slug',$slug)->get()->first();
		$csall = Members::where('deleted_at',NULL)->where('status','active')->where('is_excs','yes')->orderBy('order_no','desc')->get();
		return view('prime-minister.chief-secretary-former-detail',compact('cs','csall','language'));
	}
	public function search($language)
	{
		$request = Request()->all();
		$query = $request['query'];
		$posts = Posts::where('deleted_at',NULL)->where('status','active')->where(function($getQuery) {
			$request = Request()->all();
			return $getQuery->where('tags', 'LIKE', '%'.$request['query'].'%')
			->orWhere('title_ne','Like','%'.$request['query'].'%')
			->orWhere('title','LIKE','%'.$request['query'].'%');
		})->get();

		$resources = Resource::where('deleted_at',NULL)->where('status','active')->where(function($getQuery) {
			$request = Request()->all();
			return $getQuery->where('tags', 'LIKE', '%'.$request['query'].'%')
			->orWhere('file_name','Like','%'.$request['query'].'%')
			->orWhere('file_name_ne','LIKE','%'.$request['query'].'%');
		})->get();
		return view('search.search-results',compact('posts','resources','language','query'));
	}
}
