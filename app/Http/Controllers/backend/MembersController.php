<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MembersCategory;
use App\Photos;
use App\Members;
use Carbon\Carbon;
use Validator;
class MembersController extends Controller
{
	public function addMembersForm()
	{
		$category = MembersCategory::where('status','active')->where('deleted_at',NULL)->get();
		$photo = Photos::where('deleted_at',NULL)->get();
		return view('cd-admin.members.add-members',compact('category','photo'));
	}

	public function viewMembers()
	{
		$category = MembersCategory::where('status','active')->where('deleted_at',NULL)->get();
		$members = Members::where('deleted_at',NULL)->get();
		return view('cd-admin.members.view-members',compact('category','members'));
	}

	public function viewOneMember($id)
	{
		$data = Members::find($id);
		return view('cd-admin.members.view-one-member',compact('data'));
	}

	public function editMembersForm($id)
	{
		$data = Members::find($id);
		$category = MembersCategory::where('status','active')->where('deleted_at',NULL)->get();
		$photo = Photos::where('deleted_at',NULL)->get();
		return view('cd-admin.members.edit-members',compact('category','photo','data'));
	}
	public function addMembers()
	{
		$data = Request()->validate([
			'category' => 'required',
			'name' => 'required|max:200|unique:members',
			'contact_no' => '',
			'image_name' => '',
			'status' => 'required',
			'name_ne' => 'required|max:200|unique:members',
			'section' => '',
			'section_ne' => '',
			'email' => '',
			'post' => 'required',
			'post_ne' => 'required',
			'order' => 'required',
			'bio' => '',
			'is_expm' => 'required',
			'is_excs' => 'required',
			'from_to_ne' => '',
			'bio_ne' => '',
			'from_to' => '',
			'summary' => '',
			'summary_ne' => '',

		]);
		$category = json_encode($data['category']);
		$members = new Members();
		$members->category_id = $category;
		$members->name = $data['name'];
		$members->is_expm = $data['is_expm'];
		$members->is_excs = $data['is_excs'];
		$members->from_to = $data['from_to'];
		$members->from_to_ne = $data['from_to_ne'];
		$members->name_ne = $data['name_ne'];
		$members->contact_no = $data['contact_no'];
		$members->image_url = $data['image_name'];
		$members->status = $data['status'];
		$members->section = $data['section'];
		$members->section_ne = $data['section_ne'];
		$members->email = $data['email'];
		$members->post = $data['post'];
		$members->post_ne = $data['post_ne'];
		$members->order_no = $data['order'];
		$members->slug = str_slug($data['name'],'-');
		$members->bio = scriptStripper(html_entity_decode($data['bio']));
		$members->bio_ne = scriptStripper(html_entity_decode($data['bio_ne']));
		$members->summary = scriptStripper(html_entity_decode($data['summary']));
		$members->summary_ne = scriptStripper(html_entity_decode($data['summary_ne']));
		$members->save();
		$notification = array(
			'message' => 'Members Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-members')->with($notification);
	}

	public function editMembers($id)
	{
		$data = Request()->validate([
			'category' => 'required',
			'name' => 'required|max:200',
			'is_excs' => 'required',
			'contact_no' => '',
			'image_name' => '',
			'status' => 'required',
			'name_ne' => 'required|max:200',
			'section' => '',
			'section_ne' => '',
			'email' => '',
			'post' => 'required',
			'post_ne' => 'required',
			'order' => 'required',
			'is_expm' => 'required',
			'bio' => '',
			'bio_ne' => '',
			'from_to' => '',
			'from_to_ne' => '',
			'summary' => '',
			'summary_ne' => '',
		]);
		$category = json_encode($data['category']);
		$members = Members::find($id);
		$members->category_id = $category;
		$members->name = $data['name'];
		$members->name_ne = $data['name_ne'];
		$members->from_to = $data['from_to'];
		$members->from_to_ne = $data['from_to_ne'];
		$members->contact_no = $data['contact_no'];
		$members->image_url = $data['image_name'];
		$members->status = $data['status'];
		$members->section = $data['section'];
		$members->section_ne = $data['section_ne'];
		$members->email = $data['email'];
		$members->post = $data['post'];
		$members->post_ne = $data['post_ne'];
		$members->order_no = $data['order'];
		$members->bio = scriptStripper(html_entity_decode($data['bio']));
		$members->is_expm = $data['is_expm'];
		$members->is_excs = $data['is_excs'];
		$members->bio_ne = scriptStripper(html_entity_decode($data['bio_ne']));
		$members->summary = scriptStripper(html_entity_decode($data['summary']));
		$members->summary_ne = scriptStripper(html_entity_decode($data['summary_ne']));
		$members->slug = str_slug($data['name'],'-');
		$members->save();
		$notification = array(
			'message' => 'Members Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-members')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = Members::find($id);
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

	public function deleteMembers($id)
	{
		$members = Members::find($id);
		$members->name ='deleted__'.$members['name'];
		$members->name_ne ='deleted__'.$members['name_ne'];
		$members->deleted_at = Carbon::now('Asia/Kathmandu');
		$members->save();
		$notification = array(
			'message' => 'Member Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-members')->with($notification);
	}
	public function searchMember(Request $request)
	{
		$validation = Validator::make($request->all(), [
			'member_name' => 'required',
		]);
		if($validation->passes())
		{
			if($request->member_name == 'null')
			{
				return response()->json([
				'message'   => 'Please Select At Least One Member',
				'uploaded_image' => '',
				'class_name'  => 'alert-danger'
			]);
			}
			$member = Members::find($request->member_name);
			$categories = json_decode($member->category_id);
			$newmemberscat = '';
			foreach($categories as $key=>$cat)
			{
				$newcat[$key] = MembersCategory::find($cat); 
			}
			$count = 1;
			foreach($newcat as $newkey=>$final)
			{
				$newmemberscat .= '<div class="col-md-12 opmcm-menu-url" onclick="selectMemberCategories('.$request->widget_no.','.$final['id'].','.$member['id'].')" data-dismiss="modal">
							<p><b>'.$count.')</b>'.$final['name'].'('.$final['name_ne'].')</p>
						</div>
						<input type="hidden" name="link" id="widget_linkmembercategory'.$final['id'].'" value="'.'memberscategorywidgets/'.$member['id'].'/'.$final['id'].'">';
						$count++;
			}

			if($member)
			{
				return response()->json([
					'message'   => 'Search Results:',
					'uploaded_image' => $newmemberscat,
					'class_name'  => 'alert-success',
				]);
			}
			else
			{
				return response()->json([
					'message' => 'Search Not Successful Try Again',
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
