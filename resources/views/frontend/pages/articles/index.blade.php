@extends('frontend.layouts.landing')
@section('pageTitle','Articles')
@section('content')
@section('extraJsCss')

@stop

 <main class="site-content">
         <section class="innersection innerbannersection">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-md-6 col-6 innerbanner_img wow fadeInUp">
                     <h2>Articles</h2>
                  </div>
                  <div class="col-md-6 col-6 innerbanner_title text-right wow fadeInUp">
                     <img src="{{asset('frontend/images/infographic-banner.png')}}" />
                  </div>
               </div>
            </div>
         </section>
         <!--<section class="homesection homeslidersection infographicsec innerpages_sec wow fadeInUp" data-wow-duration="1500ms">
            <div class="homeslide_container">
               <h2 class="text-center"> <a href="#">Explore More Amazing Infographics</a></h2>
               <div class="center slider">
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics1.png')}}">
                     <h4>Category1</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics2.png')}}">
                     <h4>Category2</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics3.png')}}">
                     <h4>Category3</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics1.png')}}">
                     <h4>Category4</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics1.png')}}">
                     <h4>Category5</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics2.png')}}">
                     <h4>Category6</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics3.png')}}">
                     <h4>Category7</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
                  <div class="homeslide">
                     <img src="{{asset('frontend/images/infographics1.png')}}">
                     <h4>Category8</h4>
                     <div class="overlay-wrap">
                        <a id="preview289" data-infoid="289" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger" href="#"> Preview </a>
                        <a href="#" class="downloadedit modal-trigger btn btn-new">
                        Download &amp; Edit</a>
                        <a href="#" class="downloadpdf modal-trigger btn">
                        Download PDF</a>
                        <div class="social-share">
                           <ul>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                              <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                              <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                              <li><a href="#"><i class="fa fa-link"></i></a></li>
                           </ul>
                        </div>
                        <label>Featured</label>				
                        <div class="new-label">New</div>
                        <div class="free-label">Free</div>
                        <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
                     </div>
                  </div>
               </div>
            </div>
         </section>-->
         <section class="homesection homeslidersection inneristingsec whitebg infographicsec innerpages_sec wow fadeInUp" data-wow-duration="1500ms">
            <div class="homeslide_container">
               <div class="infographicsec_blks">
                  <div class="row" id="posts">
					@if($results)
						@foreach($results as $key=>$article)
							<div class="col-md-3 infographic_blk">
								<div class="homeslide">
									@php
										$photo = asset('/uploads/articles/featured_image/').'/'.$article->featured_image;
									@endphp
								  <img src="{{asset(timthumb($photo,334,290))}}">
								   <h4>{{$article->title}}</h4>
								   <div class="overlay-wrap">
									 
									    <a id="preview<?php echo $article->id; ?>" data-info-slug="<?php echo $article->slug; ?>" data-infoid="<?php echo $article->id; ?>" href="#modal-preview<?php echo $article->id; ?>" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger"> Preview </a>
										
									 
									  <div class="social-share">
										 <ul>
											<li>
												<a target="_blank" title="Facebook" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(url('/templates/'. $article->id)); ?>&t=<?php echo urlencode($article->title); ?>"><i class="fab fa-facebook-f"></i></a>
											
											</li>
											<li>
											
												<a title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo url('articles/'.$article->id);?>&media=<?php if(!empty($article->featured_image) && isset($article->featured_image)){ echo $article->featured_image;}?>&description=<?php echo strip_tags($article->title);?>" class="pin-it-button" count-layout="horizontal" target="_blank"><i class="fab fa-pinterest-p"></i></a>
												
												
											
											</li>
											
											
											<li>
												<a title="Twitter" href="<?php echo 'https://twitter.com/share?text='.$article->title.'&url='.url('articles/'.$article->id);?>" target="_blank"><i class="fab fa-twitter"></i></a></a>
												
											<li>
											<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo url('articles/'.$article->id);?>&title=<?php echo $article->title;?>&source=<?php echo url('articles/'.$article->id);?>" ><i data-infoid="<?php echo $article->id; ?>" class="fab fa-linkedin-in share-button linkedin fb-clicks"></i></a>
											
											
											</li>
											<li><a title="Whatsapp" target="_blank" href="https://api.whatsapp.com/send?text=<?php echo url('articles/'.$article->id);?>" data-action="share/whatsapp/share"><span><i class="fab fa-whatsapp share-button whatsapp" aria-hidden="true"></i></span></a></li>
											
											<li><a target="_blank" href="mailto:?subject=<?php echo strip_tags($article->title);?>&body=<?php echo url('articles/'.$article->id);?>" title="E-Mail Share"><span><i class="fa fa-envelope share-button" aria-hidden="true"></i></span></a></li>
											
											<li><a data-copyval="<?php echo url('articles/'.$article->id);?>" title="Copy Link" href="javascript:void(0);" class="copytxt" title="Copy Link"><span><i class="fa fa-link share-button" aria-hidden="true"></i></span></a></li>
											
										 </ul>
									  </div>
									  <label>Featured</label>				
									  <div class="new-label">New</div>
									  <div class="free-label">Free</div>
									  <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
								   </div>
								</div>
							 </div>
							 @include('frontend.pages.articles.preview')
						@endforeach
					@endif
                     
                    
                  </div>
				   <div class="col-md-12 loadmore bluebtn text-center">
                        <a href="javascript:void(0)" data-page="2" data-link="{{url('/articles?page=')}}" data-div="#posts" class="see-more">Load More</a>
                     </div>
               </div>
            </div>
         </section>
      </main>
	 
	  @section('userJs')
		<script src="{{ url('frontend/js/slider.js')}}"></script>
	@stop
@endsection