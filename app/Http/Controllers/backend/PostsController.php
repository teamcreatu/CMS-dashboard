<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;
use App\PostsCategory;
use App\Photos;
use DB;
use Carbon\Carbon;
use App\User;
use Auth;
use App\Videos;
use App\Files;
use Bsdate;
class PostsController extends Controller
{
	public function addPostForm()
	{
		$category = PostsCategory::where('status','active')->where('deleted_at',NULL)->get();
		$file = Files::where('deleted_at',NULL)->get();
		$photo = Photos::where('deleted_at',NULL)->get();
		$video = Videos::where('deleted_at',NULL)->get();
		return view('cd-admin.posts.add-posts',compact('category','file','photo','video'));
	}
	public function viewPost()
	{	
		$category = PostsCategory::where('status','active')->where('deleted_at',NULL)->get();
		$posts = Posts::where('deleted_at',NULL)->get();
		$users = User::get();
		return view('cd-admin.posts.view-posts',compact('category','posts','users'));
	}

	public function editPostForm($id)
	{
		$data = Posts::find($id);
		$category = PostsCategory::where('status','active')->where('deleted_at',NULL)->get();
		$file = Files::where('deleted_at',NULL)->get();
		$photo = Photos::where('deleted_at',NULL)->get();
		$video = Videos::where('deleted_at',NULL)->get();
		return view('cd-admin.posts.edit-posts',compact('category','file','data','photo','video'));
	}

	public function viewOnePost($id)
	{
		$data = Posts::find($id);
		return view('cd-admin.posts.view-one-posts',compact('data'));
	}
	public function addPost()
	{
		$data = Request()->validate([
			'category' => 'required',
			'title' => 'required|max:200|unique:posts',
			'description' => 'required',
			'summary' => 'required|max:100',
			'summary_ne' => 'required|max:100',
			'image_name' => 'image|mimes:jpg,png,jpeg,gif,|max:4086',
			'status' => 'required',
			'title_ne' => 'required|max:200|unique:posts',
			'description_ne' => 'required',
			'tags' => '',
			'published_date' => 'required',
			'show_latest_updated' => 'required',
			'url' => 'required|unique:posts,slug',
		]);
		$event = new Posts();
		if(isset($data['image_name']))
		{
			$file = $data['image_name'];
			$filename = time().$file->getClientOriginalName();
			$destination = public_path('uploads/posts');
			$file->move($destination,$filename);
			$event->image_url = 'public/uploads/posts/'.$filename;
		}
		$category = json_encode($data['category']);
		$event->category_id = $category;
		$event->title = $data['title'];
		$event->description = scriptStripper(html_entity_decode($data['description']));
		$event->title_ne = $data['title_ne'];
		$event->description_ne = scriptStripper(html_entity_decode($data['description_ne']));
		$event->summary = $data['summary'];
		$event->summary_ne = $data['summary_ne'];
		$event->status = $data['status'];
		$event->slug = $data['url'];
		$event->tags = $data['tags'];
		$event->created_at_nep = $data['published_date'];
		$nep_date = explode('-',$data['published_date']);
		$change = Bsdate::nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
		$event->created_at = $change['year'].'-'.$change['month'].'-'.$change['date'];
		$event->created_by = Auth::user()->id;
		$event->show_latest_updated = $data['show_latest_updated'];
		$event->save();
		$notification = array(
			'message' => 'Posts Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-posts')->with($notification);
	}

	public function updateStatus($id)
	{
		$data = Posts::find($id);
		if ($data['status'] == 'active') 
		{
			$a['status'] = 'inactive';
		}
		else
		{
			$a['status'] = 'active';
		}
		DB::table('posts')->where('id',$id)->update($a);
		$notification = array(
			'message' => 'Status Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}

	public function editPost($id)
	{
		$data = Request()->validate([
			'category' => 'required',
			'title' => 'required|max:200,unique:posts,title_ne,'.$id,
			'description' => 'required',
			'summary' => 'required|max:100',
			'summary_ne' => 'required|max:100',
			'image_name' => 'image|mimes:jpg,png,jpeg,gif,|max:4086',
			'status' => 'required',
			'title_ne' => 'required|max:200,unique:posts,title_ne,'.$id,
			'description_ne' => 'required',
			'tags' => '',
			'published_date' => 'required',
			'show_latest_updated' => 'required',
			'url' => 'required|unique:posts,slug,'.$id
		]);
		$event = Posts::find($id);
		if(isset($data['image_name']))
		{
			if(file_exists($event['image_url']))
			{
				unlink($event['image_url']);
			}
			$file = $data['image_name'];
			$filename = time().$file->getClientOriginalName();
			$destination = public_path('uploads/posts');
			$file->move($destination,$filename);
			$event->image_url = 'public/uploads/posts/'.$filename;
		}
		$category = json_encode($data['category']);
		$event->category_id = $category;
		$event->title = $data['title'];
		$event->description = scriptStripper(html_entity_decode($data['description']));
		$event->title_ne = $data['title_ne'];
		$event->description_ne = scriptStripper(html_entity_decode($data['description_ne']));
		$event->summary = $data['summary'];
		$event->summary_ne = $data['summary_ne'];
		$event->status = $data['status'];
		$event->slug = str_slug($data['title'],'-');
		$event->tags = $data['tags'];
		$event->created_by = Auth::user()->id;
		$event->show_latest_updated = $data['show_latest_updated'];
		$event->created_at_nep = $data['published_date'];
		$nep_date = explode('-',$data['published_date']);
		$change = Bsdate::nep_to_eng($nep_date[0],$nep_date[1],$nep_date[2]);
		$event->created_at = $change['year'].'-'.$change['month'].'-'.$change['date'];
		$event->save();
		$notification = array(
			'message' => 'Posts Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-posts')->with($notification);
	}

	public function deletePost($id)
	{
		$data = Posts::find($id);
		$data->title = 'deleted__'.$data['title'];
		$data->title_ne = 'deleted__'.$data['title_ne'];
		$data->deleted_at = Carbon::now('Asia/Kathmandu');
		$data->save();
		$notification = array(
			'message' => 'Posts Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-posts')->with($notification);
	}

	public function updatePostsShowStatus($id)
	{
		$data = Posts::find($id);
		if ($data['show_latest_updated'] == 'yes') 
		{
			$a['show_latest_updated'] = 'no';
		}
		else
		{
			$a['show_latest_updated'] = 'yes';
		}
		DB::table('posts')->where('id',$id)->update($a);
		$notification = array(
			'message' => 'Show Status Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}


}
