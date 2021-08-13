@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Create Article')
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
	<h1>New Article</h1>
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
					       
							
							{{ Form::open(array('url' => 'admin/article-create', 'method' => 'post','class'=>'profile form-horizontal' ,'files'=>'true')) }}


							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('title',old('title'),array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Slug') }}
											{{ Form::text('slug',old('slug'),array('id'=>'slug','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('slug')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Description') }}
											{{ Form::textarea('description',old('description'),array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('description')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Excerpt') }}
											{{ Form::textarea('excerpt',old('excerpt'),array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('excerpt')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Featured Image') }}
											{{ Form::file('image')}}
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Is Featured') }}
											
											<select  id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
												<option value=" ">Select Is Featured</option>
													<option value="1" @if(old("is_featured") == 1) {{'selected'}} @endif >Yes</option>
													<option value="0" @if(old("is_featured") == 0) {{'selected'}} @endif >No</option>
											</select>
											
											<span class="error"> {{ $errors->first('is_featured')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Is Content Protected') }}
											
											<select  id="is_protected"  class="form-control select2-single"  name="is_protected"  data-width="100%">
												<option value=" ">Select Is Protected</option>
													<option value="1" @if(old("is_protected") == 1) {{'selected'}} @endif >Yes</option>
													<option value="0" @if(old("is_protected") == 0) {{'selected'}} @endif >No</option>
											</select>
											
											<span class="error"> {{ $errors->first('is_protected')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Status') }}
											
											<select  id="status"  class="form-control select2-single"  name="status"  data-width="100%">
												<option value=" ">Select Status</option>
													<option value="1" @if(old("status") == 1) {{'selected'}} @endif >Published</option>
													<option value="0" @if(old("status") == 0) {{'selected'}} @endif >Draft</option>
											</select>
											
											<span class="error"> {{ $errors->first('status')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Category') }}
											{{ Form::text('category',old('category'),array('id'=>'category','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('category')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Author') }}
											{{ Form::text('author',old('author'),array('id'=>'author','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('author')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Meta Title') }}
											{{ Form::text('meta_title',old('meta_title'),array('id'=>'meta_title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('meta_title')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Meta Description') }}
											{{ Form::textarea('meta_description',old('meta_description'),array('id'=>'meta_description','class'=>'form-control','placeholder'=>'','rows'=>5)) }}
											<span class="error"> {{ $errors->first('meta_description')  }} </span>
										</div>
										<div class="clearfix"></div>
											
										
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input name="login" class="loginmodal-submit btn btn-primary" id="" value="Submit" type="submit">
									 <a href="{{url('admin/listarticles')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
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

<script src="{{ asset('js/module/article.js')}}"></script>	
@stop

    @stop
