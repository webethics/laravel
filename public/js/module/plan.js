$("#title").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);        
});

$(document).on('click', '.delete_plan' , function() {

	var plan_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/plans/delete_plan/'+plan_id,
        data: {_token:csrf_token,plan_id:plan_id},
        success: function(data) {
			if(data.success){
				notification('Success','Plan deleted Successfully','top-right','success',2000);
				$('.user_row_'+plan_id).hide();
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

$(document).on('click', '.delete_feature' , function() {

	var feature_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/plans/delete_feature/'+feature_id,
        data: {_token:csrf_token,feature_id:feature_id},
        success: function(data) {
			if(data.success){
				notification('Success','Feature deleted Successfully','top-right','success',2000);
				$('.user_row_'+feature_id).hide();
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
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/plans/enable-disable',
        data: {status:user_status,user_id:user_id,_token:csrf_token},
        success: function(data) {
             // IF TRUE THEN SHOW SUCCESS MESSAGE  
			 if(data.success){
				notification('Success','Plan has been enabled','top-right','success',4000);
				
			}else{
             notification('Error','Plan has been disabled.','top-right','error',4000);
			}	
			
        },
		error :function( data ) {}
    });
	
})



