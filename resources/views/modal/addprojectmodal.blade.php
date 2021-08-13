
<div id="addproject" tabindex="-1"  class="modal fade modal-right" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header py-1">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
	        <div class="modal-body">
	            <form action="" method="POST" id="updateUser" >
	            @csrf
	 
		        <div class="form-group form-row-parent">
                <label class="col-form-label" style="margin-bottom:-5px;">Title</label>
                    <div class="d-flex control-group">
                    <input type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="Title" >						
                    </div>								
		        </div>

                <div class="form-group form-row-parent">
                <label class="col-form-label" style="margin-bottom:-5px;">Description</label>
                    <div class="d-flex control-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description" rows="3"></textarea>						
                    </div>								
		        </div>



				<div class="form-row mt-4">
                <div class="col-md-12">
												<label for="Feature Images">Upload Image</label>
												
												<div class="clearfix"></div>
												<input id="fileupload" class="inputfile" type="file" name="image">
												<label class="mt-2 mb-3" for="fileupload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
												

																																						
														<div class="inputfile-preview old-file">
															<img src="http://127.0.0.1:8000/uploads/auctions/19/1770393128_auction_IMG_0719.jpeg" class="category_image auction_new_image auction_image">
															<a href="http://127.0.0.1:8000/admin/auctions/image_downlad/19" class="filedownlad filedownlad-auction">
																<i class="glyph-icon simple-icon-cloud-download"></i>
															</a>

															<a title="Delete Media" data-id="19" data-confirm_type="complete" data-confirm_message="Are you sure you want to delete the Image?" data-left_button_name="Yes" data-left_button_id="delete_auction_image" data-left_button_cls="btn-primary" class="open_confirmBox action deleteImageAuction" href="javascript:void(0)" data-auction_id="19">
																<i class="glyph-icon simple-icon-trash"></i>
															</a>
														</div>
																																					<div class="inputfile-preview new-file d-none">
													<img src="" class="category_image auction_image">
													<i class="glyph-icon simple-icon-trash new-auction-file-trash"></i>
												</div>
												<input type="hidden" name="feature_image" id="feature_image" value="">	
											


                <div class="form-row mt-4">
						<div class="col-md-12">
							<input id ="user_id" class="form-check-input" type="hidden" value="">
							<button type="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto">{{ trans('global.submit') }}</button>
							<div class="spinner-border text-primary request_loader" style="display:none"></div>
						</div>
					</div>
			
		
		
	
		
		    </div>
	    </div>
	</div>
</div>