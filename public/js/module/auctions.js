/**********Delete Game ***********/

$(document).on('click', '.delete_auction' , function() {
	var game_id = $(this).data('id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/auctions/delete_game/'+game_id,
        data: {_token:csrf_token,game_id:game_id},
        success: function(data) {
			if(data.success){
				notification('Success','Auction deleted Successfully','top-right','success',2000);
				if(typeof (data.view) != 'undefined' && data.view != null && data.view != ''){
					$('.auction_full').html(data.view);
				}else{
					$('.user_row_'+game_id).hide();
				}
			}else if(data.message){
				notification('Error',data.message,'top-right','error',4000);
			}else{	
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
});

/*==============================================
	ENABLE/DISABLE USER ACCOUNT 
============================================*/
$(document).on('click','.switch_status', function(e) {
	
	if($(this).is(":checked")){
		var game_status = 1;
	}
	else if($(this).is(":not(:checked)")){
		var game_status = 0;
	}
	var game_id = $(this).attr('data-game_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/auctions/enable-disable',
        data: {status:game_status,game_id:game_id,_token:csrf_token},
        success: function(data) {
             // IF TRUE THEN SHOW SUCCESS MESSAGE  
			 if(data.success){
				notification('Success','Lot has been active.','top-right','success',4000);
				
			}else{
             notification('Error','Lot has been deactivate.','top-right','error',4000);
			}	
			
        },
		error :function( data ) {}
    });
	
});

/*==============================================
	SEARCH FILTER FORM 
============================================*/
$(document).on('submit','#searchForm', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
	$this = $(this);
	var ajax_url = $this.attr('action');
	var method = $this.attr('method');
    $.ajax({
        type: method,
		//dataType: 'json',
        url: ajax_url,
        data: $(this).serialize(),
        success: function(data) {
			 $('.search_spinloder').css('display','none');
             $("#tag_container").empty().html(data);	
        },
		error :function( data ) {}
    });
});

/**************** File Preview *******************************/
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
    	$('.new-file .auction_image').attr('src', e.target.result);
    	$('.new-file').removeClass('d-none').show();
    	$('.old-file').hide();

    	/*Ajaxify upload image*/
    	uploadFeatureImage(e.target.result);
      	//$('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

/*Upload feature Image*/
function uploadFeatureImage(img){
	/**************** Upload feature image  *************************/
    if(img != ""){
    	var user_id = $('#user_id').val();
    	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    	var file_data = $("#fileupload").prop("files")[0]; 
		
	    var form_data = new FormData(); 
	    form_data.append("upload_feature_file", file_data);
	    form_data.append("user_id", user_id);
	    form_data.append("_token", csrf_token);
	    
		$.ajax({
	        type: "POST",
			dataType: 'json',
	        url: base_url+'/auctions/temp-save-feature-media',
	        data: form_data,
	        contentType: false,
			cache: false,
			processData: false,
	        success: function(data) {
				 if(data.success){
				 	if(typeof (data.temp_id) !="undefined" && data.temp_id != null && data.temp_id != ''){
				 		//console.log('Temp id='+data.temp_id);
				 		$('#feature_image').val(data.temp_id);
				 	}
						//notification('Success','Profile Photo Uploaded Successfully','top-right','success',2000);
				}else{
					notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
	        },
			error :function( data ) {
	         	notification('Error','Somthing went wrong.','top-right','error',2000);
			}
	    });
    }

}

$(document).ready(function(){

	$("#fileupload").change(function() {
	  	readURL(this);
	});
});

/************************** Check Feature Image Exist  *****************************************/

var feature_image = $('#feature_image').val();

/*Check if feature images not empty*/
if(feature_image != null && feature_image != ''){
	/*If file are in temp image*/
	if(feature_image.trim() != ''){
		var _token = $('meta[name="csrf-token"]').attr('content');
	  	$.ajax({
			url: '/admin/auctions/fetch_auction_image',
			type: 'post',
			data: {request: 'temp_fetch',_token:_token,auction_id:feature_image,feature_image:'1'},
			dataType: 'json',
			success: function(response){
				if(response.success){
					if(typeof (response.src) != "undefined" && response.src != null){
						$('.new-file .auction_image').attr('src', response.src);
				    	$('.new-file').removeClass('d-none').show();
				    	$('.old-file').hide();
					}
				}
			}
	    });

	}
}

/************************* Remove New Aution image  ********************************/
$(document).on('click','.new-auction-file-trash',function(){
	if($('.old-file').length > 0){
		$('.old-file').show();
	}
	$("#fileupload").val('');
	$('#feature_image').val('');
	$('.new-file').addClass('d-none').hide();
});

/*************************** Delete Original Auction Image   ***********************/

$(document).on('click','#delete_auction_image',function(){
	var auction_id = $(this).data('id');
	if(auction_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/auction_image/delete/'+auction_id,
			data: {_token:csrf_token,auction_id:auction_id},
			success: function(data) {
				if(data.success){
					notification('Success','Lot Image deleted Successfully','top-right','success',2000);
					$('.old-file').remove();
				}else if(data.message){
					notification('Error',data.message,'top-right','error',4000);
				}else{	
					notification('Error','Something went wrong.','top-right','error',3000);
				}	
			},
		});
	}else{
		notification('Error','Something went wrong.','top-right','error',3000);
	}
});

/***************************** Dropzone  **********************************/
$(document).ready(function(){
	if($('div#drop_here_auction').length > 0)
	{
		/* DROPZONE FILE UPLOAD */
		if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy())
		
		/* Drop Zone Js */ 		 
		Dropzone.autoDiscover = false;
		var fileList = new Array;
		var user_id = $('#user_id').val();
		var i = 0;
		var _token = $('meta[name="csrf-token"]').attr('content');

		myDropzone = new Dropzone('div#drop_here_auction', {
			url: "/admin/auctions/temp-save-media",
			acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg",
		    params: {'user_id':user_id},
		    addRemoveLinks: true,
		     headers: {
		        'X-CSRF-TOKEN': _token
		    },
			accept: function(file, done) {
				var ext = (file.name).split('.')[1]; // get extension from file name						
				ext = ext.toUpperCase();
				if ( ext == "JPG" || ext == "JPEG" || ext == "PNG" ||  ext == "GIF" ||  ext == "SVG"){
				  done();  
				  $('.dropzoneError').text('');
				}else { 
					done('Please select only supported files.'); 
					$('.dropzoneError').text('Please select only supported files.');
				}
			},
			init: function() { 
				var thisDropzone = this;
				var temp_images = $('#temp_images').val();

				/*If file are in temp image*/
				if(temp_images.trim() != ''){
				  	$.ajax({
						url: '/admin/auctions/fetch_auction_image',
						type: 'post',
						data: {request: 'temp_fetch',_token:_token,auction_id:temp_images},
						dataType: 'json',
						success: function(response){
							if(response.success){
								if(typeof (response.view) != "undefined" && response.view != null){
									$('.media_uploaded tbody').prepend(response.view);
								}
							}
							  /*$.each(response, function(key,value) {
								var mockFile = { name: value.name, size: value.size,media_id : value.id,image_type:'temp'};
								myDropzone.emit("addedfile", mockFile);
								myDropzone.emit("thumbnail", mockFile, value.path);
								myDropzone.emit("complete", mockFile);
							  })*/
						}
				    });

				}
									
				this.on('error', function(file, response) { 
					this.removeAllFiles();
					var errorMessage ;
					if(response.errorMessage == undefined) errorMessage = response;
					else  errorMessage = response.errorMessage;
					$(file.previewElement).find('.dz-error-message').text(errorMessage);
					$('.dropzoneError').text(errorMessage);
					
				});
				
				this.on("success", function(file, serverFileName) {
					if($(this.previewsContainer.children[1]) != undefined) $(this.previewsContainer.children[1]).remove();
					notification('Success','File has been uploaded.','top-right','success',4000);
					this.removeFile(file);
					fileList[i] = {
		                "serverFileName": serverFileName.temp_id,
		                "fileName": file.name,
		                "fileId": i
		            };
		            var temp_images = $('#temp_images').val();
		            if(temp_images.trim() != ''){
		            	var tempImageArr = temp_images.split(',');
			            tempImageArr.push(serverFileName.temp_id);
			            var tempImageStr = tempImageArr.toString();
			            $('#temp_images').val(tempImageStr);
		            }else{
		            	$('#temp_images').val(serverFileName.temp_id);
		            }
		            if(typeof (serverFileName.view) != 'undefined' && serverFileName.view != null){
		            	$('.media_uploaded tbody').prepend(serverFileName.view);
		            }
		            sortableOrderList();
		            $('.dz-message').show();
		            i += 1;
					
				});
				this.on('removedfile', function (file) {
					var rmvFile = "";
		            for (var f = 0; f < fileList.length; f++) {
		                if (fileList[f].fileName == file.name) {
		                    rmvFile = fileList[f].serverFileName;
		                }
		            }
		            if (rmvFile) {
		                $.ajax({
		                    url: '/admin/auctions/remove_auction_image', //your php file path to remove specified image
		                    type: "POST",
		                    data: {
		                        mediaId: rmvFile,
		                        type: 'delete',
								image_type :'temp',
								user_id:user_id,
								_token:_token
		                    },
		                    success: function(response){
		                    	if(response.success){
		                    		var temp_images = $('#temp_images').val();
		            				var tempImageArr = temp_images.split(',');
		                    		var tempIndex = tempImageArr.indexOf(rmvFile);
									if (tempIndex > -1) {
										tempImageArr.splice(tempIndex, 1);
										var tempImageStr = tempImageArr.toString();
										$('#temp_images').val(tempImageStr);
									}
									notification('Success','File is removed successfully','top-right','success',4000);
									$('.dropzoneError').text('');

									sortableOrderList();
		                    	}
		                    }
		                });
		            }
				}); 
			},
			thumbnailWidth: 160,
			previewTemplate: '<div class="dz-preview dz-file-preview mb-3"><div class="d-flex flex-row"><div class="p-0 w-30 position-relative"><div class="dz-error-mark"><span><i></i></span></div><div class="dz-success-mark"><span><i></i></span></div><div class="preview-container"><img data-dz-thumbnail="" class="img-thumbnail border-0" /><i class="simple-icon-doc preview-icon" ></i>	</div></div><div class="pl-3 pt-2 pr-2 pb-1 w-70 dz-details position-relative"><div><span data-dz-name=""></span></div><div class="text-primary text-extra-small" data-dz-size=""></div><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div><div class="dz-error-message"><span data-dz-errormessage=""></span></div></div><a href="#/" class="remove" data-dz-remove=""><i class="glyph-icon simple-icon-trash"></i></a></div></div>',
		});
	}
});

/***********************************Delete auction Media **************************************/

$(document).on('click','#delete_auction_media',function(){
	var self = $(this);
	var media_id = $(this).data('id');
	if(media_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/auctions/remove_auction_image',
			data: {
				_token:csrf_token,
				type: 'delete',
				image_type :'original',
				mediaId:media_id,
			},
			success: function(data) {
				if(data.success){
					notification('Success',data.message,'top-right','success',2000);
					$('#media_'+media_id).remove();
					sortableOrderList();
				}else if(data.message){
					notification('Error',data.message,'top-right','error',4000);
				}else{	
					notification('Error','Something went wrong.','top-right','error',3000);
				}	
			},
		});
	}else{
		notification('Error','Something went wrong.','top-right','error',3000);
	}
});

/************************************* Delete Temp Media   ***********************************************/

$(document).on('click','#delete_auction_tempmedia',function(){
	var self = $(this);
	var media_id = $(this).data('id');
	if(media_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/auctions/remove_auction_image',
			data: {
				_token:csrf_token,
				type: 'delete',
				image_type :'temp',
				mediaId:media_id,
			},
			success: function(data) {
				if(data.success){
					notification('Success',data.message,'top-right','success',2000);
					$('#temp_'+media_id).remove();

					//modify temp array
					var temp_images = $('#temp_images').val();
    				var tempImageArr = temp_images.split(',');
            		var tempIndex = tempImageArr.indexOf(media_id);
            		
					if (tempIndex > -1) {
						console.log('in');
						tempImageArr.splice(tempIndex, 1);
						var tempImageStr = tempImageArr.toString();
						$('#temp_images').val(tempImageStr);
					}
					sortableOrderList();
				}else if(data.message){
					notification('Error',data.message,'top-right','error',4000);
				}else{	
					notification('Error','Something went wrong.','top-right','error',3000);
				}	
			},
		});
	}else{
		notification('Error','Something went wrong.','top-right','error',3000);
	}
});

/**************************  Sortable ***************************/
if($("#sortable").length > 0){

	$( "#sortable" ).sortable({
	//$(document).on('sortable','#sortable',function(){
		placeholder: "ui-state-highlight"
	});
	$( "#sortable" ).on( "sortupdate", function( event, ui ) {
		sortableOrderList();
	});
	$( "#sortable" ).disableSelection();

}

//Order List to sort data
function sortableOrderList(){
	var mediaIndex = new Array;
	$( "#sortable tr.auction-media-row" ).each(function( index ) {
		//console.log( index + ": " + $(this).attr('id') );
		var media_id = $(this).attr('id');
		mediaIndex.push(media_id);
		//$('#sno_'+category_id).find('span').html(index+1);
		//$('s_number_'+category_id).val(index+1);
	});
	$('#sort_order').val(mediaIndex);
}
