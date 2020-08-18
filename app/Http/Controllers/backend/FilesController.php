<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Files;
use File;
use Carbon\Carbon;
use Validator;
class FilesController extends Controller
{
  public function addFileForm()
  {
   return view('cd-admin.files.add-files');
 }

 public function viewFile()
 {
   $file = Files::where('deleted_at',NULL)->get();
   return view('cd-admin.files.view-files',compact('file'));
 }

 public function addFile()
 {
   $data = Request()->validate([
     'file_title' => 'max:200|unique:files',
     'file_name' => 'required|mimes:pdf,doc,docx,xlsx,txt,xls,pptx,ppt,zip|file',
   ]);	
   $file = $data['file_name'];
    $files = new Files();
   if(isset($data['file_title']))
   {
    $filename= time().$data['file_title'];
    $files->file_title = $filename;
  }
  else
  {
    $filename= time().$file->getClientOriginalName();
    $files->file_title = $filename;
  }
  $file_type = File::extension($filename);
  $destination = public_path('uploads/files');
  $file->move($destination,$filename);
  $files->file_url = '/public/uploads/files/'.$filename;
  $files->file_type = $file_type;
  $files->save();
  $notification = array(
   'message' => 'File Added Successfully',
   'alert-type' => 'success',
 );
  return redirect()->route('view-files')->with($notification);
}

public function deleteFile()
{
  $ids = Request()->checkbox;
  foreach($ids as $id) 
  {
   $data = Files::find($id);
   $data->file_title = 'deleted__'.$data['file_title'];
   $data->deleted_at = Carbon::now('Asia/Kathmandu');
   $data->save();
 }
 $notification = array(
  'message' => 'File Deleted Successfully',
  'alert-type' => 'success',
);
 return redirect()->back()->with($notification);
}

    //   public function addFileDynamic()
    // {
    //     $data = Request()->validate([
    //         'file_title' => 'required|max:200|unique:files',
    //         'file_name' => 'required|mimes:pdf,doc,docx,xlsx,txt,xls,pptx,ppt,zip|file|max:10240',
    //     ]); 
    //     $file = $data['file_name'];
    //     $filename = time().$file->getClientOriginalName();
    //     $file_type = File::extension($filename);
    //     $destination = public_path('uploads/files');
    //     $file->move($destination,$filename);
    //     $files = new Files();
    //     $files->file_title = $data['file_title'];
    //     $files->file_url = '/public/uploads/files/'.$filename;
    //     $files->file_type = $file_type;
    //     $files->save();
    //     $notification = array(
    //         'message' => 'File Added Successfully',
    //         'alert-type' => 'success',
    //     );
    //     return redirect()->back()->with($notification);
    // }

public function addFileDynamic(Request $request)
{
  $validation = Validator::make($request->all(), [
    'select_file' => 'required|mimes:pdf,doc,docx,xlsx,txt,xls,pptx,ppt,zip|file',
  ]);
  if($validation->passes())
  {
    $file = $request->file('select_file');
    $new_name = time().'.'.$file->getClientOriginalName();
    $file->move(public_path('uploads/files'), $new_name);
    $files = new Files();
    $files->file_title = $file->getClientOriginalName();
    $files->file_type = File::extension($new_name);
    $files->file_url = 'public/uploads/files/'.$new_name;
    $files->save();

    if($files->save())
    {
      return response()->json([
        'message'   => 'File Uploaded Successfully',
        'uploaded_image' => '<div class="col-md-12 opmcm-menu-url" onclick="writelink{{'.$files->id.'}}()" data-dismiss="modal">
        <p><b></b>'.$files->file_title.'</p>
        <input type="hidden" name="link" id="image_link_modal{{'.$files->id.'}}" value="{{'.$files->file_url.'}}">
        </div>',
        'image_url' => 'public/uploads/files/'.$new_name,
        'class_name'  => 'alert-success',
      ]);
    }
    else
    {
      return response()->json([
        'message' => 'File Upload Not Successful',
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

public function addFilePostDynamic(Request $request)
{
  $validation = Validator::make($request->all(), [
    'select_file' => 'required|mimes:pdf,doc,docx,xlsx,txt,xls,pptx,ppt,zip|file',
  ]);
  if($validation->passes())
  {
    $file = $request->file('select_file');
    $new_name = time().'.'.$file->getClientOriginalName();
    $file->move(public_path('uploads/files'), $new_name);
    $files = new Files();
    $files->file_title = $file->getClientOriginalName();
    $files->file_type = File::extension($new_name);
    $files->file_url = 'public/uploads/files/'.$new_name;
    $files->save();

    if($files->save())
    {
      return response()->json([
        'message'   => 'File Uploaded Successfully',
        'image_url' => Request()->root().'/public/uploads/files/'.$new_name,
        'title' => $files->file_title,
      ]);
    }
    else
    {
      return response()->json([
        'message' => 'File Upload Not Successful',
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
