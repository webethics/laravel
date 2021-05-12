<section class="innersection innerprofilebtns">
	<div class="container">
	   <div class="row">
		  <div class="col-md-12">
			@php $account = $subscription = $downloads  = '' @endphp
			@if(collect(request()->segments())->last()=='edit-profile' || collect(request()->segments())->last()=='user-profile')
				@php $account ='active' @endphp
			 @endif
			@if(collect(request()->segments())->last()=='subscription')
				@php $subscription ='active' @endphp
			 @endif
			 
			 <ul class="innerprofilebtn_div">
				<li class="account_btn {{$account}}"><a href="{{url('edit-profile')}}"><i class="fa fa-user-circle"></i>{{trans('profile.account')}}</a></li>
				<li class="subscript_btn {{$subscription}}"><a href="{{url('subscription')}}"><i class="fa fa-bell"></i>{{trans('profile.subscription')}}</a></li>
			 </ul>
		  </div>
	   </div>
	</div>
 </section>