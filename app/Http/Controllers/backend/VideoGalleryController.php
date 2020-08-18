<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Videos;
use App\VideoGallery;
use Carbon\Carbon;
class VideoGalleryController extends Controller
{
	public function addVideoGalleryForm()
	{
		$video = Videos::where('deleted_at',NULL)->get();
		return view('cd-admin.videogallery.add-video-gallery',compact('video'));
	}

	public function viewVideoGallery()
	{
		$video = VideoGallery::where('deleted_at',NULL)->get();
		return view('cd-admin.videogallery.view-video-gallery',compact('video'));
	}
	public function editVideoGalleryForm($id)
	{
		$data = VideoGallery::find($id);
		$video = Videos::where('deleted_at',NULL)->get();
		return view('cd-admin.videogallery.edit-video-gallery',compact('video','data'));
	}
	public function addVideoGallery()
	{
		$data = Request()->validate([
			'title' => 'required|max:200|unique:video_galleries',
			'title_ne' => 'required|max:200|unique:video_galleries',
			'video_name' => 'required',
			'status' => 'required',
		]);
		$gallery = new VideoGallery();
		$gallery->title = $data['title'];
		$gallery->title_ne = $data['title_ne'];
		$gallery->video_url = $data['video_name'];
		$gallery->status = $data['status'];
		$gallery->slug = str_slug($data['title'],'-');
		$gallery->save();
		$notification = array(
			'message' => 'Video Gallery Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-video-gallery')->with($notification);
	}

	public function viewOneVideoGallery($id)
	{
		$video = VideoGallery::find($id);
		return view('cd-admin.videogallery.view-one-video',compact('video'));
	}

	public function updateStatus($id)
	{
		$data = VideoGallery::find($id);
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

	public function editVideoGallery($id)
	{
		$gallery = VideoGallery::find($id);
		$data = Request()->validate([
			'title' => 'required|max:200',
			'title_ne' => 'required|max:200',
			'video_name' => '',
			'status' => 'required',
		]);
		if(isset($data['video_name']))
		{
		$gallery->video_url = $data['video_name'];
		}
		$gallery->title = $data['title'];
		$gallery->title_ne = $data['title_ne'];
		$gallery->status = $data['status'];
		$gallery->slug = str_slug($data['title'],'-');
		$gallery->save();
		$notification = array(
			'message' => 'Video Gallery Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-video-gallery')->with($notification);
	}

	public function deleteVideoGallery($id)
	{
		$data = VideoGallery::find($id);
		$data->title = 'deleted__'.$data['title'];
		$data->title_ne = 'deleted__'.$data['title_ne'];
		$data->deleted_at = Carbon::now('Asia/Kathmandu');
		$data->save();
		$notification = array(
			'message' => 'Video Gallery Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-video-gallery')->with($notification);
	}
}
