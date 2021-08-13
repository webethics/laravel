/*==============================================
	Create Leads Form
============================================*/

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$('#leads_form').on('submit', function(event){
	
	event.preventDefault();
	

	$('#client_name-error').text('');
	$('#upwork-id-error').text('');
	$('#job_title-error').text('');
	$('#client_budget-error').text('');
	
	$('#bidder_id-error').text('');
	$('#status-error').text('');



	
	client_name = $('#client_name').val();
	// console.log(client_name);
	upwork_id = $('#upwork_id2').val();
	job_title = $('#job_title').val();
	job_url = $('#job_url').val();
	client_budget = $('#client_budget').val();
	our_estimate = $('#our_estimate').val();
	bidder_id = $('#bidder_id2').val();
	status = $('#status2').val();

	$.ajax({
	  url: "/admin/store",
	  type: "POST",
	  data:{
		client_name:client_name,
		upwork_id:upwork_id,
		job_title:job_title,
		job_url:job_url,
		client_budget:client_budget,
		our_estimate:our_estimate,
		bidder_id:bidder_id,
		status:status,
	  },
	  success:function(response){
		// $('.errors').html('');
		// $('.request_loader').css('display','none');
		console.log(response);
		if (response) {
			notification('Success','Lead Created Successfully','top-right','success',2000);
			setTimeout(function(){ $('#AddLead').modal('hide'); }, 2000);
			$("table").load("#filtered-data");
				// $(".separator").html(result);
		  $('#success-message').text(response.success);
		  $("#leads_form")[0].reset();
		}
	  },
	  error: function(response) {
		  $('#client_name-error').text(response.responseJSON.errors.client_name);
		  $('#upwork-id-error').text(response.responseJSON.errors.upwork_id);
		  $('#job_title-error').text(response.responseJSON.errors.job_title);
		  $('#job_url-error').text(response.responseJSON.errors.job_url);
		  $('#client_budget-error').text(response.responseJSON.errors.client_budget);
		  
		  $('#bidder_id-error').text(response.responseJSON.errors.bidder_id);
		  $('#status-error').text(response.responseJSON.errors.status);
	  }
	 });
	});




/*==============================================
	View Leads Modal
============================================*/
	
	$(document).on('click', '.leadview' , function() {
		
		// $('.leadViewModal').html(data.data);
		// $('.leadViewModal').modal('show');
		var lead_id = $(this).data('lead_id');
		
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		 $.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/lead/view/'+lead_id,
			
			data: {_token:csrf_token,lead_id:lead_id},
			

			success: function(data) {
				// console.log(data);
				if(data.success){
					$('.leadViewModal').html(data.data);
					$('.leadViewModal').modal('show');
					$('.errors').html('');
				}else{
					notification('Error','Something went wrong.','top-right','error',2000);
				}	
			},
		});
	})

/*==============================================
	Edit Leads Modal
============================================*/

	$(document).on('click', '.leadEdit' , function() {
		// alert("ok");
		// $('.leadViewModal').html(data.data);
		// $('.leadEditModal').modal('show');
		var lead_id = $(this).data('lead_id');
		
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		 $.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/lead/edit/'+lead_id,
			
			data: {_token:csrf_token,lead_id:lead_id},
			

			success: function(data) {
				// console.log(data);
				if(data.success){
					$('.leadEditModal').html(data.data);
					$('.leadEditModal').modal('show');
					$('.errors').html('');
				}else{
					notification('Error','Something went wrong.','top-right','error',2000);
				}	
			},
		});
	})








	/*==============================================
	Update Leads Form
============================================*/


$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).on('submit','#leads_edit_form', function(event) {
	
	event.preventDefault();

	

	lead_id = $('#lead_id').val();
	
	client_name = $('#client_name').val();
	// reason_for_lost = $('#reason_for_lost').val();
	
	upwork_id = $('#upwork_id').val();
	job_title = $('#job_title').val();
	job_url = $('#job_url').val();
	
	client_budget = $('#client_budget').val();	
	our_estimate = $('#our_estimate').val();
	bidder_id = $('#bidder_id').val();
	status = $('#status').val();

	$.ajax({
	  url: base_url+'/leads/update/'+lead_id,
	  type: "POST",
	  dataType : 'json',
	  
	  data: $(this).serialize(),
	 
	  success:function(data){
		$('.errors').html('');
		$('.request_loader').css('display','none');
		
		if (data.success) {
			
			notification('Success','Lead Updated Successfully','top-right','success',2000);
			if(typeof (data.view) != 'undefined' && data.view != null && typeof (data.class) != 'undefined'  && data.class != null && data.view != '' && data.class != ''){
				// alert(".lead_row_"+lead_id);
				// $("tr").load("#lead_id"+lead_id);
				console.log(data.class);
				$('.'+data.class).replaceWith(data.view);   //Refresh div content
				setTimeout(function(){ $('.leadEditModal').modal('hide'); }, 500);
			}else{
				setTimeout(function(){ $('.leadEditModal').modal('hide'); }, 2000);
			
			}
	
			
			
		  $('#success-message').text(response.success);
		  $("#leads_edit_form")[0].reset();
		}
	  },

	  error: function(xhr, textStatus, errorThrown, response) {
		if($('input[name="client_name"]').val().length == 0)
		{
			if(xhr.status == 422)
			{ 
				$(client_name).addClass('is-invalid');
				$('#invalid-feedback').text(xhr.responseJSON.errors.client_name["0"]).css('font-size','0.9rem');                 
			}                              
		}
		if($('input[name="job_title"]').val().length == 0)
		{
			if(xhr.status == 422)
			{ 
				$(job_title).addClass('is-invalid');
				$('#job_title_invalid-feedback').text(xhr.responseJSON.errors.job_title["0"]).css('font-size','0.9rem');                 
			}                              
		}
		if($('input[name="client_budget"]').val().length == 0)
		{
			if(xhr.status == 422)
			{ 
				$(job_title).addClass('is-invalid');
				$('#client_budget_invalid-feedback').text(xhr.responseJSON.errors.client_budget["0"]).css('font-size','0.9rem');                 
			}                              
		}
		if($('input[name="job_url"]').val().length == 0)
		{
			if(xhr.status == 422)
			{ 
				$(job_title).addClass('is-invalid');
				$('#job_url_invalid-feedback').text(xhr.responseJSON.errors.job_url["0"]).css('font-size','0.9rem');                 
			}                              
		}
		if($('input[name="our_estimate"]').val().length == 0)
		{
			if(xhr.status == 422)
			{ 
				$(job_title).addClass('is-invalid');
				$('#our_estimate_invalid-feedback').text(xhr.responseJSON.errors.our_estimate["0"]).css('font-size','0.9rem');                 
			}                              
		}
		// if($('input[name="reason_for_lost"]').val().length == 0)
		// {
		// 	if(xhr.status == 422)
		// 	{ 
		// 		$(job_title).addClass('is-invalid');
		// 		$('#reason_for_lost_invalid-feedback').text(xhr.responseJSON.errors.reason_for_lost["0"]).css('font-size','0.9rem');                 
		// 	}                              
		// }
	
	  }
	 });
	});
	
	/*-------------------------------------------

Delete Leads
-----------------------------------------------------*/

$(document).on('click', '.delete_lead' , function() {

	var lead_id = $(this).data('id');
	// alert("heloo");
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/leads/delete/'+lead_id,
        data: {_token:csrf_token,lead_id:lead_id},
        success: function(data) {
			
			if(data.success){
				notification('Success','Lead deleted Successfully','top-right','success',2000);
				$('.lead_row_'+lead_id).hide("slow");
				$("table").load("#filtered-data");
				// $("#" + data['tr']).slideUp("slow");
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
    $.ajax({
        type: "GET",
		// dataType: 'json',
        url: base_url+'/leads',
        data: $(this).serialize(),
        success: function(data) {
			 $('.search_spinloder').css('display','none');
             //start date and end date error 
			 data= data.trim();
			if(data=='date_error'){
				
				notification('Error','Start date not greater than end date.','top-right','error',4000);	
			}else if(data=='age_error'){
				notification('Error','Start age not greater than end age.','top-right','error',4000);	
			}else{
             // Set search result
			 $("#tag_container").empty().html(data); 
			}	
        },
		error :function( data ) {}
    });
});




/*==============================================
	ADD Comments Modal
============================================*/

$(document).on('click', '.leadaddcomment' , function() {
	
	// alert("ok");
	// $('.leadViewModal').html(data.data);
	// $('.leadEditModal').modal('show');
	var userid = $(this).data('user_id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
		type: "POST",
		dataType: 'json',
		url: base_url+'/addcommentview/'+userid,
		
		data: {_token:csrf_token,userid:userid},
		

		success: function(data) {
			// console.log(data);
			if(data.success){
				
				$('.leadAddCommentsmodal').html(data.data);
				$('.leadAddCommentsmodal').modal('show');  // /This name of class is defined in the leads.blade.php
				$('.errors').html('');
				
			}else{
				notification('Error','Something went wrong.','top-right','error',2000);
			}	
		},
	});
})







