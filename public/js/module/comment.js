/*==============================================
	Create  Comments Form
============================================*/

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$(document).on('submit', '#comments_form' , function(event){

	event.preventDefault();
	
	$('#comment_content-error').text('');
	commentid = $('#comment_id').val();
	comment_content = $('#comment_content').val();
	user_id = $('#user_id').val();

	$.ajax({
	  url: "/admin/comment",
	  type: "POST",
	  data:{
		comment_content:comment_content,
		user_id:user_id
	  },
	  success:function(response){
		console.log(response);
		if (response) {
			notification('Success','Comment Created Successfully','top-right','success',2000);
			$('#AddComment').modal('hide');
		
		  $('#success-message').text(response.success);
		  $("#comments_form")[0].reset();
		}
	  },
	  error: function(response) {
		$('#comment_content-error').text(response.responseJSON.errors.comment_content);
		
	  }
	 });
	});


/*==============================================
	Edit Comments Modal
============================================*/

$(document).on('click', '.editcomment' , function() {
	
	// alert("ok");
	// $('.leadViewModal').html(data.data);
	// $('.leadEditModal').modal('show');
	var comment_id = $(this).data('comment_id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
		type: "POST",
		dataType: 'json',
		url: base_url+'/editcomment/'+comment_id,
		
		data: {_token:csrf_token,comment_id:comment_id},
		

		success: function(data) {
			// console.log(data);
			if(data.success){
				
				$('.leadEditCommentsmodal').html(data.data);
				$('.leadEditCommentsmodal').modal('show');  // /This name of class is defined in the leads.blade.php
				$('.errors').html('');
				
			}else{
				notification('Error','Something went wrong.','top-right','error',2000);
			}	
		},
	});
})










/*==============================================
	Update Comments Modal
============================================*/
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).on('submit','#leads_comments_edit_form', function(event) {
	
	event.preventDefault();

	

	var comment_id = $('#commentid').val();
	lead_id = $('#lead_id').val();
	
	comment_content = $('#comment_content').val();

	
	$.ajax({
	  url: base_url+'/updatecomment/'+comment_id,
	  type: "POST",
	  dataType : 'json',
	  
	  data: $(this).serialize(),
	  success:function(data){
		// $("p").load("#comment_content_"+commentid);
		// load(response+ '.load');
		if (data.success) {
		
			notification('Success','Comment Updated Successfully','top-right','success',2000);
			$('.leadEditCommentsmodal').modal('hide');
			if(typeof (data.view) != 'undefined' && data.view != null && typeof (data.class) != 'undefined'  && data.class != null && data.view != '' && data.class != ''){
				// alert(".lead_row_"+lead_id);
			
				console.log(data.view);
				$('.'+data.class).replaceWith(data.view);   //Refresh div content
				
			}
			
		  $('#success-message').text(response.success);
		  $("#leads_comments_edit_form")[0].reset();
		}
	  },

	  error: function(xhr, textStatus, errorThrown, response) {
		if($('textarea[name="comment_content"]').val().length == 0)
		{
			if(xhr.status == 422)
			{ 
				$(comment_content).addClass('is-invalid');
				$('#invalid-feedback').text(xhr.responseJSON.errors.comment_content["0"]).css('font-size','0.9rem');                 
			}                              
		}
		
	  }
	 });
	});
	


	/*==============================================
	Add Reasons Form
============================================*/


$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).on('submit','#reasons_form', function(event) {
	
	event.preventDefault();
	// lead_id = $('#lead_id').val();

	comment_content = $('#comment_content').val();
	$.ajax({
	  url: '/admin/comment',
	  type: "POST",
	  dataType : 'json',
	  
	  data: $(this).serialize(),
	 
	  success:function(data){
		  
		$('.errors').html('');
		$('.request_loader').css('display','none');
		
		if (data.success) {
			notification('Success','Reason Added Successfully','top-right','success',2000);
			setTimeout(function(){$('.leadAddReasonsmodal').modal('hide');  }, 500);
			
		  $('#success-message').text(response.success);
		  $("#reasons_form")[0].reset();
		}
	  },

	  error: function(response) {
		$('#lost_lead_reason-errors').text(response.responseJSON.errors.comment_content);
	
	  }
	 });
	});
	


