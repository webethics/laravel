@extends('frontend.layouts.landing')
@section('pageTitle','Contact Us')
@section('content')
@section('extraJsCss')

@stop

<main class="site-content">
	 <section class="innersection innerbannersection">
		<div class="container">
		   <div class="row align-items-center">
			<div class="col-md-6 col-6 innerbanner_img wow fadeInUp">
					<h2> {{trans('contact.contact_us')}} </h2>
				</div>
				<div class="col-md-6 col-6 innerbanner_title text-right wow fadeInUp">
					<img src="{{asset('frontend/images/Group 278.png')}}" />
				</div>
		   </div>
		</div>
	 </section>

			  <section class="homesection contactinfosec" id="contactsection">
		<div class="container">
		   <div class="row">
			  <div class="col-md-6 contactinformation">
				 <h2>{{trans('contact.contact_info')}}</h2>
				 <p>{{trans('contact.have_a_question')}}</p>
				 <ul>
					<li><img src="{{asset('frontend/images/icon1.png')}}" /><span><strong>{{trans('contact.email_us')}}:</strong><a href="mailto:namoothaj@gmail.com">namoothaj@gmail.com</a></span></li>
					<!--li><img src="{{asset('frontend/images/icon2.png')}}" /><span><strong>Call Us:</strong><a href="tel:1-877-867-4567">1-877-867-4567</a></span></li>
					<li><img src="{{asset('frontend/images/icon3.png')}}" /><span><strong>Address:</strong><a href="">1815 NW 169th Pl. Suite 4060 <br> Beaverton, OR 97006</a></span></li-->
					  <li><img src="{{asset('frontend/images/icon4.png')}}" /><span><strong>{{trans('contact.Mon-Fri')}}: </strong><a href="">{{trans('contact.7am')}}-{{trans('contact.5pm')}} ({{trans('contact.pacific_time')}})</a></span></li>
				 </ul>
				 <div class="contact_socialicons">
					<h4>
					{{trans('contact.follow_us')}}: 			
					   <div class="mediaicons">
					  
							  <ul class="footersocial_icons">
					<li><a target="_blank" href="https://www.facebook.com/Namoothaj/"><i class="fab fa-facebook-f"></i></a></li>
					<li><a  target="_blank" href="https://www.instagram.com/namoothaj/"><i class="fab fa-instagram"></i></a></li>
					<!--li><a href="#"><i class="fab fa-instagram"></i></a></li>
					<li><a href="#"><i class="fab fa-twitter"></i></a></li-->
				 </ul>
					  
				  
					   </div>
					</h4>
				 </div>
			  </div>
			  <div class="col-md-6 contactform">
				<form class="contactform" action="{{ url('contact-submit') }}" method="POST" id="contactform">
                        @csrf
                        <div class="form-group">
                           <input type="text" class="form-control" id="name" placeholder="{{trans('contact.your_name')}}" name="name">
                           <div class="name_error errors"></div>
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" id="Your e-mail" placeholder="{{trans('contact.Your_email')}}" name="email">
                          <div class="email_error errors"></div>
                        </div>
						 <div class="form-group">
                          <input type="text" class="form-control" id="Subject" placeholder="{{trans('contact.subject')}}" name="subject">
                          <div class="email_error errors"></div>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" rows="7" placeholder="{{trans('contact.message')}}" name="message"></textarea>
                          <div class="message_error errors"></div>
                        </div>
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
	
                        <div class="sendbtn">
                          <a href="javascript:void(0);" class="btn btn-primary contact-form">
                              {{trans('contact.send_message')}} <span class=" spinner spinner-border text-light request_loader" style="display: none;"></span>
                           </a>	
                        </div>
                     </form>
				
			  </div>
		   </div>
		</div>
	 </section> 
</main>
@endsection

@section('userJs')
  <script src="{{ asset('frontend/js/module/contact.js')}}"></script>
@stop