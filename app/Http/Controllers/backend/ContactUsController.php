<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
class ContactUsController extends Controller
{
	public function addContactUsForm()
	{
		return view('cd-admin.contact-us.add-contact-us');
	}

	public function viewContactUs()
	{
		$contact = Contact::where('deleted_at',NULL)->first();
		return view('cd-admin.contact-us.view-contact-us',compact('contact'));
	}

	public function editContactUsForm($id)
	{
		$data = Contact::find($id);
		return view('cd-admin.contact-us.edit-contact-us',compact('data'));
	}

	public function addContactUs()
	{
		$data = Request()->validate([
			'description' => 'required',
			'description_ne' => 'required',
			'emergency_contact' =>'',
			'fb_link' => '',
			'tw_link' => '',
			'email_id' => '',
			'insta_link' => '',
			'status' => 'required',
		]);
		$contact = new Contact();
		$contact->description = $data['description'];
		$contact->description_ne = $data['description_ne'];
		$contact->status = $data['status'];
		if(isset($data['emergency_contact']))
		{
		$contact->emergency_contact = $data['emergency_contact'];
		}
		if(isset($data['fb_link']))
		{
		$contact->fb_link = $data['fb_link'];
		}
		if(isset($data['insta_link']))
		{
		$contact->insta_link = $data['insta_link'];
		}
		if(isset($data['tw_link']))
		{
		$contact->tw_link = $data['tw_link'];
		}	
		if(isset($data['email_id']))
		{
		$contact->email_id = $data['email_id'];
		}		
		$contact->save();
		$notification = array(
			'message' => 'Contact Us Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-contact-us')->with($notification);
	}

	public function editContactUs($id)
	{
		$data = Request()->validate([
			'description' => 'required',
			'description_ne' => 'required',
			'emergency_contact' => '',
			'fb_link' => '',
			'insta_link' => '',
			'tw_link' => '',
			'email_id' => '',
			'status' => 'required',
		]);
		$contact = Contact::find($id);
		$contact->description = $data['description'];
		$contact->description_ne = $data['description_ne'];
		$contact->status = $data['status'];
		$contact->emergency_contact = $data['emergency_contact']== NULL ? NULL : $data['emergency_contact'];
		$contact->fb_link = $data['fb_link']== NULL ? NULL : $data['fb_link'];
		$contact->insta_link = $data['insta_link']== NULL ? NULL : $data['insta_link'];
		$contact->tw_link = $data['tw_link']== NULL ? NULL : $data['tw_link'];
		$contact->email_id = $data['email_id']== NULL ? NULL : $data['email_id'];
		$contact->save();
		$notification = array(
			'message' => 'Contact Us Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-contact-us')->with($notification);
	}
}

