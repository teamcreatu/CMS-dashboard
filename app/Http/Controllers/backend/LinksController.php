<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use App\Links;
use Carbon\Carbon;
class LinksController extends Controller
{
	public function viewLinks()
	{
		$links = Links::where('deleted_at',NULL)->get();
		$links_category = Links::where('parent_id',0)->get();
		return view('cd-admin.links.view-links',compact('links','links_category'));
	}
	public function addLinksForm()
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$links_category = Links::where('parent_id',0)->get();
		return view('cd-admin.links.add-links',compact('photo','links_category'));
	}

	public function editLinksForm($id)
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$data = Links::find($id);
		return view('cd-admin.links.edit-links',compact('photo','data'));
	}

	public function addLinks()
	{
		$data = Request()->validate([
			'title' => 'required|max:200',
			'title_ne' => 'required|max:200',
			// 'image_name' => '',
			'link_url' => '',
			'priority_no' => 'required',
			'links_category' => 'required',
			'status' => 'required',
		]);
		$link = new Links();
		$link->title = $data['title'];
		$link->title_ne = $data['title_ne'];
		$link->link_url = $data['link_url'];
		if($data['links_category'] == 'parent')
		{
			$link->parent_id = 0;
		}
		else
		{
			$link->parent_id = $data['links_category'];
		}
		$link->priority_no = $data['priority_no'];
		$link->status = $data['status'];
		$link->save();
		$notification = array(
			'message' => 'Link Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-links')->with($notification);
	}


	public function editLinks($id)
	{
		$data = Request()->validate([
			'title' => 'required|max:200',
			'title_ne' => 'required|max:200',
			'priority_no' => 'required',
			'link_url' => '',
			'status' => 'required',
			'links_category' => 'required',
		]);

		$link = Links::find($id);
		$link->title = $data['title'];
		if($data['links_category'] == 'parent')
		{
			$link->parent_id = 0;
		}
		else
		{
			$link->parent_id = $data['links_category'];
		}
		$link->title_ne = $data['title_ne'];
		$link->priority_no = $data['priority_no'];
		$link->link_url = $data['link_url'];
		$link->status = $data['status'];
		$link->save();
		$notification = array(
			'message' => 'Link Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-links')->with($notification);
	}

	public function deleteLinks($id)
	{
		$link = Links::find($id);
		$link->title = 'deleted__'.$link['title'];
		$link->title_ne = 'deleted__'.$link['title_ne'];
		$link->deleted_at = Carbon::now('Asia/Kathmandu');
		$link->save();
		$notification = array(
			'message' => 'Link Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-links')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = Links::find($id);
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
