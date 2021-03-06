<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Photos;
use DB;
use Carbon\Carbon;
use Validator;
use Image;
use App\TemporaryImages;
class PhotosController extends Controller
{
	public function addPhotoForm()
	{
		return view('cd-admin.photos.add-photo-form');
	}

	// public function editPhotoForm($id)
	// {
	// 	$data = Photos::find($id);
	// 	return view('cd-admin.photos.edit-photo-form',compact('data'));
	// }
	public function viewPhotos()
	{
		$photos = Photos::where('deleted_at',NULL)->paginate(8);
		return view('cd-admin.photos.view-photos',compact('photos'));
	}

	public function search()
	{
		$data = Request()->searchterm;
		$photos = Photos::where('tags','LIKE',"%".$data."%")->paginate(8);
		return view('cd-admin.photos.view-photos',compact('photos','data'));
	}
	public function addPhoto()
	{
		$data = Request()->validate([
			'image_name' => 'required',
			'image_name.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
		]);	
		foreach($data['image_name'] as $image)
		{
			$photo = new Photos();
			$file = $image;
			$photo->image_title = $file->getClientOriginalName();
			$photo->image_title_ne = $file->getClientOriginalName();
			$image_type = File::extension($file->getClientOriginalName());
			$filename = time().str_slug($file->getClientOriginalName()).'.'.$image_type;
			$destination = public_path('uploads/photos');
			$destinationPath = public_path('/thumbnail/'.$filename);
			$img = Image::make($file->getRealPath());
			$dimensions = getimagesize($file);
			$width = $dimensions[0] / 4;
			$height= $dimensions[1] / 4;
			$img->resize($width, $height)->save($destinationPath);
			$file->move($destination,$filename);
			$photo->thumb_image = 'public/thumbnail/'.$new_name;
			$photo->image_url = 'public/uploads/photos/'.$filename;
			$photo->save();
		}
		$notification = array(
			'message' => 'Photo Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-photos')->with($notification);
	}

	public function deletePhoto()
	{
		$ids = Request()->checkbox;
		foreach($ids as $id)
		{
			$data = Photos::find($id);
			$data->deleted_at = Carbon::now('Asia/Kathmandu');
			$data->save();
		}
		$notification = array(
			'message' => 'Photo Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-photos')->with($notification);
	}

	// public function addPhotoDynamic()
	// {
	// 	$data = Request()->validate([
	// 		'image_name' => 'required|mimes:jpeg,jpg,png,gif|image',
	// 	]);	
	// 	$file = $data['image_name'];
	// 	$filename = time().$file->getClientOriginalName();
	// 	$image_type = File::extension($filename);
	// 	$destination = public_path('uploads/photos');
	// 	$file->move($destination,$filename);
	// 	$photo = new Photos();
	// 	$photo->image_url ='public/uploads/photos/'.$filename;
	// 	$photo->save();
	// 	$notification = array(
	// 		'message' => 'Photo Added Successfully',
	// 		'alert-type' => 'success',
	// 	);
	// 	return redirect()->back()->with($notification);
	// }

	public function addPhotoDynamic(Request $request)
	{
		$validation = Validator::make($request->all(), [
			'select_file' => 'required|image|mimes:jpeg,png,jpg,gif'
		]);
		if($validation->passes())
		{
			$photo = new Photos();
			$file = $request->file('select_file');
			$image_type = File::extension($file->getClientOriginalName());
			$new_name = time().'.'.str_slug($file->getClientOriginalName()).'.'.$image_type;
			$destinationPath = public_path('/thumbnail/'.$new_name);
			$img = Image::make($file->getRealPath());
			$dimensions = getimagesize($file);
			$width= $dimensions[0] / 4;
			$height= $dimensions[1] / 4;
			$img->resize($width, $height)->save($destinationPath);
			$photo->thumb_image = 'public/thumbnail/'.$new_name;
			$file->move(public_path('uploads/photos'), $new_name);
			$photo->image_title_ne = $file->getClientOriginalName();
			$photo->image_title = $file->getClientOriginalName();
			$photo->image_url = 'public/uploads/photos/'.$new_name;
			$photo->save();
			if($photo->save())
			{
				return response()->json([
					'message'   => 'Image Upload Successfully',
					'uploaded_image' => '<img src="'.Request()->root().'/public/uploads/photos/'.$new_name.'"  height="150px" width="200px" style="border: dotted; margin:auto;" onclick="writesidelogolink{{'.$photo->id.'}}()" data-dismiss="modal" width="300" />
					<input type="hidden" name="link" id="image_link_modal{{'.$photo->id.'}}" value="{{'.$photo->image_url.'}}">',
					'image_url' => 'public/uploads/photos/'.$new_name,
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

	function upload(Request $request)
	{
		$file = $request->file('file');
		$photo = new Photos();
		$image_type = File::extension($file->getClientOriginalName());
		$imageName = time() . '.' . str_slug($file->getClientOriginalName()).'.'.$image_type;
		$file->move(public_path('uploads/photos'), $imageName);
		$photo->image_title_ne = $file->getClientOriginalName();
		$photo->image_title = $file->getClientOriginalName();
		$photo->image_url = 'public/uploads/photos/'.$imageName;
		$photo->save();
		$temp = new TemporaryImages();
		$temp->name = $photo['image_title'];
		$temp->image_url = $photo['image_url'];
		$temp->save();
		return response()->json([
			'success' => $imageName,
		]);
	}

	function fetch()
	{
		$images = TemporaryImages::get();
		$output = '<div class="row">';
		$finalurl = '';
		foreach($images as $key=>$image)
		{
			if($key== 0)
			{
				$finalurl .= $image['image_url'];
			}
			else
			{
				$finalurl .= ','.$image['image_url'];
			}
			$output .= '
			<div class="col-md-2" style="margin-bottom:16px;" align="center">
			<img src="'.Request()->root().'/'.$image['image_url'].'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
			<button type="button" class="btn btn-link remove_image" id="'.$image['image_url'].'">Remove</button>
			</div>
			';
		}
		$output .= '</div>';
		return response()->json([
			'output' => $output,
			'url' => $finalurl,
		]);
	}

	function delete(Request $request)
	{
		if($request->get('name'))
		{
			$image = Photos::where('deleted_at',NULL)->where('image_url',$request->get('name'))->get()->first();
			$new = TemporaryImages::where('image_url',$request->get('name'))->delete();
			if(isset($image->image_url))
			{
				unlink($image->image_url);
			}
			$image = Photos::where('deleted_at',NULL)->where('image_url',$request->get('name'))->delete();
		}
	}

	function remove()
	{
		TemporaryImages::all()->delete();
	}
}
