	
	
	function showCarousel(){
		var sync11 = $(".infographic-carousel");
		var slidesPerPage = 8;
		var syncedSecondary1 = true;
		sync11
			.owlCarousel({
				items: 1,
				slideSpeed: 2000, 
				nav: true,
				navText: ["<i class='fas fa-chevron-circle-left'></i>","<i class='fas fa-chevron-circle-right'></i>"],
				dots: false,
				loop: true,
				autoHeight:true,
				responsiveRefreshRate: 200,
			})
			.on("changed.owl.carousel", syncPosition1);

		function syncPosition1(el) {
			//if you set loop to false, you have to restore this next line
			//var current = el.item.index;
			//if you disable loop you have to comment this block
			var count = el.item.count-1;
			var current = Math.round(el.item.index - (el.item.count/2) - .5);
			if(current < 0) {
			  current = count;
			}
			if(current > count) {
			  current = 0;
			}

		}
		function syncPosition21(el) {
		
			if(syncedSecondary1) {
			  var number = el.item.index;
			  sync11.data('owl.carousel').to(number, 100, true);
			}
		}
	}
         $(document).on('ready', function() {
			showCarousel();
			
         $('.center').slick({
         centerMode: true,
         centerPadding: '0px',
         slidesToShow: 4,
         autoplay: true,
         arrows: true,
         autoplaySpeed: 2000,
         responsive: [
         
         {
           breakpoint: 1025,
           settings: {
             arrows: true,
             centerMode: true,
             centerPadding: '0px',
             slidesToShow: 3
           }
         },
		   {
           breakpoint: 991,
           settings: {
             arrows: true,
             centerMode: true,
             centerPadding: '0px',
             slidesToShow: 2
           }
         },
		 
         {
           breakpoint: 480,
           settings: {
             arrows: true,
             centerMode: true,
             centerPadding: '0px',
             slidesToShow: 1
           }
         }
         ]
         });
	$('.singleslider').slick({
		slidesToShow: 1,
		arrows: false,
		autoplay: true,
	});
	
		var href = document.location.href;
		var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);
		var str = lastPathSegment.split('#');
		
		
		if(str.length > 1){
			//alert(str[1]);
			if(str[1].indexOf("modal-preview") != -1){
				$("#"+str[1]).modal('show');
			}
		}
         });
     
         window.onscroll = function() {myFunction()};
         
         var header = document.getElementById("navigation");
         var sticky = header.offsetTop;
         
         function myFunction() {
           if (window.pageYOffset > sticky) {
             header.classList.add("sticky");
           } else {
             header.classList.remove("sticky");
           }
         }
      
         wow = new WOW(
           {
             animateClass: 'animated',
             offset:       100,
             callback:     function(box) {
               console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
             }
           }
         );
         wow.init();
		 
		 $('ul.navbar-nav').find('a#plansection_nav').click(function(){
			var $href = $(this).attr('href');
			var $anchor = $('#'+$href).offset();
			$('body').animate({ scrollTop: $anchor.top });
			return false;
		});
	

		$(".see-more").click(function() {
			$('.request_loader').css('display','inline-block');
			$div = $($(this).data('div')); //div to append
			$link = $(this).data('link'); //current URL
			var total_infographics = $('#total_infographics').val();
			
			
			$page = $(this).data('page'); //get the next page #
			$href = $link + $page; //complete URL
			$.get($href, function(response) { //append data
				$('#datalength').val(response.length);
				var len = $('#datalength').val();
				var offset = $('#offset').val();
				
				
				$html = $(response).find("#posts").html(); 
				//$div.append(response).fadeIn('slow');
				
				$("#posts").show();  
				$('#offset').val(parseInt(offset)+parseInt(16));
				$('#posts').append($html);
				showCarousel();
				$('.request_loader').css('display','none');
				
				
			});
			var setoffset = $('#limit').val();
			$(this).data('page', (parseInt($page) + 1)); //update page #
			if(total_infographics < (parseInt(setoffset) * parseInt($page))){
				$(".see-more").css('display','none');
			}
			console.log(total_infographics+'---'+(parseInt(setoffset) * parseInt($page)));
		});
		
		
		$('.waves-effect').click(function() {
			var copyText = $(this).attr('data-info-slug');
			window.location.hash = copyText;
		   
		});
		
	$(document).on('click', '.copytxt', function(){
		var copyText = $(this).attr('data-copyval');
		var dummy = document.createElement("input");
		document.body.appendChild(dummy);
		dummy.setAttribute("id", "dummy_id");
		document.getElementById("dummy_id").value=copyText;
		dummy.select();
		document.execCommand("copy");
		alert("Copied text to clipboard."); 
		document.body.removeChild(dummy);
		$( this ).off( event );
	//alert(value);
	});
	
	function getSingleForm(formid){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		var form_data = new FormData(); 
		form_data.append("_token", csrf_token);
		form_data.append("formid", formid);
	
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/getSingleFormData/'+formid,
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('.error').html('');
				$('.loader_banner').css('display','none');
				if(data.success){
					$("#modal-single-row").modal('show');
					$('#frmAddProject').html(data.html);
					
					
				}else{
					notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {
			 if( data.status === 422 ) {
				$('.loader_banner').css('display','none');
				$('.error').html('');
				
			  }
			}

		});
		showCarousel();
	}
	
	function getSingleInfographic(formid){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		var form_data = new FormData(); 
		form_data.append("_token", csrf_token);
		form_data.append("formid", formid);
	
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/getSingleInfoData/'+formid,
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('.error').html('');
				$('.loader_banner').css('display','none');
				if(data.success){
					$("#modal-single-row").modal('show');
					$('#frmAddProject').html(data.html);
					showCarousel();
				}else{
					notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {
			 if( data.status === 422 ) {
				$('.loader_banner').css('display','none');
				$('.error').html('');
				
			  }
			}

		});
	}
	
	function getSingleTemplate(templateid){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		var form_data = new FormData(); 
		form_data.append("_token", csrf_token);
		form_data.append("templateid", templateid);
	
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: base_url+'/getSingleTemplateData/'+templateid,
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				$('.error').html('');
				$('.loader_banner').css('display','none');
				if(data.success){
					$("#modal-single-row").modal('show');
					$('#frmAddProject').html(data.html);
					showCarousel();
				}else{
					notification('Error','Somthing went wrong.','top-right','error',2000);
				}	 
			},
			error :function( data ) {
			 if( data.status === 422 ) {
				$('.loader_banner').css('display','none');
				$('.error').html('');
				
			  }
			}

		});
	}
	
	
	
	/*  */

      /*    document.getElementById('moar').onclick = function() {
           var section = document.createElement('section');
           section.className = 'section--purple wow fadeInDown';
           this.parentNode.insertBefore(section, this);
         }; */
