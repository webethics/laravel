/*==============================================
	Login Form
=============================================*/

$(document).on('click','#signin_button,#openlogin,#signin_tab', function(e) {
	$('#sign-in').addClass('active').fadeIn('slow');
	$('#signup_tab').removeClass('active');
	$('#signin_tab').addClass('active');
	$('#forgotPassword').hide();
	$('#account').hide();
	
	$('#tablist').show();
	$('#tablistforgot').hide();
	$('#forgotPassword').removeClass('active').fadeOut('slow');;
});
$(document).on('click','#signup_button,#accountopen,#signup_tab', function(e) {
	$('#sign-in').removeClass('active').fadeOut('slow');
	$('#account').addClass('active').fadeIn('slow');;
	$('#signup_tab').addClass('active');
	$('#signin_tab').removeClass('active');
	$('#forgotPassword').hide();
	$('#tablist').show();
	$('#sign-in').hide();
	$('#tablistforgot').hide();
	$('#forgotPassword').removeClass('active').fadeOut('slow');
	
});
$(document).on('click','#forgotopen', function(e) {
	$('#sign-in').removeClass('active').fadeOut('slow');
	$('#account').removeClass('active').fadeOut('slow');
	$('#forgotPassword').addClass('active').fadeIn('slow');;
	$('#tablistforgot').show();
	$('#tablist').hide();
});


	
$(document).on('submit','#submitLoginFormPage', function(e) {
	console.log('1');
	e.preventDefault(); 
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/login',
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			$('.request_loader').css('display','none');
			// If data inserted into DB
			if(data.success){
				
				setTimeout(function(){ $('.signinmodal').modal('hide'); }, 2000);
				setTimeout(function(){
						window.location.href = base_url+''+data.redirect_to; 
				}, 500);
			}else{
				$.getScript("https://www.google.com/recaptcha/api.js", function () {});
				$('.server_error').html(data.message);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
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
                }else{
                // $('#response').show().append(value+"<br/>"); //this is my div with messages
                }
            }); 
          }
		}

    });
});	
$(document).on('submit','#submitLoginForm', function(e) {
	console.log('2');
	e.preventDefault(); 
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/login',
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			$('.request_loader').css('display','none');
			// If data inserted into DB
			if(data.success){
				
				setTimeout(function(){ $('.signinmodal').modal('hide'); }, 2000);
				setTimeout(function(){
						window.location.href = base_url+''+data.redirect_to; 
				}, 500);
			}else{
				$.getScript("https://www.google.com/recaptcha/api.js", function () {});
				$('.server_error').html(data.message);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
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
                }else{
                // $('#response').show().append(value+"<br/>"); //this is my div with messages
                }
            }); 
          }
		}

    });
});


$(document).on('click','.formmodal .close', function(e) {	 
	$('.modal-backdrop').remove();
  });
	
$(document).on('submit','#submitSignupForm,#submitSignupForm', function(e) {
	e.preventDefault(); 
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/register',
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			$('.request_loader').css('display','none');
			// If data inserted into DB
			if(data.success){
				$('#submitSignupForm').hide();
				$('#showSuccessMessage').html(data.message).show();
			}else{
				$('.server_error').html(data.message);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
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
                }else{
                // $('#response').show().append(value+"<br/>"); //this is my div with messages
                }
            }); 
          }
		}

    });
});
	
	$(document).on('click','#landinginfo a', function(e) {		
	var  eoption = $(this).attr('data-edit');
	var csrf_token = $('input[name="_token"]').val();
	var userid = $(this).attr('data-user_id');
	//alert(eoption);
	if(eoption == "dpdf"){
		var infoid = $(this).attr('data-infoid');
		$.ajax({
			url: base_url+'/update_dpdf_count',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,infoid:infoid,user_id:userid},
			success: function(data){
				//alert(data);
				
			}
		});
	}
	
	if(eoption == "dedit"){
		var infoid = $(this).attr('data-infoid');
		
		$.ajax({
			url: base_url+'/update_depdf_count',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,infoid:infoid},
			success: function(data){
				//alert(data);
			}
		});
	}
	if(eoption == "shared"){
		var infoid = $(this).attr('data-infoid');
		var csrf_token = $('input[name="_token"]').val();
		$.ajax({
			url: base_url+'/update_shared_count',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,infoid:infoid},
			success: function(data){
				//alert(data);
			}
		});
	}
});

$(document).on('click','#landing_form a', function(e) {		
	var  eoption = $(this).attr('data-edit');
	var csrf_token = $('input[name="_token"]').val();	
	var userid = $(this).attr('data-user_id');
	//alert(eoption);
	if(eoption == "dpdf"){
		var infoid = $(this).attr('data-infoid');
		$.ajax({
			url: base_url+'/update_dpdf_count_form',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,infoid:infoid,user_id:userid},
			success: function(data){
				//alert(data);
				
			}
		});
	}
	
	if(eoption == "dedit"){
		var infoid = $(this).attr('data-infoid');
		var csrf_token = $('input[name="_token"]').val();
		$.ajax({
			url: base_url+'/update_depdf_count_form',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,infoid:infoid},
			success: function(data){
				//alert(data);
			}
		});
	}
	if(eoption == "shared"){
		var infoid = $(this).attr('data-infoid');
		var csrf_token = $('input[name="_token"]').val();
		$.ajax({
			url: base_url+'/update_shared_count_form',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,infoid:infoid},
			success: function(data){
				//alert(data);
			}
		});
	}
});

function social_login_popup(url) {
	newwindow=window.open(url,'name','height=500,width=600');
	if (window.focus) {newwindow.focus()}
	return false;
}

$(document).on('submit','#forgotPasswordForm', function(e) {
	e.preventDefault(); 
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/password/email',
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			$('.request_loader').css('display','none');
			// If data inserted into DB
			if(data.success){
				$('#forgotPasswordForm').hide();
				$('#showSuccessMessagePass').html(data.message).show();
			}else{
				$('.server_error').html(data.message);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
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
                }else{
                // $('#response').show().append(value+"<br/>"); //this is my div with messages
                }
            }); 
          }
		}

    });
});
	