<!---preview-modal-start--->	   
@extends('frontend.layouts.landing')
@section('pageTitle','Slides')
@section('content')
@section('extraJsCss')

@stop	

	<main class="site-content">
		<section class="innersection innerbannersection">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-md-6 col-6 innerbanner_img">
                     <h2>{{$template->title}}</h2>
					 
                  </div>
                 
               </div>
            </div>
         </section>
		 
		<section class="homesection homeslidersection inneristingsec whitebg infographicsec innerpages_sec wow fadeInUp" data-wow-duration="1500ms">
            <div class="homeslide_container">
               <div class="infographicsec_blks">
			   
		    <div id="template-carousel" class="singleslider slider">
  
  
				@php $path_info = pathinfo($template->files); @endphp 
				
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
				@endif
				
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