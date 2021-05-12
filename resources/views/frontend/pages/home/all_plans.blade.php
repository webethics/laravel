@extends('frontend.layouts.landing')
@section('pageTitle','Pricing')
@section('content')
@section('extraJsCss')

@stop
<main class="site-content">
	 <section class="innersection innerbannersection" style="display:none">
		<div class="container">
		   <div class="row align-items-center">
			  <div class="col-md-6 col-6 innerbanner_img wow fadeInUp">
				 <h2>Pricing</h2>
			  </div>
			  <div class="col-md-6 col-6 innerbanner_title text-right wow fadeInUp">
				 <img style='height:160px' src="{{asset('frontend/images/faq-banner.png')}}" />
			  </div>
		   </div>
		</div>
	 </section>
	 <section class="homesection faqsection wow fadeInUp" data-wow-duration="1500ms">
		<div class="container">
			<div class="plansection_cont">
                  <h2 class="text-center">{{trans('home.our-best-plan')}}</h2>
                  <p class="text-center">{{trans('home.best-price-plan')}}</p>
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
												<a href="javascript:void(0)" class="buynow">{{trans('common.active_plan')}}</a>
											@elseif(isset($user) && !empty($user))
												<a href="{{url('payment')}}/{{$value->id}}" class="buynow">{{trans('common.update_plan')}}</a>
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
											<a href="{{url('payment')}}/{{$value->id}}" >{{trans('common.update_plan')}}</a>
										@else
											<a href="javascript:void(0)" data-id="{{$value->id}}" class="buynow" >{{trans('common.buy_now')}}</a>
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
										<a href="javascript:void(0)" class="buynow" >{{trans('common.active_plan')}}</a>
									@elseif(isset($user) && !empty($user))
										<a href="{{url('payment')}}/{{$value->id}}"  class="buynow" data-plan_id="{{$value->plan_id}}" data-plan_price="{{$value->price}}">{{trans('common.update_plan')}}</a>
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
  </main>

@section('userJs')
<script src="{{ url('frontend/js/slider.js')}}"></script>

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



@endsection	