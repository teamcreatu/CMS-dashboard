<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carousel;
use Carbon\Carbon;
use App\Photos;
class CarouselController extends Controller
{
	public function addCarouselForm()
	{
		$photo = Photos::where('deleted_at',NULL)->get();
		return view('cd-admin.carousel.add-carousel',compact('photo'));
	}
	public function viewCarousel()
	{
		$carousel = Carousel::where('deleted_at',NULL)->get();
		return view('cd-admin.carousel.view-carousel',compact('carousel'));
	}

	public function editCarouselForm($id)
	{
		$data = Carousel::find($id);
		$photo = Photos::where('deleted_at',NULL)->get();
		return view('cd-admin.carousel.edit-carousel',compact('data','photo'));
	}
	public function addCarousel()
	{
		$data = Request()->validate([
			'title' => 'max:200|unique:carousels',
			'title_ne' => 'max:200|unique:carousels',
			'subtitle' => 'max:200',
			'subtitle_ne' => 'max:200',
			'status' => 'required',
			'image_name' => 'required',
		]);
		$carousel = new Carousel();
		$carousel->title = $data['title'];
		$carousel->title_ne = $data['title'];
		$carousel->subtitle = $data['subtitle'];
		$carousel->subtitle_ne = $data['subtitle_ne'];
		$carousel->image_url = $data['image_name'];
		$carousel->status = $data['status'];
		$carousel->save();
		$notification = array(
			'message' => 'Carousel Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-carousel')->with($notification);
	}

	public function editCarousel($id)
	{
		$data = Request()->validate([
			'title' => 'max:200',
			'title_ne' => 'max:200',
			'subtitle' => 'max:200',
			'subtitle_ne' => 'max:200',
			'status' => 'required',
			'image_name' => 'required',
		]);	
		$carousel = Carousel::find($id);
		$carousel->title = $data['title'];
		$carousel->title_ne = $data['title_ne'];
		$carousel->subtitle_ne =$data['subtitle_ne'];
		$carousel->subtitle =$data['subtitle'];
		$carousel->image_url = $data['image_name'];
		$carousel->status = $data['status'];
		$carousel->save();
		$notification = array(
			'message' => 'Carousel Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-carousel')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = Carousel::find($id);
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

	public function deleteCarousel()
	{
		$ids = Request()->checkbox;
		foreach($ids as $id)
		{
		$data = Carousel::find($id);
		$data->title = 'deleted__'.$data['title'];
		$data->title_ne = 'deleted__'.$data['title_ne'];
		$data->deleted_at = Carbon::now('Asia/Kathmandu');
		$data->save();
		}
		$notification = array(
			'message' => 'Carousel Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-carousel')->with($notification);
	}
}
