@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Edit Plan')
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'description',{
    allowedContent: true
} );   CKEDITOR.replace( 'arabic_description',{
    allowedContent: true
} );
</script>
@stop
<div class="row">
<div class="col-12">
	<h1>Edit Plan</h1>
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
					       
							<div class ="user_profile" style="margin-bottom:30px">
								<h2 >{{ $plan->title }}</h2>
							</div>

							{{ Form::open(array('url' => 'admin/plan-update', 'method' => 'post','class'=>'profile form-horizontal','files'=>'true')) }}


							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('title',$plan->title,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('Arabic Title') }}
										{{ Form::text('arabic_title',$plan->arabic_title,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_title')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Description') }}
											{{ Form::textarea('description',$plan->description,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('description')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Arabic Description') }}
											{{ Form::textarea('arabic_description',$plan->arabic_description,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_description')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Price') }}
											{{ Form::text('price',$plan->price,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('price')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Number Of users') }}
											{{ Form::text('number_of_users',$plan->num_of_users,array('id'=>'num_of_users','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('number_of_users')  }} </span>
										</div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Membership Length') }}
											
											<select  id="membership_length"  class="form-control select2-single"  name="membership_length"  data-width="100%">
													<option value=" ">Select Membership Length</option>
													<option value="0" @if($plan->mem_length   == '0') {{'selected'}} @endif >Monthly</option>
													<option value="1" @if($plan->mem_length == 1) {{'selected'}} @endif >Yearly</option>
													<option value="2" @if($plan->mem_length == 2) {{'selected'}} @endif >Lifetime</option>
											</select>
											
											<span class="error membership_length_error"> {{ $errors->first('membership_length')  }} </span>
										</div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Status') }}
											
											<select  id="status"  class="form-control select2-single"  name="status"  data-width="100%">
												<option value=" ">Select Status</option>
													<option value="0" @if($plan->status && $plan->status == '0') {{'selected'}} @endif >In-Active</option>
													<option value="1" @if($plan->status == 1) {{'selected'}} @endif >Active</option>
											</select>
											
											<span class="error"> {{ $errors->first('status')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Display Order') }}
											
											<select  id="display_order"  class="form-control select2-single"  name="display_order"  data-width="100%">
												<option value=" ">Select Display Order</option>
												<option value="1" @if($plan->display_order && $plan->display_order == 1) {{'selected'}} @endif >Standard</option>
												<option value="2" @if($plan->display_order == 2) {{'selected'}} @endif >Business</option>
												<option value="3" @if($plan->display_order == 3) {{'selected'}} @endif >Executive</option>
											</select>
											
											<span class="error display_order_error"> {{ $errors->first('display_order')  }} </span>
										</div>
										
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input type="hidden" value="{{$plan->plan_id}}" name="paypal_plan_id" id="paypal_plan_id" >
									<input type="hidden" value="{{$plan->id}}" name="plan_id" id="plan_id" >
									 <input name="login" class="loginmodal-submit btn btn-primary" id="" value="Update" type="submit">
									 <a href="{{url('admin/listplans')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
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

<script src="{{ asset('js/module/plan.js')}}"></script>	
@stop

  
    @stop
