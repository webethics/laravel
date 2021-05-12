<table class="table" border="0" width="100%" cellpadding="10px">
	<thead>
		<tr>
			<th colspan="2" class="text-center"><img style="width:50%" src="{{asset('frontend/images/logo.png')}}"></th>
		</tr>
		<tr>
			<th colspan="2" class="text-center"><h5 class="summary-title"  >Invoice Details</h5></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Invoice Date</th>
			<th>{{date('d M, y',strtotime($Subscription->subscription_start))}}</th>
		</tr>
		<tr>		
			<th>Status</th>
			<th>{{$Subscription->status}}</th>
		</tr>
		<tr>	
			<th>Details</th>
			<th>{{$Subscription->plan_id}}</th>
		</tr>
		<tr>	
			<th>Amount</th>
			<th>${{number_format($Subscription->plan_price,2)}} USD</th>
		</tr>
		@if($Subscription->plan->mem_length == 0)
		<tr>	
			<th>Subscription Start Date</th>
			<th>{{date('d M, Y',strtotime($Subscription->subscription_start))}}</th>
		</tr>
		<tr>	
			<th>Subscription End Date</th>
			<th>{{date('d M, Y',strtotime($Subscription->subscription_end))}}</th>
		</tr>
		<tr>	
			<th>Next Billing Date</th>
			<th>{{date('d M, Y',strtotime($Subscription->subscription_end))}}</th>
		</tr>
		<tr>	
			<th>Subscription Period</th>
			<th>Monthly</th>
		</tr>
		@elseif($Subscription->plan->mem_length == 1)
			<tr>	
				<th>Subscription Start Date</th>
				<th>{{date('d M, Y',strtotime($Subscription->subscription_start))}}</th>
			</tr>
			<tr>	
				<th>Subscription End Date</th>
				<th>{{date('d M, Y',strtotime($Subscription->subscription_end))}}</th>
			</tr>
			<tr>	
				<th>Next Billing Date</th>
				<th>{{date('d M, Y',strtotime($Subscription->subscription_end))}}</th>
			</tr>
			<tr>	
				<th>Subscription Period</th>
				<th>Yearly</th>
			</tr>
			
		@else
		<tr>	
			<th>Subscription Period</th>
			<th>Life Time Access</th>
		</tr>
		@endif
	</tbody>
	
</table>