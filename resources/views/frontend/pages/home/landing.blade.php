@extends('frontend.layouts.landing')
@section('pageTitle','Home')
@section('content')
 @php $lang = 'en'; @endphp
@if(Session::get('language') == 'ar')
	@php $lang = 'ar';@endphp
@endif	

<main class="site-content">
         <section class="homesection bannersection">
            <div class="container h-100">
               <div class="row align-items-center h-100">
                  <div class="col-md-7 bannercontent">
                     <h1>{{ trans('home.good-design')}}  <br/><span>{{ trans('home.good-business')}}.</span></h1>
                   
                     <div class="bannerbtndiv">
                        <span>
                           <a href="{{url('all-plans')}}" class="bannerbtn">{{ trans('home.start-now')}}<img src="{{ url('frontend/images/starticon.svg')}}"/></a>
                           <ul>
                             <li><a href="{{url('/slides')}}"><img src="{{asset('frontend/images/icon1.svg')}}"></a></li>
                           <li><a href="{{url('/infographics')}}"><img src="{{asset('frontend/images/icon2.svg')}}"></a></li>
                           <li><a href="{{url('forms')}}"><img src="{{asset('frontend/images/icon3.svg')}}"></a></li>
                           </ul>
                        </span>
                     </div>
                  </div>
                  <div class="col-md-5 bannerimage">
				  @if(Session::get('language') == 'ar')
					@include('frontend.pages.home.banner-arabic')
				@else
					@include('frontend.pages.home.banner-english')
				@endif 
						
                    
                  </div>
               </div>
            </div>
         </section>
         
        
         
        
       
        
         <section class="homesection plansection" id="plansection">
            <div class="container">
               <div class="plansection_cont">
                  <h2 class="text-center">{{trans('home.our-best-plan')}}</h2>
                  <!--p class="text-center">{{trans('home.best-price-plan')}}</p-->
                  <div class="pricingplan_sec">
                     <div class="row justify-content-center">
						 @if(isset($user) && !empty($user))
							 <input type = "hidden" name="login_id" id="login_id" value = "{{ $user->id }}" />
						 @else
							 <input type = "hidden" name="login_id" id="login_id" value = "" />
						 @endif
						 <input type = "hidden" name="plan_id" id="plan_id" value = "" />
						 
							@if(Session::get('language') == 'ar')
								@php $lang = 'ar' @endphp
							@else
								@php $lang = 'en' @endphp
							@endif 
						
					 @foreach($plans as $key=>$value)
						@php $mem_length = ''; @endphp
						@if($value->mem_length == 0)
							@php $mem_length = 'Monthly'; @endphp
						@endif
						@if($value->mem_length == 1)
							@php $mem_length = 'Yearly'; @endphp
						@endif
						@if($value->mem_length == 2)
							@php $mem_length = 'LifeTime'; @endphp
						@endif
						
						@if($value->display_order == '1')
							<div class="col-md-12 col-lg-4 standardprice_blk price_blk">
								<div class="pricingblk">
									<h4>{{$lang == 'ar' ? $value->arabic_title : $value->title}}</h4>
									<p>{!! $lang == 'ar' ? $value->arabic_description : $value->description !!}</p>
									<span>$ <strong>{{$value->price}}</strong></span>
									<div class="priceblk_cont">
										<ul>
											@foreach($value->features as $feat)
												<li>{{$lang == 'ar' ?  $feat->arabic_feature_text : $feat->feature_text}}</li>
											@endforeach
										</ul>
										<div class="buynow_btn">
											@if(isset($Subscription) && !empty($Subscription) && $Subscription->plan_id == $value->plan_id)
												<a href="javascript:void(0)" class="buynow" data-plan_id="{{$value->plan_id}}" data-plan_price="{{$value->price}}">{{trans('common.active_plan')}}</a>
											@elseif(isset($user) && !empty($user))
												<a href="{{url('payment')}}/{{$value->id}}"  class="buynow" >{{trans('common.update_plan')}}</a>
											@else
												<a href="javascript:void(0)" data-id="{{$value->id}}" class="buynow" >{{trans('common.buy_now')}}</a>
											@endif
										</div>
									</div>
								</div>
							</div>
						@endif
						@if($value->display_order == '2')
                        <div class="col-md-12 col-lg-4 businessprice_blk price_blk wow fadeInUp" data-wow-duration="1500ms">
                           <div class="pricingblk">
                              <span class="popularbadge">{{trans('common.popular_choice')}}</span>
                             <h4>{{$lang == 'ar' ? $value->arabic_title : $value->title}}</h4>
									<p>{!! $lang == 'ar' ? $value->arabic_description : $value->description !!}</p>
                              <span>$ <strong>{{$value->price}}</strong></span>
                              <div class="priceblk_cont">
                                 <ul>
                                   @foreach($value->features as $feat)
										<li>{{$lang == 'ar' ?  $feat->arabic_feature_text : $feat->feature_text}}</li>
									@endforeach
                                 </ul>
									<div class="buynow_btn">
										@if(isset($Subscription) && !empty($Subscription) && $Subscription->plan_id == $value->plan_id)
											<a href="javascript:void(0)" class="buynow">{{trans('common.active_plan')}}</a>
										@elseif(isset($user) && !empty($user))
											<a href="{{url('payment')}}/{{$value->id}}" class="buynow">{{trans('common.update_plan')}}</a>
										@else
											<a href="javascript:void(0)" data-id="{{$value->id}}" class="buynow">{{trans('common.buy_now')}}</a>
										@endif
									</div>
                              </div>
                           </div>
                        </div>
						@endif
						@if($value->display_order == '3')
                        <div class="col-md-12 col-lg-4 executiveprice_blk price_blk">
                           <div class="pricingblk">
                              <h4>{{$lang == 'ar' ? $value->arabic_title : $value->title}}</h4>
									<p>{!! $lang == 'ar' ? $value->arabic_description : $value->description !!}</p>
                              <span>$ <strong>{{$value->price}}</strong></span>
                              <div class="priceblk_cont">
                                 <ul>
                                   @foreach($value->features as $feat)
										<li>{{$lang == 'ar' ?  $feat->arabic_feature_text : $feat->feature_text}}</li>
									@endforeach
                                 </ul>
                                 <div class="buynow_btn">
									@if(isset($Subscription) && !empty($Subscription) && $Subscription->plan_id == $value->plan_id)
										<a href="javascript:void(0)" class="buynow" data-plan_id="{{$value->plan_id}}" data-plan_price="{{$value->price}}">{{trans('common.active_plan')}}</a>
									@elseif(isset($user) && !empty($user))
										<a href="{{url('payment')}}/{{$value->id}}"  class="buynow">{{trans('common.update_plan')}}</a>
									@else
										<a href="javascript:void(0)" data-id="{{$value->id}}" class="buynow" >{{trans('common.buy_now')}}</a>
									@endif
								 </div>
                              </div>
                           </div>
                        </div>
						@endif
						@endforeach 
                     </div>
					
                  </div>
               </div>
            </div>
         </section>
		 <section class="homesection blog" id="blogsection">
            <div class="container">
				<div class="row latestblogsec pb-3">
				<h2 class="text-center" style="width:100%;">Our Latest Posts</h2>
					
					<div class="blog-slider" id="blogSlider">
						@php 
							$blog_listing = bloglisting()
						@endphp 
						@if(count($blog_listing)>0)
						@foreach($blog_listing as $key=>$blog)	
						@php 
							$blog_content = strip_tags(excerpt($blog['content'],25, '...'))
						@endphp 
						<div class="latestbidumblk"> 
							<a href="{{url('blog')}}/{{$blog['slug']}}"> <div class="img-ref"><img  class="img-fluid" src="{{ url('uploads/blog/')}}/{{$blog['id']}}/{{$blog['image']}}" /></div>
							<h4>{{$blog['title']}}</h4>
							<p>{{ $blog_content}}  </p>
							</a> 
						</div>
						@endforeach
						@else
						<div class="latestbidumblk"> 
							<p class="error" style="color:red">No Record Found.</p>
						</div>
						@endif
					
					</div>
				</div>
			</div>
		</section>
         <section class="homesection faqsection wow fadeInUp" data-wow-duration="1500ms">
            <div class="container">
               <div class="faqcontentsec">
                  <h2 class="text-center">{{trans('home.faq')}}</h2>
                  <p>{{trans('home.want-to-ask')}}</p>
                  <div id="accordion" class="faqaccordion">
                     <div class="card wow fadeInUp" data-wow-duration="1500ms">
                        <div class="card-header">
                           <a class="card-link" data-toggle="collapse" href="#collapseOne">
                           {{trans('home.faq_question_answer_1.question_1')}}
                           </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                           <div class="card-body">
                              <p>{{trans('home.faq_question_answer_1.answer_1')}}
                              </p>
                             
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInUp" data-wow-duration="1500ms">
                        <div class="card-header">
                           <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                            {{trans('home.faq_question_answer_2.question_1')}}
                           </a>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              <p>{!! trans('home.faq_question_answer_2.answer_1') !!} 
                              </p>
                             
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInUp" data-wow-duration="1500ms">
                        <div class="card-header">
                           <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                            {{trans('home.faq_question_answer_3.question_1')}}
                           </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              <p>{{trans('home.faq_question_answer_3.answer_1')}} 
                              </p>
                             
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInUp" data-wow-duration="1500ms">
                        <div class="card-header">
                           <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                            {{trans('home.faq_question_answer_4.question_1')}}
                           </a>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              <p>{{trans('home.faq_question_answer_4.answer_1')}} 
                              </p>
                             
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInUp" data-wow-duration="1500ms">
                        <div class="card-header">
                           <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                           {{trans('home.faq_question_answer_5.question_1')}}
                           </a>
                        </div>
                        <div id="collapseFive" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              <p>{{trans('home.faq_question_answer_5.answer_1')}} 
                              </p>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
@section('userJs')
<script src="{{ url('frontend/js/module/landing.js')}}"></script>

<script>
$(document).ready(function(){
	$(document).on('click','#dweditbutton,#dwpdfbutton,.access_btn', function(e) {
		$('#sign-in').addClass('active').fadeIn('slow');
		$('#account').removeClass('active').fadeOut('slow');
	});


	var csrf_token = $('input[name="_token"]').val();
	$('.buynow').on('click', function() {
		var id = $(this).data("id");
		var plan_type = $(this).text();
		var check_login = $("#login_id").val();
		if(plan_type != "Active Plan"){
			if(check_login != ""){
				
			}else{
				$('#sign-in').addClass('active').fadeIn('slow');
				$('#account').removeClass('active').fadeOut('slow');
				$("#signinmodal").modal('show');
				$('#redirect_to').val('/payment/'+id)
			}
		}
		
		
	})
});

</script>
@stop

<!-- Modal -->
<div class="modal preview-popup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-single-row">
    <div class="modal-dialog">
        <div class="modal-content" id="frmAddProject"></div>
    </div>
</div>

<div id="payment_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
<?php 
	if(config('paypal.settings.mode') == 'live'){
		$client_id = config('paypal.live_client_id');
		$secret = config('paypal.live_secret');
		$api_url = config('paypal.live_api_url');
		$paypalproductId = config('paypal.live_productId');
	} else {
		$client_id = config('paypal.sandbox_client_id');
		$secret = config('paypal.sandbox_secret');
		$api_url = config('paypal.sandbax_api_url');
		$paypalproductId = config('paypal.sandbox_productId');
	}
?>

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<h4 class="modal-title">Payment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="payment_body">
		<div class="row">
				
			  <div class="col-md-6" style="border: 4px solid #ececee;order-radius: 12px;background-color: #fff;margin-bottom: 40px;">
				  <p class="text-center" style="font-weight:bold">
					Get Full Access to Namoothaj Toolkit with Free Updates!
				</p>
				<div id="paypal-button-container"></div>
				<img src="{{asset('frontend/images/cards.jpg')}}" style="width:100%;margin-top:10px">
			</div>	
			
			 <div class="col-md-6">
					<div class="" style="border: 4px solid #ececee;order-radius: 12px;background-color: #fff;margin-bottom: 40px;">
					<h5 class="summary-title"  style="font-weight:bold;padding: 10px;">Order Summary</h5><!--End .summary-title-->

					<table class="table table-summary">
						<thead>
							<tr>
								<th colspan="2">
									<h6>Namoothaj Subscription</h6>
									<p>Your subscription will automatically renew at the price below. </p>
									<p>You can login to your account anytime to cancel auto-renewal. </p>
								</th>
							</tr>
						</thead>

					<tbody>
						<tr>
							<td>Subscription Details</td>
							<td class="subscription-price" ></td>
						</tr>
						<tr class="summary-total">
							<td class="total-head"><b>Total:</b></td>
							<td class="subscription-total"></td>
						</tr><!-- End .summary-total -->
					</tbody>
					</table><!-- End .table table-summary -->
				</div>
				
				
			</div>
		</div>
			<input type="hidden" id="plan_id_popup" value="">
			<input type="hidden" id="plan_price_popup" value="">
			<input type="hidden" id="csrf_token_val" value="">
			<script src="https://www.paypal.com/sdk/js?client-id=ATS02aq6KyfLWqIob9YutwLmY_P2T_U8PobzSJbBPmSa6PrhjYbmciYpDfC-5CrqOdu1GUqyvtwqsMe4&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
			
			<script src="{{ url('frontend/js/jquery-2.2.0.min.js')}}" type="text/javascript"></script>

			<script>
			
				// var plan_id = document.getElementById("plan_id");
				//var planId = document.getElementById("plan_id_popup").value;
				
				var apiKey = '{{$client_id}}';
				var password = '{{$secret}}';
				var api_url = '{{$api_url}}';
				var user_id = '{{$user ? user_id() : ''}}';
				var plan_price = document.getElementById("plan_price_popup").value;
				/* var csrf_token = document.getElementById("csrf_token_val").value; */
				var csrf_token = $("#csrf_token_val").val();
				
				paypal.Buttons({
				  style: {
					  shape: 'rect',
					  color: 'gold',
					  layout: 'vertical',
					  label: 'subscribe'
				  },
					createSubscription: function(data, actions) {
						//var planId = document.getElementById("plan_id_popup").value;
						return actions.subscription.create({
							'plan_id': document.getElementById("plan_id_popup").value
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
											data: {_token:document.getElementById("csrf_token_val").value,subscription_id:subscription_id,plan_id:plan_id,user_id:user_id,PayerName:PayerName,PayerMail:PayerMail,payer_id:payer_id,plan_price:plan_price,CreateTime:CreateTime,UpdateTime:UpdateTime,status:status,next_billing_time:next_billing_time},
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


@endsection
