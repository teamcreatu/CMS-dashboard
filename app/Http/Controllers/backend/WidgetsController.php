<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\Members;
use App\MembersCategory;
use App\DefaultWidget;
use App\CustomWidgets;
use App\MakeWidgets;
use App\Widgets;
use App\Posts;
use DB;
use Carbon\Carbon;
use Session;
class WidgetsController extends Controller
{
	public function contactus($language)
	{
		$contact = Contact::where('deleted_at',NULL)->get()->first();
		return view('widgets.contactus',compact('contact','language'));
	}

	public function addCustomWidgetsForm()
	{
		$members = Members::where('deleted_at',NULL)->get();
		$category = MembersCategory::where('deleted_at',NULL)->get();
		$contact = Contact::where('deleted_at',NULL)->get()->first();
		$posts = Posts::where('deleted_at',NULL)->get();
		$make_widgets = MakeWidgets::where('deleted_at',NULL)->where('status','active')->get();
		return view('cd-admin.custom_widgets.add-custom-widgets',compact('members','contact','category','posts','make_widgets'));

	}
	public function viewCustomWidgets()
	{
		$custom = CustomWidgets::where('deleted_at',NULL)->get();
		$widgets = Widgets::where('deleted_at',NULL)->get()->groupBy('custom_widget_id');
		return view('cd-admin.custom_widgets.view-custom-widgets',compact('custom','widgets'));
	}

	public function editCustomWidgetsForm($id)
	{
		$members = Members::where('deleted_at',NULL)->get();
		$category = MembersCategory::where('deleted_at',NULL)->get();
		$contact = Contact::where('deleted_at',NULL)->get()->first();
		$data = CustomWidgets::find($id);
		$make_widgets = MakeWidgets::where('deleted_at',NULL)->where('status','active')->get();
		$widget_data = Widgets::where('deleted_at',NULL)->where('custom_widget_id',$data['id'])->get();
		$posts = Posts::where('deleted_at',NULL)->where('status','active')->get();
		return view('cd-admin.custom_widgets.edit-custom-widgets',compact('members','contact','category','data','widget_data','posts','make_widgets'));
	}
	public function viewMemberWidgets()
	{
		$members = Members::where('deleted_at',NULL)->get();
		return view('cd-admin.widgets.view-default-widgets',compact('members'));
	}

	public function viewOneMemberWidget($id)
	{
		$member = Members::find($id);
		$category = MembersCategory::where('deleted_at',NULL)->get();
		return view('widgets.contact-us',compact('member','category'));
	}
	public function spokespersonEnglish($id)
	{
		$member = Members::find($id);
		$language = 'en';
		$widget_id = Widgets::where('url','spokesperson/'.$id)->where('deleted_at',NULL)->get()->first();
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->where('id',$widget_id['custom_widget_id'])->get()->first();
		$category = MembersCategory::where('deleted_at',NULL)->get();
		return view('widgets.spokesperson',compact('member','category','custom_widget','language'));
	}
	public function spokespersonNepali($id)
	{
		$member = Members::find($id);
		$language = 'np';
		$widget_id = Widgets::where('url','spokesperson/'.$id)->where('deleted_at',NULL)->get()->first();
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->where('id',$widget_id['custom_widget_id'])->get()->first();
		$category = MembersCategory::where('deleted_at',NULL)->get();
		return view('widgets.spokesperson',compact('member','category','custom_widget','language'));
	}

	public function postEnglish($id)
	{
		$posts = Posts::find($id);
		$language = 'en';
		$widget_id = Widgets::where('url','postswidgets/'.$id)->where('deleted_at',NULL)->get()->first();
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->where('id',$widget_id['custom_widget_id'])->get()->first();
		return view('widgets.posts',compact('posts','custom_widget','language'));
	}
	public function postNepali($id)
	{
		$posts = Posts::find($id);
		$language = 'np';
		$widget_id = Widgets::where('deleted_at',NULL)->where('url','postswidgets/'.$id)->get()->first();
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->where('id',$widget_id['custom_widget_id'])->get()->first();
		return view('widgets.posts',compact('posts','custom_widget','language'));
	}



	public function staffCategoryEnglish($id)
	{
		$membersCategory = MembersCategory::find($id);
		$member = Members::where('deleted_at',NULL)->orderBy('order_no','asc')->get();
		$member_details = [];
		foreach($member as $m)
		{
			$decode = json_decode($m['category_id']);
			if(in_array($membersCategory['id'],$decode))
			{
				if(count($member_details) < 1 )
				{
				$member_details[] = $m;
				}
			}
		}
		$language = 'en';
		$widget_id = Widgets::where('url','staffscategory/'.$id)->where('deleted_at',NULL)->get()->first();
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->where('id',$widget_id['custom_widget_id'])->get()->first();
		return view('widgets.staffs-category-based',compact('member_details','custom_widget','language'));
	}
	public function staffCategoryNepali($id)
	{
		$membersCategory = MembersCategory::find($id);
		$member = Members::where('deleted_at',NULL)->orderBy('order_no','asc')->get();
		$member_details = [];
		foreach($member as $m)
		{
			$decode = json_decode($m['category_id']);
			if(in_array($membersCategory['id'],$decode))
			{
				if(count($member_details) < 1 )
				{
				$member_details[] = $m;
				}
			}
		}
		$language = 'np';
		$widget_id = Widgets::where('url','staffscategory/'.$id)->where('deleted_at',NULL)->get()->first();
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->where('id',$widget_id['custom_widget_id'])->get()->first();
		return view('widgets.staffs-category-based',compact('member_details','custom_widget','language'));
	}


	public function customWidgetsEnglish($id)
	{
		$posts = MakeWidgets::find($id);
		$language = 'en';
		$widget_id = Widgets::where('deleted_at',NULL)->where('url','madecustomwidgets/'.$id)->get()->first();
		$custom_widget = CustomWidgets::where('id',$widget_id['custom_widget_id'])->get()->first();
		return view('widgets.custom_widgets',compact('posts','custom_widget','language'));
	}
	public function customWidgetsNepali($id)
	{
		$posts = MakeWidgets::find($id);
		$language = 'np';
		$widget_id = Widgets::where('deleted_at',NULL)->where('url','madecustomwidgets/'.$id)->get()->first();
		$custom_widget = CustomWidgets::where('id',$widget_id['custom_widget_id'])->get()->first();
		return view('widgets.custom_widgets',compact('posts','custom_widget','language'));
	}

	public function MembersCategoryWidgetsNepali($member,$category)
	{
		$member_details = Members::find($member);
		$category_details = MembersCategory::find($category);
		$widget_id = Widgets::where('deleted_at',NULL)->where('url','memberscategorywidgets/'.$member.'/'.$category)->get()->first();
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->where('id',$widget_id['custom_widget_id'])->get()->first();
		$language = 'ne';
		return view('widgets.custom_widgets_category_based',compact('member_details','category_details','custom_widget','language'));
	}

	public function MembersCategoryWidgetsEnglish($member,$category)
	{
		$member_details = Members::find($member);
		$category_details = MembersCategory::find($category);
		$widget_id = Widgets::where('url','memberscategorywidgets/'.$member.'/'.$category)->get()->first();
		$custom_widget = CustomWidgets::where('id',$widget_id['custom_widget_id'])->get()->first();
		$language = 'en';
		return view('widgets.custom_widgets_category_based',compact('member_details','category_details','custom_widget','language'));
	}


	public function addCustomWidgets()
	{
		$widget = Request()->widgets;
		$i= 0;
		if($widget == NULL)
		{
			Session::flash('danger');
			return redirect()->back();
		}
		while($widget != NULL)
		{
			$a[$i]['widget'] = $widget[$i];
			unset($widget[$i]);
			$i++;
		}
		$custom_widget = new CustomWidgets();
		$custom_widget->name = Request()->title;
		$custom_widget->name_ne = Request()->title_ne;
		$custom_widget->save();

		foreach($a as $w)
		{
			$widget = new Widgets();
			$widget->custom_widget_id = $custom_widget['id'];
			$widget->url = $w['widget'];
			$widget->save();
		}
		$notification = array(
			'message' => 'Custom Widget Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-custom-widgets')->with($notification);

	}

	public function editCustomWidgets($id)
	{
		$widget_data = Widgets::where('custom_widget_id',$id)->get();
		$widget = Request()->widgets;
		$widget_id = Request()->widget_id;
		$i= 0;
		if($widget == NULL)
		{
			Session::flash('danger');
			return redirect()->back();
		}
		while($widget != NULL)
		{
			$a[$i]['widget'] = $widget[$i];
			$a[$i]['widget_id'] = $widget_id[$i];
			unset($widget[$i]);
			$i++;
		}
		$custom_widget = CustomWidgets::find($id);
		$custom_widget->name = Request()->title;
		$custom_widget->name_ne = Request()->title_ne;
		$custom_widget->save();

		foreach($a as $key=>$w)
		{
			if($w['widget_id'] != "no")
			{
				$widget[$key] = Widgets::find($w['widget_id']);
				$widget[$key]->custom_widget_id = $custom_widget['id'];
				$widget[$key]->url = $w['widget'];
				$widget[$key]->save();
			}
			else
			{
				$widget[$key] = new Widgets();
				$widget[$key]->custom_widget_id = $custom_widget['id'];
				$widget[$key]->url = $w['widget'];
				$widget[$key]->save();
			}
		}
		$notification = array(
			'message' => 'Custom Widget Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-custom-widgets')->with($notification);
	}

	public function deleteOneWidget($id)
	{
		$custom_widget = Widgets::find($id);
		$custom_widget->deleted_at = Carbon::now('Asia/Kathmandu');
		$custom_widget->save();
		$notification = array(
			'message' => 'Widget Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}

	public function deleteCustomWidget($id)
	{
		$custom_widget = CustomWidgets::find($id);
		$custom_widget->deleted_at = Carbon::now('Asia/Kathmandu');
		$custom_widget->save();
		$widget = Widgets::where('custom_widget_id',$custom_widget['id'])->get();
		foreach ($widget as $key=>$w) 
		{
			$data[$key] = Widgets::find($w['id']);
			$data[$key]->deleted_at = Carbon::now('Asia/Kathmandu');
			$data[$key]->save();
		}
		$notification = array(
			'message' => 'Custom Widget Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->back()->with($notification);
	}
}
