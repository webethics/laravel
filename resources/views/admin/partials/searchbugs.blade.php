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
                        <select id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
							<option value="0">Search By Project</option>
								<option value="1" @if(old("is_featured") == '1') {{'selected'}} @endif >Project1</option>
								<option value="2" @if(old("is_featured") == '2') {{'selected'}} @endif >Project2</option>
								<option value="3" @if(old("is_featured") == '3') {{'selected'}} @endif >Project3</option>
								
						</select>
						</div>
						<div class="form-group col-lg-6">
                        <select id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
							<option value="0">Search By Developer</option>
								<option value="1" @if(old("is_featured") == '1') {{'selected'}} @endif >Developer1</option>
								<option value="2" @if(old("is_featured") == '2') {{'selected'}} @endif >Developer2</option>
								<option value="3" @if(old("is_featured") == '3') {{'selected'}} @endif >Developer3</option>
								
						</select>
						</div>
						<div class="form-group col-lg-6">
						
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
                    <select id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
							<option value="0">Search By Status</option>
								<option value="1" @if(old("is_featured") == '1') {{'selected'}} @endif >Open</option>
								<option value="2" @if(old("is_featured") == '2') {{'selected'}} @endif >Fixed</option>
								<option value="3" @if(old("is_featured") == '3') {{'selected'}} @endif >Close</option>
								
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