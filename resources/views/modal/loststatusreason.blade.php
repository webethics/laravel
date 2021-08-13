
	<div class="modal-dialog" role="document">

			<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header"> Add Reason to Lost
			
			</div>
		
			<div class="modal-body">
		
          <!-- <input type="visible" value="2" id="leadid" /> -->
				<form  method="POST" id="reasons_form" >
					<div class="mb-3">
						<textarea class="form-control" id="comment_content" name="comment_content" rows="3" placeholder="Type Reason Here" ></textarea>
						<div class="text-danger" id="lost_lead_reason-errors"></div>	
						@foreach($leads as $lead)
						<input type="visible" id="user_id" value="{{$lead->id}}" name="user_id" />
						@endforeach
                    </div>
				
					<button  id="submit" class="btn btn-primary default btn-lg mt-5 mb-sm-0 mr-2 col-12 col-sm-auto" >Submit</button>
                   
				</form>
			</div>
		
		</div>
	</div>
</div>


<script>

</script>