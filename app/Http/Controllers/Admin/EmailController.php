<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailTemplateRequest;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Storage;
use Auth;
use Config;
use Response;
use Session;
class EmailController extends Controller
{
	//private $photos_path;
	public function __construct()
    {
		//$this->photos_path = public_path('/uploads/logo/');
    }
   
	/*
	* SETTING LAYOUT 
	*/
    public function index()
    {
		access_denied_user('email_listing');
		$emailTemplate =  EmailTemplate::all();
        return view('admin.email.index',compact('emailTemplate'));
    }
	/*
	* CREATE EMAIL TEMPLATE 
	*/
	public function createEmail(){
		access_denied_user('email_create');

		$result = EmailTemplate::orderBy('id', 'DESC')->take(1)->first();

		return view('admin.email.add_email_template', compact('result'));
	}

	public function saveEmail(EmailTemplateRequest $request){

		$title = $request->input('title');
		$template_name = preg_replace('/\s+/', '_', strtolower($title));
	    $subject = $request->input('subject');
	    $description = $request->input('description');
	    // update email template
		$data = array('title'=>$title, 'template_name'=> $template_name, 'subject'=>$subject,'content'=>$description);
	
		$new_email  = EmailTemplate::insertGetId($data);
		if($new_email != 0)
		{
			Session::flash('success', 'Email Template has been Created.');
			return redirect('admin/emails'); 
		} else {
			Session::flash('error', 'Email Template has been Updated.');
			return redirect('admin/emails'); 
		}

	}

	/*
	* EDIT EMAIL TEMPLATE 
	*/
	public function email_template_edit($id){
		access_denied_user('email_edit');
		//display edit page of email template
			$result = EmailTemplate::where('id', '=' , $id)->get();
			
			return view('admin.email.edit_email' , compact('result'));
	}

	public function email_template_update(EmailTemplateRequest $request){

       
		 $email_id = $request->input('email_id');
		//check field validation
		
	    $title = $request->input('title');
	    $subject = $request->input('subject');
	    $description = $request->input('description');
	    // update email template
	    $data = array('title'=>$title,'subject'=>$subject,'content'=>$description);
	    $email_update  = EmailTemplate::where('id', '=', $email_id);
		
		$email_update->update($data);
		Session::flash('success', 'Email Template has been Updated.');
		return redirect('admin/email/edit/'.$email_id); 

	  
	}
	
}
