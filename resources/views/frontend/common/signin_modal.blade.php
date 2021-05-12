<div class="formmodal signinmodal" id="completeModal">
         <!-- The Modal -->
         <div class="modal" id="signinmodal">
            <div class="modal-dialog">
               <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                     <h2 class="modal-title">
					 {{ trans('authentications.login.welcome_message')}}</h4>
                     <ul class="nav nav-tabs" role="tablist" id="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="signin_tab" data-toggle="tab" href="#sign-in">{{trans('authentications.login.sign_in')}}</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="signup_tab" data-toggle="tab" href="#account">{{trans('authentications.login.new_account')}}</a>
                        </li>
                     </ul>
					   <ul class="nav nav-tabs" role="tablist" id="tablistforgot" style="display:none">
                        <li class="nav-item">
                          Please enter your Email
                        </li>
                       
                     </ul>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
				  
                  <!-- Modal body -->
                  <div class="modal-body">
                     <!-- Tab panes -->
                     <div class="tab-content">
                        <div id="sign-in" class="container tab-pane active">
							<div class="server_error errors text-left"></div>
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
											
										]) !!}</div>
								    <div class="error_margin"><span class="g-recaptcha-response_error errors" >  {{ $errors->first('g-recaptcha-response')  }} </span></div>
								</div>
								
								<div class="row mt-3">
                                    <div class="col-6">

                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" name="remember_me" id="customControlAutosizing">
                                          <label class="custom-control-label" for="customControlAutosizing">{{trans('authentications.login.remember')}}</label>
                                       </div>
                                    </div>
                                    <div class="col-6 text-right formlinkdiv">
                                       <a data-toggle="modal" id="forgotopen" class="nav-link" href="#forgotPassword" class="formlink">{{ trans('authentications.login.forgot_password') }}</a> 
                                    </div>
                                 </div>
								 
								<div class="form_button">
									<input type="hidden" name="redirect_to" value="/user-profile/" id="redirect_to">
                                    <button type="submit" class="btn btn-primary">{{ trans('authentications.login.login') }}<span class=" spinner spinner-border text-light request_loader" style="display:none"></span></button>
									
                                 </div>
								  <div class="row">
                                    <div class="col-md-12 formborder">
                                       <div class="formborderdiv">
                                          <h4>{{trans('authentications.login.continue_with')}}</h4>
                                          <ul>
												@php 
													$facbookurl = url('/redirect/0');
													$google_url = url('/redirectg/0');
											   @endphp
                                             <li><a onclick="return social_login_popup('{{$facbookurl}}')" href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a onclick="return social_login_popup('{{$google_url}}')" href="javascript:void(0)"><i class="fab fa-google-plus-g"></i></a></li>
                                          </ul>
                                          <div class="createacc_btn">
                                             <a id="accountopen" class="nav-link" href="#account">{{trans('authentications.login.create_account')}}</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
								 
								
							 </form>
							 
                           </div>
                        </div>
                        <div id="account" class="container tab-pane signupmodal">
                            <div class="form_bg" >
								<div id="showSuccessMessage" style="display:none"></div>
								<div class="server_error errors text-left"></div>
							  <form class="signupform"  id="submitSignupForm" method="POST" action="{{ route('register') }}">
									{{ csrf_field() }}
									<!--div class="form-group">
									   <input class="form-control" id="email" type="text" name="first_name" placeholder="{{ trans('authentications.signup.first_name') }}" >
									   <span class="inputicon"><img src="{{asset('frontend/images/user.png')}}" /></span>
									</div>
									<div class="error_margin"><span class="first_name_error errors" >  {{ $errors->first('first_name')  }} </span></div>
									<div class="form-group">
									   <input class="form-control" id="last_name" type="text" name="last_name" placeholder="{{ trans('authentications.signup.last_name') }}" >
										<span class="inputicon"><img src="{{asset('frontend/images/user.png')}}" /></span>
									</div>
									<div class="error_margin"><span class="last_name_error errors" >  {{ $errors->first('last_name')  }} </span></div-->
									
									
									
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
									   <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ trans('authentications.signup.confirm_password') }}" >
										<span class="inputicon"><img src="{{asset('frontend/images/lockicon.png')}}" /></span>
									</div>
									<div class="error_margin"><span class="password_confirmation_error errors" >  {{ $errors->first('password_confirmation')  }} </span></div>
									<div class="clearfix"></div>
							
								 <div class="form_button">
									<button type="submit" class="btn btn-primary">{{ trans('authentications.signup.signup') }}<span class=" spinner spinner-border text-light request_loader" style="display:none"></span></button>
								 </div>
								 
								  <div class="row">
                                    <div class="col-md-12 formborder">
                                       <div class="formborderdiv">
                                          <h4>{{trans('authentications.login.continue_with')}}</h4>
                                          <ul>
												@php 
													$facbookurl = url('/redirect/0');
													$google_url = url('/redirectg/0');
											   @endphp
                                             <li><a onclick="return social_login_popup('{{$facbookurl}}')" href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                             <li><a onclick="return social_login_popup('{{$google_url}}')" href="javascript:void(0)"><i class="fab fa-google-plus-g"></i></a></li>
                                          </ul>
                                       
                                       </div>
                                    </div>
                                 </div>
								 
							  </form>
						   </div>
                        </div>
						<div id="forgotPassword" class="container tab-pane ">
                            <div class="form_bg" >
								<div id="showSuccessMessagePass" style="display:none"></div>
								<div class="server_error errors text-left"></div>
							  <form class="signupform" id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
								 {{ csrf_field() }}
								  @php $cls = 'mb-4' @endphp 
								  @if(count($errors)>0)
									  @php $cls = 'mb-0' @endphp 
								  @endif
								  
								  <div class="form-group">
									   <input class="form-control" id="email" type="email" name="email" placeholder="{{ trans('authentications.signup.email') }}" >
									   <span class="inputicon"><img src="{{asset('frontend/images/emailicon.png')}}" /></span>
									</div>
									
									<div class="error_margin"><span class="email_error errors" >  {{ $errors->first('email')  }} </span></div>
									<div class="clearfix"></div>
							
									
										<div class="form_button">
											<button type="submit" class="btn btn-primary">{{ trans('authentications.forgotpassword.submit') }}<span class=" spinner spinner-border text-light request_loader" style="display:none"></span></button>
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


	  <script>
	 
	  </script>