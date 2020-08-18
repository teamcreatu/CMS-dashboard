<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomWidgets;
use App\PageSidebar;
use App\Widgets;
use App\Contact;
class PageSidebarController extends Controller
{
	public function addPageSidebarForm()
	{
		$custom_widget = CustomWidgets::where('deleted_at',NULL)->get();
		return view('cd-admin.page-sidebar.add-page-sidebar',compact('custom_widget'));
	}

	public function viewPageSidebar()
	{	
		$contact = Contact::where('deleted_at',NULL)->get()->first();
	$sidebar = PageSidebar::where('deleted_at',NULL)->get()->first();
	$custom_widget = json_decode($sidebar['custom_widget_id']);
	$finalArray = [];
	if(isset($sidebar))
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
	return view('cd-admin.page-sidebar.view-page-sidebar',compact('finalArray','sidebar','contact'));
}

public function editPageSidebarForm($id)
{
	$custom_widget = CustomWidgets::where('deleted_at',NULL)->get();
	$pageSidebar = PageSidebar::find($id);
	$final = json_decode($pageSidebar['custom_widget_id']);
	return view('cd-admin.page-sidebar.edit-page-sidebar',compact('final','pageSidebar','custom_widget'));
}

public function addPageSidebar()
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
	$page_sidebar = new PageSidebar();
	$page_sidebar->custom_widget_id = $json_data;
	$page_sidebar->save();
	$notification = array(
		'message' => 'Page Sidebar Added Successfully',
		'alert-type' => 'success',
	);
	return redirect()->route('view-page-sidebar')->with($notification);
}	

public function editPageSidebar($id)
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
	$page_sidebar = PageSidebar::find($id);
	$page_sidebar->custom_widget_id = $json_data;
	$page_sidebar->save();
	$notification = array(
		'message' => 'Page Sidebar Updated Successfully',
		'alert-type' => 'success',
	);
	return redirect()->route('view-page-sidebar')->with($notification);
}
}
