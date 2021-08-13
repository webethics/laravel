$("#title").keyup(function(){
	var Text = $(this).val();
	Text = Text.toLowerCase();
	Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
	$("#slug").val(Text);        
});
$("#arabic_title").keyup(function(){
	var Text = $(this).val();
	Text = Text.toLowerCase();
	Text = Text.replace(/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/g,'-');
	$("#arabic_slug").val(Text);        
});

bindSortableDataElement();
sortingElements();


function sortingElements(){
	$('#form_table').DataTable({
		"ordering": true,
		"searching": false,
		"paging": false,
		columnDefs: [{
		  orderable: false,
		  targets: "no-sort"
		}],
	});

}


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
			  var category_id = $(this).data('user-id');
			  categoryIndex.push($( this ).data('user-id'));
			  $('#sno_'+category_id).find('span').html(index+1);
			  $('#s_number_'+category_id).val(index+1);
			});
			var page_number = $('input[name="page_number"]').val();
			var page_language = $('input[name="page_language"]').val();
			//New Category Index
			if(categoryIndex.length > 0){
				var csrf_token = $('meta[name="csrf-token"]').attr('content');
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: base_url+'/forms/sortlist',
					data: {_token:csrf_token,list:categoryIndex,page_number:page_number,page_language:page_language},
					success: function(data) {
						if(data.success){
							$( "#tag_container" ).html(data.view);
							notification('Success',data.message,'top-right','success',2000);
							bindSortableDataElement();
							sortingElements();
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

$(document).on('click', '.delete_form' , function() {

	var form_id = $(this).data('id');
	var lang = $(this).data('language');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/forms/delete_form/'+form_id,
        data: {_token:csrf_token,form_id:form_id,lang:lang},
        success: function(data) {
			if(data.success){
				notification('Success','Form deleted Successfully','top-right','success',2000);
				$('.user_row_'+form_id).hide();
			}else{
				if(data.message){
					notification('Error',data.message,'top-right','error',3000);
				}else{
					notification('Error','Something went wrong.','top-right','error',3000);
				}
				
			}	
        },
    });
})


function readURL(input,type,fileName) {
	if(type == "featured_image"){
		if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('.new-file .module_image').attr('src', e.target.result);
			$('.new-file').removeClass('d-none').show();
		}

		reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}else if(type == "arabic_featured_image"){
		if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('.new-file-arabic .module_image_arabic').attr('src', e.target.result);
			$('.new-file-arabic').removeClass('d-none').show();
		}

		reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}else if(type == "pdf"){
		$('.new-pdf-file').html('<i class="fa fa-file-pdf-o" aria-hidden="true"></i>'+' '+'<span id="pdf_file_name">'+fileName+'</span>');
		$('.new-pdf-file').removeClass('d-none').show();
	}else if(type == "arabic_pdf"){
		$('.new-pdf-arabic-file').html('<i class="fa fa-file-pdf-o" aria-hidden="true"></i>'+' '+'<span id="pdf_file_name">'+fileName+'</span>');
		$('.new-pdf-arabic-file').removeClass('d-none').show();
	}else if(type == "editable"){
		$('.new-editable-file').html('<i class="fa fa-file" aria-hidden="true"></i>'+' '+'<span id="pdf_file_name">'+fileName+'</span>');
		$('.new-editable-file').removeClass('d-none').show();
		
	}else if(type == "arabic_editable"){
		$('.new-editable-arabic-file').html('<i class="fa fa-file" aria-hidden="true"></i>'+' '+'<span id="pdf_file_name">'+fileName+'</span>');
		$('.new-editable-arabic-file').removeClass('d-none').show();
		
	}
}

$(document).ready(function(){
	$('.arabic').hide();
	/*Enable Sorting*/
	if($("#langauge").val() == 2){
		$('#arabic_form').show();
		
	}
	if($("#langauge").val() == 3){
		$('#arabic_form').show();
		$('#english_form').hide();
	}
	if($("#langauge").val() == 1){
		$('#english_form').show();
		
	}
	$("#langauge").change(function(e) {
		var lang_val = $(this).val();
		if(lang_val == 1){
			$('#arabic_form').hide('slow');
			$('#english_form').show('slow');
		}
		if(lang_val == 2){
			$('#arabic_form').show('slow');
			$('#english_form').show('slow');
		}
		if(lang_val == 3){
			$('#english_form').hide('slow');
			$('#arabic_form').show('slow');
		}
	});
	
	$("#arabic_form .inputfile").change(function(e) {
		var type = $(this).attr("data-id");
		var fileName = e.target.files[0].name;
	  	readURL(this,type,fileName);
	});

	$("#english_form .english").change(function(e) {
		var type = $(this).attr("data-id");
		var fileName = e.target.files[0].name;
	  	readURL(this,type,fileName);
	});
	

	
});

/**************** Multipule image Preview *******************************/


$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="mul_preview" height="50px" width = "50px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
			
			filesAmount = "";
        }

    };

    $('#preview_images').on('change', function() {
		
        imagesPreview(this, 'div.gallery');
    });
});

/*-----------------------------------------------
Export Customer 
--------------------------------------------------*/

$(document).on('click','#export_forms', function(e) {
	 e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/export_forms',
        data: {
			title:$('#title').val(),
			 lang:$('#lang').val(),
			_token:csrf_token},
			
        success: function(data) {
			
			$('.search_spinloder').css('display','none');
			if(data.success == false){
				notification('Error','No data found.','top-right','error',4000);	
			}else{
				var downloadLink = document.createElement("a");
				var fileData = ['\ufeff'+data];

				var blobObject = new Blob(fileData,{
					type: "text/csv;charset=utf-8;"
				});

				var url = URL.createObjectURL(blobObject);
				downloadLink.href = url;
				downloadLink.download = "Forms.csv";

				/*
					* Actually download CSV
				*/
				document.body.appendChild(downloadLink);
				downloadLink.click();
				document.body.removeChild(downloadLink);
			}
			
        },
		error :function( data ) {}
    });
});

/*==============================================
	ENABLE/DISABLE USER ACCOUNT 
============================================*/
$(document).on('click','.switch_status', function(e) {
	
	if($(this).is(":checked")){
		var user_status = 1;
	}
	else if($(this).is(":not(:checked)")){
		var user_status = 0;
	}
	var user_id = $(this).attr('data-user_id');
	var lang = $(this).attr('data-language');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/forms/enable-disable',
        data: {status:user_status,user_id:user_id,_token:csrf_token,lang:lang},
        success: function(data) {
             // IF TRUE THEN SHOW SUCCESS MESSAGE  
			 if(data.success){
				notification('Success','Form has been published.','top-right','success',4000);
				
			}else{
             notification('Error','Form has been drafted.','top-right','error',4000);
			}	
			
        },
		error :function( data ) {}
    });
	
})


/*==============================================
	SEARCH FILTER FORM 
============================================*/
$(document).on('submit','#searchForm', function(e) {
	var lang  = $('#lang').val();
	if(lang == 'ar'){
		url = base_url+'/listforms-arabic'
	}else{
		url = base_url+'/listforms'
	}
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: url,
        data: $(this).serialize(),
        success: function(data) {
			 $('.search_spinloder').css('display','none');
             //start date and end date error 
			if(data=='date_error'){
				notification('Error','Start date not greater than end date.','top-right','error',4000);	
			}else if(data=='age_error'){
				notification('Error','Start age not greater than end age.','top-right','error',4000);	
			}else{
             // Set search result
			 $("#tag_container").empty().html(data); 
			}	
			bindSortableDataElement();
			sortingElements();
        },
		error :function( data ) {}
    });
});
