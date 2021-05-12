@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Add Page')
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'content',{
    allowedContent: true
} );
  CKEDITOR.replace( 'arabic_content',{
    allowedContent: true
} );
</script>
@stop
<div class="row">
<div class="col-12">
	<h1>CMS Page</h1>
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
					       

							{{ Form::open(array('url' => 'admin/cms-page-new', 'method' => 'post','class'=>'profile form-horizontal')) }}


							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('title','',array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('arabic title') }}
										{{ Form::text('arabic_title','',array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_title')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('English Content') }}
											{{ Form::textarea('content','',array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('content')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Arabic Content') }}
											{{ Form::textarea('arabic_content','',array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_content')  }} </span>
										</div>
										<div class="clearfix"></div>
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input type="hidden" value="" name="email_id" id="email_id" >
									 <input name="login" class="loginmodal-submit btn btn-primary" id="profile_update" value="Submit" type="submit">
									 <a href="{{url('admin/cms-pages')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
								</div>
							</div>
							
								  {{ Form::close() }}
					</div>
				</div>
			</div>
			</div>
			</div>
			</div>

	


  
    @stop
