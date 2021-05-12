<div class="menu">
	<div class="main-menu">
		<div class="scroll">
		
		
		 @php    
			$roleArray = Config::get('constant.role_id');
			$dashboardactive='';  $custactive='';	 $configactive='';  	$roleactive='';$cmsactive='';$planactive='';$paymentactive='';
			
			$emailactive ='';$site_sactive ='';$accactive  ='';
		 @endphp
		 
		 @if(collect(request()->segments())->last()=='account')
		 @php
	      $accactive ='active'
	     @endphp
		 @endif
		
		  @if(collect(request()->segments())->last()=='settings')
		 @php
	      $configactive ='active'
	     @endphp
		 @endif
		  @if(collect(request()->segments())->last()=='dashboard')
		 @php
	      $dashboardactive ='active'
	     @endphp
		 @endif
		  
		  @if(collect(request()->segments())->last()=='customers')
		 @php
	      $custactive ='active'
	     @endphp
		 @endif
		  
		  @if(collect(request()->segments())->last()=='emails')
		 @php
	      $emailactive ='active'
	     @endphp
		 @endif
		 @if(collect(request()->segments())->last()=='roles')
		 @php
	      $roleactive ='active'
	     @endphp
		 @endif
		 
		@if(collect(request()->segments())->last()=='cms-pages')
		 @php
	      $cmsactive ='active'
	     @endphp
		 @endif
		 
		@if(collect(request()->segments())->last()=='paymentlisting')
		 @php
	      $paymentactive ='active'
	     @endphp
		 @endif
		@if(collect(request()->segments())->last()=='listplans')
		 @php
	      $planactive ='active'
	     @endphp
		 @endif
		 @if(collect(request()->segments())->last()=='blogs')
		 @php
	      $blogsactive ='active'
	     @endphp
		 @endif

		 @if(collect(request()->segments())->last()=='auctions')
		 @php
	      $auctionsactive ='active'
	     @endphp
		 @endif
		 
			<ul class="list-unstyled">
				
					@if(check_role_access('dashboard_listing'))
					<li class="{{$dashboardactive}}">
						<a href="{{url('/admin/dashboard')}}">
							<i class="simple-icon-home"></i>
							<span>Dashboard</span>
						</a>
					</li>
					@endif
					@if(current_user_role_id() != 1)
					<li class="{{$accactive}}">
						<a href="{{url('/admin/account')}}">
							<i class="iconsminds-user"></i> 
							<span>Account</span>
						</a>
					</li>
					@endif
					@if(check_role_access('customer_listing'))
						<li class="{{$custactive}}">
							<a href="{{url('/admin/customers')}}">
								<i class="simple-icon-user"></i>
								<span>Customers</span>
							</a>
						</li>
					@endif
					
					@if(check_role_access('email_listing'))
					<li class="{{$emailactive}}">
						<a href="{{url('/admin/emails')}}">
							<i class="iconsminds-mail"></i>
							<span>Email</span>
						</a>
					</li>
					@endif
					@if(check_role_access('config_listing'))
					<li class="{{$configactive}}">
						<a href="{{url('/admin/settings')}}">
							<i class="simple-icon-settings"></i>
							<span>Config</span>
						</a>
					</li>
					@endif

					@if(check_role_access('auction_listing'))
					<li class="{{$auctionsactive ?? '' }}">
						<a href="{{url('/admin/auctions')}}">
							<i class="simple-icon-list"></i>
							<span>Listing</span>
						</a>
					</li>
					@endif

					@if(check_role_access('blog_listing'))
					<li class="{{$blogsactive ?? '' }}">
						<a href="{{url('/admin/blogs')}}">
							<i class="simple-icon-grid"></i>
							<span>Blogs</span>
						</a>
					</li>
					@endif

					
					
					<li class="{{$planactive}}">
						<a href="{{url('/admin/listplans')}}">
							<i class="iconsminds-dollar	"></i>
							<span>Plans</span>
						</a>
					</li>
					
					
					<!--@if(check_role_access('roles_listing'))
					<li class="{{$roleactive}}">
						<a href="{{url('/admin/roles')}}">
							<i class="simple-icon-organization"></i>
							<span>Roles</span>
						</a>
					</li> 
					@endif -->
					
					<li class="{{$cmsactive}}">
						<a href="{{url('/admin/cms-pages')}}">
							<i class="simple-icon-docs"></i>
							<span>CMS Pages</span>
						</a>
					</li>
					
					
					<li class="{{$paymentactive}}">
						<a href="{{url('/admin/paymentlisting')}}">
							<i class="simple-icon-paypal"></i>
							<span>Payments</span>
						</a>
					</li>
					

			</ul>
		</div>
	</div>    
</div>