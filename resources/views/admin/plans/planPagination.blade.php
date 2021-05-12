<table class="table table-hover mb-0">
	<thead class="bg-primary">
		<tr>
		<th scope="col">#No.</th>
		<th scope="col">{{ trans('global.title') }}</th>
		<th scope="col">Price</th>
		<th scope="col">Display Order</th>
		<th scope="col">Status</th>
		<th scope="col">{{ trans('global.actinos') }}</th>								
		</tr>
	</thead>
	<tbody>
	 @if(is_object($listPlans) && !empty($listPlans) && $listPlans->count())
		 @php $sno = 1;$sno_new = 0  @endphp
	 
		 @php $i=1;  @endphp
	  @foreach($listPlans as $key => $plan)
		<tr data-user-id="{{ $plan->id }}" class="user_row_{{$plan->id}}" >
			<td id="sno_{{$plan->id}}">{{(($page_number-1) * 10)+$sno}} 
				<input type="hidden" name="page_number" value="{{$page_number}}" id="page_number_{{$plan->id}}"/>
				<input type="hidden" name="sno" value="{{$sno}}" id="s_number_{{$plan->id}}"/>
			</td>
			<td id="name_{{$plan->id}}">{{ $plan->title ?? '' }} </td>
			
			<td id="email_{{$plan->id}}"> {{ $plan->price  ?? '' }}</td>
			
			<td id="email_{{$plan->id}}"> {!! $plan->display_order !!}</td>
			<td id="status_{{$plan->id}}"> 
				@php  $selected=''; @endphp
				@if($plan->status==1)
				@php	$selected = 'checked=checked'@endphp
				@endif
				
				<div class="custom-switch  custom-switch-primary custom-switch-small">
				<input class="custom-switch-input switch_status" id="switch{{ $plan->id }}" type="checkbox" data-user_id="{{ $plan->id }}" {{$selected}}>
				   <label class="custom-switch-btn" for="switch{{ $plan->id }}"></label>

			  </div></td>
			<td>
				
				<a class="action" href ="{{url('admin/plans/add_features')}}/{{$plan->id}}" title="Add Features"><i class="simple-icon-plus"></i></a>
				<a class="action" href ="{{url('admin/plans/edit')}}/{{$plan->id}}" title="Edit"><i class="simple-icon-note"></i></a>
				
				<a title="Delete Plan"  data-id="{{ $plan->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the plan?"  data-left_button_name ="Yes" data-left_button_id ="delete_plan" data-left_button_cls="btn-primary" class="open_confirmBox action deleteArticle"  href="javascript:void(0)" data-role_id="{{ $plan->id }}"><i class="simple-icon-trash"></i></a>
				
			
			</td>
		</tr>
		@php $sno++ @endphp
		@php $i++;  @endphp
	 @endforeach
	@else
		<tr><td colspan="4" class="error" style="text-align:center">No Data Found.</td></tr>
	@endif	
	</tbody>
</table> 
	<!------------ Pagination -------------->
		@if(is_object($listPlans) && !empty($listPlans) && $listPlans->count()) 
		 {!! $listPlans->render() !!}  
		 @endif	