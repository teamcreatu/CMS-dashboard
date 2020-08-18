<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use App\Features;
use Carbon\Carbon;
class FeaturesController extends Controller
{
    public function addFeatureForm()
    {
    	$photo = Photos::where('deleted_at',NULL)->get();
    	return view('cd-admin.features.add-feature',compact('photo'));
    }

    public function viewFeature()
    {
    	$feature = Features::where('deleted_at',NULL)->get();
    	return view('cd-admin.features.view-feature',compact('feature'));
    }

    public function editFeatureForm($id)
    {
    	$photo = Photos::where('deleted_at',NULL)->get();
    	$data = Features::find($id);
    	return view('cd-admin.features.edit-feature',compact('photo','data'));
    }

    public function addFeature()
    {    	
    	$data = Request()->validate([
    		'title' => 'required',
    		'feature_url' => 'required',
    		'fa_icon' => 'required',
    		'status' => 'required'
    	]);
        // $file = $data['image_name'];
        // $filename = time().$file->getClientOriginalName();
        // $destination = public_path('uploads/features');
        // $file->move($destination,$filename);
        $features = new Features();
        $features->title = $data['title'];
        $features->link = $data['feature_url'];
        $features->image_name = $data['fa_icon'];
        $features->status = $data['status'];
        $features->save();
        $notification = array(
         'message' => 'Feature Added Successfully',
         'alert-type' => 'success',
     );
        return redirect()->route('view-feature')->with($notification);
    }	

    public function editFeature($id)
    {
    	$data = Request()->validate([
    		'title' => 'required',
    		'feature_url' => 'required',
    		'fa_icon' => 'required',
    		'status' => 'required'
    	]);
    	$features = Features::find($id);
        // if(isset($data['image_name']))
        // {
        //     if(file_exists('public/uploads/features/'.$features['image_name']))
        //     {
        //         unlink('public/uploads/features/'.$features['image_name']);
        //     }
        //     $file = $data['image_name'];
        //     $filename = time().$file->getClientOriginalName();
        //     $destination = public_path('uploads/features');
        //     $file->move($destination,$filename);
        //     $features->image_name = $filename;
        // }
        $features->title = $data['title'];
        $features->link = $data['feature_url'];
        $features->status = $data['status'];
        $features->image_name = $data['fa_icon'];
        $features->save();
        $notification = array(
         'message' => 'Feature Added Successfully',
         'alert-type' => 'success',
     );
        return redirect()->route('view-feature')->with($notification);
    }	




    public function updateStatus($id)
    {
      $data = Features::find($id);
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

 public function deleteFeature($id)
 {
    $data = Features::find($id);
    $data['deleted_at'] = Carbon::now('Asia/Kathmandu');
    $data->save();
    $notification = array(
        'message' => 'Feature Deleted Successfully',
        'alert-type' => 'success',
    );
    return redirect()->back()->with($notification);
}
}
