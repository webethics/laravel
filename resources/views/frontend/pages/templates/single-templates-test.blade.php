<!---preview-modal-start--->	   
@extends('frontend.layouts.landing')
@section('pageTitle','Slides')
@section('content')
@section('extraJsCss')

@stop	
@php $lang = 'en'; @endphp
@if(Session::get('language') == 'ar')
	@php $lang = 'ar';@endphp
@endif
	<main class="site-content  details_page">
		
		 
		<section class="homesection homeslidersection inneristingsec whitebg infographicsec innerpages_sec">
            <div class="homeslide_container">
			<div class="container">
			<div class="row">
			
               <div class="col-md-8  infographicsec_blks left-wrap">
				 <a href="{{ url('tempaltes') }}">{{trans('common.back_templates')}}</a>
				  <div class="infographic-single-item">
					<div id="template-carousel" class="singleslider slider">
  
  
						<?php /* @php $path_info = pathinfo($template->files); @endphp 
						
						@if($path_info['extension'] != "pdf")
							
							@if(isset($template->slideshow))
								@php $imgArray = explode(',',$template->slideshow); @endphp
								@foreach($imgArray as $key => $each_image)
									@if (trim($each_image) != '') 
										$img = get_timthumb_img($each_image, 670, 400);
										$orignal_img = $each_image;
										?>
										<div class="item @php $key==0 ? '' : '' ;  @endphp ">										 
											<a href="javascript:void(0)">
												<img src="{{ $each_image }} " class="responsive-img modal-graphic" alt="images">
											</a>
										</div>
										@php $img_update = true @endphp
									@endif
								@endforeach
							@endif
								
						@else		
							@if(!empty($template->preview_imgs))
										
								@if($template->preview_imgs > 1)
									@for($i=0;$i<$template->preview_imgs;$i++)
										<div class="item">
											@php $image = asset('/uploads/templates/output').$template->id.$i.'.jpg'; @endphp
											<img src="{{$image}}" class="responsive-img modal-graphic" alt="images">
										</div>
									@endfor
								@else 
									@php $path = asset('/uploads/templates/output').$template->id.'0.jpg'; @endphp
									<img src="{{$path}}"/>
								@endif
							@endif
						@endif  */ ?>
						
						@php $imgArray = explode(',',$template->slideshow); @endphp
					@foreach($imgArray as $key => $each_image)
						@if (trim($each_image) != '') 
							@php
							$img = timthumb($each_image, 670, 400);
							$orignal_img = asset('/uploads/templates/slideshow').'/'.$each_image;
							@endphp
							<div class="item @php $key==0 ? '' : '' ;  @endphp">										 
								
									<img src="{{ $orignal_img }} " class="responsive-img modal-graphic" alt="images">
								
							</div>
							@php $img_update = true @endphp
						@endif
					@endforeach
				
					</div>
					</div>
					<div class="description">
						<div class="entry-details">
						
							<p><?php echo $template->title; ?> {{trans('common.compatible_powerpoint')}}</p>
							<p>{{trans('common.user_these')}} <?php echo $template->title; ?> {{trans('common.diagrams')}}.</p>
							<p> {{trans('common.Includes_circle')}}</p>
						
						</div>
					</div>
						
					<div class="meta-download">
						<div class="meta-list">
						<h5>{{trans('common.downloads')}}</h5>
						<h6>{{trans('common.file')}}</h6>
						<p>{{trans('common.free_items')}}</p>
						<?php  
						  // if(!empty($userSession)){ 
						   $cpayment = checkpayments();
						   
						   if($cpayment && $cpayment['expirystatus'] == 1 && $cpayment['subscription_id'] != "" && $cpayment['user_id'] == $user->id){
						  ?>
						<p>{{trans('common.subscribed_users')}} <a style="color:#c02822;" href = "{{url('/all-plans')}}"target="_blank">{{trans('common.subscribed_now')}}</a></p>
				  <?php } ?> 
						<p>{{trans('common.instant_download')}}</p>
						</div>
					</div>	
					
					
			  </div>
			   <div class="col-md-4 right-wrap">
			   <h2>{{$template->title}}</h2>
				@include('frontend.pages.templates.download_button')
				
				<div class="meta-feature">          
					  <div class="meta-list">
						<h5>{{trans('common.features')}}</h5>
						<p>{{trans('common.templates_edit')}}</p>
					  </div>  
					  <div class="meta-list">
						<h5>{{trans('common.more')}}</h5>
						<ul>
						
							<li>{{trans('common.powerpoint')}}</li>
							<li>{{trans('common.apple_keynote')}}</li>
							<li>{{trans('common.google_slides')}}</li>
						
						</ul>
					  </div>         
				</div>	
				
				
			</div>
			
			  
			  </div>
			  
			  	

			  
            </div>
            </div>
         </section>
		 <section class="homesection homeslidersection inneristingsec whitebg infographicsec innerpages_sec">
			<div class="homeslide_container">
				<div class="infographicsec_blks">
					<div class="container">
					<div class="row" id="posts">
						
					<div class="col-12"><h2 class="text-center">{{trans('common.featured_templates')}}</h2></div>	
					@if($featured_templates)
						@php $counting = 0;$offset = 0; @endphp
						@foreach($featured_templates as $key=>$template)
							<div class="col-md-4 infographic_blk">
								<div class="homeslide">
									<div class="img-wrap  img-wrap-temp">	
									@php
										$image = asset('/uploads/templates/').'/'.$template->featured_image;
									@endphp
									
										@if($image)
											@php $img = $image; @endphp
										@else
											@if($template->featured_image != '') 
												@php $img = $image; @endphp
											@else
												@php $img = asset('/uploads/templates/output').$template->id.'0.jpg'; @endphp
											@endif
										@endif
										<img src="{{$img}}">
									</div>
									 
									 <div class="Content-wrap">
										<h4><a href="{{url('/template-details')}}/{{$template->id}}/{{$lang}}">{{$template->title}}</a></h4>
									  </div>
								</div>
								
							</div>			
						@endforeach
					@endif
					</div>
					</div>
				</div>
			</div>
		</section>
		
		
			</main>
@section('userJs')
		<script src="{{ url('frontend/js/slider.js')}}"></script>
		<script src="{{ url('frontend/js/template.js')}}"></script>
		
      <script>
	   $(document).on('ready', function() {
		var sync11 = $(".template-carousel");
		var slidesPerPage = 8;
		var syncedSecondary1 = true;
		sync11
			.owlCarousel({
				items: 1,
				slideSpeed: 2000,
				nav: true,
				navText: ["<i class='fa fa-chevron-circle-left'></i>","<i class='fa fa-chevron-circle-right'></i>"],
				dots: false,
				loop: true,
				autoHeight:true,
				responsiveRefreshRate: 200,
			})
			.on("changed.owl.carousel", syncPosition1);

		function syncPosition1(el) {
			//if you set loop to false, you have to restore this next line
			//var current = el.item.index;
			//if you disable loop you have to comment this block
			var count = el.item.count-1;
			var current = Math.round(el.item.index - (el.item.count/2) - .5);
			if(current < 0) {
			  current = count;
			}
			if(current > count) {
			  current = 0;
			}

		}
		function syncPosition21(el) {
		
			if(syncedSecondary1) {
			  var number = el.item.index;
			  sync11.data('owl.carousel').to(number, 100, true);
			}
		}
	   });
		</script>
@stop
@endsection				