<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutOfficeController extends Controller
{
	public function addAboutOfficeForm()
	{
		return view('cd-admin.aboutoffice.add-about-office-form');
	}

	public function viewAboutOffice()
	{
		return view('cd-admin.aboutoffice.view-about-office');
	}
	public function addOfficeAboutCard()
	{
		return view('cd-admin.aboutoffice.add-office-card-form');
	}
}
