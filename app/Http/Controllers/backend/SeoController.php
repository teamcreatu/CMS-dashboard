<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seo;
use Auth;
use App\User;
class SeoController extends Controller
{

	public function viewSeo()
	{
		$seo = Seo::get();
		$users = User::where('deleted_at',NULL)->get();
		return view('cd-admin.seo.view-seo',compact('seo','users'));
	}
    public function addSeoForm()
    {
    	return view('cd-admin.seo.add-seo');
    }

    public function addSeo()
    {
    	$data = Request()->validate([
    		'title' => 'required|max:77',
    		'title_ne' => 'required|max:77',
    		'description' => 'max:160',
    		'description_ne' => 'max:160',
    		'keywords' => 'max:1000',
    		'keywords_ne' => 'max:1000',
    	]);
    	$seo = new Seo();
    	$seo->title = $data['title'];
    	$seo->title_ne = $data['title_ne'];
    	$seo->description = $data['description'];
    	$seo->description_ne = $data['description_ne'];
    	$seo->keywords = $data['keywords'];
    	$seo->keywords_ne = $data['keywords_ne'];
    	$seo->created_by = Auth::user()->id;
    	$seo->save();
    	$notification = array([
    		'message' => 'SEO Added Successfully',
    		'alert-type' => 'success',
    	]);
    	return redirect()->route('view-seo')->with($notification);
    }

    public function editSeoForm($id)
    {
    	$data = Seo::find($id);
    	return view('cd-admin.seo.edit-seo',compact('data'));
    }

    public function editSeo($id)
    {
    	$data = Request()->validate([
    		'title' => 'required|max:77',
    		'title_ne' => 'required|max:77',
    		'description' => 'max:160',
    		'description_ne' => 'max:160',
    		'keywords' => 'max:1000',
    		'keywords_ne' => 'max:1000',
    	]);
    	$seo =Seo::find($id);
    	$seo->title = $data['title'];
    	$seo->title_ne = $data['title_ne'];
    	$seo->description = $data['description'];
    	$seo->description_ne = $data['description_ne'];
    	$seo->keywords = $data['keywords'];
    	$seo->keywords_ne = $data['keywords_ne'];
    	$seo->created_by = Auth::user()->id;
    	$seo->save();
    	$notification = array([
    		'message' => 'SEO Updated Successfully',
    		'alert-type' => 'success',
    	]);
    	return redirect()->route('view-seo')->with($notification);
    }
}
