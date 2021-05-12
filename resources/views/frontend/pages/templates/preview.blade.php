<!---preview-modal-start--->	   
<div class="modal preview-popup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-preview<?php echo $template->id; ?>">
	<div class="modal-dialog modal-sm">

		<div class="modal-content">
			<div class="modal-header">
				<div class="title-txt"><h5>{{$template->title}}</h5></div>
				<div class="previewhdr_btns">
					@include('frontend.pages.templates.download_button')
				</div>
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
			</div>
		    <div id="infographic-carousel" class="infographic-carousel owl-carousel owl-theme">
				
				
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
				
					
				 <?php  /* @php $path_info = pathinfo($template->files); @endphp 
				
				@if($path_info && $path_info['extension'] != "pdf")
				
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
							
							<img src="{{$path}}" />
							
						@endif
					@endif
				@endif */  ?>
				
			</div>
      
		</div>
	</div>
</div> 