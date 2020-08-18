<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MembersCategory;
use Carbon\Carbon;
class MembersCategoryController extends Controller
{
	public function addMembersCategoryForm()
	{
		return view('cd-admin.membercategory.add-member-category');
	}

	public function viewMembersCategory()
	{
		$category = MembersCategory::where('deleted_at',NULL)->get();
		return view('cd-admin.membercategory.view-member-category',compact('category'));
	}
	public function addMembersCategory()
	{
		$data = Request()->validate([
			'name' => 'required|max:200|unique:members_categories',
			'name_ne' => 'required|max:200|unique:members_categories',
			'order_no' => 'required',
			'status' => 'required',
		]);
		$category = new MembersCategory();
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->order_no = $data['order_no'];
		$category->save();
		$notification = array(
			'message' => 'Members Category Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-members-category')->with($notification);
	}

	public function editMembersCategory($id)
	{
		$data = Request()->validate([
			'name' => 'required|max:200',
			'name_ne' => 'required|max:200',
			'order_no' => 'required',
			'status' => 'required',
		]);
		$category = MembersCategory::find($id);
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->order_no = $data['order_no'];
		$category->save();
		$notification = array(
			'message' => 'Members Category Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-members-category')->with($notification);
	}

	public function deleteMembersCategory($id)
	{
		$category = MembersCategory::find($id);
		$category->name = 'deleted__'.$category['name'];
		$category->name_ne = 'deleted__'.$category['name_ne'];
		$category->deleted_at = Carbon::now('Asia/Kathmandu');
		$category->save();
		$notification = array(
			'message' => 'Members Category Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-members-category')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = MembersCategory::find($id);
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
