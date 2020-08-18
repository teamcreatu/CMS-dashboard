<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photos;
use App\Quotes;
use Carbon\Carbon;
class QuotesController extends Controller
{
   	public function addQuotesForm()
   	{
   		$photo = Photos::where('deleted_at',NULL)->get();
   		return view('cd-admin.quotes.add-quotes',compact('photo'));
   	}

   	public function viewQuotes()
   	{
   		$quotes = Quotes::where('deleted_at',NULL)->get();
   		return view('cd-admin.quotes.view-quotes',compact('quotes'));
   	}

   	   	public function editQuotesForm($id)
   	{
   		$data = Quotes::find($id);
   		$photo = Photos::where('deleted_at',NULL)->get();
   		return view('cd-admin.quotes.edit-quotes',compact('photo','data'));
   	}

   	public function addQuotes()
   	{
   		$data = Request()->validate([
   			'title' => 'required|max:200|unique:quotes',
   			'title_ne' => 'required|max:200|unique:quotes',
   			'summary' => 'required|max:600',
   			'summary_ne' => 'required|max:600',
   			'image_name' => 'required',
   			'status' => 'required',
   		]);
   		$quote = new Quotes();
   		$quote->title = $data['title'];
   		$quote->title_ne = $data['title_ne'];
   		$quote->summary = $data['summary'];
   		$quote->summary_ne = $data['summary_ne'];
   		$quote->image_url = $data['image_name'];
   		$quote->status = $data['status'];
   		$quote->save();
   		$notification = array(
			'message' => 'Quotes Added Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-quotes')->with($notification);
   	}

   	public function editQuotes($id)
   	{
   		$data = Request()->validate([
   			'title' => 'required|max:200',
   			'title_ne' => 'required|max:200',
   			'summary' => 'required|max:600',
   			'summary_ne' => 'required|max:600',
   			'image_name' => 'required',
   			'status' => 'required',
   		]);
   		$quote = Quotes::find($id);
   		$quote->title = $data['title'];
   		$quote->title_ne = $data['title_ne'];
   		$quote->summary = $data['summary'];
   		$quote->summary_ne = $data['summary_ne'];
   		$quote->image_url = $data['image_name'];
   		$quote->status = $data['status'];
   		$quote->save();
   		$notification = array(
			'message' => 'Quotes Updated Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-quotes')->with($notification);
   	}

   	public function updateStatus($id)
	{
		$data = Quotes::find($id);
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

	public function deleteQuotes($id)
	{
		$quotes = Quotes::find($id);
      $quotes->title = 'deleted__'.$quotes['title'];
      $quotes->title_ne = 'deleted__'.$quotes['title_ne'];
		$quotes->deleted_at = Carbon::now('Asia/Kathmandu');
		$quotes->save();
		$notification = array(
			'message' => 'Quotes Deleted Successfully',
			'alert-type' => 'success',
		);
		return redirect()->route('view-quotes')->with($notification);
	}

}
