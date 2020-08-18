<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\EventsCategory;
class EventsCategoryController extends Controller
{
    public function addEventsCategoryForm()
	{
		return view('cd-admin.eventscategory.add-events-category');
	}


	public function viewEventsCategory()
	{
		$category = EventsCategory::where('deleted_at',NULL)->get();
		return view('cd-admin.eventscategory.view-events-category',compact('category'));
	}


	public function addEventsCategory()
	{
		$data = Request()->validate([
			'name' => 'required|max:200|unique:events_categories',
			'name_ne' => 'required|max:200|unique:events_categories',
			'status' => 'required',
		]);
		$category = new EventsCategory();
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->slug = str_slug($data['name'],'-');

		$category->save();
		$notification = array(
			'message' => 'Events Category Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-events-category')->with($notification);
	}

	public function editEventsCategory($id)
	{
		$data = Request()->validate([
			'name' => 'required|max:200',
			'name_ne' => 'required|max:200',
			'status' => 'required',
		]);
		$category = EventsCategory::find($id);
		$category->name = $data['name'];
		$category->name_ne = $data['name_ne'];
		$category->status = $data['status'];
		$category->slug = str_slug($data['name'],'-');
		$category->save();
		$notification = array(
			'message' => 'Events Category Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-events-category')->with($notification);
	}

	public function deleteEventsCategory($id)
	{
		$category = EventsCategory::find($id);
		$category->name = 'deleted__'.$category['name'];
		$category->name_ne = 'deleted__'.$category['name_ne'];
		$category->deleted_at = Carbon::now('Asia/Kathmandu');
		$category->save();
		$notification = array(
			'message' => 'Events Category Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-events-category')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = EventsCategory::find($id);
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
