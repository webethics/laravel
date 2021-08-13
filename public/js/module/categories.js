/************  Sortable ********************/
bindSortableDataElement();

function bindSortableDataElement(){ 
	if($("#sortable").length > 0){

		$( "#sortable" ).sortable({ 
		//$(document).on('sortable','#sortable',function(){
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).on( "sortupdate", function( event, ui ) {
			var categoryIndex = new Array;
			$( "#sortable tr" ).each(function( index ) {
			  //console.log( index + ": " + $( this ).data('category-id') );
			  var category_id = $(this).data('category-id');
			  categoryIndex.push($( this ).data('category-id'));
			  $('#sno_'+category_id).find('span').html(index+1);
			  $('s_number_'+category_id).val(index+1);
			});
			
			//New Category Index
			if(categoryIndex.length > 0){
				var csrf_token = $('meta[name="csrf-token"]').attr('content');
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: base_url+'/category/sortlist',
					data: {_token:csrf_token,list:categoryIndex},
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



/************  Delete Category  **********************/

$(document).on('click', '.delete_category' , function() {
	var category_id = $(this).data('id');
	if(category_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/category/delete/'+category_id,
			data: {_token:csrf_token,category_id:category_id},
			success: function(data) {
				if(data.success){
					notification('Success','Category deleted Successfully','top-right','success',2000);
					if(typeof (data.view) != 'undefined' && data.view != null && data.view != ''){
						$('.categories_full').html(data.view);
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
	var category_id = $(this).attr('data-category_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/category/enable-disable',
        data: {status:game_status,category_id:category_id,_token:csrf_token},
        success: function(data) {
             // IF TRUE THEN SHOW SUCCESS MESSAGE  
			 if(data.success){
				notification('Success','Auction has been active.','top-right','success',4000);
				
			}else{
             notification('Error','Auction has been deactivate.','top-right','error',4000);
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
    	$('.new-file .category_image').attr('src', e.target.result);
    	$('.new-file').removeClass('d-none').show();
    	$('.old-file').hide();
      	

      	/*Ajaxify upload image*/
    	uploadFeatureImage(e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

/*Upload feature Image*/
function uploadFeatureImage(img){
	/**************** Upload feature image  *************************/
	$('.upload_feature_file_error').html('');
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
	        url: base_url+'/category/temp-save-feature-media',
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
				if( data.status === 422 ) {
					//notification('Error','Please fill all the fields.','top-right','error',4000);
		            var errors = $.parseJSON(data.responseText);
		            $.each(errors, function (key, value) {
		                // console.log(key+ " " +value);
		                if($.isPlainObject(value)) {
		                    $.each(value, function (key, value) {                       
		                        //console.log(key+ " " +value);	
							  var key = key.replace('.','_');
							  $('.'+key+'_error').show().append(value);
		                    });
		                }
		            });
		        }else{
	         		notification('Error','Somthing went wrong.','top-right','error',2000);
	         	}
	         	$('.new-category-file-trash').trigger('click');
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

/*If file are in temp image*/
if(feature_image != null && feature_image != ''){
	if(feature_image.trim() != ''){
		var _token = $('meta[name="csrf-token"]').attr('content');
	  	$.ajax({
			url: base_url+'/category/fetch_category_image',
			type: 'post',
			data: {request: 'temp_fetch',_token:_token,media_id:feature_image},
			dataType: 'json',
			success: function(response){
				if(response.success){
					if(typeof (response.src) != "undefined" && response.src != null){
						$('.new-file .category_image').attr('src', response.src);
				    	$('.new-file').removeClass('d-none').show();
				    	$('.old-file').hide();
					}
				}
			}
	    });
	}

}



/************************* Remove New category image  ********************************/
$(document).on('click','.new-category-file-trash',function(){
	if($('.old-file').length > 0){
		$('.old-file').show();
	}
	$("#fileupload").val('');
	$('#feature_image').val('');
	$('.new-file').addClass('d-none').hide();
});

/*************************** Delete Original Category Media Image   ***********************/

$(document).on('click','#delete_category_image',function(){
	var category_id = $(this).data('id');
	if(category_id != ''){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/category_image/delete/'+category_id,
			data: {_token:csrf_token,category_id:category_id},
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