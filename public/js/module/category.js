	

$(document).on('click', '.delete_Subcategory' , function() {

	var subcategory_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/dashboard/delete_subcategory/'+subcategory_id,
        data: {_token:csrf_token,subcategory_id:subcategory_id},
        success: function(data) {
			if(data.success){
				notification('Success','Subcategory deleted Successfully','top-right','success',2000);
				$('.user_row_'+subcategory_id).hide();
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