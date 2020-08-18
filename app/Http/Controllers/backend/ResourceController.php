<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Resource;
use App\ResourceCategory;
use DB;
use Carbon\Carbon;
use App\Files;
use App\User;
use Auth;
use Bsdate;
class ResourceController extends Controller
{
	public function addResourceForm()
	{
		$file = Files::where('deleted_at',NULL)->get();
		$category = ResourceCategory::where('status','active')->get();
		return view('cd-admin.resource.add-resource',compact('category','file'));
	}

	public function viewResource()
	{
		$users = User::get();
		$resource = Resource::where('deleted_at',NULL)->get();
		$category = ResourceCategory::where('status','active')->where('deleted_at',NULL)->get();
		return view('cd-admin.resource.view-resource',compact('resource','category','users'));	
	}

	public function editResourceForm($id)
	{
		$file = Files::where('deleted_at',NULL)->get();
		$category = ResourceCategory::where('status','active')->get();
		$data = Resource::find($id);
		return view('cd-admin.resource.edit-resource',compact('data','category','file'));
	}
	public function addResource()
	{
		$data = Request()->validate([
			'file_name' => 'required|max:200|unique:resources',
			'file_name_ne' => 'required|max:200|unique:resources',
			'category' => 'required',
			'status' => 'required',
			'file' => 'required',
			'tags' => '',
			'published_date' => 'required',
		]);	
		$category = json_encode($data['category']);
		$resource = new Resource();
		$resource->file_name = $data['file_name'];
		$resource->file_name_ne = $data['file_name_ne'];
		$resource->category_id = $category;
		$resource->file_url = $data['file'];
		$resource->created_at_nep = $data['published_date'];
		$nep_date = explode('-',$data['published_date']);
		$change = Bsdate::nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
		$resource->created_at = $change['year'].'-'.$change['month'].'-'.$change['date'];
		$resource->status = $data['status'];
		$resource->tags = $data['tags'];
		$resource->created_by = Auth::user()->id;
		$resource->save();
		$notification = array(
			'message' => 'Resource Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-resource')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = Resource::find($id);
		if ($data['status'] == 'active') 
		{
			$a['status'] = 'inactive';
		}
		else
		{
			$a['status'] = 'active';
		}
		DB::table('resources')->where('id',$id)->update($a);
		$notification = array(
			'message' => 'Status Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}


	public function editResource($id)
	{
		$data = Request()->validate([
			'file_name' => 'required|max:200',
			'file_name_ne' => 'required|max:200',
			'category' => 'required',
			'status' => 'required',
			'file' => 'required',
			'tags' => '',
			'published_date' => '',
		]);	
		$category = json_encode($data['category']);
		$resource = Resource::find($id);
		$resource->file_url = $data['file'];
		$resource->file_name = $data['file_name'];
		$resource->file_name_ne = $data['file_name_ne'];
		$resource->category_id = $category;
		$resource->status = $data['status'];
		$resource->tags = $data['tags'];
		$resource->created_at_nep = $data['published_date'];
		$nep_date = explode('-',$data['published_date']);
		$change = Bsdate::nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
		$resource->created_at = $change['year'].'-'.$change['month'].'-'.$change['date'];
		$resource->created_by = Auth::user()->id;
		$resource->save();
		$notification = array(
			'message' => 'Resource Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-resource')->with($notification);
	}

	public function deleteResource($id)
	{
		$data = Resource::find($id);
		$data->file_name = 'deleted__'.$data['file_name'];
		$data->file_name_ne = 'deleted__'.$data['file_name_ne'];
		$data->deleted_at = Carbon::now('Asia/Kathmandu');
		$data->save();
		$notification = array(
			'message' => 'Resource Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-resource')->with($notification);
	}

}
