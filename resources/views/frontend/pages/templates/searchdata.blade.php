@if($templates)
  @php $lang = 'en'; @endphp
	@if(Session::get('language') == 'ar')
		@php $lang = 'ar';@endphp
	@endif
	@foreach($templates as $key=>$template)
		<div class="col-md-3 infographic_blk">
			<div class="homeslide">
			<div class="img-wrap img-wrap-temp">
				@php
					$photo = asset('/uploads/templates/').'/'.$template->featured_image;
				@endphp
			  <img src="{{$photo}}">
			    @if($template->is_protected == 0)
					<div class="free-label top-label">{{trans('common.free')}}</div>
				@endif
			  </div>	
			   <h4>{{$template->title}}</h4>
			   <div class="overlay-wrap overlay-wrap-temp">
				  <a  onClick="showCarousel()" id="preview<?php echo $template->id; ?>"  data-info-slug="<?php echo $template->slug; ?>"  data-infoid="<?php echo $template->id; ?>" href="#modal-preview<?php echo $template->id; ?>" data-toggle="modal" class="modalimgview btn waves-effect waves-light btn modal-trigger"> {{trans('common.preview')}} </a>
				  @include('frontend.pages.templates.download_button')
				  <div class="social-share">
					 <ul>
						<li>
								<a data-infoid="<?php echo $template->id; ?>"  data-edit="shared" target="_blank" title="Facebook" href="https://www.facebook.com/sharer.php?u=<?php echo url('/slide-details/'. $template->id.'/'.$lang); ?>&t=<?php echo $template->title; ?>"><i class="fab fa-facebook-f"></i></a>
							
							</li>
							<li>
							
								<a data-infoid="<?php echo $template->id; ?>"  data-edit="shared" title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(url('/slide-details/'. $template->id.'/'.$lang));?>&media=<?php if(!empty($template->featured_image) && isset($template->featured_image)){ echo asset('/uploads/templates/'.$template->featured_image);}?>&description=<?php echo strip_tags($template->title);?>" class="pin-it-button" count-layout="horizontal" target="_blank"><i class="fab fa-pinterest-p"></i></a>
								
								
							
							</li>
							
							
							<li>
								<a data-infoid="<?php echo $template->id; ?>"  data-edit="shared" title="Twitter" href="<?php echo 'https://twitter.com/share?text='.$template->title.'&url='.urlencode(url('/slide-details/'. $template->id.'/'.$lang));?>" target="_blank"><i class="fab fa-twitter"></i></a></a>
								
							<li>
							<a data-infoid="<?php echo $template->id; ?>"  data-edit="shared" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(url('/slide-details/'. $template->id.'/'.$lang));?>&title=<?php echo $template->title;?>&source=<?php echo urlencode(url('/slide-details/'. $template->id.'/'.$lang));?>" ><i data-infoid="<?php echo $template->id; ?>" class="fab fa-linkedin-in share-button linkedin fb-clicks"></i></a>
							
							
							</li>
							<li><a data-infoid="<?php echo $template->id; ?>"  data-edit="shared" title="Whatsapp" target="_blank" href="https://api.whatsapp.com/send?text=<?php echo urlencode(url('/slide-details/'. $template->id.'/'.$lang));?>" data-action="share/whatsapp/share"><span><i class="fab fa-whatsapp share-button whatsapp" aria-hidden="true"></i></span></a></li>
							
							<li><a data-infoid="<?php echo $template->id; ?>"  data-edit="shared"  target="_blank" href="mailto:?subject=<?php echo strip_tags($template->title);?>&body=<?php echo urlencode(url('/slide-details/'. $template->id.'/'.$lang));?>" title="E-Mail Share"><span><i class="fa fa-envelope share-button" aria-hidden="true"></i></span></a></li>
							
							<li><a data-infoid="<?php echo $template->id; ?>"  data-edit="shared" data-copyval="<?php echo url('/slide-details/'. $template->id.'/'.$lang);?>" title="Copy Link" href="javascript:void(0);" class="copytxt" title="Copy Link"><span><i class="fa fa-link share-button" aria-hidden="true"></i></span></a></li>
					 </ul>
				  </div>
					@if($template->is_featured == 1)
						<label>{{trans('common.featured')}}</label>		
					@endif
					
				  @php 		
					$currentdate = date('Y-m-d H:i:s'); 
					$created_at = $template->created_at; 
					$expirydate = date('Y-m-d H:i:s', strtotime($created_at. ' + 15 day')); 
				@endphp	
					
					
					@if($currentdate < $expirydate)
						 <div class="new-label">{{trans('common.new')}}</div>	
					@endif
					@if($template->is_protected == 0)
						<div class="free-label">{{trans('common.free')}}</div>
					@endif
					
				 <a class="close-overlay" href="#/"><i class="fa fa-times" aria-hidden="true"></i></a>		
			   </div>
			</div>
		 </div>
		 @include('frontend.pages.templates.preview')
	@endforeach
@endif