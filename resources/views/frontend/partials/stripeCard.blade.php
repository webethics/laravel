{{-- Add Card Model --}}
<div class="modal fade popupdiv popup_table" id="stripeCardModal" class="stripeCardModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		   <div class="modal-header">
		      <h4 class="modal-title">{{trans('common.add')}} {{trans('common.card')}}</h4>
		      <button type="button" class="close" data-dismiss="modal">&times;</button>
		   </div>
		   <div class="modal-body form_div">
			    <form action="{{url('update-plan')}}" method="post" id="payment-form" class="save_card_form">
			    	@csrf
				   	<div class="form-row d-block">
				      <span class="invalid-feedback error card-server-error"></span>
				      <div class="form-group creditcard stripecard">
				          <div id="card-element">
				            <!-- A Stripe Element will be inserted here. -->
				          </div>
				      </div>

				      <!-- Used to display form errors. -->
				      <div id="card-errors" class="invalid-feedback error" role="alert"></div>
					  
				   	</div>
					 <input type="hidden" name="price" id="price" value="{{$plans->price}}">
				    <input type="hidden" name="stripe_plan_id" id="stripe_plan_id" value="{{$plans->stripe_plan_id}}">
				    <input type="hidden" name="plan_type" id="plan_type" value="{{$plans->mem_length}}">
				    <input type="hidden" name="CreateTime" id="CreateTime" value="{{date('Y-m-d H:i:s')}}">
				    <input type="hidden" name="plan" id="plan" value="{{$plans->id}}">
				   <div class="creditcard_bottom">
				      <p class="tag-line d-flex align-items-center justify-content-center"><img src="{!! asset('frontend/images/lock_icon.png') !!}" class="lockicon mr-2">This form is secure and encrypted</p>
					  <p><img class="mt-3 mx-auto d-block" src="{!! asset('frontend/images/poweredbystripe.png') !!}"></p>
				   </div>
				   <input type="hidden" name="path" id="path" value="{{$hidden_path ?? ''}}">
				   <div class="submitbtn text-center confirmbtn">
				      <button type="submit" class="save-stor-card btn btn-primary t-2" value="Submit">Add Card
					  <div class="spinner-border ml-3 stripe-spinner" role="status" style="display:none;">
					  	<span class="sr-only">Loading...</span>
						</div>   
					  </button>    
				   </div>
				</form>
		   </div>
		</div>
	</div>
</div>
{{-- Add Card Model End--}}