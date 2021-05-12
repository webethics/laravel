<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Frontend\LoginRequest;
use Config;
use App\Models\Setting;
use App\Models\User;
use App\Models\EmailTemplate;
use App\Models\Subscription;
use Auth;
use Session;
use Response;
use App\Models\Role;
use App\Models\AuditLog;
class LoginController extends Controller
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

    use AuthenticatesUsers;
	
	  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
          
		$this->middleware('guest')->except('logout');
	 //  $this->middleware('auth');
	
    }
	
	
	
	public function login(LoginRequest $request)
    {   
		
        $input = $request->all();
	
		
		$rules = array('email' => 'required|email',
				   'password' => 'required',
				   );

		$validator = Validator::make($request->input(), $rules);
		
		$remember_me = $request->has('remember_me') ? true : false; 
		
		$redirect_to = $input['redirect_to'];
		
		
		if ($validator->fails())
		{
			
			//EVENT FAILED
			return redirect('login')->withErrors($validator)->withInput($request->except('password'));
		}else{
		
			
			if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'],'role_id' => 2),$remember_me))
			{ 
	
			
	
		        //IF STATUS IS NOT ACTIVE 
				if(Auth::check() && Auth::user()->verify_token !=NULL){
					//EVENT FAILED
					//create_failed_attemp_log($input['email'],$input['password']);
					Auth::logout();
					return Response::json(array(
					  'success'=>false,
					  'message'=> 'Please be sure to check your junk mail as well - sometimes it ends up there sadly!'
					 ), 200);
				}else if(Auth::check() && Auth::user()->status == 0){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					//create_failed_attemp_log($input['email'],$input['password']);
					Auth::logout();
					return Response::json(array(
					  'success'=>false,
					  'message'=> 'Your account is deactivated.'
					 ), 200);
					
				}else if(Auth::check() && Auth::user()->role_id == 1){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					//create_failed_attemp_log($input['email'],$input['password']);
					Auth::logout();
					return Response::json(array(
					  'success'=>false,
					  'message'=> 'Please enter correct credentials.'
					 ), 200);
				}
				
				if(Auth::check() && Auth::user()->role_id == 2){ 
					
					  $user = auth()->user();
					  $Subscription = Subscription::where("user_id",$user->id)->with('plan')->orderBy('id','desc')->first();
					  if($Subscription){
							$redirect_to =  '/subscription';
					  }
					  $role_id =  $user->role_id;
					  Session::put('is_admin_login', '');
					  Session::put('admin_user_id', '');
					  
					  if( $request->session()->get('edit-profile')){
						  if(strpos($request->session()->get('edit-profile'), '/u') !== false)
						   return redirect( $request->session()->get('edit_profile'));
					  }else{

		
						  return Response::json(array(
							  'success'=>true,
							  'redirect_to'=>$redirect_to,
							  'message'=> ''
							 ), 200);
						//return redirect('user-profile');
					  }
				}else{
					Auth::logout();
				}
			
			}
			else{
				//EVENT FAILED
				//create_failed_attemp_log($input['email'],$input['password']);
				return Response::json(array(
					  'success'=>false,
					  'message'=> 'You have entered wrong details.'
					 ), 200);
				
			}
		}

    }
	
}
