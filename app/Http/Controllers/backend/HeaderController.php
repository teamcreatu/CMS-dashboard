<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Header;
use \Carbon\Carbon;
use File;
class HeaderController extends Controller
{
    public function addHeader()
    {
    	return view('cd-admin.headerform.add-headerform');
    }

    public function viewHeader()
    {
    	$header = Header::where('deleted_at',Null)->get();
    	return view('cd-admin.headerform.view-headerform',compact('header'));
    }

    public function editHeader($id)
    {
    	$header = Header::where('id',$id)->where('deleted_at',Null)->get()->first();
    	return view('cd-admin.headerform.edit-headerform',compact('header'));
    }

    public function insertHeader()
    {
    	$request = Request()->all();
    	$data = Request()->validate([
    		'name' => 'required',
    		'type' => 'required',
    		'value' => 'required',
            'color_picker_upper' =>'',
            'color_picker_lower' =>'',
            'show_main_menu' => 'required',
            'show_side_menu' => 'required',
        ]);
    	$header = new Header();
        $header->name = $request['name'];
        $header->type = $request['type'];
        $header->value = $request['value'];
        $header->color_picker_lower = $request['color_picker_lower'];
        $header->color_picker_upper = $request['color_picker_upper'];
        $header->show_main_menu = $request['show_main_menu'];
        $header->show_side_menu = $request['show_side_menu'];
        $header->save();
        $notification = array(
           'message' => 'Header added successfully!',
           'alert-type' => 'success'
       );
        return redirect()->to('/cd-admin/view-all-header')->with($notification);
    }

    public function updateHeader($id)
    {
    	$request = Request()->all();
    	$data = Request()->validate([
    		'name' => 'required',
    		'type' => 'required',
    		'value' => 'required',
            'color_picker_upper' =>'',
            'color_picker_lower' => '',
            'show_main_menu' => 'required',
            'show_side_menu' => 'required',
        ]);
    	$header = Header::where('id',$id)->where('deleted_at',Null)->get()->first();
        $header->name = $request['name'];
        $header->type = $request['type'];
        $header->value = $request['value'];
        $header->color_picker_upper = $request['color_picker_upper'];
        $header->color_picker_lower = $request['color_picker_lower'];
        $header->show_main_menu = $request['show_main_menu'];
        $header->show_side_menu = $request['show_side_menu'];
        $header->save();
        $notification = array(
           'message' => 'Header Updated successfully!',
           'alert-type' => 'success'
       );
        return redirect()->to('/cd-admin/view-all-header')->with($notification);
    }

    public function deletedHeader($id)
    {
      $header = Header::where('id',$id)->where('deleted_at',Null)->get()->first();
      $today = Carbon::now('Asia/Kathmandu');;
      $header->deleted_at = $today;
      $header->save();
      $notification = array(
       'message' => 'Header Deleted successfully!',
       'alert-type' => 'success'
   );
      return redirect()->to('/cd-admin/view-all-header')->with($notification);
  }
}
