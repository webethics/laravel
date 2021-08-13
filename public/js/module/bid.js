/**********Send Invoice ***********/

$(document).on('click', '#send_invoice' , function() {
	var auction_id = $(this).data('id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/bid/send-invoice',
        data: {_token:csrf_token,auction_id:auction_id},
        success: function(data) {
			if(data.success){
				notification('Success','Invoice email sent successfully.','top-right','success',2000);
			}else if(data.message){
				notification('Error',data.message,'top-right','error',4000);
			}else{	
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
});

$(document).on('click', '.bid_details' , function() {
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var lots_id = $(this).data('id');
	var color = $(this).data('color');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/bid/bid-listing',
        data: {_token:csrf_token,lots_id:lots_id,color:color},
        success: function(data) {
			if(data.success){
				$('.bidListing').html(data.message);
				$('.bidListing').modal('show');
				//notification('Success','successfully.','top-right','success',2000);
			}else{	
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
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
             if(data=='date_error'){
				notification('Error','Start date not greater than end date.','top-right','error',4000);	
			 }else{
	             // Set search result
				 $("#tag_container").empty().html(data); 
			 }	
        },
		error :function( data ) {}
    });
});