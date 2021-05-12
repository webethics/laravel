@extends('frontend.layouts.landing')
@section('pageTitle', 'Signup')
@section('content')
<main class="site-content">
	 <section class="innersection innerbannersection">
		<div class="container">
		   <div class="row align-items-center">
				<div class="col-md-3"></div>
				<div class="col-md-6 formmodal signinmodal" style="border:1px solid #ccc;padding:25px">
				<h2>{{ trans('authentications.login.register') }}</h2>
				<div id="sign-in" class="container tab-pane">
							<div class="server_error errors text-center"></div>
                           <div class="form_bg">
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
									   <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ trans('authentications.signup.password') }}" >
										<span class="inputicon"><img src="{{asset('frontend/images/lockicon.png')}}" /></span>
									</div>
									<div class="error_margin"><span class="password_confirmation_error errors" >  {{ $errors->first('password_confirmation')  }} </span></div>
									
							
								 <div class="form_button">
									<button type="submit" class="btn btn-primary">{{ trans('authentications.signup.signup') }}<span class=" spinner spinner-border text-light request_loader" style="display:none"></span></button>
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

<script src="{{ url('frontend/js/module/login.js')}}"></script>	
@stop
@stop
