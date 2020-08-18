<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use App\Setting;
class SettingsController extends Controller
{
  public function addSettingsForm()
  {
   $photo = Photos::where('deleted_at',NULL)->get();
   return view('cd-admin.settings.add-settings',compact('photo'));
 }

 public function addSettings()
 {
   $data = Request()->validate([
    'name' => 'required|max:200',
    'logo_image' => 'required',
    'side_logo' => '',
    'logo_text' => '',
    'logo_text_ne' => '',
    'flag' => '',
  ]);
   $setting = new Setting();
   $setting->name = $data['name'];
   $setting->logo_image = $data['logo_image'];
   $setting->side_logo = $data['side_logo'];
   $setting->logo_text_ne = $data['logo_text_ne'];
   $setting->logo_text = $data['logo_text'];
   $setting->flag = $data['flag'];
   $setting->save();
   $notification = array(
    'message' => 'Settings Added Successfully',
    'alert-type' => 'success',
  );
   return redirect()->route('view-settings')->with($notification);
 }

 public function viewSettings()
 {
   $photo = Photos::where('deleted_at',NULL)->get();
   $data = Setting::get()->first();
   return view('cd-admin.settings.view-settings',compact('photo','data'));
 }

 public function editSettings($id)
 {
   $setting = Setting::find($id);
   $data = Request()->validate([
    'name' => 'required|max:200',
    'logo_image' => 'required',
    'side_logo' => '',
    'logo_text' => '',
    'logo_text_ne' => '',
    'flag' => '',
    // 'flag' => '',
    // 'embed_url' => '',
  ]);
   if(isset($data['name']))
   {
    $setting->name = $data['name'];
  }
  if(isset($data['logo_image']))
  {
   $setting->logo_image = $data['logo_image'];
 }
 if(isset($data['logo_image_ne']))
  {
   $setting->logo_image_ne = $data['logo_image_ne'];
 }
 $setting->logo_text = $data['logo_text'];
 $setting->logo_text_ne = $data['logo_text_ne'];
 $setting->side_logo = $data['side_logo'];
 $setting->flag = $data['flag'];
 // $setting->embed_url = $data['embed_url'];
 $setting->save();
 $notification = array(
  'message' => 'Settings Updated Successfully',
  'alert-type' => 'success',
);
 return redirect()->route('view-settings')->with($notification);
}
}