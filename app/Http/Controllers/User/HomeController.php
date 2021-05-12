<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\UpdateUserProfile;
use App\Http\Requests\Frontend\UpdateUserPassword;
use App\Http\Requests\Frontend\CreateContactRequest;

use App\Http\Requests\Frontend\UploadProfilePhoto;
use App\Http\Requests\Frontend\UploadBanner;

use App\Models\Article;
use App\Models\ArabicArticle;
use App\Models\Download;
use App\Models\Role;
use App\Models\User;use App\Models\Plan;
use App\Models\Subscription;
use App\Models\EmailTemplate;
use App\Models\TempRequestUser;
use League\Csv\Writer;	
use Auth;
use Config;
use App\Models\CmsPage;
use Response;
use Hash;
use DB;
use DateTime;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
	//Records per page 
	protected $per_page;
	private $qr_code_path;
	public function __construct()
    {
		
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
	
	    $this->per_page = Config::get('constant.posts_per_page');;
		$this->report_path = public_path('/uploads/users');
    }
	
	public function setTableName(){
		
		if(Session::get('language') == 'ar'){
			$this->table = new ArabicArticle();
		}else{
			$this->table = new Article();
		}
		
	}
	
	public function home_page()
    {
		$this->setTableName();
		
		//phpinfo();die;
		$number_of_records =$this->per_page;
		$user = Auth::user();
		$forms = $this->table::where('type','form')->where('is_featured',1)->paginate(8);
		$infographics = $this->table::where('type','infographic')->where('is_featured',1)->paginate(8);
		$templates = $this->table::where('type','template')->where('is_featured',1)->paginate(8);
		
		$plans = Plan::where('status',1)->with('features')->orderBy('display_order','asc')->paginate(3);
		//pr($plans->toArray());
		if(isset($user) && !empty($user)){
			$Subscription = Subscription::where('user_id',$user->id)->where('status','ACTIVE')->first();
			return view('frontend.pages.home.landing',compact('plans','forms','infographics','templates','user','Subscription'));
		}else{
			return view('frontend.pages.home.landing',compact('plans','forms','infographics','templates','user'));
		}
		
    }
	public function allPlans(){
		$user = Auth::user();
		$plans = Plan::where('status',1)->with('features')->orderBy('display_order','asc')->get();
		
		return view('frontend.pages.home.all_plans',compact('plans','user'));
	}
	public function faq()
    {
		return view('frontend.pages.home.faq');
    }
	public function contact_us()
    {
		return view('frontend.pages.home.contact_us');
    }
	public function about_us()
    {
		$about_content = CmsPage::where('slug','about-us')->first();
		return view('frontend.pages.home.about_us',compact('about_content'));
    }
	public function terms_conditions()
    {
		$term_content = CmsPage::where('slug','terms-and-condition')->first();
		return view('frontend.pages.home.terms_conditions',compact('term_content'));
    }
	public function cookie_policy()
    {
		$cookie_content = CmsPage::where('slug','cookie-policy')->first();
		return view('frontend.pages.home.cookie_policy',compact('cookie_content'));
    }
	public function privacy_policy()
    {
		//pr($privacy_content->toArray());
		$privacy_content = CmsPage::where('slug','privacy-policy')->first();
		return view('frontend.pages.home.privacy_policy',compact('privacy_content'));
    }
	public function help()
    {
		$help = CmsPage::where('slug','help')->first();
		return view('frontend.pages.home.help',compact('help'));
    }
	public function documentation()
    {
		$documentation = CmsPage::where('slug','documentation')->first();
		return view('frontend.pages.home.documentation',compact('documentation'));
    }

	public function accessibility()
    {
		$accessibility = CmsPage::where('slug','accessibility')->first();
		return view('frontend.pages.home.accessibility',compact('accessibility'));
    }
	
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
	
	/*Submit Contact Form*/
    public function contact_submit(CreateContactRequest $request){
        $requestData = $request->all();
        $response = [];
        $response['success'] = false;
        $response['message'] = 'Invalid Request';
		
		if($request->all()){
            $name = $request->input('name');
            $from = $request->input('email');
            $subject = $request->input('subject');
            $contactMessage = $request->input('message');
            /*For sending contact mail to admin*/
            if($name !='' && $from !='' && $contactMessage !=''){
	            $admin  = 'info@namoothaj.net';
	            $admin1  = 'amit.webethics@gmail.com';
	            
	            $message = ucwords($name).' contacted you on Namoothaj by sending the following message : <br/>';
	            $message .= 'Email: '.$from.' <br/><br/>';
	            $message.=$contactMessage;
	            send_email($admin, $subject,$message, false);
	          	send_email($admin1, $subject, $message,false);

	            /*For sending contact successful message to user*/
	            $message = 'Thanks for contacting us! We will be right back to you soon.';
	            send_email($from, $subject,$message, false);

        	}

			$response['success'] = true;
            $response['message'] = 'Successfully submit form, we will contact you soon';
        }
		
	
        return Response::json($response, 200);
    }
	
	
	
	
	/* ==================================
* GET PLANS FROM  PAYPAL 
*  Update Plans is db
===========================================*/

	public function  getPaypalPlans($token){
	
		$url = $this->api_url . '/v1/billing/plans'; 
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.sandbox.paypal.com/v1/billing/plans",
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
	
}
