
@extends('frontend.layouts.landing')
@section('pageTitle','Subscription')
@section('content')
@section('extraJsCss')

@stop
<?php 

	
	if(config("paypal.paypal_mode") == 'sandbox'){
		 $client_id = config("paypal.sandbox_client_id");
		$secret = config("paypal.sandbox_secret");
		$api_url = config("paypal.sandbax_api_url");
		$paypalproductId = config('paypal.sandbox_productId');
	}
	if(config("paypal.paypal_mode") == 'live'){
		 $client_id = config("paypal.live_client_id");
		$secret = config("paypal.live_secret");
		$api_url = config("paypal.live_api_url");
		$paypalproductId = config('paypal.live_productId');
	}
	
	
?>
  <main class="site-content profilecontent">
	 
	 
	  <section class="homesection plansection innerplansection whitebg">
		<div class="container">
		   <div class="row">
				
				  <div class="col-md-8  text-center" style="background-color: #fff;margin-bottom: 40px;">
					  <p class="text-center" style="font-weight:bold;padding:10px 0;font-size:24px">
						{{trans('profile.payment_tag_line')}}
					</p>
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div id="paypal-button-container"></div>
							<div id="payment-request-button"><img src="{{asset('frontend/images/stripe.png')}}" style="width:100%;margin-top:10px"></div>
							 @include('frontend.partials.stripeCard')
							<img src="{{asset('frontend/images/cards.jpg')}}" style="width:100%;margin-top:10px">
						</div>
						<div class="col-md-3"></div>
					</div>
					<div class="clearfix"></div>
					<div class=" row btn-container">
						<a style="margin:15px auto" class="buynow" href="{{ url('/subscription') }}" class="btn btn-grey">{{trans('profile.back')}}</a>
					</div>
				</div>	
				
				 <div class="col-md-4">
						<div class="" style="border: 4px solid #ececee;border-radius: 12px;background-color: #fff;margin-bottom: 40px;">
						<h5 class="summary-title"  style="font-weight:bold;padding: 10px;">{{trans('profile.summary')}}</h5><!--End .summary-title-->

						<table class="table table-summary">
							<thead>
								<tr>
									<th colspan="2">
									
										@if($plans->mem_length == 2)
											<h6>{{trans('profile.lifetime_heading')}}</h6>
											<p>{{trans('profile.lifetime_description')}} </p>
										@elseif($plans->mem_length == 1)
											<h6>{{trans('profile.namoothaj_tag')}}</h6>
											<p>{{trans('profile.yearly_heading')}}</p>
											<p>{{trans('profile.yearly_description')}}</p>
										@else
											<h6>{{trans('profile.namoothaj_tag')}}</h6>
											<p>{{trans('profile.monthly_heading')}}</p>
											<p>{{trans('profile.monthly_description')}}</p>
										@endif
									</th>
								</tr>
							</thead>

						<tbody>
							<tr>
								<td>{{trans('profile.subscription_details')}}</td>
								<td class="subscription-price" >${{$plans->price}} USD</td>
							</tr>
							<tr class="summary-total">
								<td class="total-head"><b>{{trans('profile.total')}}:</b></td>
								<td class="subscription-total">${{$plans->price}} USD</td>
							</tr><!-- End .summary-total -->
						</tbody>
						</table><!-- End .table table-summary -->
					</div>
					
					<input type="hidden" id="plan_id_popup" value="">
					<input type="hidden" id="plan_price_popup" value="">
					<input type="hidden" id="csrf_token_val" value="">
					<script src="https://www.paypal.com/sdk/js?client-id={{$client_id}}&vault=true&intent=subscription&disable-funding=credit,card&commit=true" data-sdk-integration-source="button-factory" data-page-type="checkout"></script>
			
			<script src="{{ url('frontend/js/jquery-2.2.0.min.js')}}" type="text/javascript"></script>

			<script>
			$(document).on('click','#payment-request-button',function(){
				var $this = $(this);
				$('.error').html('');
				$("#stripeCardModal").modal("show");
			});


			
				// var plan_id = document.getElementById("plan_id");
				//var planId = document.getElementById("plan_id_popup").value;
				
				var apiKey = '{{$client_id}}';
				var password = '{{$secret}}';
				var api_url = '{{$api_url}}';
				var user_id = '{{$user ? user_id() : ''}}';
				var plan_price = '{{$plans->price}}';
				var plan_type = '{{$plans->mem_length}}';
				/* var csrf_token = document.getElementById("csrf_token_val").value; */
				var csrf_token =  document.querySelector('meta[name=csrf-token]').content;
				
				paypal.Buttons({
				  style: {
					  shape: 'rect',
					  color: 'gold',
					  layout: 'vertical',
					  label: ''
				  },
					createSubscription: function(data, actions) {
						//var planId = document.getElementById("plan_id_popup").value;
						return actions.subscription.create({
							'plan_id': '{{$plans->plan_id}}'
						});
					},
					onApprove: function(data, actions) {
						$.ajax({
							type: "POST",
							url: api_url+"/v1/oauth2/token",
							dataType: "json",
							data: {grant_type: "client_credentials"},
							beforeSend: function(xhr) { 
								xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
								xhr.setRequestHeader("Authorization", "Basic " + btoa([apiKey, password].join(":"))); 
							},
							 success: function (result) {
								// alert(JSON.stringify(result));
								//$(".loading_subscriber").show();
								//GET TOKEN 
								$.ajax(api_url+"/v1/billing/subscriptions/"+data.subscriptionID, {
									method: "GET",
									headers: {
									  "Content-Type": "application/json",
									  "Authorization": "Bearer "+result.access_token
									},
									dataType: "json",
									success: function (data) {
										// alert(JSON.stringify(data));
										var subscription_id = data.id;
										var plan_id = data.plan_id;
										//var plan_price = data.plan_price;
										//var quantity = data.quantity;
										var PayerName = data.subscriber.name.given_name+' '+data.subscriber.name.surname;
										var PayerMail = data.subscriber.email_address;
										var payer_id = data.subscriber.payer_id;
										//var Total = data.shipping_amount.value;
										var CreateTime = data.start_time;
										var UpdateTime = data.status_update_time;
										var next_billing_time = data.billing_info.next_billing_time;
										var status = data.status;
										$.ajax({
											url: base_url +'/saveSubscriptionData',
											dataType: 'json',
											type: 'post',
											contentType: 'application/x-www-form-urlencoded',
											data: {_token:document.querySelector('meta[name=csrf-token]').content,subscription_id:subscription_id,plan_id:plan_id,user_id:user_id,PayerName:PayerName,PayerMail:PayerMail,payer_id:payer_id,plan_price:plan_price,CreateTime:CreateTime,UpdateTime:UpdateTime,status:status,next_billing_time:next_billing_time,plan_type:plan_type},
											success: function(data){
												if(data.success){
													$(".loading_subscriber").hide();
													$('.user_subscribe_'+user_id).hide();  //Hide followed user from list 
													notification('Success','You have subscribed Successfully.','top-right','success',2000);
													$("#payment_modal").modal('toggle');
													setTimeout(function(){ $('.subscribeModal_'+user_id).modal('hide'); }, 1000);
													setTimeout(function(){window.location.href = base_url+'/subscription'; }, 2500);
													
												}else{
													$(".loading_subscriber").hide();
													$('.user_subscribe_'+user_id).hide();  //Hide followed user from list 
													notification('Error','Something went wrong.','top-right','error',2000);
													$("#payment_modal").modal('toggle');
													setTimeout(function(){ $('.subscribeModal_'+user_id).modal('hide'); }, 1000);
												}	
											}
										});
									},
									error: (xhr, textStatus, errorThrown) => {
										console.log(textStatus, errorThrown);
										$('.error-message-box').show();
										notification('Error',' There is some issue processing your request.You can try later.','top-right','error',3000);
										
									}
								});
							},
							error: (xhr, textStatus, errorThrown) => {
								notification('Error',' There is some issue processing your request.You can try later.','top-right','error',3000);
								
							}
						});  
					},
					onError: function (err) {
						notification('Error',' There is some issue processing your request.You can try later.','top-right','error',3000);
					},
					onCancel: function (data) {
						
					}
			  }).render('#paypal-button-container');
			</script>
					
				</div>
			</div>
		</div>
	 </section>
	
@section('userJs')
  <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript">
   var stripeClient = "{{env('STRIPE_KEY')}}";
  </script>
  
<link rel="stylesheet" href="{{ url('frontend/css/croppie.min.css')}}">
<script src="{{ url('frontend/js/croppie.js')}}"></script>
<script src="{{ url('frontend/js/module/user.js')}}"></script>
<script src="{{ url('frontend/js/module/payment-method.js')}}"></script>	
<script src="{{ url('frontend/js/module/plan.js')}}"></script>	

 
@stop
  @endsection

						