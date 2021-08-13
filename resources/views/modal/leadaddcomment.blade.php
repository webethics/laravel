
	<div class="modal-dialog" role="document">

			<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header"> Add Comment
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form  method="POST" id="comments_form" >
					<div class="mb-3">
						<textarea class="form-control" id="comment_content" name="comment_content" rows="3" placeholder="Add Comment"></textarea>
						@php
						$user = user_data()
						@endphp 
						@foreach($leads as $lead)
						<input type="visible" id="user_id" value="{{$lead->id}}" name="user_id" />
						@endforeach
						<span class="text-danger" id="comment_content-error"></span>
                    </div>
					
					<button  id="submit" class="btn btn-primary default btn-lg mt-5 mb-sm-0 mr-2 col-12 col-sm-auto" >Submit</button>
                    <button type="click" class="btn btn-secondary default btn-lg mt-5 mb-sm-0 mr-2 col-12 col-sm-auto closebutton closebutton" data-dismiss="modal">Close</button>
				</form>
			</div>
		</div>
	</div>


