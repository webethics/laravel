<form action="{{ url('leads/advance-search') }}" method="POST" id="searchForm" >
	@csrf	
		<div class="row">
			<div class="col-md-12 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="form-group col-lg-6">
										<input type="text" name="client_name" id="client_name" class="form-control" placeholder="{{trans('Search By Client Name')}}">
									</div>
									<div class="form-group col-lg-6">
										<input type="text" name="job_title" id="job_title" class="form-control" placeholder="{{trans('Search By  Title')}}">
									</div>
									<div class="form-group col-lg-6">
									<select  class="form-control select2-single" id="upwork_id1" name="upwork_id"  data-width="100%">
										<option value=" ">Select Upwork ID</option>
										@foreach($upwork_id as $upwork)
											<option value="{{$upwork->id}}" >{{$upwork->upwork_id_name}}</option>
											
										@endforeach
									</select>	
									</div>
								
									<div class="form-group col-lg-6">
									<select id="status1"  class="form-control select2-single"  name="status"  data-width="100%">
										<option value="0">Search By Status</option>
											<option value="1" >Active</option>
											<option value="2" >Hired</option>
											<option value="3" >Lost</option>
											<option value="4" >Unresponsive</option>
											
									</select>
									</div>
								
									
								</div>
							</div>	
							
							<div class="col-lg-6">
								<div class="row">
									<div class="form-group col-lg-6">
										<div class="input-group date">
											<input type="text" class="form-control"  id="start_date" name="start_date"
												placeholder="{{trans('global.start_date')}}" autocomplete="off">
											<span class="input-group-text input-group-append input-group-addon">
												<i class="simple-icon-calendar"></i>
											</span>

										</div>
									</div>
									<div class="form-group col-lg-6">
										
										<div class="input-group date">
											<input type="text" class="form-control"  placeholder="{{trans('global.end_date')}}" name="end_date" id="end_date" autocomplete="off">
											
											<span class="input-group-text input-group-append input-group-addon">
												<i class="simple-icon-calendar"></i>
											</span>
										</div>
										
									</div>
								

									<div class="form-group col-lg-6">
									<select   class="form-control select2-single"  name="bidder_id" id="bidder_id1" data-width="100%">
											<option value=" " >Select Bidder Name</option>
													@foreach($bidder as $b)
													
												<option value="{{$b->id}}">{{$b->bidder_name}}</option>
																					
													@endforeach							
											</select>	
									</div>


									<div class="form-group col-lg-6">
									<select   class="form-control select2-single"  name="custom_filter"  id="custom_filter1" data-width="100%">
										<option value=" ">Search By Custom </option>
											<option value="current_week">Current week</option>
											<option value="last_week"  > Last week</option>	
											<option value="current_month" > Current Month</option>	
											<option value="last_month"> Last Month </option>								
											
									</select>		
									</div>
								

								</div>	
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-6">
								<button id="btnFiterSubmitSearch" type="text" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto do-filter">{{trans('global.submit')}}</button>
								
								<div class="spinner-border text-primary search_spinloder" style="display:none"></div>
							</div>	
						</div>
					</div>
				</div>				
			</div>
		</div>	
</form>