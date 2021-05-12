@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Create Plan')
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'description',{
    allowedContent: true
} );CKEDITOR.replace( 'arabic_description',{
    allowedContent: true
} );
</script>
@stop
<div class="row">
<div class="col-12">
	<h1>New Plan</h1>
	<div class="separator mb-5"></div>
</div>
</div>
       <!-- Main content -->
				<div class="card">
				<div class="card-body">
				<div class="table-responsive"  id="tag_container">
				<div class="col-lg-12">
					<div class="box box-primary">
						<div class="box-body">
						  
							@include('flash-message')		
					       
							
							{{ Form::open(array('url' => 'admin/plan-create', 'method' => 'post','id' => 'createPlan','class'=>'profile form-horizontal' ,'files'=>'true')) }}


							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('title',old('title'),array('id'=>'title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error title_error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('Arabic Title') }}
										{{ Form::text('arabic_title',old('arabic_title'),array('id'=>'arabic_title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error arabic_title_error"> {{ $errors->first('arabic_title')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Description') }}
											{{ Form::textarea('description',old('description'),array('id'=>'description','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('description')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Arabic Description') }}
											{{ Form::textarea('arabic_description',old('arabic_description'),array('id'=>'arabic_description','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_description')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Price') }}
											{{ Form::text('price',old('price'),array('id'=>'price','class'=>'form-control','placeholder'=>'')) }}
											<span class="error price_error"> {{ $errors->first('price')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Number Of users') }}
											{{ Form::text('number_of_users',old('number_of_users'),array('id'=>'number_of_users','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('number_of_users')  }} </span>
										</div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Membership Length') }}
											
											<select  id="membership_length"  class="form-control select2-single"  name="membership_length"  data-width="100%">
													<option value=" ">Select Membership Length</option>
													<option value="0" @if(old("membership_length")  == '0') {{'selected'}} @endif >Monthly</option>
													<option value="1" @if(old("membership_length") == 1) {{'selected'}} @endif >Yearly</option>
													<option value="2" @if(old("membership_length") == 2) {{'selected'}} @endif >Lifetime</option>
											</select>
											
											<span class="error membership_length_error"> {{ $errors->first('membership_length')  }} </span>
										</div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Status') }}
											
											<select  id="status"  class="form-control select2-single"  name="status"  data-width="100%">
												<option value=" ">Select Status</option>
													<option value="0" @if(old("status") && old("status") == 0) {{'selected'}} @endif >In-Active</option>
													<option value="1" @if(old("status") == 1) {{'selected'}} @endif >Active</option>
											</select>
											
											<span class="error"> {{ $errors->first('status')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Display Order') }}
											
											<select  id="display_order"  class="form-control select2-single"  name="display_order"  data-width="100%">
												<option value=" ">Select Display Order</option>
												<option value="1" @if(old("display_order") && old("display_order") == 1) {{'selected'}} @endif >Standard</option>
												<option value="2" @if(old("display_order") == 2) {{'selected'}} @endif >Business</option>
												<option value="3" @if(old("display_order") == 3) {{'selected'}} @endif >Executive</option>
											</select>
											
											<span class="error display_order_error"> {{ $errors->first('display_order')  }} </span>
										</div>
										
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input name="login" class="btn-addplan loginmodal-submit btn btn-primary" id="" value="Submit" type="submit">
									 <a href="{{url('admin/listplans')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
									 <div class="spinner-border text-primary request_loader" style="display:none"></div>
								</div>
							</div>
							
								  {{ Form::close() }}
					</div>
				</div>
			</div>
			</div>
			</div>
			</div>

	

@section('userJs')
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo config('paypal.sandbox_client_id'); ?>&vault=true"></script>
<script src="{{ asset('js/module/plan.js')}}"></script>	
<script>

/* 
$(document).on('submit','#createPlan', function(e) {
    
	var apiKey = '<?php echo config("paypal.sandbox_client_id"); ?>'; // live Client ID
	var password = '<?php echo config("paypal.sandbox_secret");?>'; //live api client secret
	var planname = $('#title').val();
	var plandesc = $( 'textarea#description' ).val();//tinyMCE.activeEditor.getContent();
	var arabic_planname = $('#arabic_title').val();
	var arabic_plandesc = $( 'textarea#arabic_description' ).val();//tinyMCE.activeEditor.getContent();
	var planfee = $('#price').val();
	var membership_length = $('#membership_length').val();
	
	var feeusd = Math.round((planfee*0.27),2);
	var num_of_users = $('#number_of_users').val();
	var status = $('#status').val();
	var display_order = $('#display_order').val();
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	if(status == 1){
		statval = "ACTIVE";
	}else{
		statval = "INACTIVE";
	}
	$('.request_loader').show();
	if(membership_length == 1 && planname != '' && arabic_planname != '' && planfee != '' && display_order != '' && membership_length != ''){
		var arr = {
			"product_id": "Business", // live productID
			"name": planname,
			"description": planname,
			"status": statval,
			"billing_cycles": [
			{
				"frequency": {
					"interval_unit": "YEAR",
					"interval_count": 1
				},
				"tenure_type": "REGULAR",
				"sequence": 1,
				"total_cycles": 0,
				"pricing_scheme": {
					"fixed_price": {
						"value": feeusd,
						"currency_code": "USD"
					}
				}
			}
			],
			"payment_preferences": {
				"auto_bill_outstanding": true,
				"setup_fee": {
					"value": "0",
					"currency_code": "USD"
				},
				"setup_fee_failure_action": "CONTINUE",
				"payment_failure_threshold": 3
			}
		};
		$.ajax({
			type: "POST",
			url: "<?php echo config('paypal.sandbax_api_url');?>/v1/oauth2/token",
			dataType: "json",
			data: {grant_type: "client_credentials"},
			beforeSend: function(xhr) { 
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
				xhr.setRequestHeader("Authorization", "Basic " + btoa([apiKey, password].join(":"))); 
			},
			success: function (result) {
		
				$.ajax("<?php echo config('paypal.sandbax_api_url');?>/v1/billing/plans", {
					method: "post",
					headers: {
						"Content-Type": "application/json",
						"Authorization": "Bearer "+result.access_token
					},			
					dataType: "json",
					data: JSON.stringify(arr),
					success: function (datares) {
						var planID = datares.id;
						
						$.ajax({
							url: base_url+'/plan-create',
							dataType: 'json',
							type: 'post',
							contentType: 'application/x-www-form-urlencoded',
							data: {_token:csrf_token,plan_id:planID,title:planname,description:plandesc,arabic_title:arabic_planname,arabic_description:arabic_plandesc,price:planfee,num_of_users:num_of_users,mem_length:membership_length,status:status,display_order:display_order},
							success: function(data){
								 
							if(data){
									$('.request_loader').hide();
									notification('Success','Plan added Successfully','top-right','success',2000);
									setTimeout(function(){window.location.href = base_url+'/listplans'; }, 2000);
								}
							},
							error: function( jqXhr, textStatus, errorThrown ){
								$('.request_loader').css('display','none');
								if( jqXhr.status !== 422 ) {
									notification('Error',errorThrown,'top-right','error',3000);
								}
								if( jqXhr.status === 422 ) {
									$('.request_loader').css('display','none');
									$('.errors').html('');
									//notification('Error','Please fill all the fields.','top-right','error',4000);
									var errors = $.parseJSON(jqXhr.responseText);
									$.each(errors, function (key, value) {
										if($.isPlainObject(value)) {
											$.each(value, function (key, value) {                       
												var key = key.replace('.','_');
												$('.'+key+'_error').show().append(value);
											});
										}else{
										
										}
									}); 
								  } 
							}
						});  
					},
					error: function( jqXhr, textStatus, errorThrown ){
						$('.request_loader').css('display','none');
						if( jqXhr.status !== 422 ) {
							notification('Error',errorThrown,'top-right','error',3000);
						}
						if( jqXhr.status === 422 ) {
							$('.request_loader').css('display','none');
							$('.errors').html('');
							//notification('Error','Please fill all the fields.','top-right','error',4000);
							var errors = $.parseJSON(jqXhr.responseText);
							$.each(errors, function (key, value) {
								if($.isPlainObject(value)) {
									$.each(value, function (key, value) {                       
										var key = key.replace('.','_');
										$('.'+key+'_error').show().append(value);
									});
								}else{
								
								}
							}); 
						  } 
					}
				});
			},
			error: function( jqXhr, textStatus, errorThrown ){
				$('.request_loader').css('display','none');
				if( jqXhr.status !== 422 ) {
					notification('Error',errorThrown,'top-right','error',3000);
				}
				if( jqXhr.status === 422 ) {
					$('.request_loader').css('display','none');
					$('.errors').html('');
					//notification('Error','Please fill all the fields.','top-right','error',4000);
					var errors = $.parseJSON(jqXhr.responseText);
					$.each(errors, function (key, value) {
						if($.isPlainObject(value)) {
							$.each(value, function (key, value) {                       
								var key = key.replace('.','_');
								$('.'+key+'_error').show().append(value);
							});
						}else{
						
						}
					}); 
				  } 
			}
		});
	}else if(membership_length == '0' && membership_length != 'NULL'  && planname != '' && arabic_planname != '' && planfee != '' && display_order != '' && membership_length != ''){
		var arr = {
			"product_id": "Standard", // live productID
			"name": planname,
			"description": planname,
			"status": statval,
			"billing_cycles": [
			{
				"frequency": {
					"interval_unit": "MONTH",
					"interval_count": 1
				},
				"tenure_type": "REGULAR",
				"sequence": 1,
				"total_cycles": 0,
				"pricing_scheme": {
					"fixed_price": {
						"value": feeusd,
						"currency_code": "USD"
					}
				}
			}
			],
			"payment_preferences": {
				"auto_bill_outstanding": true,
				"setup_fee": {
					"value": "0",
					"currency_code": "USD"
				},
				"setup_fee_failure_action": "CONTINUE",
				"payment_failure_threshold": 3
			}
		};
		$.ajax({
			type: "POST",
			url: "<?php echo config('paypal.sandbax_api_url');?>/v1/oauth2/token",
			dataType: "json",
			data: {grant_type: "client_credentials"},
			beforeSend: function(xhr) { 
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
				xhr.setRequestHeader("Authorization", "Basic " + btoa([apiKey, password].join(":"))); 
			},
			success: function (result) {
		
				$.ajax("<?php echo config('paypal.sandbax_api_url');?>/v1/billing/plans", {
					method: "post",
					headers: {
						"Content-Type": "application/json",
						"Authorization": "Bearer "+result.access_token
					},			
					dataType: "json",
					data: JSON.stringify(arr),
					success: function (datares) {
						var planID = datares.id;
						
						$.ajax({
							url: base_url+'/plan-create',
							dataType: 'json',
							type: 'post',
							contentType: 'application/x-www-form-urlencoded',
							data: {_token:csrf_token,plan_id:planID,title:planname,description:plandesc,arabic_title:arabic_planname,arabic_description:arabic_plandesc,price:planfee,num_of_users:num_of_users,mem_length:membership_length,status:status,display_order:display_order},
							success: function(data){

								if(data){
									$('.request_loader').hide();
									notification('Success','Plan added Successfully','top-right','success',2000);
									setTimeout(function(){window.location.href = base_url+'/listplans'; }, 2500);
									
								}
							},
							error: function( jqXhr, textStatus, errorThrown ){
								$('.request_loader').css('display','none');
								if( jqXhr.status !== 422 ) {
									notification('Error',errorThrown,'top-right','error',3000);
								}
								if( jqXhr.status === 422 ) {
									
									$('.errors').html('');
									//notification('Error','Please fill all the fields.','top-right','error',4000);
									var errors = $.parseJSON(jqXhr.responseText);
									$.each(errors, function (key, value) {
										if($.isPlainObject(value)) {
											$.each(value, function (key, value) {                       
												var key = key.replace('.','_');
												$('.'+key+'_error').show().append(value);
											});
										}else{
										
										}
									}); 
								  } 
							}
						});  
					},
					error: function( jqXhr, textStatus, errorThrown ){
						$('.request_loader').css('display','none');
						
						if( jqXhr.status !== 422 ) {
							notification('Error',errorThrown,'top-right','error',3000);
						}
						if( jqXhr.status === 422 ) {
							
							$('.errors').html('');
							//notification('Error','Please fill all the fields.','top-right','error',4000);
							var errors = $.parseJSON(jqXhr.responseText);
							$.each(errors, function (key, value) {
								if($.isPlainObject(value)) {
									$.each(value, function (key, value) {                       
										var key = key.replace('.','_');
										$('.'+key+'_error').show().append(value);
									});
								}else{
								
								}
							}); 
						  } 
					}
				});
			},
			error: function( jqXhr, textStatus, errorThrown ){
				$('.request_loader').css('display','none');
				 if( jqXhr.status !== 422 ) {
							notification('Error',errorThrown,'top-right','error',3000);
					}
					if( jqXhr.status === 422 ) {
						
						$('.errors').html('');
						//notification('Error','Please fill all the fields.','top-right','error',4000);
						var errors = $.parseJSON(jqXhr.responseText);
						$.each(errors, function (key, value) {
							if($.isPlainObject(value)) {
								$.each(value, function (key, value) {                       
									var key = key.replace('.','_');
									$('.'+key+'_error').show().append(value);
								});
							}else{
							
							}
						}); 
					  } 
			}
		});
	}else{
		var planID = "";
		$.ajax({
			url: base_url+'/plan-create',
			dataType: 'json',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {_token:csrf_token,plan_id:planID,title:planname,description:plandesc,arabic_title:arabic_planname,arabic_description:arabic_plandesc,price:planfee,num_of_users:num_of_users,mem_length:membership_length,status:status,display_order:display_order},
			success: function(data){
				$('.request_loader').hide();
			if(data){
				notification('Success','Plan added Successfully','top-right','success',2000);
				setTimeout(function(){window.location.href = base_url+'/listplans'; }, 2500);
				}
			},
			error: function( jqXhr, textStatus, errorThrown ){
				$('.request_loader').css('display','none');
				 if( jqXhr.status !== 422 ) {
					notification('Error',errorThrown,'top-right','error',3000);
				}
				
				if( jqXhr.status === 422 ) {
					
					$('.errors').html('');
					//notification('Error','Please fill all the fields.','top-right','error',4000);
					var errors = $.parseJSON(jqXhr.responseText);
					
					$.each(errors, function (key, value) {
						if($.isPlainObject(value)) {
							$.each(value, function (key, value) { 
								console.log(value);	
								var key = key.replace('.','_');
								$('.'+key+'_error').show().append(value);
							});
						}else{
						
						}
					}); 
				  } 
			}
		});  
			
		
	}
}); */
</script>
@stop

    @stop
