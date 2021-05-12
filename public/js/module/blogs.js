 /************  Sortable ********************/
bindSortableDataElement();

function bindSortableDataElement(){ 
	if($("#sortable").length > 0){

		$( "#sortable" ).sortable({
		//$(document).on('sortable','#sortable',function(){
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).on( "sortupdate", function( event, ui ) {
			var blogIndex = new Array;
			$( "#sortable tr" ).each(function( index ) {
			  //console.log( index + ": " + $( this ).data('blog-id') );
			  var blog_id = $(this).data('blog-id');
			  blogIndex.push($( this ).data('blog-id'));
			  $('#sno_'+blog_id).find('span').html(index+1);
			  $('s_number_'+blog_id).val(index+1);
			});
			
			//New Blog Index
			if(blogIndex.length > 0){
				var csrf_token = $('meta[name="csrf-token"]').attr('content');
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: base_url+'/blog/sortlist',
					data: {_token:csrf_token,list:blogIndex},
					success: function(data) {
						if(data.success){
							notification('Success',data.message,'top-right','success',2000);
						}else if(data.message){
							notification('Error',data.message,'top-right','error',2000);
						}else{	
							notification('Error','Something went wrong.','top-right','error',2000);
						}	
					},
					error :function( data ) {
						notification('Error','Something went wrong.','top-right','error',3000);
					}
				});

			}
		});
		$( "#sortable" ).disableSelection();

	}
}



/************  Delete Blog  **********************/

$(document).on('click', '.delete_blog' , function() {
	var blog_id = $(this).data('id');
	if(blog_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/blog/delete/'+blog_id,
			data: {_token:csrf_token,blog_id:blog_id},
			success: function(data) {
				if(data.success){
					notification('Success','Blog deleted Successfully','top-right','success',2000);
					if(typeof (data.view) != 'undefined' && data.view != null && data.view != ''){
						$('.blogs_full').html(data.view);
						bindSortableDataElement();
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
	}else{
		notification('Error','Something went wrong.','top-right','error',3000);
	}
	
});

/************  Delete Blog Category  **********************/

$(document).on('click', '.deleteblogcategory' , function() {
	var blog_id = $(this).data('id');
	if(blog_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/blog-categories/delete/'+blog_id,
			data: {_token:csrf_token,blog_id:blog_id},
			success: function(data) {
				if(data.success){
					notification('Success','Blog category deleted Successfully','top-right','success',2000);
					if(typeof (data.view) != 'undefined' && data.view != null && data.view != ''){
						$('.blogs_full').html(data.view);
						bindSortableDataElement();
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
	}else{
		notification('Error','Something went wrong.','top-right','error',3000);
	}
	
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
	var blog_id = $(this).attr('data-blog_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/blog/enable-disable',
        data: {status:game_status,blog_id:blog_id,_token:csrf_token},
        success: function(data) {
             // IF TRUE THEN SHOW SUCCESS MESSAGE  
			 if(data.success){
				notification('Success','Blog has been actived.','top-right','success',4000);
				
			}else{
             notification('Error','Blog has been deactivated.','top-right','error',4000);
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
    	$('.new-file .blog_image').attr('src', e.target.result);
    	$('.new-file').removeClass('d-none').show();
    	$('.old-file').hide();
      	

      	/*Ajaxify upload image*/
    	//uploadFeatureImage(e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}


$(document).ready(function(){

	$("#fileupload").change(function() {
	  	readURL(this);
	});
});

/************************** Check Feature Image Exist  *****************************************/

var feature_image = $('#feature_image').val();

/*If file are in temp image*/
if(feature_image != null && feature_image != ''){
	if(feature_image.trim() != ''){
		var _token = $('meta[name="csrf-token"]').attr('content');
	  	$.ajax({
			url: base_url+'/blog/fetch_blog_image',
			type: 'post',
			data: {request: 'temp_fetch',_token:_token,media_id:feature_image},
			dataType: 'json',
			success: function(response){
				if(response.success){
					if(typeof (response.src) != "undefined" && response.src != null){
						$('.new-file .blog_image').attr('src', response.src);
				    	$('.new-file').removeClass('d-none').show();
				    	$('.old-file').hide();
					}
				}
			}
	    });
	}

}



/************************* Remove New blog image  ********************************/
$(document).on('click','.new-blog-file-trash',function(){
	if($('.old-file').length > 0){
		$('.old-file').show();
	}
	$("#fileupload").val('');
	$('#feature_image').val('');
	$('.new-file').addClass('d-none').hide();
});

/*************************** Delete Original Blog Media Image   ***********************/

$(document).on('click','#delete_blog_image',function(){
	var blog_id = $(this).data('id');
	if(blog_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/blog_image/delete/'+blog_id,
			data: {_token:csrf_token,blog_id:blog_id},
			success: function(data) {
				if(data.success){
					notification('Success','Auction Image deleted Successfully','top-right','success',2000);
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