<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomWidgets;
use App\Footer;
use App\Contact;
use App\Widgets;
class FooterController extends Controller
{
	public function addFooterForm()
	{
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->get();
		return view('cd-admin.footerform.add-footer',compact('custom_widget'));
	}
	public function editFooterForm($id)
	{
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->get();
		$footer = Footer::find($id);
		$final = json_decode($footer['custom_widget_id']);
		return view('cd-admin.footerform.edit-footer',compact('final','footer','custom_widget'));
	}

	public function viewFooter()
	{
		$contact = Contact::where('deleted_at',NULL)->get()->first();
		$footer = Footer::where('deleted_at',NULL)->get()->first();
		$custom_widget = json_decode($footer['custom_widget_id']);
		$finalArray = [];
		if(isset($footer))
		{
			foreach($custom_widget as $key=>$c)
			{
				$custom = CustomWidgets::find($c->custom_widget_id);
				$widgets = Widgets::where('deleted_at',NULL)->where('custom_widget_id',$c->custom_widget_id)->get();
				$finalArray[$key]['name'] = $custom['name'];
				$finalArray[$key]['name_ne'] =$custom['name_ne'];
				$finalArray[$key]['widgets'] = $widgets;
			}
		}
		return view('cd-admin.footerform.view-footer',compact('finalArray','footer','contact'));
	}
	public function addFooter()
	{
		$custom_widget_title = Request()->custom_widget_title;
		$i = 0;
		while($custom_widget_title != NULL)
		{
			$a[$i]['custom_widget_id'] = $custom_widget_title[$i];
			unset($custom_widget_title[$i]);
			$i++;
		}
		$json_data = json_encode($a);
		$page_sidebar = new Footer();
		$page_sidebar->custom_widget_id = $json_data;
		$page_sidebar->save();
		$notification = array(
			'message' => 'Footer Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-footer')->with($notification);
	}

	public function editFooter($id)
	{
		$custom_widget_title = Request()->custom_widget_title;
		$i = 0;
		while($custom_widget_title != NULL)
		{
			$a[$i]['custom_widget_id'] = $custom_widget_title[$i];
			unset($custom_widget_title[$i]);
			$i++;
		}
		$json_data = json_encode($a);
		$page_sidebar = Footer::find($id);
		$page_sidebar->custom_widget_id = $json_data;
		$page_sidebar->save();
		$notification = array(
			'message' => 'Footer Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-footer')->with($notification);
	}


}
