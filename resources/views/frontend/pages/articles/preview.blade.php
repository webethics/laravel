<!---preview-modal-start--->	   
<div class="modal preview-popup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-preview<?php echo $article->id; ?>">
	<div class="modal-dialog modal-sm">

		<div class="modal-content">
			<div class="modal-header">
				<div class="title-txt"><h5>{{$article->title}}</h5></div>
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
				<div class="clearfix"></div>
			</div>
			<div class="modal-body">
				
				<div class="featured_image">
					@php
						$photo = asset('/uploads/articles/featured_image').'/'.$article->featured_image;
					@endphp
					<img style="width:100%" src="{{asset($photo)}}">
				</div>
				<div class="description">
					{!! $article->description !!}
				</div>
				
			</div>
      
		</div>
	</div>
</div> 