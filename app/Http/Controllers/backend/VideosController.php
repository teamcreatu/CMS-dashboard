<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Videos;
use File;
use App\Photos;
use Carbon\Carbon;
use Validator;
class VideosController extends Controller
{
	public function addVideoForm()
	{
		return view('cd-admin.videos.add-videos');
	}
	public function viewVideo()
	{
		$video = Videos::where('deleted_at',NULL)->get();
		return view('cd-admin.videos.view-videos',compact('video'));
	}

	public function viewOneVideo($id)
	{
		$video = Videos::find($id);
		return view('cd-admin.videos.view-one-video',compact('video'));
	}

	public function searchVideo()
	{
		$data = Request()->searchterm;
		$video = Videos::where('tags','LIKE',"%".$data."%")->paginate(6);
		return view('cd-admin.videos.view-videos',compact('video','data'));
	}
	public function addVideo()
	{
		$data = Request()->validate([
			'title' => '',
			'video_name' => 'required|mimes:webm,3gp,mp4,m4r,m4v,avi,wmv,mov,webm,wmv,ogg',
		]);
		$video = new Videos();
		$file = $data['video_name'];
		$name_only = explode(".",$file->getClientOriginalName());
		$video_type = File::extension($file->getClientOriginalName());
		if(isset($data['title']))
		{
			$filename = time().$data['title'].'.'.$video_type;
			$video->video_title = $data['title'];
			$video->video_title_ne = $data['title'];
		}
		else
		{
			$filename = time().$file->getClientOriginalName();

			$video->video_title = $name_only[0];
			$video->video_title_ne = $name_only[0];
		}
		$destination = public_path('uploads/videos');
		$video->video_url = '/public/uploads/videos/'.$filename;
		$video->video_type = $video_type;
		$video->save();

		$file->move($destination,$filename);
		$notification = array(
			'message' => 'Video Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-videos')->with($notification);
	}
	public function deleteVideo()
	{
		$ids = Request()->checkbox;
		foreach($ids as $id)
		{
			$data = Videos::find($id);
			$data->video_title = 'deleted__'.$data['video_title'];
			$data->video_title_ne = 'deleted__'.$data['video_title_ne'];
			$data->deleted_at = Carbon::now('Asia/Kathmandu');
			$data->save();
		}
		$notification = array(
			'message' => 'Videos Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-videos')->with($notification);
	}

	// public function addVideoDynamic()
	// {
	// 	$data = Request()->validate([
	// 		'video_name' => 'required|mimes:webm,3gp,mp4,m4r,m4v,avi,wmv,mov,webm,wmv,ogg',
	// 	]);
	// 	$file = $data['video_name'];
	// 	$filename = time().$file->getClientOriginalName();
	// 	$video_type = File::extension($filename);
	// 	$destination = public_path('uploads/videos');
	// 	$file->move($destination,$filename);
	// 	$video = new Videos();
	// 	$video->video_url = '/public/uploads/videos/'.$filename;
	// 	$video->video_type = $video_type;
	// 	$video->save();
	// 	$notification = array(
	// 		'message' => 'Video Added Successfully',
	// 		'alert-type' => 'success',
	// 	);
	// 	return redirect()->back()->with($notification);
	// }


	


	public function addVideoDynamic(Request $request)
	{
		$validation = Validator::make($request->all(), [
			'select_file' => 'required|mimes:webm,3gp,mp4,m4r,m4v,avi,wmv,mov,webm,wmv,ogg'
		]);
		if($validation->passes())
		{
			$image = $request->file('select_file');
			$new_name = time().'.'.$image->getClientOriginalName();
			$image->move(public_path('uploads/videos'), $new_name);
			$photo = new Videos();
			$photo->video_type = File::extension($new_name);
			$photo->video_url = 'public/uploads/videos/'.$new_name;
			$photo->save();

			if($photo->save())
			{
				return response()->json([
					'message'   => 'Image Upload Successfully',
					'uploaded_image' => '<video width="250" height="200" controls>
					<source src="{{'.Request()->root().'/'.'public/uploads/videos/'.$new_name.'}}">
					</video>
					<div align="center">
					<span class="btn btn-success" onclick="writelink{{'.$photo->id.'}}()" data-dismiss="modal" style="margin:auto;">Select</span>
					<input type="hidden" name="link" id="image_link_modal{{'.$photo->id.'}}" value="{{'.$photo->video_url.'}}">
					</div>',
					'image_url' => 'public/uploads/videos/'.$new_name,
					'class_name'  => 'alert-success',
				]);
			}
			else
			{
				return response()->json([
					'message' => 'Image Upload Not Successful',
					'class_name' => 'alert-danger'
				]);
			}
		}
		else
		{
			return response()->json([
				'message'   => $validation->errors()->all(),
				'uploaded_image' => '',
				'class_name'  => 'alert-danger'
			]);
		}
	}


}
