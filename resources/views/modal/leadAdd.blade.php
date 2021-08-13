
<div id="AddLead" tabindex="-1"  class="modal fade modal-right" role="dialog">
	<div class="modal-dialog">
	
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" style="overflow: visible;">
				<form  method="POST"  id="leads_form" >
					<!-- Client Name -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Client Name</label>
						<div class="d-flex control-group">
							<input type="text" name="client_name" id="client_name" class="form-control" placeholder="Client Name" autocomplete="off">	
						</div>	
						<span class="text-danger" id="client_name-error"></span>
					</div>

					<!-- Upwork_id -->
					<div class="form-group form-row-parent">
					<label class="col-form-label" style="margin-bottom:-5px;">Upwork ID</label>
					
					<select  class="form-control select2-single" id="upwork_id2" name="upwork_id" style="height:50px;"  data-width="100%" >
					
										<option value=" " style="padding-left:10px;">  Select Upwork ID</option>
										@foreach($upwork_id as $upwork)
											<option value="{{$upwork->id}}" >{{$upwork->upwork_id_name}}</option>
											
										@endforeach
					</select>	
					<span class="text-danger" id="upwork-id-error"></span>
					</div>
		
		
				<!-- Job Title -->
					<div class="form-group form-row-parent">
					<label class="col-form-label" style="margin-bottom:-5px;"> Title</label>
						<div class="d-flex control-group">
							<input type="text" name="job_title"  id="job_title"  class="form-control" placeholder=" Title" maxlength="25" autocomplete="off">								
						</div>	
						<span class="text-danger" id="job_title-error"></span>						
					</div>	


							<!-- Job URL -->
					<div class="form-group form-row-parent">
					<label class="col-form-label" style="margin-bottom:-5px;"> Job URL</label>
						<div class="d-flex control-group">
							<input type="text" name="job_url"  id="job_url"  class="form-control" placeholder=" Job URL" autocomplete="off">								
						</div>	
						<span class="text-danger" id="job_url-error"></span>						
					</div>	


							<!-- Client Budget -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Client Budget</label>
						<div class="d-flex control-group">
							<input type="text" name="client_budget"  id="client_budget" class="form-control" placeholder="Client Budget" autocomplete="off">								
						</div>	
						<span class="text-danger" id="client_budget-error"></span>							
					</div>	

					<!-- Our Estimate -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Our Estimate</label>
							<div class="d-flex control-group">
								<input type="text" name="our_estimate"  class="form-control" id="our_estimate" placeholder="Our	Estimate" autocomplete="off">								
							</div>	
									
					</div>	

							<!-- Bidder ID -->
						<div class="form-group form-row-parent">
							<label class="col-form-label" style="margin-bottom:-5px;">Bidder Name</label>
							<div class="d-flex control-group">
						
								<select   class="form-control select2-single"  name="bidder_id" id="bidder_id2" data-width="100%">
								<option value=" " >Select Bidder Name</option>
										@foreach($bidder as $b)
										
									<option value="{{$b->id}}">{{$b->bidder_name}}</option>
																		
										@endforeach							
								</select>
							</div>	
							<span class="text-danger" id="bidder_id-error"></span>						
						</div>



							<!-- Status -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Status</label>
						<div class="d-flex control-group">
							<select   class="form-control select2-single"  name="status" id="status2" data-width="100%">
								<!-- <option value=" "  >Status</option> -->
								<option value="1" >Active</option>
								<option value="2" >Hired</option>
								<option value="3" >Lost</option>
								<option value="4" >Unresponsive</option>
							</select>						
						</div>
						<span class="text-danger" id="status-error"></span>		
					</div>

							<!-- Submit Button -->
						<div class="form-row mt-4">
							<div class="col-md-12">
								<button  id="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto">{{ trans('global.submit') }}</button>
									<div class="spinner-border text-primary request_loader" style="display:none"></div>
							</div>
						</div>
			
				</form>
				</div>
			</div>
		
		</div>
	</div>
</div>
