/*==============================================
	POST UPLOAD BUTTON 
============================================*/
/* function chooseFile() {
	  var filename = $('#upload_post').val('');
      $("#upload_post").click();
}
$('#upload_post').change(function() {
        var filename = $('#upload_post').val();
        if (filename.substring(3,11) == 'fakepath') {
            filename = filename.substring(12);
        } // Remove c:\fake at beginning from localhost chrome
		//var filename = "The file " + filename +" has been selected.";
		var filename = "The file " + filename +" has been selected.";
        //notification('',filename,'top-right','none',4000);
		$('.file_post_select_text').html(filename)
   });
	 */
   
   shortemTxt('comment',100,'See More','Less'); 
   
   shortemTxt('user_bio',50,'More Info','Less');

/*=================================================
	POST THE CONTENT  
=================================================*/
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
 
/*  $(document).on('submit','#upload_post_form', function(e) {
    e.preventDefault(); 
	$('.request_loader_post').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/postcontent',
        data: new FormData(this),
		contentType: false,
		cache: false,
		processData: false,
        success: function(data) {
			$('.error').html('');
			$('.request_loader_post').css('display','none');
			 if(data.success){
				$("#upload_post_form")[0].reset();
				$(".file_post_select_text").html('');
				
				if($('postbox>h2').removeClass('notfound'))
					
				$( ".postBox" ).prepend( data.data );
				notification('Success','Post Content Successfully','top-right','success',2000);
			}else{
				$(".file_post_select_text").html('');
				notification('Error','Somthing went wrong.','top-right','error',2000);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader_post').css('display','none');
			$(".file_post_select_text").html('');
			$('.error').html('');
			//notification('Error','Please fill at list one field.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
			//console.log(errors)
            $.each(errors, function (key, value) {
                if($.isPlainObject(value)) {
                    $.each(value, function (key, value) { 					
                       //console.log(key+ " " +value);	
					  var key = key.replace('.','_');
					  $('.'+key+'_error').show().append(value);
					
					  notification('Error',value[0],'top-right','error',4000);
                    });
                }
            }); 
          }
		}

    });
}); */



/*=================================================
	POST LIKE BY USER 
=================================================*/

 $(document).on('click','.post_like', function(e) {
    e.preventDefault(); 
	var _this = $(this);
	$('.request_loader').css('display','inline-block');
	var user_id = $(_this).data('user_id');
	var post_id = $(_this).data('post_id');
	var post_like = $('.post_like_'+post_id).val();
	if(post_like==1)
		$('.post_like_'+post_id).val(0)
	else
		$('.post_like_'+post_id).val(1)
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/likepost',
        data: {_token:csrf_token,user_id:user_id,post_id:post_id,post_like:post_like},
        success: function(data) {
			 if(data.success){
				 
				 // Add/Remove  Active class for like 
				 if(post_like==1){
				  $(_this).addClass('like_unlike').css('color','#69C729');
				  
				 }
			     if(post_like==0){
				  $(_this).removeClass('like_unlike').css('color','');
				 }
			     
				  $('.post_count_'+post_id).html(data.likedcount);
				//notification('Success','Post Content Successfully','top-right','success',2000);
			}else{
				//notification('Error','Somthing went wrong.','top-right','error',2000);
			}	 
        },
		error :function( data ) {}

    });
});

/*=================================================
	POST COMMET BY USER 
=================================================*/

 $(document).on('click','.post_comment', function(e) {
    e.preventDefault(); 
	
	var user_id = $(this).data('user_id');
	var post_id = $(this).data('post_id');
	var comment_ = $('.comment_'+post_id).val();
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	if(comment_!=''){
		$('.request_loader_'+post_id).css('display','inline-block');
		$('.comment_'+post_id).removeClass('border_error');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/postcomment',
			data: {_token:csrf_token,user_id:user_id,post_id:post_id,comment:comment_},
			success: function(data) {
				 if(data.success){
					 
					  $('.request_loader_'+post_id).css('display','none');
					  $('.comment_'+post_id).val('');
					  $('.post_comment_count_'+post_id).html(data.postCommentCount);
					  $( ".comment_box_"+post_id).html( data.data );
					  
					  
					  //Set start record from 0 and set total page in view more total_page
					    $('.view_more_comment_'+post_id).attr('data-total_page',data.total_page);
						$('.view_more_comment_'+post_id).attr('data-page',2); //starting from page 2 
	 
					   shortemTxt('comment',100,'See More','Less');
					  //$('post_count_'+post_id).html(data.likedcount);
					  notification('Success','Post Comment Successfully','top-right','success',2000);
				}else{
					//notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {}
		});
	}else{
		$('.comment_'+post_id).addClass('border_error');
	}
});


/*=================================================
	COMMENT LIKE BY USER 
=================================================*/

 $(document).on('click','.comment_like', function(e) {
	
    e.preventDefault(); 
	var _this = $(this);
	$('.request_loader').css('display','inline-block');
	var liked_to = $(_this).data('commented_to');
	var post_id = $(_this).data('post_id');
	var comment_id = $(_this).data('comment_id');
	var comment_like = $('.comment_like_'+comment_id).val();
	if(comment_like==1)
		$('.comment_like_'+comment_id).val(0)
	else
		$('.comment_like_'+comment_id).val(1)
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/likepostcomment',
        data: {_token:csrf_token,comment_id:comment_id,liked_to:liked_to,post_id:post_id,comment_like:comment_like},
        success: function(data) {
			 if(data.success){
				 
				 // Add/Remove  Active class for like 
				 if(comment_like==1){
				  $(_this).addClass('like_unlike').css('color','#69C729');
				  
				 }
			     if(comment_like==0){
				  $(_this).removeClass('like_unlike').css('color','');
				 }
			     
				  $('.comment_like_count_'+comment_id).html(data.likedcount);
				//notification('Success','Post Content Successfully','top-right','success',2000);
			}else{
				//notification('Error','Somthing went wrong.','top-right','error',2000);
			}	 
        },
		error :function( data ) {}

    });
});

/*=================================================
	SHOW ALL REPLY AND REPLY TO COMMENT BOX  
=================================================*/

 $(document).on('click','.reply_icon', function(e) {
	var _this = $(this);
	var comment_id = $(_this).data('comment_id');
	var _reply = $('.reply_comment_'+comment_id).val();
	$('.main_reply_box_'+comment_id+' ' ).slideToggle();
	//$('.reply_box_'+comment_id).slideToggle();
});

/*=================================================
	REPLY ON COMMENT BY USER 
=================================================*/

 $(document).on('click','.comment_reply', function(e) {
    e.preventDefault(); 
	
	var reply_to = $(this).data('reply_to');
	var post_id = $(this).data('post_id');
	var comment_id = $(this).data('comment_id');
	var reply = $('.reply_box_area_'+comment_id).val();
	var csrf_token = $('meta[name="csrf-token"]').attr('content');

	var no_more = $('.view_more_comment_reply_'+comment_id).data('no_more'); //if 0 then not make the limit

	if(reply!=''){
		$('.comment_reply_loader_'+comment_id).css('display','inline-block');
		$('.reply_comment_'+comment_id).removeClass('border_error');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/replycomment',
			data: {_token:csrf_token,reply_to:reply_to,post_id:post_id,reply:reply,comment_id:comment_id,no_more:no_more},
			success: function(data) {
				 if(data.success){
					 
					  $('.comment_reply_loader_'+comment_id).css('display','none');
					  $('.reply_box_area_'+comment_id).val('');
					  $('.reply_count_'+comment_id).html(data.CommentReplyCount);
					  $( ".reply_list_ul_"+comment_id).html( data.data);
					  
					  //Set start record from 0 and set total page in view more total_page
					   $('.view_more_comment_reply_'+comment_id).attr('data-total_page',data.total_page);
					   $('.view_more_comment_reply_'+comment_id).attr('data-page',2); //starting from page 2 
	 
					   shortemTxt('comment',100,'See More','Less');
					  //$('post_count_'+post_id).html(data.likedcount);
					  notification('Success','Post Comment Successfully','top-right','success',2000);
				}else{
					//notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {}
		});
	}else{
		$('.reply_box_area_'+comment_id).addClass('border_error');
	}
});




/*=================================================
	FOCUS ON COMMENT BOX  
=================================================*/
$(document).on('click','.comment_count', function(e) {
   // e.preventDefault(); 
	var post_id = $(this).attr('data-post_id');
	$('.comment_'+post_id).focus();

});

/*=================================================
	VIEW MORE COMMENT 
=================================================*/

 $(document).on('click','.view_more_comment', function(e) {
    e.preventDefault(); 
	
	var user_id = $(this).data('user_id');
	var post_id = $(this).data('post_id');
	var total_page = $(this).data('total_page');
	var next_page = $(this).attr('data-page');
	var set_next_page = parseInt(next_page)+1;
     $(this).attr('data-page',set_next_page);
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	if(next_page<=total_page){
		
		$('.request_loader_'+post_id).css('display','inline-block');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/view_more_comment',
			data: {_token:csrf_token,user_id:user_id,post_id:post_id,page:next_page},
			success: function(data) {
				 if(data.success){		 
				     //  if(data.per_page_record > data.last_page_records_count >)
					  $('.request_loader_'+post_id).css('display','none');
					  $( ".comment_box_"+post_id).append( data.data );
					   shortemTxt('comment',100,'See More','Less');
					 // notification('Success','Post Comment Successfully','top-right','success',2000);
				}else{
					//notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {}
		});
	}else{
		$(this).hide();
		//notification('Error','Done','top-right','success',2000);
		//$('.comment_'+post_id).addClass('border_error');
	}
});


/*=================================================
	VIEW MORE REPLY 
=================================================*/

 $(document).on('click','.view_more_reply', function(e) {
    e.preventDefault(); 
	
	var reply_to = $(this).data('reply_to');
	var comment_id = $(this).data('comment_id');
	//var total_page = $(this).data('total_page');
	//var total_record = $(this).data('total_record');
	//var next_page = $(this).attr('data-page');
	//var set_next_page = parseInt(next_page)+1;
    //$(this).attr('data-page',set_next_page);
	var no_more = $('.view_more_comment_reply_'+comment_id).data('no_more');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	//if(next_page<=total_page){
		
		$('.view_more_reply_loader_'+comment_id).css('display','inline-block');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/view_more_reply',
			data: {_token:csrf_token,reply_to:reply_to,comment_id:comment_id,no_more:no_more},
			success: function(data) {
				 if(data.success){		 
				       
					  $('.view_more_reply_loader_'+comment_id).css('display','none');
					  $( ".reply_list_ul_"+comment_id).prepend( data.data );
					   shortemTxt('comment',100,'See More','Less');
					   
					 // var hide_view_more =  next_page*data.per_page_record ;
					 // alert(hide_view_more +'--'+total_record)
					  // if(data.per_page_record > data.last_page_records_count || hide_view_more == total_record){
						 //  $('.view_more_comment_reply_'+comment_id).attr('data-no_more',0);
						   $('.view_more_comment_reply_'+comment_id).hide();
					 //  }
					 // notification('Success','Post Comment Successfully','top-right','success',2000);
				}else{
					
					//notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {}
		});
	//}else{
	//	$('.view_more_comment_reply_'+comment_id).attr('data-no_more',0);
	//	$('.view_more_comment_reply_'+comment_id).hide();
		//notification('Error','Done','top-right','success',2000);
		//$('.comment_'+post_id).addClass('border_error');
	//}
});

/*  LOAD MORE POST/FEEDS */ 
	var page = 1;
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
			
			if($('.ajax_load_no_more').css('display')=='block')
				$('.ajax_load_no_more').remove();
			
			//If data is there to load more 
			
			//$( "li.item-ii" ).find( "li" )
			if(!$('h2').hasClass('notfound') && $('.ajax_load_no_more').css('display')=='none'){
				url = $(location).attr('pathname');
				
					page++;
				 if(url=='/')
					url = url;
				 if(url.indexOf('user') !== -1)
					 url = url;	
				loadMoreData(page,url);
			}
	    }
	});
	
// LOAD MORE  FEEDS	
	function loadMoreData(page,url){
	  $.ajax(
	        {
	            url: base_url+url+'/?page=' + page,
	            type: "get",
	            beforeSend: function()
	            {
	                $('.ajax_load_no_more').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data.html == ""){
	                $('.ajax_load_no_more').html("No more records found");
	                return;
	            }
	            $('.ajax_load_no_more').hide();
	            $(".postBox").append(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
	}
	
/*==============================================
	OPEN SUBSCRIBE MODAL AND FREE SUBSCRIBE MODAL 
============================================*/
$(document).on('click', '.subscribeModal_Open' , function() {
	var user_id = $(this).data('user_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/subscribeModal',
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){
				$('.subscribeModal_'+user_id).html(data.data);
				$('.subscribeModal_'+user_id).modal('show');
				//$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})
/*==============================================
	FOLLOW USER  
============================================*/
$(document).on('click', '.follow_user' , function() {
	var user_id = $(this).data('user_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/follow_user',
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){
				$('.user_subscribe_'+user_id).hide();  //Hide followed user from list 
				notification('Success','You have successfully followed user.','top-right','success',2000);
				setTimeout(function(){ $('.subscribeModal_'+user_id).modal('hide'); }, 1000);
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})



/*==========================================
	OPEN DELETE POST MODAL 
============================================*/
$(document).on('click', '.deletePostModal_Open' , function() {
	var post_id = $(this).data('post_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/delete_post_modal',
        data: {_token:csrf_token,post_id:post_id},
        success: function(data) {
			if(data.success){
				$('.delete_Post_Modal_'+post_id).html(data.data);
				$('.delete_Post_Modal_'+post_id).modal('show');
				//$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})
	
/*=================================================
	DELETE POST  
=================================================*/

 $(document).on('click','.delete_post', function(e) {
    e.preventDefault(); 

	var post_id = $(this).data('post_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	
		$('.loader_delete_post').css('display','inline-block');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/delete_post',
			data: {_token:csrf_token,post_id:post_id},
			success: function(data) {
				 if(data.success){
					 
					  $('.loader_delete_post').css('display','none');
					  $('.post_'+post_id).hide();
					  $('.delete_Post_Modal_'+post_id).modal('hide');
					  notification('Success','Post Deleted Successfully','top-right','success',2000);
				}else{
					notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {}
		});
	
});



	
//CLIP TO COPY TEXT 
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Link to profile was copied to clipboard!";
  //tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy link to profile";
}



//ADD WATER MART TO POST IMAGES 
$(document).ready(function(){

 $('img.watermark_img').watermark({
	path: watermark_image,
	opacity:0.8,
	gravity:'se',
	width:'600px'
 });
 
 //Added Video Watermark
 $('head').append("<style>.video-warapper::before{background:url('"+watermark_image+"');background-size:cover;}</style>");
 
 
 
 });
 