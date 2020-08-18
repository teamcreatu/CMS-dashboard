<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use App\PhotoGallery;
use Carbon\Carbon;
use App\TemporaryImages;
class PhotoGalleryController extends Controller
{
	public function addPhotoGalleryForm()
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		TemporaryImages::truncate();
		return view('cd-admin.photogallery.add-photo',compact('photo'));
	}

	public function viewPhotoGallery()
	{
		$photo = PhotoGallery::where('deleted_at',NULL)->paginate('6');
		return view('cd-admin.photogallery.view-photo',compact('photo'));
	}

	public function editPhotoGalleryForm($id)
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		$data = PhotoGallery::find($id);
		TemporaryImages::truncate();
		return view('cd-admin.photogallery.edit-photo',compact('photo','data'));
	}
	public function addPhotoGallery()
	{
		$data = Request()->validate([
			'title' => 'required|max:200|unique:photo_galleries',
			'title_ne' => 'required|max:200|unique:photo_galleries',
			'image_name' => 'required',
			'image_names' => 'required',
			'status' => 'required',
		]);
		$first = explode(',',$data['image_names']);
		$second = array_unique($first);
		$final = '';
		foreach($second as $s)
		{
			if($final == '')
			{
				$final = $final.$s;
			}
			else
			{
				$final = $final.','.$s;
			}
		}
		$gallery = new PhotoGallery();
		$gallery->title = $data['title'];
		$gallery->title_ne = $data['title_ne'];
		$gallery->image_url = $data['image_name'];
		$gallery->image_urls = $final;
		$gallery->status = $data['status'];
		$gallery->slug = str_slug($data['title'],'-');
		$gallery->save();
		$notification = array(
			'message' => 'Photo Gallery Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-photo-gallery')->with($notification);
	}

	public function viewOnePhotoGallery($id)
	{
		$data = PhotoGallery::find($id);
		$allPhoto = $data['image_urls'];
		$finalphoto = explode(',',$allPhoto);
		return view('cd-admin.photogallery.view-one-photo-gallery',compact('data','finalphoto'));
	}

	public function deletePhotoGallery($id)
	{
		$data = PhotoGallery::find($id);
		$data->title = 'deleted__'.$data['title'];
		$data->title_ne = 'deleted__'.$data['title_ne'];
		$data->deleted_at = Carbon::now('Asia/Kathmandu');
		$data->save();
		$notification = array(
			'message' => 'Photo Gallery Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-photo-gallery')->with($notification);
	}

	public function editPhotoGallery($id)
	{
		$data =Request()->validate([
			'title' => 'required|max:200',
			'title_ne' => 'required|max:200',
			'image_name' => 'required',
			'image_names' => '',
			'status' => 'required',
		]);
		$first = explode(',',$data['image_names']);
		$second = array_unique($first);
		$gallery = PhotoGallery::find($id);
		$final = '';
		if(isset($data['image_names']))
		{
			foreach($second as $s)
			{
				if($final == '')
				{
					$final = $final.$s;
				}
				else
				{
					$final = $final.','.$s;
				}
			}
			$gallery->image_urls = $final;
		}
		$gallery->title = $data['title'];
		$gallery->title_ne = $data['title_ne'];
		$gallery->image_url = $data['image_name'];
		$gallery->status = $data['status'];
		$gallery->slug = str_slug($data['title'],'-');
		$gallery->save();
		$notification = array(
			'message' => 'Photo Gallery Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-one-photo-gallery',$id)->with($notification);
	}

	public function AddAnotherPhotoForm($id)
	{
		$data = PhotoGallery::find($id);
		$photo = Photos::where('deleted_at',NULL)->get();
		return view('cd-admin.photogallery.add-photo-to-gallery',compact('data','photo'));
	}

	public function AddAnotherPhoto($id)
	{
		$data =Request()->validate([
			'image_names' => 'required',
		]);
		$gallery = PhotoGallery::find($id);
		$first = explode(',',$gallery['image_urls']);
		$testfirst = explode(',',$data['image_names']);
		$test = array_unique(array_merge($testfirst,$first));
		$final = '';
		foreach($test as $t)
		{
			if($final == '')
			{
				$final = $final.$t;
			}
			else
			{
				$final = $final.','.$t;
			}
		}
		$gallery->image_urls = $final;
		$gallery->save();
		$notification = array(
			'message' => 'New Photo Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-one-photo-gallery',$id)->with($notification);
	}

	public function deleteOnePhotoFromGallery($id)
	{
		$gallery = PhotoGallery::find($id);
		$image = Request()->image;
		$data = PhotoGallery::find($id);
		$test = explode(',',$data['image_urls']);
		
		foreach($test as $key=>$t)
		{
			if($image != $t)
			{
				$testfinal[$key] = $t;
			} 
		}
		$final = '';
		foreach($testfinal as $t)
		{
			if($final == '')
			{
				$final = $final.$t;
			}
			else
			{
				$final = $final.','.$t;
			}
		}
		$gallery->image_urls = $final;
		$gallery->save();
		$notification = array(
			'message' => 'Photo Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-one-photo-gallery',$id)->with($notification);
	}

}

