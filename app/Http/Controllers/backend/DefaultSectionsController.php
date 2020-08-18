<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DefaultSection;
class DefaultSectionsController extends Controller
{
    public function viewDefaultSectionTitle()
    {
    	$data = DefaultSection::get();
    	return view('cd-admin.default_sections_title.view-default-sections-title',compact('data'));
    }

    public function editDefaultSectionTitle($id)
    {
    	$data =Request()->validate([
    		'title' => '',
    		'title_ne' => '',
    		'subtitle' => '',
    		'subtitle_ne' => '',
    	]);
    	$section = DefaultSection::find($id);
    	$section->title = $data['title'];
    	$section->title_ne = $data['title_ne'];
    	$section->subtitle = $data['subtitle'];
    	$section->subtitle_ne = $data['subtitle_ne'];
    	$section->save();
    	$notification = array(
			'message' => 'Default Section Title Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-default-section-title')->with($notification);
    }
}
