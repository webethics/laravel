<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
							<div class="modal-body">
							<form method="POST" id="leads_comments_edit_form">
							
                            <div class="mb-3">
							@foreach($comments as $comment)
							<input type="hidden" id="commentid" value="{{$comment->id}}"/>
                                <textarea class="form-control{{ $errors->has('comment_content') ? ' is-invalid' : '' }} comment_content_{{$comment->id}}" id="exampleFormControlTextarea1" name="comment_content"  rows="3">{{$comment->comment_content}}</textarea>
								@endforeach
                                </div>
								<span class="text-danger" id="invalid-feedback"> </span>
								
                                <button type="submit" class="btn btn-primary default btn-lg mt-5 mb-sm-0 mr-2 col-12 col-sm-auto">Submit</button>

                                <button type="submit" class="btn btn-dark default btn-lg mt-5 mb-sm-0 mr-2 col-12 col-sm-auto closebutton" data-dismiss="modal">Close</button>
							</form>
							</div>
							
						
							</div>

					</div>
				</div>