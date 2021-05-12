<footer class="site-footer">
	 <div class="container">
		<div class="footercontsec">
		   <div class="row footerrow">
			  <div class="col-md-5 footerinfo">
				 <div class="col-md-12 footerlogo">
						@if(Session::get('language') == 'ar')
							<a class="img-fluid" href="{{url('/')}}"><img src="{{asset('frontend/images/logo.svg')}}" /></a>
						
						@else
							<a class="img-fluid" href="{{url('/')}}"><img src="{{asset('frontend/images/logo.svg')}}" /></a>
						@endif
						
				 </div>
				 <!--p>{{trans('common.footer_tagline')}}</p-->
				 <ul class="footersocial_icons">
					<li><a target="_blank" href="https://www.facebook.com/Namoothaj/"><i class="fab fa-facebook-f"></i></a></li>
					<!--li><a href="https://www.youtube.com/channel/UCyalFiLQYAWohOpYQQZgDag"><i class="fab fa-youtube"></i></a></li-->
					<li><a  target="_blank"  href="https://www.instagram.com/namoothaj/"><i class="fab fa-instagram"></i></a></li>
					<!--li><a href="https://www.linkedin.com/company/mawjuud/"><i class="fab fa-linkedin"></i></a></li>
					<li><a href="https://twitter.com/mawjuud"><i class="fab fa-twitter"></i></a></li-->
				 </ul>
			  </div>
			  
			  	 
			  <div class="col-md-7 footerlinks">
				 <div class="footerlink_widget">
					<div class="footerlink_area">
					   <h4>{{trans('common.information')}}</h4>
					   <ul class="footerlink_list">
						  <li><a id="plansection_nav" href="{{url('/')}}#plansection">{{trans('common.pricing')}} </a></li>
						  <li><a href="{{url('/about-us')}}">{{trans('common.about-us')}}</a></li>
						  <li><a href="{{url('/contact-us')}}">{{trans('common.contact-us')}}</a></li>
					   </ul>
					</div>
				 </div>
				 <!--div class="footerlink_widget">
					<div class="footerlink_area">
					   <h4>{{trans('common.category')}}</h4>
					   <ul class="footerlink_list">
						  <li><a href="{{url('/infographics')}}">{{trans('common.infographics')}}</a></li>
						  <li><a href="{{url('/slides')}}">{{trans('common.slides')}}</a></li>
						  <li><a href="{{url('/forms')}}">{{trans('common.forms')}}</a></li>
					   </ul>
					</div>
				 </div-->
				 <!--div class="footerlink_widget">
					<div class="footerlink_area">
					   <h4>{{trans('common.quick-link')}}</h4>
					   <ul class="footerlink_list">
						  <li><a href="{{url('/help')}}">{{trans('common.help')}}   </a></li>
						  <li><a href="{{url('/documentation')}}">{{trans('common.documentation')}}</a></li>
						  <li><a href="{{url('/accessibility')}}">{{trans('common.accessibility')}}</a></li>
					   </ul>
					</div>
				 </div-->
			  </div>
		   </div>
		</div>
	 </div>
	 <div class="footercopyright">
		<div class="container">
		   <div class="row">
			  <div class="col-md-6 footercopyright_right">
				 <ul>
					<li><a href="{{url('/privacy-policy')}}">{{trans('common.privacy-policy')}}</a></li>
					<li><a href="{{url('/terms-conditions')}}">{{trans('common.terms-&-conditions')}}</a></li>
					<li><a href="{{url('/cookie-policy')}}">{{trans('common.cookie-policy')}}</a></li>
				 </ul>
			  </div>
			  <div class="col-md-6 footercopyright_left">
				 <p>{{date('Y')}} {{trans('common.namoothaj')}}</p>
			  </div>
		   </div>
		</div>
	 </div>
  </footer>
  
  @include('frontend.common.signin_modal')

