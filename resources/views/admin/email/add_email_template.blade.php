@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Edit Email Template')
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'description',{
    allowedContent: true
} );
</script>
@stop
<div class="row">
<div class="col-12">
	<h1>Email Template</h1>
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
						  
						@if(Session::has('success'))
							<div class="success success-info">
								<a class="close" data-dismiss="alert">×</a>
								{!!Session::get('success')!!}
							</div>
						@elseif(Session::has('error'))
							<div class="alert alert-info">
								<a class="close" data-dismiss="alert">×</a>
								{!!Session::get('error')!!}
							</div>
						@endif
							<div class ="user_profile" style="margin-bottom:30px">
								<h2 >Add New Email Template</h2>
							</div>
							{{ Form::open(array('url' => 'admin/emails/save', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Title') }}
											{{ Form::text('title', '' ,array('id'=>'title','class'=>'form-control','placeholder'=>'Email Title')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>

										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Subject') }}
											{{ Form::text('subject', '' ,array('id'=>'subject','class'=>'form-control','placeholder'=>'Email Subject')) }}
											<span class="error"> {{ $errors->first('subject')  }} </span>
										</div>

										
										<div class="clearfix"></div>

										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Description') }}
											{{ Form::textarea('description',$result->content,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('description') }} </span>
										</div>


									</div>

								</div>
							</div>

							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									 <input name="login" class="loginmodal-submit btn btn-primary" id="profile_update" value="Submit" type="submit">
									 <a href="{{url('admin/email')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
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
