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
use App\Links;
use App\Setting;
use App\Section;
use App\CustomSections;
use App\PostsCategory;
use App\DefaultSection;
use Carbon\Carbon;
use App\Seo;
class FrontendController extends Controller
{
	public function viewEnglishPage($page_slug)
	{
		$sections =[];
		$data = Page::where('slug',$page_slug)->firstorFail();
		$parsed = $this->tag_contents($data['description'],'[[[section[[[',']]]section]]]');
		$language = 'en';
		foreach($parsed as $key => $p)
		{
			$section = [] ;
			$section["section_id"] = $p.$key;
			$section['section_url'] = $p;
			$sections[$key] = $section;
			$change = '[[[section[[['.$section['section_url'].']]]section]]]'; 
			$changeto = '<section id="'.$section['section_id'].'"></section>';
			$data['description'] = $this->str_replace_first($change,$changeto,$data['description']);
		}
		return view('home.english',compact('data','sections','language'));

	}

	public function viewHomePage()
	{
		$sections =[];
		$language=substr(urldecode(Request()->url()),-2);
		$data = Page::where('title','Home')->firstorFail();
		$parsed = $this->tag_contents($data['description'],'[[[section[[[',']]]section]]]');
		foreach($parsed as $key => $p)
		{
			$section = [] ;
			$section["section_id"] = $p.$key;
			$section['section_url'] = $p;
			$sections[$key] = $section;
			$change = '[[[section[[['.$section['section_url'].']]]section]]]'; 
			$changeto ='<section id="'.$section['section_id'].'"></section>';
			$data['description'] = $this->str_replace_first($change,$changeto,$data['description']);
		}
		return view('home.home',compact('data','sections','language'));
	}

	function str_replace_first($from, $to, $content)
	{
		$from = '/'.preg_quote($from, '/').'/';

		return preg_replace($from, $to, $content, 1);
	}
	public function viewNepaliPage($page_slug)
	{
		$sections =[];
		$data = Page::where('slug',$page_slug)->firstorFail();
		$parsed = $this->tag_contents($data['description_np'],'[[[section[[[',']]]section]]]');
		$language = 'np';
		foreach($parsed as $key => $p)
		{
			$section = [] ;
			$section["section_id"] = $p.$key;
			$section['section_url'] = $p;
			$sections[$key] = $section;
			$change = '[[[section[[['.$section['section_url'].']]]section]]]'; 
			$changeto ='<section id="'.$section['section_id'].'"></section>';
			$data['description_np'] = $this->str_replace_first($change,$changeto,$data['description_np']);
		}
		return view('home.nepali',compact('data','sections','language'));
	}
	function tag_contents($string, $tag_open, $tag_close)
	{

		foreach (explode($tag_open, $string) as $key => $value) 
		{
			if(strpos($value, $tag_close) !== FALSE)
			{
				$result[] = substr($value, 0, strpos($value, $tag_close));
			}
			else
			{
				$result[] = NULL;
			}
		}
		return $result;
	}

	public function getSection($id,$section_id,$language)
	{
		$members = Members::where('deleted_at',NULL)->where('status','active')->get();
		$member_category = MembersCategory::where('deleted_at',NULL)->where('status','active')->get();
		$resource_category = ResourceCategory::where('deleted_at',NULL)->where('status','active')->get();
		$custom_section = CustomSections::where('deleted_at',NULL)->where('status','active')->get();
		$is_homepage = Request()->is_homepage;
		switch ($id) 
		{
			case 'carousel':
			$carousel = Carousel::where('deleted_at',NULL)->where('status','active')->get();
			$html = view('section.carousel',compact('carousel','language','is_homepage'))->render();
			break;

			case 'event':
			$section = DefaultSection::where('value',$id)->get()->first();
			$events = Events::where('deleted_at',NULL)->where('status','active')->get();
			$html = view('section.event',compact('events','language','is_homepage','section'))->render();
			break;

			// case 'embed_link':
			// $embed = Setting::get()->first();
			// $html = view('section.embed_url',compact('embed','language','is_homepage'))->render();
			// break;

			case 'government':
			$links = Links::where('deleted_at',NULL)->where('status','active')->orderBy('priority_no','asc')->get()->take(6);
			$section = DefaultSection::where('value',$id)->get()->first();
			$html = view('section.government',compact('language','links','is_homepage','section'))->render();
			break;

			case 'government-carousel':
			$section = DefaultSection::where('value',$id)->get()->first();
			$link = Links::where('deleted_at',NULL)->where('status','active')->orderBy('priority_no','asc')->get();
			$count = count($link);
			$links = [];
			for($i=0;$i<$count;$i=$i+6)
			{
				$j = $i;
				for($j = 0;$j<$count;$j++)
				{
					$links[$i]['link'] = Links::where('deleted_at',NULL)->where('status','active')->orderBy('priority_no','asc')->skip($i)->take(6)->get();
				}
			}
			$html = view('section.government-carousel',compact('language','links','is_homepage','section'))->render();
			break;

			case 'information':
			$dep = Department::where('deleted_at',NULL)->get();
			$section = DefaultSection::where('value',$id)->get()->first();
			$html = view('section.information',compact('language','dep','is_homepage','section'))->render();
			break;

			// case 'information-list':
			// $dep = Department::where('deleted_at',NULL)->get();
			// $html = view('section.information',compact('language','dep','is_homepage'))->render();
			// break;

			case 'latest-updated-list':
			$new = Posts::where('deleted_at',NULL)->where('status','active')->where('show_latest_updated','yes')->orderBy('id','desc')->get();
			$count = count($new);
			$latest = [];
			for($i=0;$i<$count;$i=$i+5)
			{
				$j = $i;
				for($j = 0;$j<$count;$j++)
				{
					$latest[$i]['link'] = Posts::where('deleted_at',NULL)->where('status','active')->where('show_latest_updated','yes')->orderBy('id','desc')->skip($i)->take(5)->get();
				}
			}
			$section = DefaultSection::where('value',$id)->get()->first();
			$html = view('section.latestupdated-carousel',compact('latest','language','is_homepage','section'))->render();
			break;

			// case 'latestupdated':
			// $latest = Posts::where('deleted_at',NULL)->where('status','active')->where('show_latest_updated','yes')->orderBy('id','desc')->take(3)->get();
			// $html = view('section.latestupdated-list',compact('latest','language','is_homepage'))->render();
			// break;

			case 'posts':
			$section = DefaultSection::where('value',$id)->get()->first();
			$news = Posts::where('deleted_at',NULL)->where('status','active')->where('created_at','<=',Carbon::now('Asia/Kathmandu'))->orderBy('id','desc')->take(3)->get();
			$html = view('section.news',compact('news','language','is_homepage','section'))->render();
			break;

			// case 'cabinet':
			// $cabinet = Members::where('deleted_at',NULL)->where('status','active')->take(6)->get();
			// $category = MembersCategory::where('deleted_at',NULL)->where('status','active')->get();
			// $section = DefaultSection::where('value',$id)->get()->first();
			// $html = view('section.cabinet',compact('language','cabinet','category','is_homepage','section'))->render();
			// break;

			case 'member':
			$members = Members::where('deleted_at',NULL)->where('status','active')->orderBy('order_no','asc')->where('is_expm','no')->where('is_excs','no')->get();
			$category = MembersCategory::where('deleted_at',NULL)->where('status','active')->orderBy('order_no','asc')->get()->first();
			$category1 = MembersCategory::where('deleted_at',NULL)->where('status','active')->orderBy('order_no','asc')->skip(1)->take(1)->first();
			$section = DefaultSection::where('value',$id)->get()->first();
			$val1 = 0;
			$val2 = 0;
			$data = NULL;
			$data1 = NULL;
			foreach($members as $key =>$m)
			{
				$decode = json_decode($m['category_id']);
				if(in_array($category['id'],$decode))
				{
					if($val1 == 0)
					{
						$data = $m;
						$val1++;
					}
				}
				if(in_array($category1['id'],$decode))
				{
					if($val2 == 0)
					{
						$data1 = $m;
						$val2++;
					}
				}
			}
			$html = view('section.member',compact('language','is_homepage','section'))->with('data',$data)->with('data1',$data1)->render();
			break;

			case 'ex-pm':
			$prime = Members::where('deleted_at',NULL)->where('status','active')->where('is_expm','yes')->orderBy('order_no','desc')->get();
			$onepm = collect($prime)->take(1);
			$section = DefaultSection::where('value',$id)->get()->first();
			$html = view('section.ex-pm',compact('language','prime','section','onepm'))->render();
			break;
			
			case 'former-cs':
			$cs = Members::where('deleted_at',NULL)->where('status','active')->where('is_excs','yes')->orderBy('order_no','desc')->get();
			$onecs = collect($cs)->take(1);
			$section = DefaultSection::where('value',$id)->get()->first();
			$html = view('section.ex-cs',compact('language','cs','section','onecs'))->render();
			break;

			case 'prime-minister-former':
			$former = MembersCategory::where('deleted_at',NULL)->where('name','Former Prime Ministers')->get()->first();
			$minister = Members::where('deleted_at',NULL)->where('status','active')->where('category_id',$former['id'])->get(); 
			$html = view('section.prime-minister-former',compact('minister','language','is_homepage'))->render();
			break;

			case 'video-gallery':
			$video = VideoGallery::where('deleted_at',NULL)->where('status','active')->get();
			$html = view('section.video-gallery',compact('video','language','is_homepage'))->render();
			break;

			case 'quotes':
			$quotes = Quotes::where('deleted_at',NULL)->where('status','active')->get();
			$html = view('section.pm-quotes',compact('quotes','language','is_homepage'))->render();
			break;

			case 'speeches':
			$videos = VideoGallery::where('deleted_at',NULL)->where('status','active')->get();
			$html = view('section.pm-speeches',compact('videos','language','is_homepage'))->render();
			break;

			case 'photo-gallery':
			$albums = PhotoGallery::where('deleted_at',NULL)->where('status','active')->paginate(9);
			$html = view('section.album-list',compact('albums','language','is_homepage'))->render();
			break;

			case 'event-list':
			$events = Events::where('deleted_at',NULL)->where('status','active')->get();
			$html = view('section.event-list',compact('events','language','is_homepage'))->render();
			break;

			case 'posts-list':
			$news = Posts::where('deleted_at',NULL)->where('status','active')->orderBy('id','desc')->paginate(9);
			$html = view('section.news-list',compact('news','language','is_homepage'))->render();
			break;

			case 'allstaff':
			$category = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->take(1)->get()->first();
			$category1 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(1)->take(1)->get()->first();
			$category2 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(2)->take(1)->get()->first();
			$category3 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(3)->take(1)->get()->first();
			$category4 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(4)->take(1)->get()->first();
			$category5 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(5)->take(1)->get()->first();
			$category6 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(6)->take(1)->get()->first();
			$category7 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(7)->take(1)->get()->first();
			$category8 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(8)->take(1)->get()->first();
			$category9 = MembersCategory::where('deleted_at',NULL)->where('order_no','<',100)->orderBy('order_no','asc')->skip(9)->take(1)->get()->first();
			$final = [];
			$p1 = [];
			$p2 = [];
			$p3 = [];
			$p = [];
			$p4 = [];
			$priority1 =$priority2 = $priority3 = $priority4 = $priority5 = $priority6 = $priority7 =$priority8= [];
			$member = Members::where('deleted_at',NULL)->where('is_expm','no')->where('is_excs','no')->orderBy('order_no','asc')->get();
			$p3count = 0;
			$p4count = 0;
			$count = 0;
			$allstaffs = [];
			$allstaffs1 = [];
			$allstaffs3 = [];
			$allstaffs2 = [];
			$allstaffs4 = [];
			foreach($member as $key=>$m)
			{
				$decode = json_decode($m['category_id']);

				if(in_array($category['id'],$decode))
				{
					$p[$key] = $m['id'];
				}
				if(in_array($category1['id'],$decode))
				{
					if(count($priority1) <= 1 )
					{
						$priority1[$key] = $m;
						$p1[$key] = $m['id']; 
					}
				}
				elseif(in_array($category2['id'],$decode))
				{	
					$priority2[$key] = $m;
					if(count($priority2) % 5 == 1)
					{
						$count++;
					}
					$priority2[$key]['random'] = $count;
					$p2[$key] = $m['id']; 
				}
				elseif(in_array($category3['id'],$decode))
				{
					$priority3[$key] = $m;
					if(count($priority3) % 5 == 1)
					{
						$p3count++;
					}
					$priority3[$key]['random'] = $p3count;
					$p3[$key] = $m['id']; 
				}
			}
			$allstaffcount = 0;
			$test = 0;
			$allid = array_merge($p1,$p2,$p3,$p);
			foreach($member as $key1=>$mem)
			{
				if(!in_array($mem['id'],$allid))
				{
					$decode = json_decode($mem['category_id']);
					if(in_array($category4['id'],$decode))
					{
						$allstaffs[$key1] = $mem;
						$p4[$key1] = $mem['id'];
					}

					if(in_array($category5['id'],$decode))
					{
						$allstaffs[$key1] = $mem;
						$p4[$key1] = $mem['id'];
					}
					if(in_array($category6['id'],$decode))
					{
						$allstaffs[$key1] = $mem;
						$p4[$key1] = $mem['id'];
					}
					if(in_array($category7['id'],$decode))
					{

						$allstaffs[$key1] = $mem;
						$p4[$key1] = $mem['id'];
					}
					if(in_array($category8['id'],$decode))
					{
						$allstaffs[$key1] = $mem;
						$p4[$key1] = $mem['id'];
					}
					if(in_array($category9['id'],$decode))
					{
						$allstaffs[$key1] = $mem;
						$p4[$key1] = $mem['id'];
					}
				}
			}
			$finalpriority3 = collect($priority3)->groupBy('random');
			$finalpriority2 = collect($priority2)->groupBy('random');
			$section = DefaultSection::where('value',$id)->get()->first();
			$html = view('section.allstaffs',compact('allstaffs','priority1','finalpriority2','finalpriority3','language','is_homepage','section','category1','category2','category3'))->render();
			break;

			case 'alldownloads':
			$resources = Resource::where('deleted_at',NULL)->where('status','active')->where('created_at','<=',Carbon::now('Asia/Kathmandu'))->orderBy('id','desc')->get();
			$category_name = ResourceCategory::where('deleted_at',NULL)->where('status','active')->get();
			$section = DefaultSection::where('value',$id)->get()->first();
			$html = view('section.alldownloads',compact('resources','category_name','language','is_homepage','section'))->render();
			break;

			default:
			foreach ($members as $m)
			{
				if ($id === 'staff-detail'.$m['id'])
				{		 
					$minister = Members::where('id',$m['id'])->get()->first();
					$html = view('section.minister',compact('is_homepage'))->with('minister',$minister)->with('language',$language)->render();
					break 2;
				}
			}
			foreach($member_category as $mc)
			{
				if($id === 'staff-team'.$mc['id'])
				{

					$mem = Members::where('deleted_at',NULL)->orderBy('order_no','asc')->get();
					foreach ($mem as $m) 
					{
						$decode = json_decode($m['category_id']);
						if(in_array($mc['id'],$decode))
						{
							$members[] = $m;
						}
					}
					$member_category = MembersCategory::where('deleted_at',NULL)->get();
					$html = view('section.prime-minister-team',compact('language','member_category','is_homepage'))->with('members',$members)->render();
					break 2;
				}	
			}

			foreach($resource_category as $rc)
			{
				if($id === 'downloads'.$rc['id'])
				{
					$resources=[];
					$res = Resource::where('deleted_at',NULL)->get();
					foreach ($res as $r) 
					{
						$decode = json_decode($r['category_id']);
						if(in_array($rc['id'],$decode))
						{
							$resources[] = $r;
						}
					}
					$category_name = ResourceCategory::where('deleted_at',NULL)->where('status','active')->where('id',$rc['id'])->get()->first();
					$html = view('section.samiti-decisions',compact('resources','category_name','language','is_homepage'))->render();
					break 2;
				}	
			}
			foreach($member_category as $s)
			{
				if($id === 'staff'.$s['id'])
				{
					$mem = Members::where('deleted_at',NULL)->orderBy('order_no','asc')->get();
					foreach ($mem as $r) 
					{
						$decode = json_decode($r['category_id']);
						if(in_array($s['id'],$decode))
						{
							$staff[] = $r;
						}
					}
					$category_name = MembersCategory::where('deleted_at',NULL)->where('status','active')->get();
					$html = view('section.allstaffs',compact('staff','category_name','language','is_homepage'))->render();
					break 2;
				}	
			}

			foreach ($custom_section as $key => $section) 
			{
				if($id === 'custom-'.$section['id'])
				{
					$custom = CustomSections::find($section['id']);
					$section = Section::where('deleted_at',NULL)->where('custom_section_id',$custom['id'])->get();
					$finalSection = [];
					if($custom['content_type'] == 'page')
					{
						foreach($section as $key=>$s)
						{
							if(strpos($s['links'],'page/') !== false)
							{
								$remove1 = substr($s['links'],0,-3);
								$remove2 = substr($remove1,5,);
								$finalSection[$key] = Page::where('slug',$remove2)->get()->first();
								$finalSection[$key]['link_type'] = 'internal';
								$finalSection[$key]['headline'] = $s['headline'];
							}
							else
							{
								$finalSection[$key]['link'] = $s['links'];
								$finalSection[$key]['link_type'] = 'external';
								$finalSection[$key]['headline'] = $s['headline'];
							}
						}
						$html =  view('section.custom_pages',compact('custom','finalSection','language','is_homepage'))->render();
					}
					else
					{
						$postcat = PostsCategory::find($custom['category_id']);
						$posts = Posts::where('deleted_at',NULL)->get();
						$post=[];
						foreach($posts as $p)
						{	
							if(in_array($postcat['id'],json_decode($p['category_id'])))
							{
								$post[] = $p;
							}
						}
						for ($i=0; $i < count($post); $i++) { 

						}
						$html = view('section.custom_posts',compact('custom','post','language'))->render();
					}
					break 2;
				}	
			}
		}
		$response = [];
		$response["htmlContent"] = $html;
		$response["section_id"] =  $section_id;
		$json = json_encode($response);
		return $json;
	}
}
