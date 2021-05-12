@extends('frontend.layouts.landing')
@section('pageTitle','Edit Profile')
@section('content')
@section('extraJsCss')

@stop
<main class="site-content profilecontent">
	@include('frontend.pages.account.profile_top_section')
	@include('frontend.pages.account.profile_menu')
	 <section class="profileformsec mt-4">
		<div class="container">
		   <div class="dahboardright_section_bg">
			  <div class="dashboard_contblk">
				 <h4>{{trans('profile.basic_info')}}</h4>
				 <form method="POST"  class="frm_class dashboard-form">
					<div class="row">
					   <div class="form-group col">
						  <label>{{trans('profile.first_name')}}</label>
						   <input name="first_name" id="first_name" value="{{user_data()->first_name}}" placeholder="First Name" required="required" class="form-control" type="text">
							<i class="fa fa-check"></i>
						   <div class="error_margin"><span class="first_name_error error" ></span></div>
					   </div>
					    <div class="form-group col">
						   <label>{{trans('profile.last_name')}}*</label>
						   <input name="last_name" id="last_name" value="{{user_data()->last_name}}" placeholder="Last Name" required="required" class="form-control" type="text">
							<i class="fa fa-check"></i>
							<div class="error_margin"><span class="last_name_error error" ></span></div>
					   </div>
					   <div class="form-group col">
						   <label>{{trans('profile.email')}}*</label>
						   <input type="email"  class="form-control" value="{{user_data()->email}}" placeholder="Email" disabled="disabled">
							<i class="fa fa-check"></i>
					   </div>
					</div>
					<div class="row mt-4 updatebtnrow">
					   <div class="col text-center">
						  <div class="updatebtn">
							<a href="javascript:void(0)" class="btn btn-primary update_profile">{{trans('profile.update_info')}}</a>
						  </div>
					   </div>
					</div>
				 </form>
			  </div>
			  <div class="dashboard_contblk dashpwd_blk">
				 <h4>{{trans('profile.password')}}</h4>
				 <form class="dashboard-form">
				 @csrf
					<div class="row">
					   <div class="form-group col">
						  <label>{{trans('profile.current_password')}}*</label>
						   <input name="old_password"  required="required" placeholder="Current Password"  class="form-control"  type="password">
						  <i class="fa fa-check"></i>
						   <div class="error_margin"><span class="old_password_error errors" ></span></div>
					   </div>
					   <div class="form-group col">
						  <label>{{trans('profile.new_password')}}</label> 
						  <input name="password"  required="required" placeholder="New Password" class="form-control" type="password">
						  <i class="fa fa-check"></i>
						  <div class="error_margin"><span class="password_error errors" ></span></div>
					   </div>
					   <div class="form-group col">
						  <label>{{trans('profile.verify_password')}}</label>
						  <input name="confirm_password"  required="required" placeholder="Verify Password" class="form-control" type="password">
						  <i class="fa fa-check"></i>
						  <div class="error_margin"><span class="confirm_password_error errors" ></span></div>
					   </div>
					</div>
					<div class="row mt-4 updatebtnrow">
					   <div class="col text-center">
						  <div class="updatebtn">
							<a href="javascript:void(0)" class=" btn btn-primary update_password">{{trans('profile.update_password')}} </a>
							
						  </div>
					   </div>
					</div>
				 </form>
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
<script src="{{ url('frontend/js/module/profile.js')}}"></script>	
<script src="{{ url('frontend/js/module/plan.js')}}"></script>	

 
@stop
  @endsection
