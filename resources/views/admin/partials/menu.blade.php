<div class="menu">
	<div class="main-menu">
		<div class="scroll">
		
		
		 @php    
			$roleArray = Config::get('constant.role_id');
			$dashboardactive='';  $custactive='';	 $configactive='';  	$roleactive=''; $bugsactive=''; $leadsactive=''; $hractive='';
			
			$emailactive ='';$site_sactive ='';$accactive  ='';
		 @endphp
		 
		 @if(collect(request()->segments())->last()=='hrpanel')
		 @php
	      $hractive ='active'
	     @endphp
		 @endif

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

		 @if(collect(request()->segments())->last()=='leads')
		 @php
	      $leadsactive ='active'
	     @endphp
		 @endif

		 @if(collect(request()->segments())->last()=='roles')
		 @php
	      $roleactive ='active'
	     @endphp
		 @endif
		 
		@if(collect(request()->segments())->last()=='bugs')
		 @php
	      $bugsactive ='active'
	     @endphp
		 @endif
		 
	
		
		 @if(collect(request()->segments())->last()=='blogs')
		 @php
	      $blogsactive ='active'
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
					<li class="{{$leadsactive}}">
						<a href="{{url('/admin/leads')}}">
							<i class="iconsminds-dollar	"></i>
							<span>Leads</span>
						</a>
					</li>
					@if(check_role_access('customer_listing'))
						<li class="{{$custactive}}">
							<a href="{{url('/admin/customers')}}">
								<i class="simple-icon-user"></i>
								<span>Users</span>
							</a>
						</li>
					@endif
					
				

					<li class="{{$hractive}}">
						<a href="{{url('/admin/hrpanel')}}">
							<i class="simple-icon-grid"></i>
							<span>HR</span>
						</a>
					</li>

					<li class="{{$bugsactive}}">
						<a href="{{url('/admin/bugs')}}">
						<i class="simple-icon-docs"></i>
							<span>Bugs</span>
						</a>
					</li>



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

				

					
				

				
					
					
					<!--@if(check_role_access('roles_listing'))
					<li class="{{$roleactive}}">
						<a href="{{url('/admin/roles')}}">
							<i class="simple-icon-organization"></i>
							<span>Roles</span>
						</a>
					</li> 
					@endif -->
					
				
					
					
					

			</ul>
		</div>
	</div>    
</div>