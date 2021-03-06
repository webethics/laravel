@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Create Subcategory')
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
	<h1>New Subcategory For {{$category}}</h1>
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
					       

							{{ Form::open(array('url' => 'admin/create-subcategory-new', 'method' => 'post','class'=>'profile form-horizontal')) }}


							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('Sub Category Name') }}
										{{ Form::text('name','',array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('name')  }} </span>
										</div>
										<div class="clearfix"></div>
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input type="hidden" value="{{$category}}" name="category" id="category" >
									 <input name="login" class="loginmodal-submit btn btn-primary" id="profile_update" value="Submit" type="submit">
									 <a href="{{url('admin/dashboard')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
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
