
<div class="modal-dialog" role="document">
	<div class="modal-content">
			<!-- Modal Header -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
			
  	@foreach($leads as $lead)
	  				<!-- Modal Body -->
		<div class="modal-body">
			<form method="POST" id="leads_edit_form">
				<input type="hidden" id="lead_id" value="{{$lead->id}}"/>
							<!-- CLIENT NAME -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Client Name</label>
							<div class="d-flex control-group">
								<input type="text" name="client_name" id="client_name" value="{{$lead->client_name}}" class="form-control{{ $errors->has('client_name') ? ' is-invalid' : '' }}" placeholder="Client Name" autocomplete="off">
							</div>	
							<span class="text-danger" id="invalid-feedback"> </span>
					</div>

							<!-- UPWORK ID -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Upwork ID</label>
							<select  id="upwork_id" class="form-control select2-single"  name="upwork_id"  data-width="100%">
							@foreach($upwork_id as $upwork)
								<option value="{{$upwork->id}}" @if($lead->upwork_id == $upwork->id) selected @endif >{{$upwork->upwork_id_name}}</option>	
							@endforeach
							</select>
							<div class="text-danger" id="upwork_id-errors"></div>
					</div>
						
						
								<!-- JOB TITLE -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Title</label>
							<div class="d-flex control-group">
								<input type="text"  name="job_title"  id="job_title"  value="{{$lead->job_title}}"  class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}" placeholder="Job Title" autocomplete="off">
							</div>	
							<div class="text-danger" id="job_title_invalid-feedback"></div>									
					</div>	

									<!-- JOB URL -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Job URL</label>
						<div class="d-flex control-group">
							<input type="text"  name="job_url"  id="job_url"  value="{{$lead->job_url}}"  class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}" placeholder="Job URL" autocomplete="off">								
						</div>	
						<div class="text-danger" id="job_url_invalid-feedback"></div>									
					</div>	
										<!-- CLIENT BUDGET -->
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Client Budget</label>
							<div class="d-flex control-group">
								<input type="text" name="client_budget"  id="client_budget"  value="{{$lead->client_budget}}"  class="form-control{{ $errors->has('client_budget') ? ' is-invalid' : '' }}"  placeholder="Client 		Budget" autocomplete="off">								
							</div>		
						<div class="text-danger" id="client_budget_invalid-feedback"></div>							
					</div>	

									<!-- OUR ESTIMATE -->
									
					<div class="form-group form-row-parent">
						<label class="col-form-label" style="margin-bottom:-5px;">Our Estimate</label>
						<div class="d-flex control-group">
							<input type="text" value="{{$lead->our_estimate}}"  name="our_estimate"   class="form-control{{ $errors->has('our_estimate') ? ' is-invalid' : '' }}"  id="our_estimate"  placeholder="Our Estimate" autocomplete="off">
						</div>	
							<div class="text-danger" id="our_estimate_invalid-feedback"></div>								
					</div>	
										<!-- BIDDER NAME -->
						<div class="form-group form-row-parent">
							<label class="col-form-label" style="margin-bottom:-5px;">Bidder Name</label>
								<div class="d-flex control-group">
									<select  name="bidder_id" id="bidder_id"   class="form-control select2-single"    data-width="100%">
										@foreach($bidder as $bi)
											<option value="{{$bi->id}}" @if($lead->bidder_id == $bi->id) selected @endif>
											{{$bi->bidder_name}}</option>
										@endforeach	
									</select>						
								</div>	
							<div class="text-danger" id="bidder_id-errors"></div>								
						</div>



								<!-- STATUS	 -->
						<div class="form-group form-row-parent">
							<label class="col-form-label" style="margin-bottom:-5px;">Status</label>
								<div class="d-flex control-group">
									<select name="status" id="status" data-lead_id="{{$lead->id}}" class="form-control select2-single reason"    data-width="100%">
								
										<option value="1"   @if($lead->status == 1) selected @endif>Active</option>
								
										<option value="2"   @if($lead->status == 2) selected @endif>Hired</option>
								
										<option value="3"   @if($lead->status == 3) selected @endif>Lost</option>
								
										<option value="4"  @if($lead->status == 4) selected @endif>Unresponsive</option>

									</select>						
								</div>	
							<div class="text-danger" id="status-errors"></div>									
						</div>
												
							<!-- submit Button -->
						<div class="form-row mt-4">
							<div class="col-md-12">
								<button  id="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto">{{ trans('global.submit') }}</button>
							</div>
						</div>
			</form>
								<!-- Add Comment Modal -->
							<label class="mb-5 mt-5">Comments</label><a href="#" class="leadaddcomment" style="margin-left: 169px;font-weight: bolder;" onMouseOver="this.style.color='#f9633e'"  class="addcoment" data-user_id="{{$lead->id}}" onMouseOut="this.style.color='#3934d8'"> Add Comment</a>
								<div class="commentdiv">
									@foreach($comments as $key => $comment)
									@include('admin.comments.comments')
									@endforeach
								</div>		
						
		</div>  <!-- Modal body Div Closing -->
	@endforeach
	 </div>  <!-- Modal Content Div Closing -->
</div>	<!-- Modal Dialog Div Closing -->


				<!-- Dropdown Picker JS -->
<script>
   $('#upwork_id,#bidder_id,#status').select2({
		dropdownParent: $('.leadEditModal')
			
    });


	// Lost Reason Modal 

	$(document).ready(function(){ //Make script DOM ready
    $('#status').change(function() { //jQuery Change Function
        var opval = $(this).val();
		 //Get value from select element
		var userid = $(this).data('lead_id');
	
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
        if(opval=="3"){ //Compare it and if true
			$.ajax({
		type: "POST",
		dataType: 'json',
		url: base_url+'/addreasonmodal/'+userid,
		
		data: {_token:csrf_token,userid:userid},
		

		success: function(data) {
			// console.log(data);
			if(data.success){
				
				$('.leadAddReasonsmodal').html(data.data);
				$('.leadAddReasonsmodal').modal('show');  // /This name of class is defined in the leads.blade.php
				$('.errors').html('');
				
			}else{
				notification('Error','Something went wrong.','top-right','error',2000);
			}	
		},
	});
        }
    });
});


// Lost Reason Pop-up blocking if it is empty
$('.leadAddReasonsmodal').on('hide.bs.modal', function(e){
var reason = $('#lost_lead_reason').val();
  if( reason == "" ) {
     e.preventDefault();
     e.stopImmediatePropagation();
   	 return false; 
   }    
});

</script>






