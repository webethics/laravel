<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\UpdateUserProfile;
use App\Http\Requests\Frontend\UpdateUserPassword;

use App\Http\Requests\Frontend\UploadProfilePhoto;
use App\Http\Requests\Frontend\UploadBanner;
use App\Models\Download;
use App\Models\Role;
use App\Models\User;
use Stripe;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\EmailTemplate;
use App\Models\TempRequestUser;
use App\Models\UserCard;

use League\Csv\Writer;	
use Auth;
use Config;
use Response;
use Hash;
use DB;
use PDF;
use DateTime;
use Session;
use Carbon\Carbon;

class UsersController extends Controller
{
	//Records per page 
	protected $per_page;
	private $qr_code_path;
	public function __construct()
    {
	  
        $this->per_page = Config::get('constant.per_page');
		$this->report_path = public_path('/uploads/users');
		
		if(config("paypal.paypal_mode") == 'sandbox'){
			$this->client_id = config("paypal.sandbox_client_id");
			$this->secret = config("paypal.sandbox_secret");
			$this->api_url = config("paypal.sandbax_api_url");
		}
		if(config("paypal.paypal_mode") == 'live'){
			$this->client_id = config("paypal.live_client_id");
			$this->secret = config("paypal.live_secret");
			$this->api_url = config("paypal.live_api_url");
		}
		
		

		/* if(config("foloosi.mode") == 'test'){
			$this->merchant_key = config("foloosi.test_merchant_key");
			$this->secret_key = config("foloosi.test_secret_key");
			
		}
		if(config("foloosi.mode") == 'live'){
			$this->merchant_key = config("foloosi.live_merchant_key");
			$this->secret_key = config("foloosi.live_secret_key");
		}
		

		$this->initialize_setup_api_url =  config("foloosi.initialize_setup_api_url");
		$this->transaction_list_api_url =  config("foloosi.transaction_list_api_url");
		 */
    }
	
	public function editProfile()
    {
	
		//Subscriber list 
		/* $user = User::where('id', auth::user()->id)->first();
		pr($user);
		$user = auth::user(); */
		
		return view('frontend.pages.account.edit_profile');
		
    }
	public function userProfile(){
	
		return view('frontend.pages.account.edit_profile');
	}
	
	public function userSubscription(){
		
		$getToken = $this->getPaypalAccessToken();
		 //IF TOKEN NOT RETURN THEN SHOW ERROR 
		 if($getToken['success']){
			$accessToken=$getToken['access_token'];
			$update_plan = $this->getPaypalPlans($accessToken);
		 }
		 $user = Auth::user();
		 $plans = Plan::where('status',1)->with('features')->orderBy('display_order','asc')->get();
		 $Subscription = Subscription::where("user_id",$user->id)->orderBy('id','desc')->first();
		 if($Subscription){
			if($Subscription->paymentMethod == 'Paypal'){
				$Subscription->plan = Plan::where('plan_id',$Subscription->plan_id)->first();
			}
			if($Subscription->paymentMethod == 'Stripe'){
				$Subscription->plan = Plan::where('stripe_plan_id',$Subscription->plan_id)->first();
			}
			return view('frontend.pages.account.billing_details',compact('user','Subscription'));
		}else{
			return view('frontend.pages.account.subscription',compact('plans','user','Subscription'));
		}

	}
	
	public function enableDisableUser(Request $request)
	{
		if($request->ajax()){
			$user = User::where('id',$request->user_id);

			$data =array();
			$data['renew_status'] =  $request->status;
			$user->update($data);
			
			// Show message on the basis of status 
			if($request->status==1)
			 $enable =true ;
			if($request->status==0)
			 $enable =false ;
		  
		   $result =array('success' => $enable);	
		   return Response::json($result, 200);
		}
		
	}
	
	public function pdfview(Request $request)
	{
		$user = Auth::user();
		$Subscription = Subscription::where("user_id",$user->id)->orderBy('id','desc')->first();
		if($Subscription->paymentMethod == 'Paypal'){
			$Subscription->plan = Plan::where('plan_id',$Subscription->plan_id)->first();
		}
		if($Subscription->paymentMethod == 'Stripe'){
			$Subscription->plan = Plan::where('stripe_plan_id',$Subscription->plan_id)->first();
		}
		
		view()->share('Subscription',$Subscription);
		
		$pdf = PDF::loadView('frontend.pages.account.pdfview');
		return $pdf->download('invoice.pdf');
		
		//return view('frontend.pages.account.pdfview');
	}
	
	public function userPayment($id){
		
		$getToken = $this->getPaypalAccessToken();
		//$getFoloosiToken = $this->getFoloosiAccessToken($id);
		 //IF TOKEN NOT RETURN THEN SHOW ERROR 
		 if($getToken['success']){
			$accessToken=$getToken['access_token'];
			$update_plan = $this->getPaypalPlans($accessToken);
		 }
		/*  if($getFoloosiToken['success']){
			$referenceToken=$getFoloosiToken['referenceToken'];
		 } */

		 $user = Auth::user();
	
		// $plans = Plan::with('features')->orderBy('display_order','asc')->paginate(15);
		$plans = Plan::where('status',1)->where("id",$id)->with('features')->orderBy('display_order','asc')->first();
		//pr($plans->toArray());
		 $Subscription = Subscription::where("user_id",$user->id)->orderBy('id','desc')->first();
		 
		return view('frontend.pages.account.payment',compact('plans','user','Subscription'));
	}

	public function userFoloosiPayment($id){
		
		$getToken = $this->getFoloosiAccessToken($id);
		 //IF TOKEN NOT RETURN THEN SHOW ERROR 
		 if($getToken['success']){
			$accessToken=$getToken['referenceToken'];
		 }
		 $user = Auth::user();
	
		// $plans = Plan::with('features')->orderBy('display_order','asc')->paginate(15);
		$plans = Plan::where('status',1)->where("id",$id)->with('features')->orderBy('display_order','asc')->first();
		//pr($plans->toArray());
		 $Subscription = Subscription::where("user_id",$user->id)->orderBy('id','desc')->first();
		 
		return view('frontend.pages.account.foloosi',compact('plans','user','Subscription', 'accessToken'));
	}
	
	public function updatePlan(Request $request){
    	$data = [];
        $data['success'] = false;
        $data['message'] = 'Something went wrong';

    	if($request->ajax()){
    		$request_data = $request->all();
		//	pr($request_data);
    		$user_id = auth::user()->id; 
    		$user = User::where('id',$user_id)->first();
			$plan_price = $request->price;
			$plan_type = $request->plan_type;
			if($plan_type == '0'){
				$validity = 'Monthly';
				$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s', $strtotime_subscription_start);
				$subscription_end = date('Y-m-d H:i:s', strtotime('1 month',$strtotime_subscription_start));
				$subscription_end_date = date('Y-m-d H:i:s', strtotime('1 month',$strtotime_subscription_start));
			}
      		if($plan_type == '1'){
				$validity = 'Yearly';
				$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s', $strtotime_subscription_start);
				$subscription_end = date('Y-m-d H:i:s', strtotime('1 year',$strtotime_subscription_start));
				$subscription_end_date = date('Y-m-d H:i:s', strtotime('1 year',$strtotime_subscription_start));
			}
      		if($plan_type == '2'){
				$validity = 'Lifetime';
				$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s', $strtotime_subscription_start);
				$subscription_end = date('Y-m-d H:i:s', strtotime('20 year',$strtotime_subscription_start));
				$subscription_end_date = ' - ';
			}
			
			
    		if($user){
				
    			if(!empty($request_data['plan'])){
		        	//$payment_method = $request_data['payment_method'];
		        	$stripe = Stripe::make(env('STRIPE_SECRET'));
					
		        	$plan = Plan::where('id',$request_data['plan'])->first();
					
		        	/*If plan exist*/
		        	if($plan){
		        		//check
		        		$oldSubscription = Subscription::where('user_id',$user_id)->first(); 
		        		/*Stripe Payment Method*/
			        	
			        		try{
				        		$customer_id = $user->stripe_customer_id;
				        		if(empty($customer_id)){
				        			$customer = $stripe->customers()->create([
						                'email' => $user->email,
						            ]);

						            if(!empty($customer)){
						            	$customer_id = $customer['id'];
						            }
				        		}
								
				        		if(!empty($customer_id))
				        		{
					        		//check token exist
				                	$cardTokenId = $request->get('stripeToken');
				                	$card = $stripe->cards()->create($customer_id, $cardTokenId);

				                	$cardId = $card['id'];

					                $userCard = [
					                    'stripe_card_id' => $card['id'],
					                    'last4' => $card['last4'],
					                    'user_id'=>$user_id
					                ];

					                //Save to db
					                $saveCard = UserCard::create($userCard);

					                //check if already subscription created
					                if($oldSubscription && !empty($oldSubscription->subscription_id)){
					                	$destroySubscription = $this->cancelStripePaymentSubscription($oldSubscription->subscription_id);
					                }

					                /*Create New Subscription*/
				                    $createSubscription = $stripe->subscriptions()->create($customer_id, [
									    'plan' => $plan->stripe_plan_id,
									]);

									$createSubscriptionId = $createSubscription['id'];

				                   /*  $users = User::find($user_id);
				                    //save db
				                    $users->stripe_customer_id = $customer_id;
				                    $users->plan_id = $request_data['plan'];
				                    $users->save(); */

				                    if(!empty($createSubscriptionId)){
					                	/*Save data to subscription table*/
					                	$subscription = [
					                		'user_id'=>$user_id,
					                		//'payment_method_id' => $payment_method,
					                		'status' => 'ACTIVE',
											'paymentMethod' => 'Stripe',
											'subscription_id' => $createSubscriptionId,
					                		'plan_id' => $plan->stripe_plan_id,
					                		'plan_price' => $plan_price,
					                		'subscription_start' => $subscription_start,
					                		'subscription_end' => $subscription_end,
					                	];
										
										
	
					                	$saveSubscription = Subscription::create($subscription);

					                	if($saveSubscription){
					                		
					                		$data['success'] = true;
					                		$data['message'] = 'Your Plan is successfully activated';
					                	}
					                }
				                }
				        	}catch (Exception $e) {
				                //Session::put('error',$e->getMessage());
				                $response['msg'] = $e->getMessage();
				                return $response;
				            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {

				                $response['msg'] = $e->getMessage();
				                return $response;
				            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
				                 $response['msg'] = $e->getMessage();
				                 return $response;
				           }
			        	
			        }
				}
			}
    	return Response::json($data, 200);
		}

    }
	
	public function cancelStripePaymentSubscription($subscription_id){
    	$subscription = Subscription::where('subscription_id',$subscription_id)->first();
		
    	if($subscription){
    		//check paymethod 
    		
    		$cancelStatus = $this->cancelStripeSubscription($subscription);
    	
    	}
		$updateSubscriber = Subscription::where('subscription_id',$subscription_id);
		$Subscriber =array();
		$Subscriber['status']='CANCELLED';
		$updateSubscriber->update($Subscriber);
    	return $cancelStatus;
    }

    public function cancelStripeSubscription($subscription){
    	$response['success'] = false;
    	$stripe = Stripe::make(env('STRIPE_SECRET'));
    	if(!empty($subscription)){
    		//get customer id
    		$user = Subscription::where('user_id',$subscription->user_id)->first();
    		if($user && !empty($user->stripe_customer_id) && !empty($subscription->subscription_id)){
    			$retrivesSbscription = $stripe->subscriptions()->find($user->stripe_customer_id, $subscription->subscription_id);
    			/*Check if subscribtion exist*/
    			if(!empty($retrivesSbscription['id'])){
    				$cancelSubscription = $stripe->subscriptions()->cancel($user->stripe_customer_id, $subscription->subscription_id);
    			}
    			$response['success'] = true;
    		}

    	}
    	return $response;
    }



	public function userDownloads(){
		$user = Auth::user();
		$downloads = Download::where("user_id",$user->id)->with('articles','arabic_articles')->get();
		//pr($downloads->toArray());
		return view('frontend.pages.account.downloads',compact('downloads'));
	}
	/*==================================================
	UPDATE USER PROFILE 
==================================================*/ 	
	public function UpdateEditProfile(UpdateUserProfile $request)
	{
		if($request->ajax()){
			$request->first_name;
			$id = auth::user()->id; 
			$data=array(
			'first_name'=>$request->first_name,
			'last_name'=>$request->last_name,
			);
			
			//check if other user take this name or not 
			$user = User::where('id','==',$id)->get();
			if(count($user) <=0){
				if($request->user_bio)
					$data['user_bio']=$request->user_bio;
					User::where('id',$id)->update($data);
					$result = array('success'=>true);
			}else{
				 $result = array('success'=>false);
			}	
			return Response::json($result, 200);
		}
    }
	
    
	//VERIFY ACCOUNT  
	public function verifyAccount($token)
    {
		
		$result = User::where('verify_token', '=' ,$token)->get();
		$notwork =false; 
		if(count($result)>0){
			if($result[0]->created_by == 0){
				$userUpdate = User::where('email',$result[0]->email);
				$data['verify_token'] =NULL;			
				$data['status'] =1;		
				$data['created_by'] = 1;
				$userUpdate->update($data);
				return redirect('login')->with('success','Your account is verified.');	;
			}else{
				$url_post = url('password/reset_new_user_password');
				$notwork =true;  
				return view('auth.passwords.reset',compact('token','notwork','url_post'));	
			}
			
		}else{
			 return redirect('login')->with('error','Your Link is not correct to reset password.');	;
		}
		
		
        	
    }
	public function passwordUpdate(UpdateUserPassword $request)
    {
		// IF AJAX
		if($request->ajax()){
			$data=array();
			$userData = user_data();
			$user_id = auth::user()->id; 
			$userUpdate = User::where('id',$user_id);
			$newPassword=$request->password; //NEW PASSWORD
			$hashed = $userData->password;  //DB PASSWORD
	   
			if(Hash::check($request->old_password, $hashed)){
				$hashed = Hash::make($newPassword);
				
				$data['password'] = $hashed;			
				$userUpdate->update($data);
				$result =array(
				'success' => true
				);	
			}else{
				$result =array(
				'success' => false,
				'errors' => array('old_password'=>'Password does not match.')
				);	
			}
			return Response::json($result, 200);
		}
    }	
	
    public function uploadProfilePhoto(UploadProfilePhoto $request)
    {
		// IF AJAX
		if($request->ajax()){
			$user_data =user_data();
			$user_id =$user_data->id;
			/***** Upload Crop profile *******/
			$image_file = $request->upload_profile_crop_file;
			list($type, $image_file) = explode(';', $image_file);
			list(, $image_file)      = explode(',', $image_file);
			$image_file = base64_decode($image_file);
			$image_name= time().'_profile_'.rand(100,999).'.png';

			//CREATE REPORT FOLDER IF NOT 
			if (!is_dir($this->report_path)) {
			mkdir($this->report_path, 0777);
			}
			//CREATE USER ID FOLDER 
			$user_id_path = $this->report_path.'/'.$user_id;
			if (!is_dir($user_id_path)) {
			mkdir($user_id_path, 0777);
			}

			if($user_data->profile_photo != NULL)
				@unlink($user_id_path.'/'.$user_data->profile_photo);

			file_put_contents($user_id_path.'/'.$image_name, $image_file);

			/****** Upload Original Photo ********/
			$original_image = $request->file('upload_profile_file');
				
			$new_name = rand() . '_original_profile.' . $original_image->getClientOriginalExtension();

			//CREATE REPORT FOLDER IF NOT 
			if (!is_dir($this->report_path)) {
				mkdir($this->report_path, 0777);
			}
			//CREATE USER ID FOLDER 
			$user_id_path = $this->report_path.'/'.$user_id;
			if (!is_dir($user_id_path)) {
				mkdir($user_id_path, 0777);
			}
			
			if($user_data->profile_original_photo != NULL)
		 		@unlink($user_id_path.'/'.$user_data->profile_original_photo);

			$original_image->move($user_id_path, $new_name);

			/***** Check if coach image exist and not empty *******/
			if(isset($request->upload_coache_crop_file) && !empty($request->upload_coache_crop_file)){

				$coach_image_file = $request->upload_coache_crop_file;
				list($type, $coach_image_file) = explode(';', $coach_image_file);
				list(, $coach_image_file)      = explode(',', $coach_image_file);
				$coach_image_file = base64_decode($coach_image_file);
				$coache_image_name= time().'_coache_profile_'.rand(100,999).'.png';

				//CREATE REPORT FOLDER IF NOT 
				if (!is_dir($this->report_path)) {
				mkdir($this->report_path, 0777);
				}
				//CREATE USER ID FOLDER 
				$user_id_path = $this->report_path.'/'.$user_id;
				if (!is_dir($user_id_path)) {
				mkdir($user_id_path, 0777);
				}

				if(isset($user_data->userProfile)){
					if(!empty($user_data->userProfile->coache_photo))
						@unlink($user_id_path.'/'.$user_data->userProfile->coache_photo);
				}
				file_put_contents($user_id_path.'/'.$coache_image_name, $coach_image_file);

				$userProfile = UserProfile::updateOrCreate([
				    //Add unique field combo to match here
				    //For example, perhaps you only want one entry per user:
				    'user_id'   => $user_id,
				],[
				    'coache_photo' => $coache_image_name
				]);
			}
			
			//$image->move($user_id_path, $new_name);
			$userUpdate = User::where('id',$user_id);
			$data['profile_photo'] = $image_name;
			$data['profile_original_photo'] = $new_name;		
			$userUpdate->update($data);
			$path = url('uploads/users').'/'.$user_id.'/'.$image_name;

			//$image_url  =  timthumb($path,140,140);
			$image_url  =  $path;


			return response()->json([
			'success'=>true,
			'message' => 'Image Upload Successfully',
			'image_url'  => $image_url
			]);  
				
		}
    }

	
	public function uploadBannerPhoto(UploadBanner $request)
    {
		// IF AJAX
		if($request->ajax()){
				/*** Banner Original File ***/
				$image = $request->file('upload_banner_file');
				// pr($image->getClientOriginalName());
				//$document_type = $request->document_type;
				$new_name = rand() . '_original_banner.' . $image->getClientOriginalExtension();
				
				$user_data =user_data();
				$user_id =$user_data->id;
			
					
				//CREATE REPORT FOLDER IF NOT 
				if (!is_dir($this->report_path)) {
					mkdir($this->report_path, 0777);
				}
				//CREATE USER ID FOLDER 
				$user_id_path = $this->report_path.'/'.$user_id;
				if (!is_dir($user_id_path)) {
					mkdir($user_id_path, 0777);
				}
				
				if($user_data->banner_original_photo != NULL)
			 		@unlink($user_id_path.'/'.$user_data->banner_original_photo);

				$image->move($user_id_path, $new_name);

				/**** Upload Banner Crop Image ******/
				$banner_crop_file = $request->upload_banner_crop_file;
				if(!empty($banner_crop_file)){
					list($type, $banner_crop_file) = explode(';', $banner_crop_file);
					list(, $banner_crop_file)      = explode(',', $banner_crop_file);
					$banner_crop_file = base64_decode($banner_crop_file);
					$image_name= time().'_banner_'.rand(100,999).'.png';

					//CREATE REPORT FOLDER IF NOT 
					if (!is_dir($this->report_path)) {
						mkdir($this->report_path, 0777);
					}
					//CREATE USER ID FOLDER 
					$user_id_path = $this->report_path.'/'.$user_id;
					if (!is_dir($user_id_path)) {
						mkdir($user_id_path, 0777);
					}

					if($user_data->banner_photo != NULL)
						@unlink($user_id_path.'/'.$user_data->banner_photo);

					file_put_contents($user_id_path.'/'.$image_name, $banner_crop_file);
				}

				$userUpdate = User::where('id',$user_id);
				$data['banner_original_photo'] = $new_name;	
				$data['banner_photo'] = $image_name;			
			    $userUpdate->update($data);
				$path = url('uploads/users').'/'.$user_id.'/'.$image_name;
				
                //$image_url  =  timthumb($path,448,155);
                $image_url = $path;
				
				  return response()->json([
				   'success'=>true,
				   'message' => 'Image Upload Successfully',
				   'image_url'  => $image_url
				  ]); 
				
		}
    }

	public function saveSubscriptionData(Request $request){
		
		if($request->ajax()){
			if(isset($request->plan_id) && !empty($request->plan_id)){
				$get_amount = Plan::where('plan_id',$request->plan_id)->first();
				$plan_price = $get_amount->price;
			}else{
				$plan_price = $request->plan_price;
			}
			$plan_type = $request->plan_type;
			if($plan_type == '0'){
				$validity = 'Monthly';
				$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s', $strtotime_subscription_start);
				$subscription_end = date('Y-m-d H:i:s', strtotime('1 month',$strtotime_subscription_start));
				$subscription_end_date = date('Y-m-d H:i:s', strtotime('1 month',$strtotime_subscription_start));
			}
      		if($plan_type == '1'){
				$validity = 'Yearly';
				$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s', $strtotime_subscription_start);
				$subscription_end = date('Y-m-d H:i:s', strtotime('1 year',$strtotime_subscription_start));
				$subscription_end_date = date('Y-m-d H:i:s', strtotime('1 year',$strtotime_subscription_start));
			}
      		if($plan_type == '2'){
				$validity = 'Lifetime';
				$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s', $strtotime_subscription_start);
				$subscription_end = date('Y-m-d H:i:s', strtotime('20 year',$strtotime_subscription_start));
				$subscription_end_date = ' - ';
			}
			
			$user_id = user_data()->id;
			
			$subscription_data = Subscription::where('user_id',$user_id)->first();
			
			
			
			if($subscription_data){
				//Cancel Previous Subscription First 
				
				$getToken = $this->getPaypalAccessToken();
				//IF TOKEN NOT RETURN THEN SHOW ERROR 
				if(!$getToken['success']){
					$result = array('success'=>false,'msg'=>$getToken['msg']);	
					return Response::json($result,200);
				}
				$accessToken=$getToken['access_token']; ;
				$headers = array(
						'Content-Type: application/json',
						 'Authorization: Bearer ' . $accessToken
				);
				
				$subscription_id= $subscription_data->subscription_id;
				$urln = $this->api_url .'/v1/billing/subscriptions/'.$subscription_id;
				$curl = curl_init($urln);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POST, false);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				$response1 = curl_exec($curl);
				//$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				$SubsResponse = json_decode($response1);
				//echo 'hfghgf';
				//pr($SubsResponse);
				if(curl_errno($curl)){
							//If an error occured, throw an Exception.
							 $result['success']=false;
							 $result['msg']='Request Error:' . curl_error($curl);
							 $result['access_token']='';
							 return Response::json($result,200);
				}
				
				//IF SUBSCRIPTION IS ACTIVE ON PAYPAL THEN CANCEL SUBSCRIPTION
				if($SubsResponse->status=='ACTIVE'){			

					$urln1 = $this->api_url .'/v1/billing/subscriptions/'.$subscription_id.'/cancel';
					$curl1 = curl_init($urln1);
					curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl1, CURLOPT_POST, true);
					curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
					$response2 = curl_exec($curl1);
					$http_code = curl_getinfo($curl1, CURLINFO_HTTP_CODE);
					if(curl_errno($curl1)){
								//If an error occured, throw an Exception.
								 $result['success']=false;
								 $result['msg']='Request Error:' . curl_error($curl1);
								 $result['access_token']='';
								 return Response::json($result,200);
					}
					if($http_code==204){
						$updateSubscriber = Subscription::where('id',$subscription_id)->where('status','ACTIVE');
						$Subscriber =array();
						$Subscriber['status']='CANCELLED';
						$updateSubscriber->update($Subscriber); 
						//$updateSubscriber->delete();
						// $result['success']=true;
						// $result['msg']='Subscription Cancel SuccessFully';
						// return Response::json($result,200);			
					}	
					
				}else{
					$result['success']=false;
					$result['msg']='Something went wrong.';
					return Response::json($result,200);		
				} 
				
				
				$subscriber  = Subscription::where('user_id',$user_id)/*->where('status','CANCELLED')*/;
				//SET DATA TO SAVE SUBSCRIPTION 
				$user_id = user_data()->id;
				$subscription_price = $plan_price ;
				$subscribed_user = $request->user_id;
				$new_Subscriber = array();
				$new_Subscriber['subscription_id']   	= $request->subscription_id;
				$new_Subscriber['plan_id']  			= $request->plan_id;
				$new_Subscriber['user_id']  			= $subscribed_user;
				$new_Subscriber['paymentMethod']  		= 'Paypal';
				$new_Subscriber['payer_name']   		= $request->PayerName;
				$new_Subscriber['payer_mail']   		= $request->PayerMail;
				$new_Subscriber['payer_id']   		= $request->payer_id;
				$new_Subscriber['plan_price']   		= $subscription_price;
				$new_Subscriber['status']  			= $request->status;
				$new_Subscriber['subscription_start']   = $subscription_start;
				$new_Subscriber['subscription_end']   = $subscription_end;
				$subscriber->update($new_Subscriber);
			}else{
				
				$new_Subscriber  = new Subscription;
				//SET DATA TO SAVE SUBSCRIPTION 
				$user_id = user_data()->id;
				$subscription_price = $plan_price ;
				$subscribed_user = $request->user_id;
				
				$new_Subscriber->subscription_id   	= $request->subscription_id;
				$new_Subscriber->plan_id  			= $request->plan_id;
				$new_Subscriber->user_id  			= $subscribed_user;
				$new_Subscriber->paymentMethod  	= 'Paypal';
				$new_Subscriber->payer_name   		= $request->PayerName;
				$new_Subscriber->payer_mail   		= $request->PayerMail;
				$new_Subscriber->payer_id   		= $request->payer_id;
				$new_Subscriber->plan_price   		= $subscription_price;
				$new_Subscriber->status   			= $request->status;
				
				$new_Subscriber->subscription_start   = $subscription_start;
				$new_Subscriber->subscription_end   = $subscription_end;
				$new_Subscriber->save();
				
			}
			
			
            if($request->PayerName != ''){
				$mailData['payuser'] = $request->PayerName;
			} else {
				$mailData['payuser'] = 'User';
			}
			$mailData['total'] = $subscription_price;
			$mailData['plan_id'] = $request->plan_id;
			$mailData['planname'] = $request->planname;
			
			
			$uname = user_data()->first_name.' '.user_data()->last_name;
			if($uname != ''){
				$uname = $uname;
			} else {
				$uname = 'User';
			}
			//$token = getToken();
			$logo = url('/frontend/images/logo.png');
			$to = user_data()->email;
			//EMAIL REGISTER EMAIL TEMPLATE 
			$result = EmailTemplate::where('template_name','invoice')->get();
			$subject = $result[0]->subject;
      		$message_body = $result[0]->content;
      		
      		$list = Array
              ( 
                 '[NAME]' => $uname,
				 '[PAYERNAME]' => $request->PayerName,
				 '[PAYEREMAIL]' =>  $request->PayerMail,
				 '[PAYERID]' =>  $request->payer_id,
				 '[PLANSTART]' => $subscription_start,
				 '[PLANEND]' => $subscription_end_date,
				 '[PLANTIME]' => $validity,
				 '[BILLINGDATE]' => $subscription_end_date,
				 '[TOTAL]' => '$'.$subscription_price.' USD',
				 '[PLANID]' => $request->plan_id,
                 '[LOGO]' => $logo,
              );

      		$find = array_keys($list);
      		$replace = array_values($list);
      	    $message = str_ireplace($find, $replace, $message_body);
			
			//$mail = send_email($to, $subject, $message, $from, $fromname);
			
			$mail = send_email($to, $subject, $message);
			
			
			$result['success']=true;
			$result['msg']='User Subscribed SuccessFully';
			return Response::json($result,200);			
		}
		
	}

	public function saveFoloosiSubscriptionData(Request $request){
	
			if(isset($request->plan_id) && !empty($request->plan_id)){
				$get_amount = Plan::where('plan_id',$request->plan_id)->first();
				$plan_price = $get_amount->price;
			}else{
				$plan_price = $request->plan_price;
			}
			
			$plan_type = $request->plan_type;
			
			if($plan_type == '0'){
				$validity = 'Monthly';
				//$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s');
				$subscription_end = date('Y-m-d H:i:s', strtotime('1 month',strtotime($subscription_start)));
				$subscription_end_date = date('Y-m-d H:i:s', strtotime('1 month',strtotime($subscription_start)));
			}
      		if($plan_type == '1'){
				$validity = 'Yearly';
				//$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s');
				
				$subscription_end = date('Y-m-d H:i:s', strtotime('1 year',strtotime($subscription_start)));
				$subscription_end_date = date('Y-m-d H:i:s', strtotime('1 year',strtotime($subscription_start)));
				
			}
      		if($plan_type == '2'){
				$validity = 'Lifetime';
				//$strtotime_subscription_start = strtotime($request->CreateTime);
				$subscription_start = date('Y-m-d H:i:s');
				$subscription_end = date('Y-m-d H:i:s', strtotime('20 year',strtotime($subscription_start)));
				$subscription_end_date = ' - ';
			}
			
			
			$user_id = user_data()->id;
			
			$subscription_data = Subscription::where('user_id',$user_id)->first();
			
			$new_Subscriber  = new Subscription;
			//SET DATA TO SAVE SUBSCRIPTION 
			$user_id = user_data()->id;
			$subscription_price = $plan_price ;
			$subscribed_user = $request->user_id;

			//echo $request->status;
			//die();

			if($request->status == 'success'){
			
			$new_Subscriber->subscription_id   	= $request->subscription_id;
			$new_Subscriber->plan_id  			= $request->plan_id;
			$new_Subscriber->user_id  			= $subscribed_user;
			$new_Subscriber->paymentMethod  	= 'Foloosi';
			$new_Subscriber->payer_name   		= $request->PayerName;
			$new_Subscriber->payer_mail   		= $request->PayerMail;
			$new_Subscriber->payer_id   		= $request->subscription_id;
			$new_Subscriber->plan_price   		= $subscription_price;
			$new_Subscriber->status   			= 'ACTIVE';
			
			$new_Subscriber->subscription_start   = $subscription_start;
			$new_Subscriber->subscription_end   = $subscription_end;
			$new_Subscriber->save();
			
			}
				
			
			$mailData['payuser'] = $request->PayerName;
			$mailData['total'] = $subscription_price;
			$mailData['plan_id'] = $request->plan_id;
			$mailData['planname'] = $request->planname;
			
			
			$uname = user_data()->first_name.' '.user_data()->last_name;
			//$token = getToken();
			$logo = url('/frontend/images/logo.png');
			$to = user_data()->email;
			//EMAIL REGISTER EMAIL TEMPLATE 
			$result = EmailTemplate::where('template_name','invoice')->get();
			$subject = $result[0]->subject;
      		$message_body = $result[0]->content;
      		
      		$list = Array
              ( 
                 '[NAME]' => $uname,
				 '[PAYERNAME]' => $request->PayerName,
				 '[PAYEREMAIL]' =>  $request->PayerMail,
				 '[PAYERID]' =>  $request->payer_id,
				 '[PLANSTART]' => $subscription_start,
				 '[PLANEND]' => $subscription_end_date,
				 '[PLANTIME]' => $validity,
				 '[BILLINGDATE]' => $subscription_end_date,
				 '[TOTAL]' => '$'.$subscription_price.' USD',
				 '[PLANID]' => $request->plan_id,
                 '[LOGO]' => $logo,
              );

      		$find = array_keys($list);
      		$replace = array_values($list);
      	    $message = str_ireplace($find, $replace, $message_body);
			
			//$mail = send_email($to, $subject, $message, $from, $fromname);
			
			$mail = send_email($to, $subject, $message);
			
			
			$result['success']=true;
			$result['msg']='User Subscribed SuccessFully';
			return $result;			
		
		
	}


   //logout 	
   public function logout()
    {
		 \Auth::logout();
		 Session::put('is_admin_login', '');
		 Session::put('admin_user_id', '');
		 return redirect('/');
		
    }
	
	public function changelanguage($locale){
		Session::put('language', $locale);
		echo $locale;
		return redirect()->back();
	}
	 
	function password_generate($chars) 
	{
	  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
	  return substr(str_shuffle($data), 0, $chars);
	}
	
	/* ==================================
* GET ACCESS TOKEN FROM  PAYPAL 
*  RETURN  access_token
===========================================*/

	public function  getPaypalAccessToken(){
	
		$url = $this->api_url . '/v1/oauth2/token'; 
		$username = $this->client_id;   //Client ID
		$password = $this->secret;     //secret ID
		$headers = array(
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Basic '. base64_encode("$username:$password")
			);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS , rawurldecode(http_build_query(array(
			'grant_type' => 'client_credentials'
		  ))));
		
		 $response = curl_exec($ch);
		 $result =array();
		 if(curl_errno($ch)){
			//If an error occured, throw an Exception.
			 $result['success']=false;
			 $result['msg']='Request Error:' . curl_error($ch);
			 $result['access_token']='';
		}else{
			$json = json_decode($response);
			$accessToken = $json->access_token;
			 $result['success']=true;
			 $result['msg']='';
			 $result['access_token']=$accessToken;
		}
		//pr($response)
		return $result;
		
		
	}

	public function  getFoloosiAccessToken($id){
	
		$url = $this->initialize_setup_api_url ; 
		$merchant_key = $this->merchant_key ;
		$secret_key = $this->secret_key ;
	
		$headers = array(
			'Content-Type: application/json',
			'merchant_key: '. $merchant_key
		);

		$user = Auth::user();


		$planPrice = $this->getPlanPrice($id);

		$postFields = array(
			"transaction_amount" => $planPrice, 
			"currency" => "AED", 
			"customer_name" => $user->first_name.' '. $user->last_name , 
			"customer_email" => $user->email , 
			"customer_mobile" => $user->mobile_number
		);
	
		$postFields = json_encode($postFields);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS , $postFields );

		$response = curl_exec($ch);
		$result =array();
		if(curl_errno($ch)){
			//If an error occured, throw an Exception.
			 $result['success']=false;
			 $result['msg']='Request Error:' . curl_error($ch);
			 $result['access_token']='';
		}else{
			$json = json_decode($response);
			//echo "<pre>";
			//echo  $json->data->reference_token;
			//print_r($json);
			//die();
			$referenceToken = $json->data->reference_token;
			 $result['success']=true;
			 $result['msg']='';
			 $result['referenceToken']=$referenceToken;
		}
		//pr($response)
		return $result;
		
		
	}

	public function  getPlanPrice($id){
		$planData = Plan::where('id', $id )->first();
		$planPrice = $planData->price;
		return $planPrice;
	}
	
	
	
	
	/* ==================================
* GET PLANS FROM  PAYPAL 
*  Update Plans is db
===========================================*/

	public function  getPaypalPlans($token){
	
		$url = $this->api_url . '/v1/billing/plans'; 
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer $token",
			"cache-control: no-cache",
			"content-type: application/json",
		  ),
		));

		$response = curl_exec($curl);
		 if(curl_errno($curl)){
			//If an error occured, throw an Exception.
			 $result['success']=false;
			 $result['msg']='Request Error:' . curl_error($curl);
		}else{
			$json = json_decode($response);
			if(isset($json) && !empty($json)){
				foreach($json->plans as $val){
					$get_plan = Plan::where('title', $val->name)->first();
					if(isset($get_plan)){
						$get_plan->plan_id = $val->id;
						$get_plan->save();
					}
				}
			}
			$result['success']=true;
			$result['msg']='';
		}
		//pr($response)
		return $result;
		
		
	}
	
				
/*===========================================================
    OPEN CANCEL SUBSCRIPTION MODAL 
==============================================================*/	
	public function openCancelSubscriptionModal(Request $request)
    {
        $subscription_id   = $request->subscription_id;
		$subscription_data = Subscription::where('subscription_id',$subscription_id)->where('status','ACTIVE')->get();

		$subscription_data=$subscription_data[0];
		$view = view("modal.cancel_subscription_modal",compact('subscription_data'))->render();
		$success = true;
		
		 return Response::json(array(
		  'success'=>$success,
		  'data'=>$view
		 ), 200); 
   }
   
   
/* ======================================================
* CANCEL SUBSCRIPTION 
=============================================================*/
    public function cancelSubscription(Request $request){

		$subscriptionId= $request->subscription_id;
		$subscription_data = Subscription::where('id',$subscriptionId)->where('status','ACTIVE')->get();
	
		//GET TOKEN 
        $getToken = $this->getPaypalAccessToken();
		 //IF TOKEN NOT RETURN THEN SHOW ERROR 
		 if(!$getToken['success']){
			$result = array('success'=>false,'msg'=>$getToken['msg']);	
            return Response::json($result,200);
		 }
		$accessToken=$getToken['access_token']; ;
		$headers = array(
				'Content-Type: application/json',
				 'Authorization: Bearer ' . $accessToken
		);
		
		//UPDATE PLAN PRICE 
		if(count($subscription_data)>0 && $subscription_data[0]->subscription_id !=''){
		
			$subscription_id = $subscription_data[0]->subscription_id;
			$urln = $this->api_url .'/v1/billing/subscriptions/'.$subscription_id;
			$curl = curl_init($urln);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, false);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			$response1 = curl_exec($curl);
			//$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			$SubsResponse = json_decode($response1);
			//echo 'hfghgf';
			//pr($SubsResponse);
			if(curl_errno($curl)){
						//If an error occured, throw an Exception.
						 $result['success']=false;
						 $result['msg']='Request Error:' . curl_error($curl);
						 $result['access_token']='';
						 return Response::json($result,200);
			}
			
			//IF SUBSCRIPTION IS ACTIVE ON PAYPAL THEN CANCEL SUBSCRIPTION
			if($SubsResponse->status=='ACTIVE'){			

				$urln1 = $this->api_url .'/v1/billing/subscriptions/'.$subscription_id.'/cancel';
				$curl1 = curl_init($urln1);
				curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl1, CURLOPT_POST, true);
				curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);
				$response2 = curl_exec($curl1);
				$http_code = curl_getinfo($curl1, CURLINFO_HTTP_CODE);
				if(curl_errno($curl1)){
							//If an error occured, throw an Exception.
							 $result['success']=false;
							 $result['msg']='Request Error:' . curl_error($curl1);
							 $result['access_token']='';
							 return Response::json($result,200);
				}
				if($http_code==204){
					$updateSubscriber = Subscription::where('id',$subscriptionId)->where('status','ACTIVE');
					$Subscriber =array();
					$Subscriber['status']='CANCELLED';
					$updateSubscriber->update($Subscriber); 
					//$updateSubscriber->delete();
					$result['success']=true;
					$result['msg']='Subscription Cancel SuccessFully';
					return Response::json($result,200);			
				}	
				
			}else{
						$result['success']=false;
						$result['msg']='Something went wrong.';
						return Response::json($result,200);		
			} 
			
		}	
		
		//IF FREE SUBSCRIPTION THEN DELETE DATA FROM SUBSCRIBER TABLE 
		if(count($subscription_data)>0 && ($subscription_data[0]->subscription_id =='' || $subscription_data[0]->subscription_id==NULL)){
			$deleteSubscriber = Subscription::where('id',$subscriptionId)->where('status','ACTIVE');
			$deleteSubscriber->forceDelete();
			$result['success']=true;
			$result['msg']='UnSubscribed SuccessFully';
			return Response::json($result,200);			
		}
	}


    /*Send Reminder Email*/
    public function scheduledReminderEmail(){

		$subscriptions = Subscription::where('paymentMethod', 'Foloosi')->get();
		

        if(!is_null($subscriptions) && count($subscriptions)>0){
			
            foreach ($subscriptions as $key=>$subscription){
                $date = Carbon::parse($subscription['subscription_end']);
                $now = Carbon::now();

				$diff = $date->diffInDays($now);
				//echo $diff."......";
				//echo $now."......";
				//echo $date.".....<br/>";

				$link = 'https://www.foloosi.com/merchant/login';

                if(($now < $date) && ( $diff == 10 || $diff == 5 || $diff == 0 )){
                    //send reminder mail to foloosi users
                    $user_data = User::where('id', $subscription['user_id'])->first();
					$uname =$user_data->first_name.' '.$user_data->last_name;
					//$token = getToken();
					$logo = url('/frontend/images/logo.png');
					$to = $user_data->email;
					//EMAIL REGISTER EMAIL TEMPLATE 
					$result = EmailTemplate::where('template_name','foloosi_subscription_reminder')->get();
					$subject = $result[0]->subject;
					$message_body = $result[0]->content;
					
					$list = Array
						( 
							'[NAME]' => $uname,
							'[PAYERNAME]' => $subscription['payer_name'],
							'[PAYEREMAIL]' =>  $subscription['payer_mail'],
							'[PAYERID]' =>  $subscription['payer_id'],
							'[PLANSTART]' => $subscription['subscription_start'],
							'[PLANEND]' => $subscription['subscription_end'],
							'[BILLINGDATE]' => $subscription['subscription_end'],
							'[TOTAL]' => '$'.$subscription['plan_price'].' USD',
							'[PLANID]' => $subscription['plan_id'],
							'[LOGO]' => $logo,
							'[DAYS]' => $diff,
							'[LINK]' => $link,
						);

					$find = array_keys($list);
					$replace = array_values($list);
					$message = str_ireplace($find, $replace, $message_body);
					
					//$mail = send_email($to, $subject, $message, $from, $fromname);
					
					$mail = send_email($to, $subject, $message);
					
					
					$result['success']=true;
					$result['msg']='Foloosi Subscription Expiration Reminder mail sent successFully';
					echo "<pre>";
					echo $result['msg'];	
				}
            }
        }

	}	
  
}
