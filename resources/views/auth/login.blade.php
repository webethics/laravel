@extends('frontend.layouts.landing')
@section('pageTitle', 'Login')
@section('content')

			 <main class="site-content">
	 <section class="innersection innerbannersection">
		<div class="container">
		   <div class="row align-items-center">
				<div class="col-md-3"></div>
				<div class="col-md-6 formmodal signinmodal" style="border:1px solid #ccc;padding:25px">
				<h2>{{ trans('authentications.login.login') }}</h2>
				<div id="sign-in" class="container tab-pane">
							<div class="server_error errors text-center"></div>
                           <div class="form_bg">
							 <form class="signupform" id="submitLoginFormPage" method="POST" action="{{ route('login') }}" >
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
										<input type="hidden" name="redirect_to" value="/user-profile/" id="redirect_to">
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
								 
								 
								 
							 </form>
							  <div class="col-md-12 col-sm-12 facebook">
                                        <div class="form-group position-relative">                                         
                                            <button class="form-control">
                                                <div class="icon d-inline-block ">
                                                    <i class="fab fa-facebook-f"></i>
                                                </div>
                                               @php 
												$facbookurl = url('/redirect/0')
											   @endphp
												<div class="text d-inline-block" onclick="return social_login_popup('{{$facbookurl}}')">
												   Sign in with Facebook
												</div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 google">
                                        <div class="form-group position-relative">                                         
                                            <button class="form-control">
                                                <div class="icon d-inline-block ">
                                                    <i class="fab fa-google"></i>
                                                </div>
                                                @php 
													$google_url = url('/redirectg/0')
												@endphp
												<div class="text d-inline-block" onclick="return social_login_popup('{{$google_url}}')">
													Sign in with Google
												</div>
                                            </button>
                                        </div>
                                    </div>
									
                           </div>
                        </div>
				</div>
					<div class="col-md-3"></div>
		   </div>
		</div>
	 </section>
	 


@section('userJs')


<script>
function social_login_popup(url) {
	newwindow=window.open(url,'name','height=500,width=600');
	if (window.focus) {newwindow.focus()}
	return false;
}


</script>
@stop
@stop
