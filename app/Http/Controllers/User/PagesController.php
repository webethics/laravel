<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ConsignForm;
use App\Mail\ContactMail;
use App\Mail\FreeAppraisalsForm;
use App\Http\Requests\Frontend\CreateConsignRequest;
use App\Http\Requests\Frontend\CreateContactRequest;
use App\Http\Requests\Frontend\CreateFreeAppraisalsRequest;
use Response;
use App\Models\Category;
use Mail;
use App\Models\ConsignExperts;
use App\Models\Blog;
use App\Models\Auction;
use App\Models\EmailTemplate;
use App\Models\State;
use App\Models\City;
class PagesController extends Controller
{
    public function about()
    {
		return view('frontend.creaters.pages.about');	
    }

    public function consign($auction_cat){
		
		$result = ConsignExperts::where('auction_cat',$auction_cat)->where('status', '=', 1);
		$experts = $result->orderBy('sort_position')->get();
		
    	return view('frontend.creaters.pages.consign',compact('experts'));	
    }

 

    public function conditions(){
    	return view('frontend.creaters.pages.terms');
    }

    public function compliances(){
        return view('frontend.creaters.pages.compliances');
    }

    public function privacyPolicy(){
        return view('frontend.creaters.pages.privacyPolicy');
    }

    public function host(){
        return view('frontend.creaters.pages.host');
    }

    /*Submit Consign Form*/
    public function consign_submit(CreateConsignRequest $request){
        $requestData = $request->all();
        $response = [];
        $response['success'] = false;
        $response['message'] = 'Invalid Request';
		
		//print_r($requestData);
		$attachment_array =array();
		if(!empty($requestData['uploads_item_photo'])){
			//File Name
			$file = $requestData['uploads_item_photo'];
			foreach($file as $key=>$val){
			$file_name = $val->getClientOriginalName();
			$ext =$val->getClientOriginalExtension();
			$new_name = pathinfo($file_name, PATHINFO_FILENAME).'_'.microtime().'.'.$ext;
			//Move Uploaded File
			$destinationPath = public_path('uploads/consign_apprasial_img');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
				
			}
			$img_path = $destinationPath.'/'.$new_name; 
			$attachment_array[] =$img_path;
			public_path('uploads/consign_apprasial_img');
			$val->move($destinationPath,$new_name);
			chmod($destinationPath, 0777);
			chmod($img_path, 0777);
			}	
		}
		

        if(count($requestData) > 0){
            $personalData = [];
            $itemData = [];

            //$senderEmail = "priya.webethics@gmail.com";
            
            $senderEmail = "contact@bidum.eu";

            $personalKey = ['first_name','last_name','street_address','address_line','city','state','zipcode','email','primary_phone','secondary_phone','fax'];
            $itemKey = ['description','maker','year_of_manufacture','model','color','material','how_long_have_you_own_it','estimated_value','estimated_reserve','list_of_most_important_details_about_the_item'];

            
            foreach ($requestData as $key => $value) {
				if(!is_array($value)){
                if(!empty(trim($value))){
                    $key_text = str_replace("_"," ",$key);
                    $key_text = ucfirst($key_text);
                    if(in_array($key, $personalKey)){
                        $personalData[$key_text] = trim($value);
                    }elseif (in_array($key, $itemKey)) {
                        $itemData[$key_text] = trim($value);
                    }
                }
				}
            }
            
            $data = [
              'personalData'  => $personalData,
              'itemData' => $itemData,
            ];
            /*********** code written by Akram Chauhan  ***********/
            $message = view("email.newconsign",compact('data'))->render();
            $subject = 'New Consign Request';
            $mail = send_email($senderEmail, $subject, $message,'','',$attachment_array);
            /************** End **********************/
            if(count($attachment_array)>0){
				chmod($destinationPath, 0777);
				chmod($img_path, 0777);
				foreach($attachment_array as $key=>$val){
					@unlink($val);
				}
			}
            //Mail::to($senderEmail)->send(new ConsignForm($data));

            $response['success'] = true;
            $response['message'] = 'Successfully submit consign form, we will contact you soon';
        }
        return Response::json($response, 200);

    }

    /*Submit Contact Form*/
    public function contact_submit(CreateContactRequest $request){
        $requestData = $request->all();
        $response = [];
        $response['success'] = false;
        $response['message'] = 'Invalid Request';

        if(count($requestData) > 0){
            //$contactData = [];

            $senderEmail = "contact@bidum.eu";
            // foreach ($requestData as $key => $value) {
            //     if(!empty(trim($value))){
            //         $key_text = str_replace("_"," ",$key);
            //         $key_text = ucfirst($key_text);
            //         $contactData[$key_text] = trim($value);
            //     }
            // }
            
            // $data = [
            //   'contactData'  => $contactData
            // ];
            $logo = url('/frontend/images/logo.svg');
            //EMAIL REGISTER EMAIL TEMPLATE 
            $result = EmailTemplate::where('template_name','contact_form')->get();
            $subject = $result[0]->subject;
            $message_body = $result[0]->content;
            
            $list = Array
              ( 
                 '[CONTACT_NAME]' => $request->name,
                 '[CONTACT_EMAIL]' => $request->email,
                 '[CONTACT_MESSAGE]' => $request->message,
              );

            $find = array_keys($list);
            $replace = array_values($list);
            $message = str_ireplace($find, $replace, $message_body);
            
            $mail = send_email($senderEmail, $subject, $message);
            //Mail::to($senderEmail)->send(new ContactMail($data));

            $response['success'] = true;
            $response['message'] = 'Successfully submit form, we will contact you soon';
        }
        return Response::json($response, 200);
    }
	public function auction_info($id){
		
		$category_id = 0;
		$category = Category::where('id',$id)->first();
		
		if($category){
			$category_id = $category->id;
			$auctions = Auction::where('category_id',$category_id)->where('featured',1)->limit(4)->get();
			$resultBlog 	= Blog::where('status', '=', 1)->where('auction_cat',$category->auction_cat)->orderBy('id','desc')->first();
			//pr($auctions->toArray());die;
			if($auctions)
				return view('frontend.creaters.pages.auction_info',compact('auctions','category','resultBlog'));	
		}
		
	}
	
	// BLOG DETAIL PAGE 
	public function blog_details($slug){
		
		
		$result = Blog::where('status', '=', 1)->where('slug',$slug);
		$blog = $result->first();
		
		
		$next = Blog::where('id', '>', $blog->id)->first();
		$prev_id= Blog::where('id', '<', $blog->id)->max('id');
		
		$previous = Blog::where('id', $prev_id)->first();
		
		//print_r($previous); die;
		
    	return view('frontend.blog.detail',compact('blog','previous','next'));	
    }
	
	
	public function contact(){
		
    	return view('frontend.creaters.pages.contact');
    }
	
	public function how_to_sell(){
		
    	return view('frontend.creaters.pages.how_to_sell');
    }
	public function how_to_bid(){
    	return view('frontend.creaters.pages.how_to_bid');
    }
	public function how_to_buy(){
    	return view('frontend.creaters.pages.how_to_buy');
    }
	
	public function meetOurExperts(){
		
		$result = ConsignExperts::where('status', '=', 1);
		$experts = $result->orderBy('sort_position')->get();
    	return view('frontend.creaters.pages.meetOurExperts',compact('experts'));
    }
	
	public function freeAppraisals(){
		
    	return view('frontend.creaters.pages.freeAppraisals');
    }
	
	/*Submit Consign Form*/
    public function freeAppraisals_submit(CreateFreeAppraisalsRequest $request){
        $requestData = $request->all();
        $response = [];
        $response['success'] = false;
        $response['message'] = 'Invalid Request';
		
		//print_r($requestData);
		$attachment_array =array();
		if(!empty($requestData['uploads_item_photo'])){
			//File Name
			$file = $requestData['uploads_item_photo'];
			foreach($file as $key=>$val){
			$file_name = $val->getClientOriginalName();
			$ext =$val->getClientOriginalExtension();
			$new_name = pathinfo($file_name, PATHINFO_FILENAME).'_'.microtime().'.'.$ext;
			//Move Uploaded File
			$destinationPath = public_path('uploads/consign_apprasial_img');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
				
			}
			$img_path = $destinationPath.'/'.$new_name; 
			$attachment_array[] =$img_path;
			public_path('uploads/consign_apprasial_img');
			$val->move($destinationPath,$new_name);
			chmod($destinationPath, 0777);
			chmod($img_path, 0777);
			}	
		}
		

        if(count($requestData) > 0){
            $personalData = [];
            $itemData = [];

            $senderEmail = "contact@bidum.eu";

            $personalKey = ['first_name','last_name','street_address','address_line','city','state','zipcode','email','primary_phone','secondary_phone','fax'];
            $itemKey = ['description','maker','year_of_manufacture','model','color','material','how_long_have_you_own_it','estimated_value','estimated_reserve','list_of_most_important_details_about_the_item'];

            
            foreach ($requestData as $key => $value) {
				if(!is_array($value)){
                if(!empty(trim($value))){
                    $key_text = str_replace("_"," ",$key);
                    $key_text = ucfirst($key_text);
                    if(in_array($key, $personalKey)){
                        $personalData[$key_text] = trim($value);
                    }elseif (in_array($key, $itemKey)) {
                        $itemData[$key_text] = trim($value);
                    }
                }
				}
            }
            
            $data = [
              'personalData'  => $personalData,
              'itemData' => $itemData,
            ];

            /*********** code written by Akram Chauhan  ***********/
            $message = view("email.newconsign",compact('data'))->render();
            $subject = 'New Consign Request';
            $mail = send_email($senderEmail, $subject, $message,'','',$attachment_array);
            /************** End **********************/
            if(count($attachment_array)>0){
				chmod($destinationPath, 0777);
				chmod($img_path, 0777);
				foreach($attachment_array as $key=>$val){
					@unlink($val);
				}
			}
			
            //Mail::to($senderEmail)->send(new ConsignForm($data));

            $response['success'] = true;
            $response['message'] = 'Successfully submit Free Appraisals form, we will contact you soon';
        }
        return Response::json($response, 200);

    }
	
	public function schedule($auction_cat){
		//echo $slug;;die;
		$categories = Category::where('auction_cat',$auction_cat)->where('status',1)->orderBy('sale_start_on', 'ASC')->get();
		
		$upcoming_auction = array();
		foreach($categories as $key=>$value){
			$date = strtotime($value->sale_end_on);
			$now =strtotime("now"); 
			if($date >= $now){
				$upcoming_auction[] = $value;
			}
		}
		if($upcoming_auction)
			$number = count($upcoming_auction);
		//pr(@upcoming_auction->toArray());
    	return view('frontend.creaters.pages.schedule',compact('categories','upcoming_auction','number'));
    }
	
	public function getAllschedule($auction_cat=''){
		//echo $slug;;die;
		
		$categories = Category::where('status',1)->orderBy('sale_start_on', 'ASC')->get();
		
		$upcoming_auction = array();
		foreach($categories as $key=>$value){
			$date = strtotime($value->sale_end_on);
			$now =strtotime("now"); 
			if($date >= $now){
				$upcoming_auction[] = $value;
			}
		}
		if($upcoming_auction)
			$number = count($upcoming_auction);
		//pr(@upcoming_auction->toArray());
    	return view('frontend.creaters.pages.schedule',compact('categories','upcoming_auction','number'));
    }

    /****    get states by country    ****/
    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    /*****     get cities by state     *****/
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }

	
}
