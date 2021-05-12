<!--signup-modal-->
  <div class="formmodal signinmodal" id="signupmodal">
	 <!-- The Modal -->
	 <div class="modal" id="signmopdal">
		<div class="modal-dialog">
		   <div class="modal-content">
			  <!-- Modal Header -->
			  <div class="modal-header">
				 <h2 class="modal-title">
				 Welcome to Namoothaj</h4>
				 <ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
					   <a class="nav-link" data-toggle="tab" href="#sign-in1">Sign In</a>
					</li>
					<li class="nav-item">
					   <a class="nav-link active" data-toggle="tab" href="#account1">New Account</a>
					</li>
				 </ul>
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			  <!-- Modal body -->
			  <div class="modal-body">
				 <!-- Tab panes -->
				 <div class="tab-content">
					<div id="sign-in1" class="container tab-pane">
					   <div class="server_error errors text-center"></div>
                           <div class="form_bg">
							 <form class="signupform" id="submitLoginForm" method="POST" action="{{ route('login') }}" >
								{{ csrf_field() }}
								<div class="form-group">
								   <input class="form-control" id="email" type="email" name="email" placeholder="{{ trans('authentications.login.email') }}" >
								   <span class="inputicon"><img src="{{asset('frontend/images/emailicon.png')}}" /></span>
								</div>
								<div class="error_margin"><span class="email_error errors" >  {{ $errors->first('email')  }} </span></div>
								<div class="form-group">
								   <input class="form-control" id="password" type="password" name="password" placeholder="{{ trans('authentications.login.password') }}" >
								    <span class="inputicon"><img src="{{asset('frontend/images/lockicon.png')}}" /></span>
								</div>
								 <div class="error_margin"><span class="password_error errors" >  {{ $errors->first('password')  }} </span></div>
						
						
								<div class="form-group captchaimg">
									
								   <div class="captcha_wrapper">{!! htmlFormSnippet([
											"theme" => "light",
											"size" => "normal",
											"tabindex" => "3",
											"callback" => "callbackFunction",
											"expired-callback" => "expiredCallbackFunction",
											"error-callback" => "errorCallbackFunction",
										]) !!}</div>
								    <div class="error_margin"><span class="g-recaptcha-response_error errors" >  {{ $errors->first('g-recaptcha-response')  }} </span></div>
								</div>
								
								<div class="row mt-3">
                                    <div class="col-6">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                          <label class="custom-control-label" for="customControlAutosizing">{{trans('authentications.login.remember')}}</label>
                                       </div>
                                    </div>
                                    <div class="col-6 text-right formlinkdiv">
                                       <a data-toggle="modal" href="#" data-target="#forget_modal" class="formlink">{{ trans('authentications.login.forgot_password') }}</a> 
                                    </div>
                                 </div>
								 
								<div class="form_button">
                                    <button type="submit" class="btn btn-primary">{{ trans('authentications.login.login') }}<span class=" spinner spinner-border text-light request_loader" style="display:none"></span></button>
									
                                 </div>
								  <div class="row">
                                    <div class="col-md-12 formborder">
                                       <div class="formborderdiv">
                                          <h4>{{trans('authentications.login.continue_with')}}</h4>
                                          <ul>
                                             <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                          </ul>
                                          <div class="createacc_btn">
                                             <a href="#">{{trans('authentications.login.create_account')}}</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
								 
								 
							 </form>
							 
                           </div>
					</div>
					<div id="account1" class="container tab-pane signupmodal active">
					   <div class="form_bg">
						  <form class="signupform"  id="submitSignupForm" method="POST" action="{{ route('register') }}">
								{{ csrf_field() }}
								<div class="form-group">
								   <input class="form-control" id="email" type="text" name="first_name" placeholder="{{ trans('authentications.signup.first_name') }}" >
								   <span class="inputicon"><img src="{{asset('frontend/images/user.png')}}" /></span>
								</div>
								<div class="error_margin"><span class="first_name_error errors" >  {{ $errors->first('first_name')  }} </span></div>
								<div class="form-group">
								   <input class="form-control" id="last_name" type="text" name="last_name" placeholder="{{ trans('authentications.signup.last_name') }}" >
								    <span class="inputicon"><img src="{{asset('frontend/images/user.png')}}" /></span>
								</div>
								<div class="error_margin"><span class="last_name_error errors" >  {{ $errors->first('last_name')  }} </span></div>
								
								
								
								<div class="form-group">
								   <input class="form-control" id="email" type="email" name="email" placeholder="{{ trans('authentications.signup.email') }}" >
								   <span class="inputicon"><img src="{{asset('frontend/images/emailicon.png')}}" /></span>
								</div>
								<div class="error_margin"><span class="email_error errors" >  {{ $errors->first('email')  }} </span></div>
								
								<div class="form-group">
								   <input class="form-control" id="password" type="password" name="password" placeholder="{{ trans('authentications.signup.password') }}" >
								    <span class="inputicon"><img src="{{asset('frontend/images/lockicon.png')}}" /></span>
								</div>
								<div class="error_margin"><span class="password_error errors" >  {{ $errors->first('password')  }} </span></div>
								
								<div class="form-group">
								   <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ trans('authentications.signup.password') }}" >
								    <span class="inputicon"><img src="{{asset('frontend/images/lockicon.png')}}" /></span>
								</div>
								<div class="error_margin"><span class="password_confirmation_error errors" >  {{ $errors->first('password_confirmation')  }} </span></div>
								
						
							 <div class="form_button">
								<button type="submit" class="btn btn-primary">{{ trans('authentications.signup.signup') }}<span class=" spinner spinner-border text-light request_loader" style="display:none"></span></button>
							 </div>
						  </form>
					   </div>
					</div>
				 </div>
			  </div>
		   </div>
		</div>
	 </div>
  </div>