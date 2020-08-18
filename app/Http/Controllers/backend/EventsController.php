<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events;
use App\EventsCategory;
use App\Photos;
use DB;
use Carbon\Carbon;
class EventsController extends Controller
{
	public function addEventsForm()
	{	
		$photo = Photos::where('deleted_at',NULL)->get();
		$category = EventsCategory::where('status','active')->where('deleted_at',NULL)->get();
		return view('cd-admin.events.add-events',compact('category','photo'));
	}

	public function viewEvents()
	{
		$events = Events::where('deleted_at',NULL)->get();
		$category = EventsCategory::get();
		return view('cd-admin.events.view-events',compact('events','category'));	
	}

	public function viewOneEvent($id)
	{
		$data = Events::find($id);
		return view('cd-admin.events.view-one-event',compact('data'));
	}

	public function editEventsForm($id)
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$category = EventsCategory::where('status','active')->where('deleted_at',NULL)->get();
		$data = Events::find($id);
		return view('cd-admin.events.edit-events',compact('data','category','photo'));
	}

	public function addEvents()
	{
		$data = Request()->validate([
			'category' => 'required',
			'title' => 'required|max:200|unique:events',
			'description' => 'required',
			'event_date' => 'required|date',
			'image_name' => '',
			'status' => 'required',
			'title_ne' => 'required|max:200|unique:events',
			'description_ne' => 'required',
		]);
		$event = new Events();
		$event->category_id = $data['category'];
		$event->title = $data['title'];
		$event->description = $data['description'];
		$event->title_ne = $data['title_ne'];
		$event->description_ne = $data['description_ne'];
		$event->event_date = $data['event_date'];
		$event->image_url = $data['image_name'];
		$event->status = $data['status'];
		$event->slug = str_slug($data['title'],'-');
		$event->save();
		$notification = array(
			'message' => 'Event Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-events')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = Events::find($id);
		if ($data['status'] == 'active') 
		{
			$a['status'] = 'inactive';
		}
		else
		{
			$a['status'] = 'active';
		}
		DB::table('events')->where('id',$id)->update($a);
		$notification = array(
			'message' => 'Status Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}

	public function editEvents($id)
	{
		$data = Request()->validate([
			'category' => 'required',
			'title' => 'required|max:200',
			'description' => 'required',
			'event_date' => 'required|date',
			'image_name' => '',
			'status' => 'required',
			'title_ne' => 'required|max:200',
			'description_ne' => 'required',
		]);
		$event =  Events::find($id);
		$event->category_id = $data['category'];
		$event->title = $data['title'];
		$event->description = $data['description'];
		$event->title_ne = $data['title_ne'];
		$event->description_ne = $data['description_ne'];
		$event->event_date = $data['event_date'];
		$event->image_url = $data['image_name'];
		$event->status = $data['status'];
		$event->slug = str_slug($data['title'],'-');
		$event->save();
		$notification = array(
			'message' => 'Event Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-events')->with($notification);
	}

	public function deleteEvents($id)
	{
		$data = Events::find($id);
		$data->title = 'deleted__'.$data['title'];
		$data->title_ne = 'deleted__'.$data['title_ne'];
		$data->deleted_at = Carbon::now('Asia/Kathmandu');
		$data->save();
		$notification = array(
			'message' => 'Event Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-events')->with($notification);
	}

}
