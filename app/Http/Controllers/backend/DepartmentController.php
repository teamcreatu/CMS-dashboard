<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use Carbon\Carbon;
class DepartmentController extends Controller
{
     public function addDepartmentForm()
    {
    	return view('cd-admin.department.add-department');
    }

    public function viewDepartment()
    {
    	$department = Department::where('deleted_at',NULL)->get();
    	return view('cd-admin.department.view-department',compact('department'));
    }

    public function editDepartmentForm($id)
    {
    	$data = Department::find($id);
    	return view('cd-admin.department.edit-department',compact('data'));
    }

    public function addDepartment()
    {    
    	$data = Request()->validate([
    		'title' => 'required',
    		'title_ne' => 'required',
    		'image_name' => 'required',
    		'status' => 'required',
    		'link_url' => 'required',
    	]);
    	$file = $data['image_name'];
    	$filename = time().$file->getClientOriginalName();
    	$destination = public_path('uploads/department');
    	$file->move($destination,$filename);
    	$department = new Department();
    	$department->title = $data['title'];
    	$department->title_ne = $data['title_ne'];
    	$department->link_url = $data['link_url'];
    	$department->image_name = $filename;
    	$department->status = $data['status'];
    	$department->save();
    	$notification = array(
			'message' => 'Department Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-department')->with($notification);
    }	

     public function editDepartment($id)
    {
    	$data = Request()->validate([
    		'title' => 'required',
    		'title_ne' => 'required',
    		'image_name' => '',
    		'status' => 'required',
    		'link_url' => 'required',
    	]);
    	$department = Department::find($id);
    	if(isset($data['image_name']))
    	{
    		if(file_exists('public/uploads/department/'.$department['image_name']))
    		{
    			unlink('public/uploads/department/'.$department['image_name']);
    		}
    		$file = $data['image_name'];
    		$filename = time().$file->getClientOriginalName();
    		$destination = public_path('uploads/department');
    		$file->move($destination,$filename);
    		$department->image_name = $filename;
    	}
    	$department->title = $data['title'];
    	$department->title_ne = $data['title_ne'];
    	$department->link_url = $data['link_url'];
    	$department->status = $data['status'];
    	$department->save();
    	$notification = array(
			'message' => 'Department Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-department')->with($notification);
    }	




    public function updateStatus($id)
	{
		$data = Department::find($id);
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

	 public function deleteDepartment($id)
    {
        $data = Department::find($id);
        $data['deleted_at'] = Carbon::now('Asia/Kathmandu');
        $data->save();
        $notification = array(
            'message' => 'Department Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
