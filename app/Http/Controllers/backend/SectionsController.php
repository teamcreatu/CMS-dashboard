<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DefaultSection;
use App\Page;
use App\PostsCategory;
use App\CustomSections;
use App\Section;
use Session;
use Carbon\Carbon;
use App\Posts;
class SectionsController extends Controller
{


	public function viewCustomSection()
	{
		$custom = CustomSections::where('deleted_at',NULL)->get();
		$widgets = Section::where('deleted_at',NULL)->get()->groupBy('custom_section_id');
		return view('cd-admin.custom_sections.view-custom-sections',compact('custom','widgets'));
	}
	public function addCustomSectionForm()
	{
		$allpage = Page::where('title','!=','Home')->get();
		$page = [];
		foreach($allpage as $key=>$p)
		{
			if(!strpos($p['description'],'[[[section[[[') && !strpos($p['description_np'],'[[[section[[['))
			{
				$page[$key] = $p;
			}
		}
		$post_category = PostsCategory::where('deleted_at',NULL)->where('status','active')->get();
		return view('cd-admin.custom_sections.add-custom-sections',compact('page','post_category'));
	}

	public function viewOneCustomSection($id)
	{
		$custom = CustomSections::find($id);
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
				}
				else
				{
					$finalSection[$key]['link'] = $s['links'];
					$finalSection[$key]['link_type'] = 'external';
				}
			}
			$language = 'en';
			return view('cd-admin.custom_sections.view-one-custom-section-page',compact('custom','finalSection','language'));
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
			$language = 'en';

			return view('cd-admin.custom_sections.view-one-custom-section-post',compact('custom','post','language'));
		}
		
	}

	public function addCustomSection()
	{
		$headline = Request()->headline;
		$links = Request()->links;
		$i= 0;
		$data = Request()->validate([
		    'title' => 'required',
		    'title_ne' => 'required',
		    'priority_no' => 'required',
		    'background_color' => '',
		    'content_type' => 'required',
		    ]);
		$home_page = Page::where('title','Home')->get()->first();
		if(Request()->content_type == 'page')
		{
			if($headline == NULL || $links == NULL )
			{
				Session::flash('danger');
				return redirect()->back();
			}
		}
		while($headline != NULL)
		{
			$a[$i]['headline'] = $headline[$i];
			$a[$i]['links'] = $links[$i];
			unset($headline[$i]);
			$i++;
		}
		$custom_section = new CustomSections();
		$custom_section->title = Request()->title;
		$custom_section->title_ne = Request()->title_ne;
		$custom_section->view_type = Request()->view_type;
		$custom_section->content_type = Request()->content_type;
		$custom_section->status = Request()->status;
		$custom_section->slug = str_slug(Request()->title,'-');
		$custom_section->background_color = Request()->background_color;
		$custom_section->priority_no = Request()->priority_no;
		if(Request()->content_type == 'post')
		{
			$custom_section->category_id = Request()->post_category;
		};
		$save = $custom_section->save();
		if(Request()->content_type == 'page' && $custom_section->save())
		{
			foreach($a as $w)
			{	
				$section = new Section();
				$section->custom_section_id = $custom_section['id'];
				$section->headline = $w['headline'];
				$section->links = $w['links'];
				$section->save();
			}
		}
		if($save)
		{
			$description = $home_page['description'].'[[[section[[[custom-'.$custom_section['id'].']]]section]]]';
			$description_np = $home_page['description_np'].'[[[section[[[custom-'.$custom_section['id'].']]]section]]]';
			$homepage = Page::where('title','Home')->get()->first();
			$homepage->description = $description;
			$homepage->description_np = $description_np;
			$homepage->save();
		}
		$notification = array(
			'message' => 'Custom Section Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-custom-section')->with($notification);
	}

	public function editCustomSectionForm($id)
	{
		$data = CustomSections::find($id);
		$links = Section::where('deleted_at',NULL)->where('custom_section_id',$id)->get();
		$allpage = Page::where('title','!=','Home')->get();
		$page = [];
		foreach($allpage as $key=>$p)
		{
			if(!strpos($p['description'],'[[[section[[[') && !strpos($p['description_np'],'[[[section[[['))
			{
				$page[$key] = $p;
			}
		}
		$post_category = PostsCategory::where('deleted_at',NULL)->where('status','active')->get();
		return view('cd-admin.custom_sections.edit-custom-sections',compact('data','links','page','post_category'));
	}

	public function editCustomSection($id)
	{
		$section_data = Section::where('custom_section_id',$id)->get();
		$title = Request()->title;
		$title_ne = Request()->title_ne;
		$headline = Request()->headline;
		$links = Request()->links;
		$data = Request()->validate([
		    'title' => 'required',
		    'title_ne' => 'required',
		    'priority_no' => 'required',
		    'background_color' => '',
		    'content_type' => 'required',
		    ]);
		$i= 0;
		if(Request()->content_type == 'page')
		{
			if($links == NULL)
			{
				Session::flash('danger');
				return redirect()->back();
			}
		}
		while($headline != NULL)
		{
			$a[$i]['headline'] = $headline[$i];
			$a[$i]['links'] = $links[$i];
			unset($headline[$i]);
			$i++;
		}
		$custom_section = CustomSections::find($id);
		$custom_section->title = Request()->title;
		$custom_section->title_ne = Request()->title_ne;
		$custom_section->view_type = Request()->view_type;
		$custom_section->content_type = Request()->content_type;
		$custom_section->status = Request()->status;
		$custom_section->priority_no = Request()->priority_no;
		$custom_section->slug = str_slug(Request()->title,'-');
		if(Request()->content_type == 'post')
		{
			$custom_section->category_id = Request()->post_category;
		};
		$custom_section->save();
		Section::where('custom_section_id',$id)->delete();
		if(Request()->content_type == 'page' && $custom_section->save())
		{
			foreach($a as $w)
			{	
				$section = new Section();
				$section->custom_section_id = $custom_section['id'];
				$section->headline = $w['headline'];
				$section->links = $w['links'];
				$section->save();
			}
		}
		$notification = array(
			'message' => 'Custom Section Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-custom-section')->with($notification);
	}

	public function deleteOneSection($id)
	{
		$section = Section::find($id);
		$section->headline = 'deleted__'.$section['headline'];
		$section->links = 'deleted__'.$section['links'];
		$section->deleted_at = Carbon::now('Asia/Kathmandu');
		$section->save();
		$notification = array(
			'message' => 'Section Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}

	public function sortCustomSection()
	{
		$section = CustomSections::where('deleted_at',NULL)->orderBy('priority_no','asc')->get();
		return view('cd-admin.custom_sections.sort-custom-section',compact('section'));
	}

	public function sortSection()
	{
		$request = Request()->all();
		$section = CustomSections::find($request['id']);
		$section->priority_no = $request['sorting'];
		if($section->save())
			$allsection = CustomSections::where('deleted_at',NULL)->orderBy('priority_no','asc')->get();
		$home_page = Page::where('title','Home')->get()->first();
		foreach($allsection as $key=>$s)
		{	
			$find[$key] = '[[[section[[[custom-'.$s['id'].']]]section]]]';
			$replace[$key] = '';	
		}
		$removed_description =  str_replace($find,$replace,$home_page['description']);
		$removed_description_np = str_replace($find,$replace,$home_page['description_np']);
		
		$final_description = str_replace('</p>','',$removed_description);
		$final_description_np = str_replace('</p>','',$removed_description_np);				
		foreach($allsection as $key=>$s)
		{	
			$final_description = $final_description.'[[[section[[[custom-'.$s['id'].']]]section]]]';
			$final_description_np = $final_description_np.'[[[section[[[custom-'.$s['id'].']]]section]]]';
		}
			$homepage = Page::where('title','Home')->get()->first();
			$homepage->description = $final_description;
			$homepage->description_np = $final_description_np;
			$homepage->save();
	}

	public function deleteCustomSection($id)
	{
		$data = CustomSections::find($id);
		$sections = Section::where('deleted_at',NULL)->where('custom_section_id',$id)->delete();
		$home_page = Page::where('title','Home')->get()->first();
		$find = '[[[section[[[custom-'.$id.']]]section]]]';
		$description =  str_replace($find,'',$home_page['description']);
		$description_np =  str_replace($find,'',$home_page['description_np']);
		$home_page->description = $description;
		$home_page->description_np = $description_np;
		$home_page->save();
		$data->delete();
		$notification = array(
			'message' => ' Custom Section Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}
}
