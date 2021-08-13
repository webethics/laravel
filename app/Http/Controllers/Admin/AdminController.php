<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ResetPassword;
use Config;
use App\Models\TempRequestUser;
use App\Models\Setting;
use App\Models\User;
use App\Models\EmailTemplate;
use Auth;
use Session;use DB;
use Hash;
use App\Models\Role;
use App\Models\AuditLog;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   // use AuthenticatesUsers;
	
	
	  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		//$this->middleware('guest')->except('logout');
	
	 }
	
	
	
	public function index(){
		
		
		
		if(Session::get('admin_user_id')) {
			
    		if(!empty(Session::get('is_admin_login'))  && Session::get('is_admin_login') == 1 && !empty(Session::get('user_id'))){
				Auth::loginUsingId(Session::get('user_id'));
			}
			$user = user_data();
			$user_id = $user->id;
			$temp_details =  TempRequestUser::where('user_id',$user_id)->orderBy('id','desc')->first();
			//echo '<pre>';print_r($nominee_details->toArray());die;
			return view('admin.account.account', compact('user','temp_details'));
    	}
	    else {
			return view('admin.authentication.login');	
	    }

	} 
	
	public function login(){
		//check session admin id
		if(Session::get('admin_user_id'))
			return redirect('/admin');
		else
			return view('admin.authentication.login');
	}
	public function forgot_password(){
		//check session admin id
		if(Session::get('admin_user_id'))
			return redirect('/admin');
		else
			return view('admin.authentication.email');
	}
	
	public function checklogin(Request $request){
		
		//pr($request->all());
		$rules = array('email' => 'required|email',
			'password' => 'required'
		);
		// check login fields validations
		$validator = Validator::make($request->input(), $rules);
		if ($validator->fails()) {
			return redirect('/admin/login')->withErrors($validator)->withInput($request->except('password'));
		}else{
			
			if(Auth::attempt(array('email' =>$request->email, 'password' =>$request->password, 'role_id' =>1)))
			{ 
		        //IF STATUS IS NOT ACTIVE 
				if(Auth::check() && Auth::user()->verify_token !=NULL){
					//EVENT FAILED
					Auth::logout();
					return redirect('/admin/login')->with('error', 'Your account is not verified.Please check your email and verify your account.');
				}else if(Auth::check() && Auth::user()->status == 0){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					Auth::logout();
					return redirect('/admin/login')->with('error', 'Your account is deactivated.');
				}else if(Auth::check() && Auth::user()->role_id != 1){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					Auth::logout();
					return redirect('/admin/login')->with('error', 'Please fill correct credential.');
				}
				
				if(Auth::check() && Auth::user()->status == 1){
					$user = Auth::user();
					$role_id =  $user->role_id;
					//$role_id = Config::get('constant.role_id');
					/*flag variables*/
					$is_admin = 0;

					if(!empty($role_id)){
						$fetchUserRole = Role::where('id',$role_id)->first();
						/*If data present*/
						if(!is_null($fetchUserRole) && ($fetchUserRole->count())>0){
							$user_role = $fetchUserRole->slug;
							if($user_role == 'super-admin'){
								// set session value
								Session::put('is_admin_login', '1');
								Session::put('admin_user_id', $user->id);
								Session::put('user_id','');
							}
							if($user_role == 'user'){
								Session::put('is_admin_login', '0');
								Session::put('admin_user_id','');
								Session::put('user_id',$user->id);
							}
						}
		
					}
					
				}else{
					
					return redirect()->route('/admin/login');
				}
				
			  /* USE/ANALYST/USER-ADMIN LOGIN SETTING ADMIN ENABLE DOUBLE AUTHENTICATION  */ 
			  $setting = Setting::where('user_id',1)->get();
			  //pr($setting);
			  // IF DOUBLE AUTHENTICATION IS ON 
			  if($setting[0]->double_authentication){
				  /* Send OTP to User in email or phone */
				    $otp  = getToken(7); 
				    $usertData = User::where('id',$user->id);
					$data =array();
					$data['otp'] =$otp; 
					$usertData->update($data);
					$to  = $user->email; 
					//EMAIL REGISTER EMAIL TEMPLATE 
					$result = EmailTemplate::where('template_name','one_time_otp')->get();
					$subject = $result[0]->subject;
					$message_body = $result[0]->content;
					$uname = $user->first_name .' '.$user->last_name;
					$logo = url('/img/logo.png');
					
					$list = Array
					  ( 
						 '[NAME]' => $uname,
						 '[OTP]' => $otp,
						 '[LOGO]' => $logo,
					  );

					$find = array_keys($list);
					$replace = array_values($list);
					$message = str_ireplace($find, $replace, $message_body);
	
					$mail = send_email($to, $subject, $message); 
				
				 /*   */
				 return redirect('send-otp')
				->with('message','Please check email or phone for OTP.');
				  
			  }else{		
					
					// IF DOUBLE AUTHENTICATION IS OFF : ANALYST/ADMIN/USER/USER_ADMIN 
					 return redirect(redirect_route_name());
			  }
			}else{
				Session::flash('error', 'Please fill correct credential.');
				return redirect('/admin/login');
			}
			

		}
	}
	
	public function sendpasswordemail(Request $request)
    {
	
		$rules = array('email' => 'required|email');
		$validator = Validator::make($request->input(), $rules);
		if ($validator->fails())
		{
		
			return redirect('admin/forgot-password')->withErrors($validator);
		}
		else
		{
	
			$user = User::where('email',$request->email)->get();
			
			//IF EMAIL FOUND IN DB THEN NEED TO SEND EMAIL LINK TO RESET THE PASSWORD 
			if(count($user)>0){
				
				//SEND PASSWORD RESET LINK IN EMAIL .
				$token	= getToken();
				$uname 	= $user[0]->owner_name;
				$logo 	= url('/img/logo.png');
				$url 	= url('admin/password/reset/'.$token);
				$link   = $url ;
				$to 	= $request->email;
				//EMAIL FORGOT EMAIL TEMPLATE 
				$result = EmailTemplate::where('template_name','forgot_password')->get();
				$subject = $result[0]->subject;
				$message_body = $result[0]->content;
				
				$list = Array
				  ( 
					 '[NAME]' => $uname,
					 '[LINK]' => $link,
					 '[LOGO]' => $logo,
				  );

				$find = array_keys($list);
				$replace = array_values($list);
				$message = str_ireplace($find, $replace, $message_body);
				
				//$from = 'test@test.com';
				//$fromname = 'cdr';

			   // echo $message; die;
				//$mail = send_email($to, $subject, $message, $from, $fromname);
				$data = array('email'=>$request->email,'token'=>$token,'created_at'=>date('Y-m-d H:i:s'));
				//$result = DB::table('password_resets')->where('email', '=' ,$request->email)->get();
				DB::table('password_resets')->where('email', '=',$request->email)->delete();
				DB::table('password_resets')->insert($data);
				
				$mail = send_email($to, $subject, $message);
				return redirect('admin/forgot-password')->with('success','Please check your email for password reset.');	
			
			}else{
				
				    return redirect('admin/password/reset')->with('error','Your email not found.');
			}
		   
		}
	}	
	
	public function reset_password($token){
		
		$result = DB::table('password_resets')->where('token', '=' ,$token)->get();
		$notwork =false; 
		if(count($result)>0){
		 
		    $url_post = url('admin/password-reset');
			$notwork =true; 
			return view('admin.authentication.reset',compact('token','notwork','url_post'));	
		}else{
			
			 return view('admin.authentication.reset',compact('token','notwork','url_post'));
		}
		
		
		return view('admin.authentication.reset');
		
	}
	
	public function reset(ResetPassword $request)
    {
		$result = DB::table('password_resets')->where('token', '=' ,$request->token)->get();
		if(count($result)>0){
		
			$user_Data =  User::where('email',$result[0]->email)->get();
			$userUpdate = User::where('email',$result[0]->email);
			if(count($user_Data)>0){
				$user =DB::table('password_resets')->where('email', '=',$result[0]->email)->delete();
				$newPassword=$request->password; //NEW PASSWORD
				$hashed = Hash::make($newPassword);
				$data['password'] = $hashed;			
				$userUpdate->update($data);
				$url = 'admin/password/reset/'.$request->token;
				return redirect('/admin/login')->with('success','Password has been reset.Please login here.');	
			}else{
				return redirect('admin/password/reset/'.$request->token)->with('error','Something Went Wrong.');	
			}
			
		}
		
        	
    }
	
}
