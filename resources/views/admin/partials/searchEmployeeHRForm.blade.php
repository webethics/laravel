<form action="{{ url('customer/advance-search') }}" method="POST" id="searchForm" >
		@csrf
<div class="row">
	<div class="col-md-12 mb-4">
	<div class="card h-100">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="form-group col-lg-6">
							<input type="text" name="Emp_ID" id="Emp_ID" class="form-control" placeholder="{{trans('Search By EMP ID')}}">
						</div>
						<div class="form-group col-lg-6">
							<input type="text" name="name" id="name" class="form-control" placeholder="{{trans('Search By Name')}}">
						</div>
						<div class="form-group col-lg-6">
						<select id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
							<option value="0">Select Tech Stack</option>
								<option value="a" @if(old("is_featured") == '1') {{'selected'}} @endif >PHP</option>
								<option value="b" @if(old("is_featured") == '2') {{'selected'}} @endif >Wordpress</option>
								<option value="c" @if(old("is_featured") == '3') {{'selected'}} @endif >Java</option>
								<option value="d" @if(old("is_featured") == '4') {{'selected'}} @endif >C++</option>
						</select>
						</div>
						<div class="form-group col-lg-6">
						<select id="By_Status"  class="form-control select2-single"  name="is_featured"  data-width="100%">
							<option value="0">Select By Category</option>
								<option value="1" @if(old("By_Status") == '1') {{'selected'}} @endif >Category1</option>
								<option value="2" @if(old("By_Status") == '2') {{'selected'}} @endif >Category2</option>
								<option value="3" @if(old("By_Status") == '3') {{'selected'}} @endif >Category3</option>
								
						</select>
						</div>  
						
						<!-- If User is Super Admin --> 
						@if(current_user_role_id() == '10000')
						<div class="form-group col-lg-6">
							<select  id="role_id"  class="form-control select2-single"  name="role_id"  data-width="100%">
										
    								<option value=" ">{{trans('global.filter_by_role')}}</option>
								@foreach($roles as $key=>$role)
								@if($role->id!=1)
								<option value="{{$role->id}}">{{$role->title}}</option>
								@endif
								@endforeach
							</select>
						</div>
						@endif
						
					</div>
				</div>	
				
				<div class="col-lg-6">
					<div class="row">

					<div class="form-group col-lg-6">
							<input type="text" name="email" id="email" class="form-control" placeholder="{{trans('Search By Email')}}">
						</div>
                        <div class="form-group col-lg-6">
							<input type="text" name="Phone" id="Phone" class="form-control" placeholder="{{trans('Search By Phone')}}">
						</div>




						


						<div class="form-group col-lg-6">
							  
						<select id="By_Status"  class="form-control select2-single"  name="is_featured"  data-width="100%">
							<option value="0">Select By Company</option>
								<option value="1" @if(old("By_Status") == '1') {{'selected'}} @endif >Webethics</option>
								<option value="2" @if(old("By_Status") == '2') {{'selected'}} @endif >Microsoft</option>
								<option value="3" @if(old("By_Status") == '3') {{'selected'}} @endif >Google</option>
								
						</select>
							
						</div>
						
                       
                       
					
						
					
						<!-- <div class="form-group col-lg-6">
							<input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Search by Mobile Number">
						</div>
						 -->
						<!--<div class="form-group col-lg-6">
							<select  id="gender"  class="form-control select2-single"  name="gender"  data-width="100%">
										
								<option value=" ">{{trans('global.filter_by_gender')}}</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>
						<div class="form-group col-lg-3">
							<select id="age_from"  class="form-control select2-single"  name="age_from"  data-width="100%">
								<option value=" ">{{trans('global.filter_by_age_from')}}</option>
								@for($i=12;$i<=65;$i++)
									<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div>
						<div class="form-group col-lg-3">						
							<select id="age_to"  class="form-control select2-single"  name="age_to"  data-width="100%">
								<option value=" ">{{trans('global.filter_by_age_to')}}</option>
								@for($i=12;$i<=65;$i++)
									<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div> 
						-->
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-6">
					<button type="submit" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto">{{trans('global.submit')}}</button>
					
					<div class="spinner-border text-primary search_spinloder" style="display:none"></div>
				</div>	
			</div>
		</div>
	</div>				
	</div>
	</div>	
</form>