@extends('frontend.layouts.landing')
@section('pageTitle','Help')
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
						$title = $help->title;
						$content = $help->content;
					}elseif(Session::get('language') == 'ar'){
						$title = $help->arabic_title;
						$content = $help->arabic_content;
					}else{
						$title = $help->title;
						$content = $help->content;
					}
				
				?>
					<h2>{{ $title }}</h2>
				</div>
				<div class="col-md-6 col-6 innerbanner_title text-right wow fadeInUp">
					<img src="{{asset('frontend/images/Group 279.png')}}" />
				</div>
		   </div>
		</div>
	 </section>

	 <section class="aboutsection innerpages_sec innerpage_content wow fadeInUp" data-wow-duration="1500ms">
		<div class="container"><div class="row">
			
			<div class="tms">
				{!! $content !!}
		   
		  </div> </div>
		 </div>
			
			</section>

  </main>
@endsection