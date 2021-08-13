	
$(document).on('keyup','#searchByarticleName', function(e) {	
		var querytxt = $("#searchByarticleName").val();	
		var csrf_token = $('input[name="_token"]').val();
		if(querytxt.length > 0){
			$("#load_more").css('display', 'none');
			$('#load_more').removeAttr("disabled");
		}else{
			$("#load_more").css('display', 'block');
			$('#offset').val(20);
			$('#load_more').removeAttr("disabled");
			$("#load_more").attr('value', 'Load More');
		}
		$(".loading-image").show();
		$.ajax({
			type: "POST",
			url: base_url+'/SearchAutoCompleteform1',
			data: ({_token:csrf_token,string: $("#searchByarticleName").val()}),
			success: function(data) {
				//$("#tempdiv").show();  
				$(".loading-image").hide();
				$("#posts").html(data.html); 
				/* $('#tempdiv > li > a').click(function(){
					var search_resultList = $(this).text();
					$("#searchByarticleName").val(search_resultList); 
					$("#tempdiv").hide();         
				}); */
			}      
		}); 
	});	

$(document).on('click','#dweditbutton,#dwpdfbutton', function(e) {
	$('#sign-in').addClass('active').fadeIn('slow');
	$('#account').removeClass('active').fadeOut('slow');
});


$(document).on('click','.modalimgview', function(e) {		
    var infoid = $(this).attr('data-infoid');
	var csrf_token = $('input[name="_token"]').val();
	$.ajax({
		url: base_url+'/update_preview_count_form',
		dataType: 'json',
		type: 'post',
		contentType: 'application/x-www-form-urlencoded',
		data: {_token:csrf_token,infoid:infoid},
		success: function(data){
			
		}
	});
	
});

$(document).on('click','a', function(e) {		
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
		var userid = $(this).attr('data-user_id');
		$.ajax({
			url: base_url+'/update_depdf_count_form',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,infoid:infoid,user_id:userid},
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

$(document).ready(function(){
	var href = document.location.href;
	var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);
	var str = lastPathSegment.split('#');
	console.log(str);
	
	if(str.length > 1){
		 if(str[0] == 'forms'){
			var slug = str[1];
			var csrf_token = $('input[name="_token"]').val();
			$.ajax({
				url: base_url+'/forms/get_info_from_slug',
				dataType: 'json',
				type: 'post',
				contentType: 'application/x-www-form-urlencoded',
				data: {_token:csrf_token,slug:slug},
				success: function(data){
					$("#modal-preview"+data).modal('show');
				}
			});
		 }
	}
})