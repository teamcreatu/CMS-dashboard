<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LinksCategory;
use Carbon\Carbon;
class LinksCategoryController extends Controller
{
    
	public function addLinksCategoryForm()
	{
		return view('cd-admin.link_category.add-links-category');
	}

	public function viewLinksCategory()
	{
		$category = LinksCategory::where('deleted_at',NULL)->get();
		return view('cd-admin.link_category.view-links-category',compact('category'));
	}
	public function addLinksCategory()
	{
		$data = Request()->validate([
			'name' => 'required|max:200|unique:members_categories',
			'name_ne' => 'required|max:200|unique:members_categories',
			'status' => 'required',
		]);
		$category = new LinksCategory();
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->save();
		$notification = array(
			'message' => 'Links Category Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-links-category')->with($notification);
	}

	public function editLinksCategory($id)
	{
		$data = Request()->validate([
			'name' => 'required|max:200',
			'name_ne' => 'required|max:200',
			'status' => 'required',
		]);
		$category = LinksCategory::find($id);
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->save();
		$notification = array(
			'message' => 'Links Category Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-links-category')->with($notification);
	}

	public function deleteLinksCategory($id)
	{
		$category = LinksCategory::find($id);
		$category->deleted_at = Carbon::now('Asia/Kathmandu');
		$category->save();
		$notification = array(
			'message' => 'Links Category Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-links-category')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = LinksCategory::find($id);
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
