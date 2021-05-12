@extends('frontend.layouts.landing')
@section('pageTitle','Edit Profile')
@section('content')
@section('extraJsCss')

@stop
<main class="site-content profilecontent">
	@include('frontend.pages.account.profile_top_section')
	@php $validity = ''; @endphp
	@if($Subscription->plan->mem_length == '0')
		@php $validity = trans('profile.monthly'); @endphp
	@endif
	@if($Subscription->plan->mem_length == '1')
		@php $validity = trans('profile.yearly'); @endphp
	@endif
	@if($Subscription->plan->mem_length == '2')
		@php $validity = trans('profile.LiftTime'); @endphp
	@endif
	@include('frontend.pages.account.profile_menu')
	 <section class="profileformsec mt-4">
		<div class="container">
		   <div class="dahboardright_section_bg">
			  <div class="dashboard_contblk">
				 <h4>Billing Details</h4>
					<div class="col-md-6">
						<div class="" style="margin-bottom: 40px;">
							<h5 class="summary-title"  style="font-weight:bold;padding: 10px;">{{trans('profile.invoice_details')}}</h5><!--End .summary-title-->

							<table class="table table-summary-blling">
								<thead>
									<tr>
									<th>
									<h6>{{trans('profile.current_subscription')}}</h6>
									</th>
									</tr>		
								</thead>
								<tbody>
									<tr>
										<td>
											<p><b>{{trans('profile.account')}}: </b> @if($Subscription->status == 'ACTIVE') <span class="{{$Subscription->status}}">Active</span>@endif</p>
											<p><b>{{trans('profile.auto_renewal')}}:</b> @if($user->renew_status == '1') <span class="{{$Subscription->status}}">{{trans('profile.active')}}</span> @else <span>{{trans('profile.in_active')}}</span>@endif</p>
											<p><b>{{trans('profile.price')}}:</b> ${{number_format($Subscription->plan_price,2)}}</p>
											@if($Subscription->plan->mem_length == '2')
												<p><b>{{trans('profile.subscription_period')}} : </b>{{ $validity }}</p>
											@else
												<p><b>{{trans('profile.current_period')}}: </b>{{date('d M, Y',strtotime($Subscription->subscription_start))}} - {{date('d M, Y',strtotime($Subscription->subscription_end))}}</p>
												<p><b>Next Payment Due On</b> {{date('d M, Y',strtotime($Subscription->subscription_end))}}</p>
											@endif
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					
					
					</div>
					<div class="col-md-12">
						<div class="" style="margin-bottom: 40px;">
							<h5 class="summary-title"  style="font-weight:bold;padding: 10px;">{{trans('profile.subscription')}}</h5><!--End .summary-title-->

							<table class="table table-summary-blling">
								<thead>
									<tr>
										<th>{{trans('profile.sno')}}</th>
										<th>{{trans('profile.plan')}}</th>
										<th>{{trans('profile.total')}}</th>
										<th>{{trans('profile.start_date')}}</th>
										<th>{{trans('profile.end_date')}}</th>
										<th>{{trans('profile.auto_renew')}}</th>
									</tr>		
								</thead>
								<tbody>
									<tr>
										
										
										<td>1</td>
										<td>{{$validity}}</td>
										<td>${{number_format($Subscription->plan_price,2)}} USD</td>
										<td>{{date('d M, Y',strtotime($Subscription->subscription_start))}}</td>
											@if($Subscription->plan->mem_length == '2')
												<td> - </td>
											@else
												<td>{{date('d M, Y',strtotime($Subscription->subscription_end))}}</td>
											@endif
										
										
										<td>@php  $selected=''; @endphp
												@if($user->renew_status==1)
												@php	$selected = 'checked=checked'@endphp
												@endif	
												<div class="custom-switch  custom-switch-primary custom-switch-small">
												<input @if($Subscription->plan->mem_length == 2) {{ 'disabled' }} @endif class="custom-switch-input switch_status" id="switch{{ $user->id }}" type="checkbox" data-language="en"   data-user_id="{{ $user->id }}" {{$selected}}>
												   <label class="custom-switch-btn" for="switch{{ $user->id }}"></label>

											  </div></td>
									</tr>
								</tbody>
							</table>
						</div>
					
					
					</div>
					
					<div class="col-md-12">
						<div class="" style="margin-bottom: 40px;">
							<h5 class="summary-title"  style="font-weight:bold;padding: 10px;">{{trans('profile.invoice_history')}}</h5><!--End .summary-title-->

							<table class="table table-summary-blling">
								<thead>
									<tr>
										<th>{{trans('profile.invoice_date')}}</th>
										<th>{{trans('profile.status')}}</th>
										<th>{{trans('profile.details')}}</th>
										<th>{{trans('profile.amount')}}</th>
										<th>{{trans('profile.download_invioce')}}</th>
									</tr>		
								</thead>
								<tbody>
									<tr>
										<td>{{date('d M, Y',strtotime($Subscription->subscription_start))}}</td>
										<td>{{$Subscription->status}}</td>
										<td>{{$Subscription->plan_id}}</td>
										<td>${{number_format($Subscription->plan_price,2)}}</td>
										<td><a href="{{ url('pdfview') }}">{{trans('profile.download_pdf')}}</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					
					
					</div>
					
			  </div>
			 
		   </div>
		</div>
	 </section>
  </main>
@include('frontend.pages.account.profile_image_upload')

@section('userJs')
<link rel="stylesheet" href="{{ url('frontend/css/croppie.min.css')}}">
<script src="{{ url('frontend/js/croppie.js')}}"></script>
<script src="{{ url('frontend/js/module/user.js')}}"></script>	
<script src="{{ url('frontend/js/module/plan.js')}}"></script>	

 
@stop
  @endsection
