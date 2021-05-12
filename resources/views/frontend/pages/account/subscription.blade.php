<?php
use App\Models\Plan;
?>
@extends('frontend.layouts.landing')
@section('pageTitle','Subscription')
@section('content')
@section('extraJsCss')

@stop
  <main class="site-content profilecontent">
	 @include('frontend.pages.account.profile_top_section')
	 @include('frontend.pages.account.profile_menu')
	 <section class="innerplansection whitebg">
		<div class="container">
		   <div class="plansection_cont">
			 
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
											@elseif(isset($user) && !empty($user) && isset($Subscription) && !empty($Subscription))
												<a href="{{url('payment')}}/{{$value->id}}" class="buynow">{{trans('common.update_plan')}}</a>
											@else
												<a href="{{url('payment')}}/{{$value->id}}" class="buynow">{{trans('common.buy_now')}}</a>
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
										@elseif(isset($user) && !empty($user) && isset($Subscription) && !empty($Subscription))
											<a href="{{url('payment')}}/{{$value->id}}" >{{trans('common.update_plan')}}</a>
										@else
											<a href="{{url('payment')}}/{{$value->id}}"  class="buynow" >{{trans('common.buy_now')}}</a>
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
									@elseif(isset($user) && !empty($user) && isset($Subscription) && !empty($Subscription))
										<a href="{{url('payment')}}/{{$value->id}}"  class="buynow" data-plan_id="{{$value->plan_id}}" data-plan_price="{{$value->price}}">{{trans('common.update_plan')}}</a>
									@else
										<a href="{{url('payment')}}/{{$value->id}}"  class="buynow" >{{trans('common.buy_now')}}</a>
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
@include('frontend.pages.account.profile_image_upload')

@section('userJs')
<link rel="stylesheet" href="{{ url('frontend/css/croppie.min.css')}}">
<script src="{{ url('frontend/js/croppie.js')}}"></script>
<script src="{{ url('frontend/js/module/user.js')}}"></script>	
<script src="{{ url('frontend/js/module/plan.js')}}"></script>	

 <script>
$(document).ready(function(){
	
	var csrf_token = $('input[name="_token"]').val();
	
});

</script>
@stop

  @endsection