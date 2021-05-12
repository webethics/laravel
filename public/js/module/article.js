$("#title").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);        
});

$(document).on('click', '.delete_article' , function() {

	var article_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/articles/delete_article/'+article_id,
        data: {_token:csrf_token,article_id:article_id},
        success: function(data) {
			if(data.success){
				notification('Success','Article deleted Successfully','top-right','success',2000);
				$('.user_row_'+article_id).hide();
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