@if($media->image != NULL)
	@php $row_id = "temp_".$media->id; @endphp
	@if(isset($imageType) && $imageType != 'temp')
		@php $row_id = "media_".$media->id; @endphp
	@endif
	<tr class="auction-media-row" id="{{$row_id}}">
		<td>
			<img alt="Thumbnail" src="{{$media->image_url}}" class="list-thumbnail responsive border-0">
		</td>
		<td class="text-center">
			@if(isset($imageType) && $imageType != 'temp')
				@php $deleteButtonId = 'delete_auction_media'; @endphp
				<a href="{{url('/admin/auctions/image_downlad')}}/{{$auction->id}}/{{$media->id}}" class="filedownlad filedownlad-auction">
					<i class="glyph-icon simple-icon-cloud-download"></i>
			@else
				@php $deleteButtonId = 'delete_auction_tempmedia'; @endphp
			@endif
		</td>
		<td class="text-center">
			<a title="Delete Media"  data-id="{{$media->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Image?"  data-left_button_name ="Yes" data-left_button_id ="{{$deleteButtonId}}" data-left_button_cls="btn-primary" class="remove open_confirmBox action deleteMediaAuction"  href="javascript:void(0)" data-media_id="{{ $media->id }}" data-image_type="{{$imageType ?? 'temp'}}" data-dz-remove="">
				<i class="glyph-icon simple-icon-trash"></i>
			</a>
		</td>
	</tr>
	{{--<div class="card d-flex flex-row mb-3 list-item-wrap auction-media-row" id="{{$row_id}}">
	   	<a class="d-flex" href="#">
	   		<img alt="Thumbnail" src="{{$media->image_url}}" class="list-thumbnail responsive border-0 card-img-left">
	   	</a>
		<div class="pl-2 d-flex flex-grow-1 min-width-zero">
			<div class="custom-control custom-checkbox pl-1 align-self-center px-3">
				@if(isset($imageType) && $imageType != 'temp')
					@php $deleteButtonId = 'delete_auction_media'; @endphp
					<a href="{{url('/admin/auctions/image_downlad')}}/{{$auction->id}}/{{$media->id}}" class="filedownlad filedownlad-auction">
						<i class="glyph-icon simple-icon-cloud-download"></i>
					</a>
				@else
					@php $deleteButtonId = 'delete_auction_tempmedia'; @endphp
				@endif

				<a title="Delete Media"  data-id="{{$media->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Image?"  data-left_button_name ="Yes" data-left_button_id ="{{$deleteButtonId}}" data-left_button_cls="btn-primary" class="remove open_confirmBox action deleteMediaAuction"  href="javascript:void(0)" data-media_id="{{ $media->id }}" data-image_type="{{$imageType ?? 'temp'}}" data-dz-remove="">
					<i class="glyph-icon simple-icon-trash"></i>
				</a>
			</div>
		</div>
	</div>--}}


@endif