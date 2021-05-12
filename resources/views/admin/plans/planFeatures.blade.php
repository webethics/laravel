@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Plan Features')
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
       /*  CKEDITOR.replace( 'description',{
    allowedContent: true
} ); */
</script>
@stop
<div class="row">
<div class="col-12">
	<h1>Features for {{ $plan->title }}</h1>
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
					       
							
								
								@if($plan->features)
									<div class ="user_profile" style="margin-bottom:30px">
										<h2>Features</h2>
									</div>
									<ul>
									@foreach($plan->features as $feature)
										<li class="user_row_{{$feature->id}}"><span id="eng_plan_text_{{$feature->id}}">{{$feature->feature_text}}</span> <a title="Edit Feature"  data-id="{{ $feature->id }}"  class=" action " id="feature_edit" href="javascript:void(0)" data-role_id="{{ $feature->id }}"><i class="simple-icon-pencil"></i></a> <a title="Delete Feature"  data-id="{{ $feature->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the feature?"  data-left_button_name ="Yes" data-left_button_id ="delete_feature" data-left_button_cls="btn-primary" class="open_confirmBox action deleteFeature"  href="javascript:void(0)" data-role_id="{{ $feature->id }}"><i class="simple-icon-trash"></i></a></li>
									@endforeach
									</ul>
								@endif
								
								@if($plan->features)
									<div class ="user_profile" style="margin-bottom:30px">
										<h2>Arabic Features</h2>
									</div>
									<ul>
									@foreach($plan->features as $feature)
										<li class="user_row_{{$feature->id}}"><span id="arabic_plan_text_{{$feature->id}}">{{$feature->arabic_feature_text}}</span> <a title="Edit Feature"  data-id="{{ $feature->id }}"  class=" action" id="arabic_feature_edit"  href="javascript:void(0)" data-role_id="{{ $feature->id }}"><i class="simple-icon-pencil"></i></a> <a title="Delete Feature"  data-id="{{ $feature->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the feature?"  data-left_button_name ="Yes" data-left_button_id ="delete_feature" data-left_button_cls="btn-primary" class="open_confirmBox action deleteFeature"  href="javascript:void(0)" data-role_id="{{ $feature->id }}"><i class="simple-icon-trash"></i></a></li>
									@endforeach
									</ul>
								@endif
								
								<div class ="user_profile" style="margin-bottom:30px">
										<h2>Add New Feature</h2>
									</div>
							{{ Form::open(array('url' => 'admin/add-feature', 'method' => 'post','class'=>'profile form-horizontal','files'=>'true')) }}


							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Plan Feature') }}
											{{ Form::text('feature_text',$plan->feature_text,array('class'=>'form-control','id'=>'feature_text','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('feature_text')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Arabic Plan Feature') }}
											{{ Form::text('arabic_feature_text',$plan->arabic_feature_text,array('class'=>'form-control','id'=>'arabic_feature_text','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_feature_text')  }} </span>
										</div>
										<div class="clearfix"></div>
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input type="hidden" value="" name="feature_id" id="feature_id" >
									<input type="hidden" value="{{$plan->id}}" name="plan_id" id="plan_id" >
									 <input name="login" class="loginmodal-submit btn btn-primary" id="" value="Submit" type="submit">
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

	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
@section('userJs')

<script src="{{ asset('js/module/plan.js')}}"></script>	
<script type="text/javascript">
$('#feature_edit,#arabic_feature_edit').click(function() {
	
	var feature_id =  $(this).data('id');
	$('#feature_text').val($('#eng_plan_text_'+feature_id).html());
	$('#arabic_feature_text').val($('#arabic_plan_text_'+feature_id).html());
	$('#feature_id').val(feature_id);
});

</script>
@stop

  
    @stop
