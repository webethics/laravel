<table class="table table-hover mb-0">
	<thead class="bg-primary">
		<tr>
		<th scope="col">#No.</th>
		<th scope="col">Name</th>
		<th scope="col">Email</th>
		<th scope="col">Subscription Id</th>
		<th scope="col">Plan Id</th>
		<th scope="col">Payment Method</th>
		<th scope="col">Plan Price</th>
		<th scope="col">Status</th>
		<!--<th scope="col">{{ trans('global.actinos') }}</th>-->								
		</tr>
	</thead>
	<tbody>
	 @if(is_object($Subscription) && !empty($Subscription) && $Subscription->count())
		 @php $sno = 1;$sno_new = 0  @endphp
	 
		 @php $i=1;  @endphp
	  @foreach($Subscription as $key => $plan)
		<tr data-user-id="{{ $plan->id }}" class="user_row_{{$plan->id}}" >
			<td id="sno_{{$plan->id}}">{{(($page_number-1) * 10)+$sno}} 
				<input type="hidden" name="page_number" value="{{$page_number}}" id="page_number_{{$plan->id}}"/>
				<input type="hidden" name="sno" value="{{$sno}}" id="s_number_{{$plan->id}}"/>
			</td>
			<td id="name_{{$plan->id}}">{{ $plan->first_name." ".$plan->last_name ?? '' }} </td>
			
			<td id="name_{{$plan->id}}">{{ $plan->email ?? '' }} </td>
			
			<td id="name_{{$plan->id}}">{{ $plan->subscription_id ?? '' }} </td>
			
			<td id="email_{{$plan->id}}"> {{ $plan->plan_id  ?? '' }}</td>
			
			<td id="email_{{$plan->id}}"> {{ $plan->paymentMethod  ?? '' }}</td>
			
			<td id="email_{{$plan->id}}"> {!! $plan->plan_price !!}</td>
			
			<td id="status_{{$plan->id}}"> {!! $plan->status !!}</td>
			
			<!--<td>
				
				<a class="action" href ="{{url('admin/plans/add_features')}}/{{$plan->id}}" title="Add Features"><i class="simple-icon-plus"></i></a>
				<a class="action" href ="{{url('admin/plans/edit')}}/{{$plan->id}}" title="Edit"><i class="simple-icon-note"></i></a>
				
				<a title="Delete Plan"  data-id="{{ $plan->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the plan?"  data-left_button_name ="Yes" data-left_button_id ="delete_plan" data-left_button_cls="btn-primary" class="open_confirmBox action deleteArticle"  href="javascript:void(0)" data-role_id="{{ $plan->id }}"><i class="simple-icon-trash"></i></a>
				
			
			</td>-->
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
		@if(is_object($Subscription) && !empty($Subscription) && $Subscription->count()) 
		 {!! $Subscription->render() !!}  
		 @endif	