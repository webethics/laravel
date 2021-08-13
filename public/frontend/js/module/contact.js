/***************** Submit Contact form  *******************************/

$(document).on('click','.contact-form', function(e) {
    e.preventDefault();
	$('.request_loader').css('display','inline-block');
	$('.errors').html('');
	$this = $(this);
	var form = $(this).parents('form.contactform');
	var ajax_url = form.attr('action');
	var method = form.attr('method');

	
    $.ajax({
        type: method,
		//dataType: 'json',
        url: ajax_url,
        data: form.serialize(),
        success: function(data) {
			$('.request_loader').css('display','none');
			// If data inserted into DB
				if(data.success){
					if(typeof (data.message) != 'undefined' && data.message != null && data.message != ''){
						notification('Success',data.message,'top-right','success',3000);
					}else{
						notification('Success','Successfully submit consign form','top-right','success',3000);
					}
				
				$("#contactform")[0].reset();
				$('html, body').animate({
			        scrollTop: $("#contactformsection").offset().top
			    }, 2000);
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

            $('html, body').animate({
		        scrollTop: $("#contactformsection").offset().top
		    }, 2000);
          }
		}

    });
});