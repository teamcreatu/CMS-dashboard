<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PageCategory;
use App\Page;
use DB;
use Carbon\Carbon;
use App\Photos;
class PageController extends Controller
{
    public function addPageCategory()
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$category = DB::table('page_categories')->get();
		return view('cd-admin.page-category.add-page-category',compact('category','photo'));
	}

	public function viewPageCategory()
	{
		$category = PageCategory::where('deleted_at',Null)->get()->all();
		return view('cd-admin.page-category.view-page-category',compact('category'));
	}

	public function editPageCategory($id)
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$category = DB::table('page_categories')->where('id',$id)->get()->first();
		$getCategory = DB::table('page_categories')->get();
		$category_name = DB::table('page_categories')->where('id',$category->parent_id)->get()->first();
		return view('cd-admin.page-category.edit-page-category',compact('getCategory','category','category_name','photo'));
	}
	public function insertPageCategory()
	{
		$data = Request()->validate([
			'name' => 'required',
			'title_ne' => 'required',
			'parent_category' => 'required',
			'status' => 'required',
			'image_name' => '',
		]);

		if($data['parent_category'] == 'NULL')
		{
			$a['parent_id'] = NULL;
		}
		else
		{
			$a['parent_id'] = $data['parent_category'];			
		}
		unset($data['parent_category']);
		$slug= $data['name'];
        $slug = mb_strtolower($slug, "UTF-8");;
        $slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
        $slug= preg_replace('/-+/', '-', $slug);
        $a['slug']=$slug;

        $slug= $data['title_ne'];
        $slug = mb_strtolower($slug, "UTF-8");;
        $slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
        $slug= preg_replace('/-+/', '-', $slug);
        $a['slug_ne']=$slug;
		$a['created_at'] = Carbon::now('Asia/Kathmandu');
		$a['image_url'] = $data['image_name'];
		unset($data['image_name']);
		$merge =array_merge($data,$a);
		DB::table('page_categories')->insert($merge);
		$notification = array(
			'message' => 'Page Category added successfully!',
			'alert-type' => 'success'
		);
		return redirect()->to('/cd-admin/view-all-pageCategory')->with($notification);
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
		return redirect()->to('/cd-admin/view-all-pageCategory')->with($notification);
	}

	public function updatePageCategory($id)
	{
		$data = Request()->validate([
			'name' => 'required',
			'title_ne' => 'required',
			'parent_category' => 'required',
			'status' => 'required',
			'image_name' => '',
		]);

		if($data['parent_category'] == 'NULL')
		{
			$a['parent_id'] = NULL;
		}
		else
		{
			$a['parent_id'] = $data['parent_category'];			
		}
		unset($data['parent_category']);

		$slug= $data['name'];
        $slug = mb_strtolower($slug, "UTF-8");;
        $slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
        $slug= preg_replace('/-+/', '-', $slug);
        $a['slug']=$slug;

        $slug= $data['title_ne'];
        $slug = mb_strtolower($slug, "UTF-8");;
        $slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
        $slug= preg_replace('/-+/', '-', $slug);
        $a['slug_ne']=$slug;
		$a['updated_at'] = Carbon::now('Asia/Kathmandu');

		$old = DB::table('page_categories')->where('id',$id)->get()->first();
		$a['image_url'] = $data['image_name'];
		unset($data['image_name']);
		$merge =array_merge($data,$a);

		DB::table('page_categories')->where('id',$id)->update($merge);
		$notification = array(
			'message' => 'Page Category updated successfully!',
			'alert-type' => 'success'
		);
		return redirect()->to('/cd-admin/view-all-pageCategory')->with($notification);
	}

	public function deletedPageCategory($id)
	{
		$test = DB::table('page_categories')->where('id',$id)->get()->first();
		$te['deleted_at'] = Carbon::parse('Asia/Kathmandu')->format('Y-m-d H:i:s');
		DB::table('page_categories')->where('id',$id)->update($te);
		$q = DB::table('page_categories')->where('parent_id',$id)->get();
		foreach($q as $child)
		{
			$this->deletedPageCategory($child->id);
		}
		$notification = array(
			'message' => 'Product Category deleted Successfully!',
			'alert-type' =>'success'
		);
		return redirect()->to('/cd-admin/view-all-pageCategory')->with($notification);
	}
}
