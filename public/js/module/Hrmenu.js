/*==============================================
	Add Employee Hr Panel Form
============================================*/

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$('#add_employee_form').on('submit', function(event){

	event.preventDefault();
	
	$('#emp_id-error').text('');
    // console.log(dsegu);
	$('#emp_name-error').text('');
	$('#father_name-error').text('');
	$('#personal_email-error').text('');
	$('#professional_email-error').text('');
	
	$('#phone-error').text('');
    $('#current_address-error').text('');
    $('#permanent_address-error').text('');
    $('#date_of_joining-error').text('');
    $('#date_of_birth-error').text('');
    $('#current_salary-error').text('');
    $('#category-error').text('');
    $('#pan_details-error').text('');
    $('#epfo_details-error').text('');
    $('#esi_details-error').text('');
    $('#bank_account-error').text('');
    $('#ifsc_code-error').text('');



	emp_id = $('#emp_id').val();
	emp_name = $('#emp_name').val();
	father_name = $('#father_name').val();
	personal_email = $('#personal_email').val();
	professional_email = $('#professional_email').val();
	phone = $('#phone').val();
	current_address = $('#current_address').val();
	permanent_address = $('#permanent_address').val();
    date_of_joining = $('#date_of_joining').val();
    date_of_birth = $('#date_of_birth').val();
    current_salary = $('#current_salary').val();
    category = $('#category').val();
    pan_details = $('#pan_details').val();
    epfo_details = $('#epfo_details').val();
    esi_details = $('#esi_details').val();
    bank_account = $('#bank_account').val();
    ifsc_code = $('#ifsc_code').val();

	$.ajax({
	  url: "/admin/store/employee",
	  type: "POST",
	  data:{
        emp_id:emp_id,
		emp_name:emp_name,
		father_name:father_name,
		personal_email:personal_email,
		professional_email:professional_email,
		phone:phone,
		current_address:current_address,
		permanent_address:permanent_address,
		date_of_joining:date_of_joining,
        date_of_birth:date_of_birth,
        current_salary:current_salary,
        category:category,
        pan_details:pan_details,
        epfo_details:epfo_details,
        esi_details:esi_details,
        bank_account:bank_account,
        ifsc_code:ifsc_code,
	  },
	  success:function(response){
		// $('.errors').html('');
		// $('.request_loader').css('display','none');
		console.log(response);
		if (response) {
			notification('Success','Employee Created Successfully','top-right','success',2000);
		
			// $("table").load("#filtered-data");
				// $(".separator").html(result);
		  $('#success-message').text(response.success);
		  $("#add_employee_form")[0].reset();
		}
	  },
	  error: function(response) {
          $('#emp_id-error').text(response.responseJSON.errors.emp_id);
		  $('#emp_name-error').text(response.responseJSON.errors.emp_name);
		  $('#father_name-error').text(response.responseJSON.errors.father_name);
		  $('#personal_email-error').text(response.responseJSON.errors.personal_email);
		  $('#phone-error').text(response.responseJSON.errors.phone);
          $('#date_of_joining-error').text(response.responseJSON.errors.date_of_joining);
          $('#date_of_birth-error').text(response.responseJSON.errors.date_of_birth);
          $('#current_salary-error').text(response.responseJSON.errors.current_salary);
          $('#category-error').text(response.responseJSON.errors.category);
          $('#esi_details-error').text(response.responseJSON.errors.esi_details);
        
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

$(document).on('click', '.viewemployee' , function() {
	
	var employee_id = $(this).data('employee_id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
		type: "POST",
		dataType: 'json',
		url: base_url+'/hrpanel/view/'+employee_id,
		
		data: {_token:csrf_token,employee_id:employee_id},
		

		success: function(data) {
			// console.log(data);
			if(data.success){
				$('.employeeviewmodal').html(data.data);
				$('.employeeviewmodal').modal('show');
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',2000);
			}	
		},
	});
})


	/*-------------------------------------------

Delete Employee
-----------------------------------------------------*/

$(document).on('click', '.delete_employee' , function() {

	var employee_id = $(this).data('id');
		 
	var csrf_token = $('meta[name="csrf-token"]').attr('content');

	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/employee/delete/'+employee_id,
        data: {_token:csrf_token,employee_id:employee_id},
        success: function(data) {
			
			if(data.success){
				notification('Success','Employee deleted Successfully','top-right','success',2000);
				$('.employee_row_'+employee_id).hide("slow");
			
				
			}else{
				
				notification('Error','Something went wrong.','top-right','error',3000);
				
				
			}	
        },
    });
});


/*==============================================
	Add HR-TAB Form
============================================*/

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$('#add_hr_form').on('submit', function(event){

	event.preventDefault();

    $('#hired_on-error').text('');
    $('#increment_due-error').text('');
   



	tech_stack = $('#tech_stack').val();
	past_experience = $('#past_experience').val();
	past_companies = $('#past_companies').val();
	tele_verification = $('#tele_verification').val();
	email_verification = $('#email_verification').val();
	hired_through = $('#hired_through').val();
	hired_on = $('#hired_on').val();
	increment_due = $('#increment_due').val();
    leaving_date = $('#leaving_date').val();
    education = $('#education').val();
    comments = $('#comments').val();
   

	$.ajax({
	  url: "/admin/store/hr",
	  type: "POST",
	  data:{
        tech_stack:tech_stack,
		past_experience:past_experience,
		past_companies:past_companies,
		tele_verification:tele_verification,
		email_verification:email_verification,
		hired_through:hired_through,
		hired_on:hired_on,
		increment_due:increment_due,
		leaving_date:leaving_date,
        education:education,
        comments:comments,
      
	  },
	  success:function(response){
		// $('.errors').html('');
		// $('.request_loader').css('display','none');
		console.log(response);
		if (response) {
			notification('Success','Hr Added Successfully','top-right','success',2000);
		
			// $("table").load("#filtered-data");
				// $(".separator").html(result);
		  $('#success-message').text(response.success);
		  $("#add_hr_form")[0].reset();
		}
	  },
	  error: function(response) {
          $('#hired_on-error').text(response.responseJSON.errors.hired_on);
		  $('#increment_due-error').text(response.responseJSON.errors.increment_due);
		
        
	  }
	 });
	});



