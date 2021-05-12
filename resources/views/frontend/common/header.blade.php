
    	<section id="navigation">
         <header class="site-header">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg">
                     <div class="headerleft">
						@if(Session::get('language') == 'ar')
							<a class="navbar-brand logowidget" href="{{url('/')}}"><img src="{{asset('frontend/images/logo.svg')}}" /></a>
						
						@else
							<a class="navbar-brand logowidget" href="{{url('/')}}"><img src="{{asset('frontend/images/logo.svg')}}" /></a>
						@endif
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <img src="{{asset('frontend/images/menutoggle.svg')}}" />
                        </button>
                        <form class="form-inline searchform" style="display:none">
                           <input class="form-control mr-sm-2" type="search" placeholder="{{trans('common.search')}}" aria-label="Search">
                           <button class="btn" type="submit">
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                 <defs>
                                    <style>.a{fill:#4a4a4a;}</style>
                                 </defs>
                                 <path class="a" d="M7.927,0a7.927,7.927,0,1,0,7.927,7.927A7.936,7.936,0,0,0,7.927,0Zm0,14.39A6.463,6.463,0,1,1,14.39,7.927,6.471,6.471,0,0,1,7.927,14.39Z"/>
                                 <g transform="translate(12.341 12.341)">
                                    <path class="a" d="M356.49,355.455l-4.2-4.2a.732.732,0,0,0-1.035,1.035l4.2,4.2a.732.732,0,0,0,1.035-1.035Z" transform="translate(-351.046 -351.046)"/>
                                 </g>
                              </svg>
                           </button>
                        </form>
                     </div>
                  </div>
					@php $active = '';$active1 = '';@endphp
					@if(Session::get('language') == 'en')
						@php $active = 'active_lang';@endphp
					@endif
					@if(Session::get('language') == 'ar')
						@php $active1 = 'active_lang'; @endphp
					@endif
					
					
				  @if(!Auth::user())
                  <div class="col-lg">
						
						
                     <ul class="headerright_btns">
						<li class="lang {{$active}}"><a href="/changelanguage/en">EN</a></li>
						<li class="lang {{$active1}}"><a href="/changelanguage/ar">عربي</a></li>
						
							
                        <li class="signin"><a id="signin_button" href="#sign-in" data-toggle="modal" data-target="#signinmodal">{{trans('common.signin')}}</a>
                        </li>
                        <li class="signup "><a id="signup_button" href="#account" data-toggle="modal" data-target="#signinmodal">{{trans('common.signup')}}</a></li>
                     </ul>
                  </div>
				  @else
					<div class="col-lg">
                     <ul class="headerright_btns">
						<li class="lang {{$active}}"><a href="/changelanguage/en">EN</a></li>
						<li class="lang {{$active1}}"><a href="/changelanguage/ar">عربي</a></li>
						
                        <li class="signin"><a href="{{('/logout')}}" >{{trans('common.logout')}} </a></li>
                        @php
                           $user = Auth::user();
                           $userRole = $user->role_id;
                        @endphp
                        @if( $userRole == 1)
                            <li class="signup"><a href="{{('/admin')}}">{{trans('common.my-account')}}</a></li>
                        @else
                            <li class="signup"><a href="{{('/edit-profile')}}">{{trans('common.my-account')}}</a></li>
                        @endif
                     </ul>
                  </div> 
				  @endif
               </div>
            </div>
         </header>
		 @php $home = $about = $contact =  $pricing =  $slides =  $articles =  $infographics = '' @endphp
		 @if(collect(request()->segments())->last()=='/' || collect(request()->segments())->last()=='')
			@php $home ='active' @endphp
		 @endif
		
		 @if(collect(request()->segments())->last()=='slides')
			@php $slides ='active' @endphp
		 @endif
		 
         @if(collect(request()->segments())->last()=='all-plans')
			@php $pricing ='active' @endphp
		 @endif
          @if(collect(request()->segments())->last()=='about-us')
			@php $about ='active' @endphp
		 @endif
         @if(collect(request()->segments())->last()=='contact-us')
			@php $contact ='active' @endphp
		 @endif
        
         <nav class="navbar navbar-expand-lg navigationbar">
            <div class="container">
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto ml-auto">
                     <li class="nav-item {{$home}}">
                        <a class="nav-link" href="{{url('/')}}">{{trans('common.home')}}</a>
                     </li>
                     
					 
						<li class="nav-item  {{$pricing}}"><a  class="nav-link" href="{{url('/all-plans')}}">{{trans('common.pricing')}} </a></li>
						  <li class="nav-item  {{$about}}"><a class="nav-link" href="{{url('/about-us')}}">{{trans('common.about-us')}}</a></li>
						  <li class="nav-item  {{$contact}}"><a class="nav-link" href="{{url('/contact-us')}}">{{trans('common.contact-us')}}</a></li>
						  
					</ul>
               </div>
            </div>
         </nav>
      </section>
	  