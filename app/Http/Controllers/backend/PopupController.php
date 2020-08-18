<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Popup;
use Carbon\Carbon;
use App\Videos;
use App\Files;
use App\Photos;
use DB;
class PopupController extends Controller
{
	public function addPopupForm()
	{
		$file = Files::where('deleted_at',NULL)->get();
		$photo = Photos::where('deleted_at',NULL)->get();
		$video = Videos::where('deleted_at',NULL)->get();
		return view('cd-admin.popup.add-popup',compact('file','photo','video'));
	}

	public function addPopup()
	{
		$data = Request()->validate([
			'title' => 'required',
			'title_ne' => 'required',
			'description' => 'required',
			'description_ne' => 'required',
			'status' => 'required',
			'published_date' => '',
		]);
		$popup = new Popup();
		$popup->status = $data['status'];
		$popup->title = $data['title'];
		$popup->title_ne = $data['title_ne'];
		$popup->description = scriptStripper(html_entity_decode($data['description']));
		$popup->description_ne = scriptStripper(html_entity_decode($data['description_ne']));
		if(isset($data['published_date']))
		{
			$popup->created_at = Carbon::parse($data['published_date'])->format('Y-m-d h:m:s');
		}
		$popup->save();
		$notification = array(
			'message' => 'Popup Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-popup')->with($notification);
	}

	public function viewPopup()
	{
		$popup = Popup::where('deleted_at',NULL)->get();
		return view('cd-admin.popup.view-popup',compact('popup'));
	}
	public function editPopupForm($id)
	{
		$data = Popup::find($id);
		$file = Files::where('deleted_at',NULL)->get();
		$photo = Photos::where('deleted_at',NULL)->get();
		$video = Videos::where('deleted_at',NULL)->get();
		return view('cd-admin.popup.edit-popup',compact('data','file','photo','video'));
	}

	public function editPopup($id)
	{
		$popup = Popup::find($id);
		$data = Request()->validate([
			'title' => 'required',
			'title_ne' => 'required',
			'description' => 'required',
			'description_ne' => 'required',
			'status' => 'required',
			'published_date' => '',
		]);
		$popup->status = $data['status'];
		$popup->title = $data['title'];
		$popup->title_ne = $data['title_ne'];
		$popup->description = scriptStripper(html_entity_decode($data['description']));
		$popup->description_ne = scriptStripper(html_entity_decode($data['description_ne']));
		if(isset($data['published_date']))
		{
			$popup->created_at = Carbon::parse($data['published_date'])->format('Y-m-d h:m:s');
		}
		$popup->save();
		$notification = array(
			'message' => 'Popup Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-popup')->with($notification);
	}

	public function deletePopup($id)
	{
		$popup = Popup::find($id);
		$popup->deleted_at = Carbon::now('Asia/Kathmandu');
		$popup->save();
		$notification = array(
			'message' => 'Popup Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-popup')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = Popup::find($id);
		if ($data['status'] == 'active') 
		{
			$a['status'] = 'inactive';
		}
		else
		{
			$a['status'] = 'active';
		}
		DB::table('popups')->where('id',$id)->update($a);
		$notification = array(
			'message' => 'Status Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}

}
