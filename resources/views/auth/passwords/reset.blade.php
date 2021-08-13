
@extends('frontend.layouts.landing')
@section('pageTitle', 'Login')
@section('content')

			 <main class="site-content">
	 <section class="innersection innerbannersection">
		<div class="container">
		   <div class="row align-items-center">
				<div class="col-md-3"></div>
				<div class="col-md-6 formmodal signinmodal" style="border:1px solid #ccc;padding:25px">
				<h2>{{ trans('authentications.login.forgot_password') }}</h2>
				<div id="sign-in" class="container tab-pane">
							<div class="server_error errors text-center"></div>
                           <div class="form_bg">
							
                       @include('flash-message')
					 @if($notwork)
                      <form class="signupform"  method="POST" action="{{ $url_post }}">
							 {{ csrf_field() }}
						<input name="token" value="{{ $token }}" type="hidden">	 
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"  placeholder="Enter Password">
							<span class="inputicon"><img src="{{asset('frontend/images/lockicon.png')}}" /></span>
                        </div>
						<div class="error_margin"><span class="errors" >  {{ $errors->first('password')  }} </span></div>
                        <div class="form-group">
                          <input type="password" name="password_confirmation" class="form-control"placeholder="Confirm Password">
                               <span class="inputicon"><img src="{{asset('frontend/images/lockicon.png')}}" /></span>
                        </div>
						<div class="error_margin"><span class="errors" >  {{ $errors->first('password')  }} </span></div>
                       
                        <div class="form_button">
                           <button type="submit" class="btn btn-primary">{{ trans('authentications.login.submit') }}<span class=" spinner spinner-border text-light request_loader" style="display:none"></span></button>
								
                        </div>
                        

                        
                     </form>
					@else
						 <h1>
                           
                                <div class="" style="font-size:14px">This link is not working any more.Please click <strong><a data-toggle="modal" href="#" data-target="#forget_modal" class="forget_password">Here</a></strong> to reset password </div>
                           
                        </h1>
					@endif 
							 
									
                           </div>
                        </div>
				</div>
					<div class="col-md-3"></div>
		   </div>
		</div>
	 </section>
	 


@section('userJs')

<script src="{{ url('frontend/js/module/login.js')}}"></script>	
<script>
function social_login_popup(url) {
	newwindow=window.open(url,'name','height=500,width=600');
	if (window.focus) {newwindow.focus()}
	return false;
}


</script>
@stop
@stop
