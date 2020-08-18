<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResourceCategory;
use Carbon\Carbon;
class ResourceCategoryController extends Controller
{
	public function addResourceCategoryForm()
	{
		return view('cd-admin.resource-category.add-resource-category');
	}

	public function viewResourceCategory()
	{
		$category = ResourceCategory::where('deleted_at',NULL)->paginate(15);
		return view('cd-admin.resource-category.view-resource-category',compact('category'));
	}

	public function editResourceCategoryForm()
	{
		return view('cd-admin.resource-category.edit-resource-category');
	}

	public function addResourceCategory()
	{
		$data = Request()->validate([
			'name' => 'required|max:200|unique:resource_categories',
			'name_ne' => 'required|max:200|unique:resource_categories',
			'status' => 'required',
		]);
		$category = new ResourceCategory();
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->slug = str_slug($data['name'],'-');
		$category->save();
		$notification = array(
			'message' => 'Resource Category Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-resource-category')->with($notification);
	}

	public function editResourceCategory($id)
	{
		$data = Request()->validate([
			'name' => 'required|max:200',
			'name_ne' => 'required|max:200',
			'status' => 'required',
		]);
		$category = ResourceCategory::find($id);
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->slug = str_slug($data['name'],'-');
		$category->save();
		$notification = array(
			'message' => 'Resource Category Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-resource-category')->with($notification);
	}

	public function deleteResourceCategory($id)
	{
		$category = ResourceCategory::find($id);
		$category->name = 'deleted__'.$category['name'];
		$category->name_ne = 'deleted__'.$category['name_ne'];
		$category->deleted_at = Carbon::now('Asia/Kathmandu');
		$category->save();
		$notification = array(
			'message' => 'Resource Category Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-resource-category')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = ResourceCategory::find($id);
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
