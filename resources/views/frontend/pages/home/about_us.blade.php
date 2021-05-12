@extends('frontend.layouts.landing')
@section('pageTitle','About Us')
@section('content')
@section('extraJsCss')

@stop

 <main class="site-content">
	 <section class="innersection innerbannersection">
		<div class="container">
		   <div class="row align-items-center">
			  <div class="col-md-6 col-6 innerbanner_img wow fadeInUp">
				<?php 
					if(Session::get('language') == 'en'){
						$title = $about_content->title;
						$content = $about_content->content;
					}elseif(Session::get('language') == 'ar'){
						$title = $about_content->arabic_title;
						$content = $about_content->arabic_content;
					}else{
						$title = $about_content->title;
						$content = $about_content->content;
					}
				
				?>
				 <h2>{{ $title }}</h2>
			  </div>
			  <div class="col-md-6 col-6 innerbanner_title text-right wow fadeInUp">
				 <img src="{{asset('frontend/images/about-banner.png')}}" />
			  </div>
		   </div>
		</div>
	 </section>
	 <section class="aboutsection innerpages_sec innerpage_content wow fadeInUp" data-wow-duration="1500ms">
		<div class="container">
		{!! $content !!}
		<!--<p>Mawjuud.com, founded in 2016, is a mobile and online real estate resource that makes finding a home easy and enjoyable by providing home buyers, renters, and sellers the insights they need to make informed decisions about where to live.Mawjuud is a fully fledged real estate and rental website portal dedicated to empowering consumers with data, inspiration and knowledge, and connecting them with the best local professionals who can help. Mawjuud operates a leading real estate and home-related information marketplaces on mobile and the Web, with a complementary portfolio services to help people find vital information about homes and connect with local professionals. <br/><br/>Mawjuud offers updates on new homes and rentals that hit the market, data on affordability and home price history, and insights on what it’s really like to live in a neighborhood. Mawjuud focus on all stages of the home life cycle: renting, buying, and selling. Mawjuud portfolio of consumer brands includes real estate and rental marketplaces. In addition, Mawjuud provides advertising services real estate agents and rental and mortgage professionals, helping maximize business opportunities and connect to consumers.<br/><br/> Additionally, Mawjuud connects users with agents, property managers, and mortgage lenders to offer solutions and professional guidance throughout every step of the home search.<br/><br/> Mawjuud was incorporated as a Free Zone establishment in Dec 2016, and we launched the initial version of our website, Mawjuud.com, in December 2016.<br/><br/> Mawjuud launched in 2016 and is headquartered in Dubai.<br/> Mawjuud.com is owned and manage by Mawjuud FZE</p>-->
	 </section>
  </main>
@endsection