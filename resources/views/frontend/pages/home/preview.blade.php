<!---preview-modal-start--->	   
<div class="modal preview-popup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-preview<?php echo $form->id; ?>">
	<div class="modal-dialog modal-sm">

		<div class="modal-content">
			<div class="modal-header">
				<div class="title-txt"><h5>{{$form->title}}</h5></div>
				<div class="previewhdr_btns">
					<a href="#" class="downloadedit modal-trigger btn btn-new">Download &amp; Edit</a>
					<a href="#" class="downloadpdf modal-trigger btn btn-grey">Download PDF</a>
				</div>
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
			</div>
		    <div class="singleslider slider">
				
				@php $path_info = pathinfo($form->files); @endphp 
				
				@if($path_info['extension'] != "pdf")
					
					@if(isset($form->slideshow))
						@php $imgArray = explode(',',$form->slideshow); @endphp
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
					@if(!empty($form->preview_imgs))
								
						@if($form->preview_imgs > 1)
							@for($i=0;$i<$form->preview_imgs;$i++)
								<div class="item">
									@php $image = asset('/uploads/forms/output').$form->id.$i.'.jpg'; @endphp
									<img src="{{$image}}" class="responsive-img modal-graphic" alt="images">
								</div>
							@endfor
						@else 
							@php $path = asset('/uploads/forms/output').$form->id.'0.jpg'; @endphp
							<img src="{{$path}}"/>
						@endif
					@endif
				@endif
				
			</div>
      
		</div>
	</div>
</div> 