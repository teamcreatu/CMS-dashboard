<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use App\Files;
use App\Videos;
use App\MakeWidgets;
use Carbon\Carbon;
use DB;
class MakeWidgetsController extends Controller
{

	public function viewMakeWidgets()
	{
		$widgets = MakeWidgets::where('deleted_at',NULL)->get();
		return view('cd-admin.makewidget.view-make-widgets',compact('widgets'));
	}
    public function addMakeWidgetForm()
    {
    	$photo = Photos::where('deleted_at',NULL)->get();
    	$file = Files::where('deleted_at',NULL)->get();
    	$video = Videos::where('deleted_at',NULL)->get();
    	return view('cd-admin.makewidget.add-make-widget',compact('photo','video','file'));
    }

     public function editMakeWidgetsForm($id)
    {
    	$photo = Photos::where('deleted_at',NULL)->get();
    	$file = Files::where('deleted_at',NULL)->get();
    	$video = Videos::where('deleted_at',NULL)->get();
    	$data = MakeWidgets::find($id);
    	return view('cd-admin.makewidget.edit-make-widgets',compact('photo','video','file','data'));
    }

    public function addMakeWidget()
    {
    	$data = Request()->validate([
    		'title' => 'required',
    		'title_ne' => 'required',
    		'description' => 'required',
    		'description_ne' => 'required',
    		'status' => 'required',
    		'image_name' => 'required',
    	]);
    	$makeWidget = new MakeWidgets();
    	if(isset($data['image_name']))
    	{
    		$file = $data['image_name'];
    		$file_name = time().$file->getClientOriginalName();
    		$destination = public_path('uploads/makewidgets');
    		$file->move($destination,$file_name);
    		$makeWidget->image_url = 'public/uploads/makewidgets/'.$file_name;
    	}
    	$makeWidget->title = $data['title'];
    	$makeWidget->title_ne = $data['title_ne'];
    	$makeWidget->description = $data['description'];
    	$makeWidget->description_ne = $data['description_ne'];
    	$makeWidget->status = $data['status'];
    	$makeWidget->save();
    	$notification = array(
			'message' => 'Make Widgets Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-make-widgets')->with($notification);
    }

    public function editMakeWidgets($id)
    {
    	$data = Request()->validate([
    		'title' => 'required|unique:make_widgets,id,'.$id,
    		'title_ne' => 'required|unique:make_widgets,id,'.$id,
    		'description' => 'required',
    		'description_ne' => 'required',
    		'status' => 'required',
    		'image_name' => '',
    	]);
    	$makeWidget = MakeWidgets::find($id);
    	if(isset($data['image_name']))
    	{
    		if(file_exists('public/uploads/makewidgets/'.$makeWidget['image_url']))
    		{
    			unlink('public/uploads/makewidgets/'.$makeWidget['image_url']);
    		}
    		$file = $data['image_name'];
    		$file_name = time().$file->getClientOriginalName();
    		$destination = public_path('uploads/makewidgets');
    		$file->move($destination,$file_name);
    		$makeWidget->image_url = 'public/uploads/makewidgets/'.$file_name;
    	}
    	$makeWidget->title = $data['title'];
    	$makeWidget->title_ne = $data['title_ne'];
    	$makeWidget->description = $data['description'];
    	$makeWidget->description_ne = $data['description_ne'];
    	$makeWidget->status = $data['status'];
    	$makeWidget->save();
    	$notification = array(
			'message' => 'Make Widgets Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-make-widgets')->with($notification);
    }

    public function updateStatus($id)
	{
		$data = MakeWidgets::find($id);
		if ($data['status'] == 'active') 
		{
			$a['status'] = 'inactive';
		}
		else
		{
			$a['status'] = 'active';
		}
		DB::table('make_widgets')->where('id',$id)->update($a);
		$notification = array(
			'message' => 'Status Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}

	public function deleteMakeWidgets($id)
	{
		$data = MakeWidgets::find($id);
		$data->title = 'deleted__'.$data['title'];
		$data->title_ne = 'deleted__'.$data['title_ne'];
		$data->deleted_at = Carbon::now('Asia/Kathmandu');
		$data->save();
		$notification = array(
			'message' => 'Make Widgets Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}
}
