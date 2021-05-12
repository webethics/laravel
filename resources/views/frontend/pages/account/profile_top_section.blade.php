@if(auth::user()->banner_photo==NULL)
	@php
		$banner_photo =  url('frontend/images/game_guide_banner.png');
	@endphp
@else
	@php
		$banner_photo =  banner_photo(auth::user()->id);
	@endphp
@endif

<section class="innersection profilebanner profile-banner"  style="background-image:url({{$banner_photo}})">
		<div class="container">
		   <div class="row align-items-center">
		   <div class="content-holder">
			  <div class="col-md-12 profilebanner_cont wow fadeInUp">
			 
				<div class="profile-image">
						<input type="hidden" value="{{auth::user()->role_id}}" id="user_role_id">
						@if(auth::user()->profile_photo==NULL)
					       {{--<div class="thumb profile_photo image"> --}}
								<a href="javascript:void(0)" data-toggle="modal" data-target="#upload_photo_modal" class="show_image"  >
									<span> 
										<img src="{{ url('frontend/images/user-profile.png')}}">
										{{-- substr(auth::user()->first_name,0,1) --}}
									</span>
								</a>
				            {{--</div>--}}
						@else
						 
							@php
								$photo =  profile_photo(auth::user()->id);
							@endphp

							{{--<div class="image profile_photo">--}}
								<a href="javascript:void(0)" data-toggle="modal" data-target="#upload_photo_modal" class="show_image"  >
									<div id='profile-upload'>
										<img class="profile_photo_change" src="{{$photo}}">
										{{--<img class="profile_photo_change" src="{{timthumb($photo,140,140)}}">--}}
									  	<i class="fa fa-camera"></i>
									</div>
								</a>	
							{{--</div>--}}
			 
						@endif

							
					</div>
					
				
				 <div class="profilecont">
					<h2>{{user_data()->first_name}} {{user_data()->last_name}}</h2>
					<span><i class="fa fa-envelope"></i>{{user_data()->email}}</span>
				 </div>
			  </div>
			  <!--div class="col-md-8">
					@include('frontend.pages.account.profile_menu')
			  </div-->
		   </div> 
		   </div>
		</div>
		<a href="javascript:void(0);" data-toggle="modal" data-target=".upload_banner_modal" class="edit-option"><i class="fas fa-pencil-alt"></i></a>
	 </section>