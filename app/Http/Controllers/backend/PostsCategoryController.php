<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PostsCategory;
use Carbon\Carbon;
class PostsCategoryController extends Controller
{
	public function addPostsCategoryForm()
	{
		return view('cd-admin.postscategory.add-posts-category');
	}


	public function viewPostsCategory()
	{
		$category = PostsCategory::where('deleted_at',NULL)->get();
		return view('cd-admin.postscategory.view-posts-category',compact('category'));
	}


	public function addPostsCategory()
	{
		$data = Request()->validate([
			'name' => 'required|max:200|unique:posts_categories',
			'name_ne' => 'required|max:200|unique:posts_categories',
			'status' => 'required',
		]);
		$category = new PostsCategory();
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->slug = str_slug($data['name'],'-');
		$category->save();
		$notification = array(
			'message' => 'Posts Category Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-posts-category')->with($notification);
	}

	public function editPostsCategory($id)
	{
		$data = Request()->validate([
			'name' => 'required|max:200',
			'name_ne' => 'required|max:200',
			'status' => 'required',
		]);
		$category = PostsCategory::find($id);
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->slug = str_slug($data['name'],'-');
		$category->save();
		$notification = array(
			'message' => 'Posts Category Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-posts-category')->with($notification);
	}

	public function deletePostsCategory($id)
	{
		$category = PostsCategory::find($id);
		$category->name = 'deleted__'.$category['name'];
		$category->name_ne = 'deleted__'.$category['name_ne'];
		$category->deleted_at = Carbon::now('Asia/Kathmandu');
		$category->save();
		$notification = array(
			'message' => 'Posts Category Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-posts-category')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = PostsCategory::find($id);
		if ($data['status'] == 'active') 
		{
			$a['status'] = 'inactive';
		}
		else
		{
			$a['status'] = 'active';
		}
		$data->status = $a['status'];
		$data->save();
		$notification = array(
			'message' => 'Status Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}
}
