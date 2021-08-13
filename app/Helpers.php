<?php
//use DB;

//namespace App\Http\Middleware;
use App\Models\Role;
use App\Models\User;
use App\Models\RolesPermission;
use App\Models\PermissionList;
use App\Models\Setting;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Notification;
use App\Models\EmailTemplate;
use App\Models\Subscription;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\StateList;
use App\Models\CityLists;
use App\Models\Company;
use App\Models\Plan;
use Carbon\Carbon;
use App\Models\Bidder;
use App\Models\Leads;
use App\Models\Upwork_id;

use Illuminate\Support\Str;


/**

* [To encode string]

* @param string $str

*/

if ( ! function_exists('encoding')) {

    function encoding($str){

        $one = serialize($str);

        $two = @gzcompress($one,9);

        $three = addslashes($two);

        $four = base64_encode($three);

        $five = strtr($four, '+/=', '-_.');

        return $five;

    }

}


function banner_photo($user_id){
	
	      $user_data = User::where('id',$user_id)->get();
		  $banner_image =   url('/uploads/users').'/'. $user_data[0]->id .'/'. $user_data[0]->banner_photo;
		  return $banner_image ;

}

//use Config;
// Return User Role ID 
function current_user_role_id(){
	$user = \Auth::user();
	return $user->role_id;
}

function current_user_role_name(){
	$user = \Auth::user();
	$role = Role::where('id',$user->role_id)->get();
	return $role[0]->slug;
} 
/* Get Loggedin User data */
function user_data(){
	$user = \Auth::user();
	return $user;
}

/* Get Current User ID */
function user_id(){
	$user = \Auth::user();
	return $user->id;
}

/* Get User data by ID  */
function user_data_by_id($id){
	$userData = User::where('id',$id)->get();
	return $userData[0];
}

/* Explode by  */
function explodeTo($sign,$data){
	$exp = explode($sign,$data);
	return $exp;
}


function role_data_by_id($id){
	$role = Role::where('id',$id)->get();
	return $role[0];
} 



/* Exploade by |  */ 
function split_to_array($sign,$data){
		$data = explode($sign,$data);
		return $data;
}

/* ================================
   If double authentication not set then redirect to below routes of user role base 
============================*/
function redirect_route_name(){
	
	  $role_id = Config::get('constant.role_id');
	  $user_id =user_id();
	  $user_data = user_data_by_id($user_id);
			
	  if(is_null($user_data->otp)){
		  
	   // IF DATA_ADMIN/DATA_ANALYST/CUSTOMER_USER/CUSTOMER_ADMIN 
	   
	   if($role_id['SUPER_ADMIN']== current_user_role_id()){
		  return 'admin/dashboard'; 
	   }
	   else if($role_id['NORMAL_USER']== current_user_role_id()){
		 	return 'edit-profile';				
	   } else if($role_id['INDIA_HEAD']== current_user_role_id()){
		 	return 'edit-profile';					
	   }else if(current_user_role_id() > 2){
		  return 'edit-profile';	
	   }
	   	  
	   }else{
		   
		    \Auth::logout();
		   return '/'; 
	  }  
}

function profile_photo($user_id){
	   
	  $user_data = User::where('id',$user_id)->get();

	  $profile_photo =  url('/uploads/users').'/'. $user_data[0]->id .'/'. $user_data[0]->profile_photo;
	  return $profile_photo ;

}

function check_role_access($permission_slug){
	
	$user = \Auth::user();
	$current_user_role_id = $user->role_id;
	
	$permission_list_for_role = RolesPermission::where('role_id',$current_user_role_id)->get();
	
	
	$permission_array = array();
	foreach($permission_list_for_role as $permission){
			
		 $slug = PermissionList::where('id',$permission->permission_id)->select('slug')->first();
		 $permission_array[] = $slug->slug;
	}
	
	if(in_array($permission_slug,$permission_array)){
		return true;
	}else{
		return false;
	}
}

function access_denied_user($permission_slug,$already_check = 0){
	$user = \Auth::user();
	$current_user_role_id = $user->role_id;
	
	$permission_list_for_role = RolesPermission::where('role_id',$current_user_role_id)->get();
//	pr($permission_list_for_role->toArray());
	
	$permission_array = array();
	foreach($permission_list_for_role as $permission){
			
		 $slug = PermissionList::where('id',$permission->permission_id)->select('slug')->first();
		 $permission_array[] = $slug->slug;
	}
	
	if(in_array($permission_slug,$permission_array)){
		return true;
	}else{
		/*check if admin user login*/
		//check session admin id
		if(!empty(Session::get('is_admin_login'))  && Session::get('is_admin_login') == 1 && !empty(Session::get('admin_user_id')) && $already_check == 0){
			Auth::loginUsingId(Session::get('admin_user_id'));
			access_denied_user($permission_slug,1);
		}else{
			return abort_unless(\Gate::denies(current_user_role_name()), 403);
		}
	}
}

/* // USER/ANALYST NOT ALBE TO ACCESS 
function access_denied_user(){
	
		$role_id = Config::get('constant.role_id');
	    if($role_id['CUSTOMER_USER']== current_user_role_id()){
		  return abort_unless(\Gate::denies(current_user_role_name()), 403);
	    } 
} */

function access_denied_user_analyst(){
	
		$role_id = Config::get('constant.role_id');
	    if($role_id['CUSTOMER_USER']== current_user_role_id() || $role_id['DATA_ANALYST']== current_user_role_id()){
		  return abort_unless(\Gate::denies(current_user_role_name()), 403);
	    } 
	
}


//EMAIL SEND 
 function send_email($to='',$subject='',$message='',$from='',$fromname=''){
	try {	
			$mail = new PHPMailer();
			$mail->isSMTP(); // tell to use smtp
			$mail->CharSet = "utf-8"; // set charset to utf8
			$mail->SMTPSecure = "tls";
			$setting = Setting::where('id',1)->get();
	
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = false;
			
			$mail->Host = $setting[0]->smtp_host;
			$mail->Port = 587;//$setting[0]->smtp_port;
			$mail->Username =$setting[0]->smtp_user;
            $mail->Password = urlsafe_b64decode($setting[0]->smtp_password); 		
			
			
			
			if($from!='')
			 $mail->From = $from;
		     else
			 $mail->From = $setting[0]->from_email ;
		 
			if($fromname!='')
			 $mail->FromName = $fromname;
		     else
			 $mail->FromName = $setting[0]->from_name;
			
			$mail->AddAddress($to);
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			//$mail->addReplyTo(‘examle@examle.net’, ‘Information’);
			//$mail->addBCC(‘examle@examle.net’);
			//$mail->addAttachment(‘/home/kundan/Desktop/abc.doc’, ‘abc.doc’); // Optional name
			$mail->SMTPOptions= array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
			);

			$mail->send();
		
			return true ;
		}catch (phpmailerException $e) {
				dd($e);
		} catch (Exception $e) {
				dd($e);
		}
		 return false ;
   }
// TOKEN 
	function getToken($length='')
	{
		if($length=='')
			$length =20;
		
		    $token = "";
		    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		    $codeAlphabet.= "0123456789";
		    $max = strlen($codeAlphabet); // edited

		    for ($i=0; $i < $length; $i++) {
		        $token .= $codeAlphabet[rand(0, $max-1)];
		    }

		    return $token;
	}
	

// GET THE IP ADDRESS 
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

// Show Site Title and LOGO 
function showSiteTitle($title){
	$setting = Setting::where('id',1)->first();
	
	if($setting && $title == 'title'){
		if($setting->site_title && $setting->site_title != ''){
			return $setting->site_title;
		}else{
			return trans('global.site_title');
		}
	}else if($setting && $title == 'logo'){
		if($setting->site_logo && $setting->site_logo != ''){

			return url('uploads/logo/'.$setting->site_logo);
		}else{
			return url('/img/logo.svg');
		}
	}
}

function urlsafe_b64decode($string)
{
	$ciphering = "AES-128-CTR";
	$decryption_key = "GeeksforGeeks";
	$options = 0;
	$iv_length = openssl_cipher_iv_length($ciphering);
	$decryption_iv = '1234567891011121';
	return openssl_decrypt ($string, $ciphering,$decryption_key, $options, $decryption_iv);
}

/* Function For the image */ 
function timthumb($img,$w,$h){

		  $user_img =  url('plugin/timthumb/timthumb.php').'?src='.$img.'&w='.$w.'&h='.$h.'&zc=0&q=99';

		  return $user_img ;

}

function list_states(){
	$statesData = StateList::all();
	return $statesData;
}

function list_companies(){
	$CompanyData = Company::all();
	return $CompanyData;
}

function list_plans(){
	$planData = Plan::all();
	return $planData;
}

function relationsArray(){
	//$array = array();
	$array = array(
				'wife'=>'Wife',
				'husband'=>'Husband',
				'daughter'=>'Daughter',
				'son'=>'Son',
				'mother'=>'Mother',
				'father'=>'Father',
				'brother'=>'Brother', 	
				'sister'=>'Sister',
			);

	return $array;			
}
function birth_years(){
	$birth_years = collect(range(12, 5))->map(function ($item) {
		return (string) date('Y') - $item;
	});
	return $birth_years;
}
function getStateNameByStateId($state_id){
	$state_name = '';
	$getname = StateList::where('id',$state_id)->select('state_name')->first();
	if(!is_null($getname) && ($getname->count())>0)
		$state_name = $getname->state_name;
	return $state_name;
}
function getDistrictNameByDistrictId($district_id){
	$district_name = '';
	$getname = CityLists::where('id',$district_id)->select('city_name')->first();
	if(!is_null($getname) && ($getname->count())>0)
		$district_name = $getname->city_name;
	return $district_name;
}
function viewDateFormat($date){
	return Carbon::parse($date)->format(config('constant.FRONT_DATE_FORMAT'));
}
// function currentDate($date){
// 	return Carbon::parse($date)->format(config('constant.FRONT_DATE_FORMAT'));
// }
function create_slugify($string, $replace = array(), $delimiter = '-') {
		// https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
		if (!extension_loaded('iconv')) {
		throw new Exception('iconv module not loaded');
		}
		// Save the old locale and set the new locale to UTF-8
		$oldLocale = setlocale(LC_ALL, '0');
		setlocale(LC_ALL, 'en_US.UTF-8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
		if (!empty($replace)) {
		$clean = str_replace((array) $replace, ' ', $clean);
		}
		// $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower($clean);
		$clean = preg_replace("/[\/_|+ -!@#$%^&*()]+/", $delimiter, $clean);
		$clean = trim($clean, $delimiter);
		// Revert back to the old locale
		setlocale(LC_ALL, $oldLocale);
		return $clean;
	}
	
function checkpayments(){
	$user = Auth::user();
	if($user){
		
		$userID = $user->id;
		$getData = Subscription::where("user_id",$userID)->where("status",'ACTIVE')->orderBy('id','desc')->first();
		if(!empty($getData)){
				$data['subscription_id'] = $getData->subscription_id;
				$data['plan_id'] 	= $getData->plan_id;
				$data['status'] 	= $getData->status;
				$data['username'] 	= $getData->payer_name;
				$data['user_id'] = $getData->user_id;
				if($data['status'] == "COMPLETED"){
					$data['expirystatus'] = 1;
				}else if($data['status'] == "ACTIVE"){
					 $currentdate = date('Y-m-d'); 
					 $expiiry = date('Y-m-d',strtotime($getData->subscription_end) ); 
					if($currentdate < $expiiry){ 
						$data['expirystatus'] = 1;
					}else{
						$data['expirystatus'] = 0;
					}
				}else if($data['status'] == "SUSPENDED"){
					$currentdate = date('Y-m-d'); 
					$expiiry = date('Y-m-d',strtotime($getData->subscription_end) ); 
					if($currentdate < $expiiry){ 
						$data['expirystatus'] = 1;
					}else{
						$data['expirystatus'] = 0;
					}
				}else{
					$data['expirystatus'] = 0;
				}
				return $data;
			}else{
				$getDatan = Subscription::where("user_id",$userID)->orderBy('id','desc')->first();
				if(!empty($getDatan)){
					
					 $data['subscription_id'] = $getDatan->subscription_id;
					 $data['plan_id'] = $getDatan->plan_id;
						$data['status'] = $getDatan->status;
					  
						$data['username'] = $getDatan->payer_name;
						$data['user_id'] = $getData->userID;
						if($data['status'] == "COMPLETED"){
							$data['expirystatus'] = 1;
						}else if($data['status'] == "ACTIVE"){
							$currentdate = date('Y-m-d'); 
							$expiiry = date('Y-m-d', strtotime('+1 year', strtotime($getDatan->updated_at)) ); 
							//$expiiry = date('Y-m-d',strtotime($getDatan->UpdateTime) ); 
							if($currentdate < $expiiry){ 
								$data['expirystatus'] = 1;
							}else{
								$data['expirystatus'] = 0;
							}
						}else if($data['status'] == "SUSPENDED"){
							$currentdate = date('Y-m-d'); 
							$expiiry = date('Y-m-d', strtotime('+1 year', strtotime($getDatan->updated_at)) ); 
							//$expiiry = date('Y-m-d',strtotime($getDatan->UpdateTime) ); 
							if($currentdate < $expiiry){ 
								$data['expirystatus'] = 1;
							}else{
								$data['expirystatus'] = 0;
							}
						}else{
							$data['expirystatus'] = 0;
						}
						
						
						return $data;
				}
			}
	}else{
		
	}

}



function pr($data){

  echo "<pre>";
  print_r($data);
  echo "</pre>" ;die;
}
/*
*Display policy number
*/
function generatePolicyNumber($userId){
	$policyId = '#'.str_pad($userId, 8, '0', STR_PAD_LEFT);
	return $policyId;
}

// Get Category LISTING  
function getAllCategory(){
	$result = BlogCategory::get();
	return $result ;
}


// BLOG LISTING PAGE 
function bloglisting(){
		
	$result = Blog::where('status', '=', 1);
	$blogs = $result->orderBy('position')->get();
	
	return $blogs ;
}

function excerpt($data,$words_length,$end)
{
	return Str::words($data, $words_length,$end);
}


// Leads Listing And insertion

function leadslisting(){

	$Leads = Leads::orderBy('id', 'DESC')->get();
	
	return $Leads;
	
  }
  function lead_by_id($id){
	$leads_by_id = Leads::where('id',$id)->get();
	return $leads_by_id;
  }

//   All Bidders
  function bidder_all(){

	$bidder = Bidder::all();
	return $bidder;
	
  }

//   ALL Upwork Account
  function upwork_all(){

	$upwork_id = Upwork_id::all();
	return $upwork_id;
	
	
  }

//   upwork id names
function upwork_id_names(){
	$Leads = leadslisting();
    return $upwork_id_name;
	
  }

  function viewTimeFormat($time){
	
	// Carbon::parse($p->created_at)->diffForHumans();
	return Carbon::parse($time)->toDayDateTimeString();
}




// Upwork Names Based on ID
//   function upwork_id_names_idbased($id){
// 	$leads = Leads::where('id','2')->get();
	
     
// 		foreach ($leads as $ld) {

			
// 			$upworid = $ld->upwork_id;

// 			//  pr($upworkid);
// 		}
// 		foreach($upworid as $u){
// 			$upwork_id_name = Upwork_id::select('upwork_id_name')->where('id',$u)->get();
// 			// pr($upwork_id_name);
// 			return $upwork_id_name;
// 		}
		
	
	
//   }

//   Selected Bidder names

// function bidder_names(){
// 	$Leads = Leads::orderBy('id', 'DESC')->get();
	
     
// 		foreach ($Leads as $ld) {
// 			$bidderid = $ld->bidder_id;
// 		}
	
// 	$biddername = Bidder::select('bidder_name')->where('id',$bidderid)->get();
// 	return $biddername;
	
//   }