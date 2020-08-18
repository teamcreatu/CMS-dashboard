<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PageCategory;
use App\Page;
use DB;
use Carbon\Carbon;
use App\Members;
use App\MembersCategory;
use App\ResourceCategory;
use App\Photos;
use App\DefaultSection;
use App\User;
use Auth;
use App\CustomSections;
use App\Files;
use App\Videos;
use Bsdate;
class PageDetailController extends Controller
{
	public function addPageDetail()
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$members = Members::where('deleted_at',NULL)->where('status','active')->get();
		$member_category = MembersCategory::where('deleted_at',NULL)->where('status','active')->get();
		$resource_category = ResourceCategory::where('deleted_at',NULL)->where('status','active')->get();
		$category = DB::table('page_categories')->where('deleted_at',NULL)->get();
		$default_page = DefaultSection::get();
		$file = Files::where('deleted_at',NULL)->get();
		$video = Videos::where('deleted_at',NULL)->get();
		$custom_sections = CustomSections::where('deleted_at',NULL)->where('status','active')->get();
		return view('cd-admin.page.add-page',compact('photo','category','members','member_category','member_category','resource_category','default_page','custom_sections','file','video'));
	}

	public function viewPageDetail()
	{
		$page = Page::get()->all();
		$users = User::get();
		$category = PageCategory::where('status','active')->where('deleted_at',NULL)->get();
		return view('cd-admin.page.view-page',compact('page','category','users'));
	}

	public function editPageDetail($id)
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$members = Members::where('deleted_at',NULL)->where('status','active')->get();
		$member_category = MembersCategory::where('deleted_at',NULL)->where('status','active')->get();
		$page = Page::find($id);
		$resource_category = ResourceCategory::where('deleted_at',NULL)->where('status','active')->get();
		$default_page = DefaultSection::get();
		$file = Files::where('deleted_at',NULL)->get();
		$photo = Photos::where('deleted_at',NULL)->get();
		$video = Videos::where('deleted_at',NULL)->get();
		$custom_sections = CustomSections::where('deleted_at',NULL)->where('status','active')->get();
		return view('cd-admin.page.edit-page',compact('page','member_category','members','resource_category','photo','default_page','custom_sections','file','video'));
	}
	public function insertPageDetail()
	{
		$data = Request()->validate([
			'title' => 'required|unique:pages',
			'title_ne' => 'required|unique:pages',
			'description' => 'required',
			'same_content' => '',
			'description_np' => '',
			'page_template' => '',
			'tags' => '',
			'published_date' => 'required',
			'url' => 'required|unique:pages,slug',
		]);
		if(!isset($data['same_content']))
		{
			Request()->validate([
				'description_np' => 'required',
			]);
			$a['description_np'] = scriptStripper(html_entity_decode($data['description_np']));
		}
		else
		{
			$a['description_np'] = $data['description'];
		}
		$a['slug']=$data['url'];
		$a['slug_ne'] = $data['url'];
		$a['created_at_nep'] = $data['published_date'];
		$nep_date = explode('-',$data['published_date']);
		$change = Bsdate::nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
		$a['created_at'] = $change['year'].'-'.$change['month'].'-'.$change['date'];
		$a['description'] = scriptStripper(html_entity_decode($data['description']));
		unset($data['page_template']);
		unset($data['published_date']);
		unset($data['url']);
		unset($data['description']);
		unset($data['description_np']);
		unset($data['same_content']);
		$a['created_by'] = Auth::user()->id;
		$merge =array_merge($data,$a);
		DB::table('pages')->insert($merge);
		$notification = array(
			'message' => 'Page Detail added successfully!',
			'alert-type' => 'success'
		);

		return redirect()->to('/cd-admin/view-all-pageDetail')->with($notification);
	}

	public function updatePageStatus($id)
	{
		$data = DB::table('page_categories')->where('id',$id)->get()->first();
		if ($data->status == 'active') 
		{
			$a['status'] = 'inactive';
		}
		else
		{
			$a['status'] = 'active';
		}
		DB::table('page_categories')->where('id',$id)->update($a);
		$notification = array(
			'message' => 'Status Changed Successfully!',
			'alert-type' => 'info'
		);
		return redirect()->to('/cd-admin/view-all-pageDetail')->with($notification);
	}

	public function updatePageDetail($id)
	{
		$data = Request()->validate([
			'title' => 'required|unique:pages,title,'.$id,
			'title_ne' => 'required|unique:pages,title_ne,'.$id,
			'description' => 'required',
			'description_np' => '',
			'page_template' => '',
			'tags' => '',
			'published_date' => 'required',
			'url' => 'required|unique:pages,slug,'.$id,
			'same_content' => '',
		]);
		$page = Page::find($id);
		if(!isset($data['same_content']))
		{
			Request()->validate([
				'description_np' => 'required',
			]);
			$a['description_np'] = scriptStripper(html_entity_decode($data['description_np']));
		}
		else
		{
			$a['description_np'] = $data['description'];
		}
		if($page->title == 'Home')
		{
			unset($data['title']);
			unset($data['title_ne']);
		}
		$a['slug']=$data['url'];
		$a['slug_ne']=$data['url'];
		$a['updated_at'] = Carbon::now('Asia/Kathmandu');
		$a['updated_by'] = Auth::user()->id;
		$old = DB::table('pages')->where('id',$id)->get()->first();
		$a['created_at_nep'] = $data['published_date'];
		$nep_date = explode('-',$data['published_date']);
		$change = Bsdate::nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
		$a['created_at'] = $change['year'].'-'.$change['month'].'-'.$change['date'];
		$a['description'] = scriptStripper(html_entity_decode($data['description']));
		unset($data['published_date']);
		unset($data['url']);
		unset($data['description']);
		unset($data['description_np']);
		unset($data['same_content']);
		$a['created_by'] = Auth::user()->id;
		$merge =array_merge($data,$a);
		DB::table('pages')->where('id',$id)->update($merge);
		$notification = array(
			'message' => 'Page Detail updated successfully!',
			'alert-type' => 'success'
		);
		return redirect()->to('/cd-admin/view-all-pageDetail')->with($notification);
	}

	public function deletedPageDetail($id)
	{
		$test = DB::table('pages')->where('id',$id)->delete();
		$notification = array(
			'message' => 'Product Detail deleted Successfully!',
			'alert-type' =>'success'
		);
		return redirect()->to('/cd-admin/view-all-pageDetail')->with($notification);
	}

	public function viewOnePage($id)
	{
		$data = Page::find($id);
		return view('cd-admin.page.view-one-page',compact('data'));
	}
}
