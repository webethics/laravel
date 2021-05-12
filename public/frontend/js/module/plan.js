/*==============================================
	SET SUBSCRIPTION PRICE 
============================================*/
 SetPrice();
 $(document).on('click','.subscription_update', function(e) {	

     e.preventDefault(); 
	//var user_id = $('#user_id').val();
	$('.loader_subscription_price').css('display','inline-block');
	
	
	//SET PRICE FOR SUBSCRIPTION  
	 SetPrice();
	
	var csrf_token = $('input[name="_token"]').val();
	var subscription_fee = $('#subscription_fee').val();
	var fee_checked = $('#fee_checked').val();
	var price_without_fee = $('#price_without_fee').val();
	//
	if(subscription_fee<=0 && subscription_fee!='' ){
		$('.loader_subscription_price').css('display','none');
		notification('Error','Price Should be not be Zero','top-right','error',4000);
	}
    $.ajax({
        type: "POST",
		dataType: 'json',
         url: base_url+'/create_update_paypal_plan',
        data: {_token:csrf_token,subscription_fee:subscription_fee,fee_checked:fee_checked,price_without_fee:price_without_fee},
        success: function(data) {
			$('.error').html('');
			$('.loader_subscription_price').css('display','none');
			 if(data.success){
				notification('Success','Subscription Price Updated Successfully','top-right','success',2000);
			}else{
				notification('Error',data.msg,'top-right','error',4000);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.loader_subscription_price').css('display','none');
			$('.error').html('');
			//notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
            $.each(errors, function (key, value) {
                if($.isPlainObject(value)) {
                    $.each(value, function (key, value) {                       
                        //console.log(key+ " " +value);	
					  var key = key.replace('.','_');
					  $('.'+key+'_error').show().append(value);
                    });
                }
            }); 
          }
		}

    }); 
});	
$(document).on('change', '#select_subscription_fee' , function() {
	  SetPrice();

});


/*==============================================
	IF CHECKBOX IS CHEKED THE FAN WILL PAY THE CREDIT FEES 
	4.9%+30CENTS
============================================*/
$(document).on('click', '.fee_deduction_checkbox' , function() {

	 SetPrice();
    
})

function SetPrice(){
	
	var fee_checked =0;
	var price_without_fee = $('#select_subscription_fee').val();
	if(price_without_fee !='FREE'){
	
	$('.set_free_button').hide();
	$('.set_price_button').show();
	$('.selected_price').show();
	$('.checkbox_fee').show();
	var select_subscription_fee = $('#select_subscription_fee').val();
	if($('.fee_deduction_checkbox').is(":checked")){	
	 fee_checked =1;
	 deducted_fee = parseFloat((select_subscription_fee*4.9/100)+0.3);
	 select_subscription_fee = parseFloat(select_subscription_fee)+deducted_fee;
	 select_subscription_fee = select_subscription_fee.toFixed(2);
	}
	if(select_subscription_fee!='NaN'){
    $('#subscription_fee').val(select_subscription_fee); //set subscription price 
    $('.price_without_fee').val(price_without_fee);
    $('.final_subscription_price').html(select_subscription_fee);
	$('#fee_checked').val(fee_checked);
	}
	}else{
		 $('.selected_price').hide();
		 $('.checkbox_fee').hide();
		 $('.set_price_button').hide();
		 $('.set_free_button').show();
		
	}
      //set checkbox value 
	
}

//IF PRICE SELECTED AS FREE THEN DEACIVATE THE PLAN 

 $(document).on('click','.subscription_update_as_free', function(e) {	
 

     e.preventDefault(); 
	//var user_id = $('#user_id').val();
	$('.loader_subscription_update_as_free').css('display','inline-block');
	//SET PRICE FOR SUBSCRIPTION  
	 SetPrice();
	
	var csrf_token = $('input[name="_token"]').val();
	var subscription_fee = $('#select_subscription_fee').val();
	 //DEACIVATE THE PLAN IF PRICE SET AS FREE 
		$.ajax({
			type: "POST",
			dataType: 'json',
			 url: base_url+'/deactivate_plan',
			data: {_token:csrf_token,subscription_fee:subscription_fee},
			success: function(data) {
				$('.error').html('');
				$('.loader_subscription_update_as_free').css('display','none');
				 if(data.success){
					notification('Success',data.msg,'top-right','success',2000);
				}else{
					notification('Error',data.msg,'top-right','error',4000);
				}	 
			},
			error :function( data ) {}

		}); 
});	



/*==============================================
	OPEN CANCEL SUBSCRIPTION MODAL 
============================================*/
$(document).on('click', '.cancel_subscribeModal_Open' , function() {

	var subscription_id = $(this).data('subscription_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/openCancelSubscriptionModal',
        data: {_token:csrf_token,subscription_id:subscription_id},
        success: function(data) {
			if(data.success){
				$('.canelSubscrptionModal_'+subscription_id).html(data.data);
				$('.canelSubscrptionModal_'+subscription_id).modal('show');
				//$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})


/*==============================================
	CANCEL USER SUBSCRIPTION  
============================================*/
 $(document).on('click','.cancel_subscription', function(e) {

     e.preventDefault(); 
	$('.loader_cancel_subscription').css('display','inline-block');
	var csrf_token = $('input[name="_token"]').val();
	var subscription_id = $(this).data('subscription_id');
	
    $.ajax({
        type: "POST",
		dataType: 'json',
         url: base_url+'/cancel_subscription',
        data: {_token:csrf_token,subscription_id:subscription_id},
        success: function(data) {
			$('.error').html('');
			$('.loader_cancel_subscription').css('display','none');
			 if(data.success){
				notification('Success',data.msg,'top-right','success',3000);
				$('.subscribed_id_'+subscription_id).hide();
			}else{
				notification('Error',data.msg,'top-right','error',4000);
			}	 
			$('.canelSubscrptionModal_'+subscription_id).modal('hide');
        },
		error :function( data ) {}

    }); 
});	



/*==============================================
	OPEN TIP MODAL FOR PAYMENT 
============================================*/
$(document).on('click', '.tip_modal' , function() {

	var post_id = $(this).data('post_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/tipModal',
        data: {_token:csrf_token,post_id:post_id},
        success: function(data) {
			if(data.success){
				$('.tipModal_'+post_id).html(data.data);
				$('.tipModal_'+post_id).modal('show');
				//$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})


/*==============================================
	WITHDRAW AMOUNT REQUEST 
============================================*/
$(document).on('click', '.withdraw_request' , function() {

	//var user_id = $('#user_id').val();
	$('.loader_withdraw_request').css('display','inline-block');
	var csrf_token = $('input[name="_token"]').val();
	var withdraw_amount = $('input[name="withdraw_amount"]').val();
	//
	if(withdraw_amount<=0 && withdraw_amount!='' ){
		$('.loader_withdraw_request').css('display','none');
		notification('Error','Price Should be not be Zero','top-right','error',4000);
		return false;
	}
    $.ajax({
        type: "POST",
		dataType: 'json',
         url: base_url+'/withdraw_amount_request',
        data: {_token:csrf_token,withdraw_amount:withdraw_amount},
        success: function(data) {
			$('.error').html('');
			$('.loader_withdraw_request').css('display','none');
			 if(data.success){
				 
				$('#walltet_amount').html(data.walletTotal);
				$('#requested_withdraw_amount').html(data.PendingWithdrawAmount);
				$('#remaining_balance').html(data.remaininig_blance);
				notification('Success','You Withdraw request is send Price Updated Successfully','top-right','success',2000);
			}else{
				notification('Error',data.msg,'top-right','error',4000);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.loader_withdraw_request').css('display','none');
			$('.error').html('');
			//notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
            $.each(errors, function (key, value) {
                if($.isPlainObject(value)) {
                    $.each(value, function (key, value) {                       
                        //console.log(key+ " " +value);	
					  var key = key.replace('.','_');
					  $('.'+key+'_error').show().append(value);
                    });
                }
            }); 
          }
		}

    }); 
})



