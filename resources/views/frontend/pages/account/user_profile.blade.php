@extends('frontend.layouts.landing')
@section('content')
@section('extraJsCss')

@stop
<main class="site-content profilecontent">
	 <section class="innersection profilebanner">
		<div class="container">
		   <div class="row align-items-center">
			  <div class="col-md-12 col-12 profilebanner_cont wow fadeInUp">
				 <div class="profileimg">
				 
				 @if(auth::user()->profile_photo==NULL)
					   <div class="thumb profile_photo image">
						  <a href="javascript:void(0)" data-toggle="modal" data-target=".upload_photo_modal" class="show_image"  ><span> {{ substr(auth::user()->first_name,0,1) }}</span></a>
					   </div>
					@else
					 
					 @php
						$photo =  profile_photo(auth::user()->id);
					 @endphp
					<div class="image profile_photo">
						 <a href="javascript:void(0)" data-toggle="modal" data-target=".upload_photo_modal" class="show_image"  >
							<div id='profile-upload'>
							 <img class="profile_photo_change" src="{{timthumb($photo,80,80)}}">
							  <i class="fa fa-camera"></i>
							</div>
						 </a>	
					</div>
					 
					@endif
		
				 </div>
				 <div class="profilecont">
					<h2>{{user_data()->first_name}} {{user_data()->last_name}}</h2>
					<span><i class="fa fa-envelope"></i>{{user_data()->email}}</span>
				 </div>
			  </div>
		   </div>
		</div>
	 </section>
	 <section class="innersection innerprofilebtns">
		<div class="container">
		   <div class="row">
			  <div class="col-md-12">
				 <ul class="innerprofilebtn_div">
					<li class="account_btn active"><a href="#"><i class="fa fa-user-circle"></i>{{trans('profile.account')}}</a></li>
					<li class="subscript_btn"><a href="#"><i class="fa fa-bell"></i>{{trans('profile.subscription')}}</a></li>
				 </ul>
			  </div>
		   </div>
		</div>
	 </section>
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
							<a href="javascript:void(0)" class=" btn btn-primary update_password"> {{trans('profile.update_password')}}</a>
							
						  </div>
					   </div>
					</div>
				 </form>
			  </div>
		   </div>
		</div>
	 </section>
  </main>
  <div class="modal fade upload_photo_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg subs-modal profile_photo_modal">
    <div class="modal-content">
			<div class="modal-body">
			
			
		    	<div class="modal-header md-header" >
				 <div class="header-cont"><span style="color:#fff;font-size:16px">{{trans('profile.upload_photo')}} </span>  </div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			
			  </div>
			
			
				
					  <div class="row upload_box">
						<div class="col-md-6 text-center">
						<div id="upload-demo"></div>
						</div>
						<div class="col-md-6" style="padding:5%;">
						<strong>{{trans('profile.choose_photo')}}:</strong>
						<!--input type="file" id="image_file"--> 
						 <input type="file" id="upload_profile_file" name="upload_profile_file" class="upload_input" accept="image/*" onChange="validate(this.value)"/>
						<p class="upload_profile_file_error error">&nbsp; </p>
						<button class="btn  btn-block upload-image" disabled="disabled" style="margin-top:2%">{{trans('profile.upload_image')}}</button>
						<div class="alert alert-success" id="upload-success" style="display: none;margin-top:10px;"></div>
						</div>
						<!--div class="col-md-4">
						<div id="preview-crop-image" style="background:#9d9d9d;width:200px;padding:50px 50px;height:200px;"></div>
						</div-->
					  </div>

		  </div>
   
    </div>
  </div>
</div>
  @endsection
