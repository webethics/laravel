<tr data-auction-id="{{ $auction->id }}" class="user_row_{{$auction->id}}" >		
	<td id="sno_{{$auction->id}}">{{(($page_number-1) * 10)+$sno}} 
		<input type="hidden" name="page_number" value="{{$page_number}}" id="page_number_{{$auction->id}}"/>
		<input type="hidden" name="sno" value="{{$sno}}" id="s_number_{{$auction->id}}"/>
	</td>
	<td id="category_{{$auction->id}}">
			{{$auction->category->title}}
	</td>
	<td id="title_{{$auction->id}}">
		@if(check_role_access('auction_edit')) 
			<a class="action editauction action_title" href="{{'/admin/auctions/edit/'}}{{$auction->id}}" data-auctionId="{{ $auction->id }}" title="{{$auction->title}}">{{$auction->title}} </a> 
		@else
			{{$auction->title}}
		@endif
	</td>
	<td id="status_{{$auction->id}}">
		@php  $selected=''; @endphp
		@if($auction->status==1)
		@php	$selected = 'checked=checked'@endphp
		@endif	
		<div class="custom-switch  custom-switch-primary custom-switch-small">
			<input class="custom-switch-input switch_status" id="switch{{ $auction->id }}" type="checkbox" data-auction_id="{{ $auction->id }}" {{$selected}}>
			   <label class="custom-switch-btn" for="switch{{ $auction->id }}"></label>

		  </div>
	</td>
	<td id="action_{{$auction->id}}">
		
		@if(check_role_access('auction_edit'))
			<a class="action editAuction" href="{{'/admin/auctions/edit/'}}{{$auction->id}}" data-auction_id="{{ $auction->id }}" title="Edit Lot"><i class="simple-icon-note"></i> </a>
		@endif
		
		@if(check_role_access('auction_delete'))
			<a title="Delete Lot"  data-id="{{ $auction->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the lot?"  data-left_button_name ="Yes" data-left_button_id ="delete_auction" data-left_button_cls="btn-primary" class="open_confirmBox action deleteauction"  href="javascript:void(0)" data-auction_id="{{ $auction->id }}"><i class="simple-icon-trash"></i></a>
		@endif	
	</td>	
</tr>