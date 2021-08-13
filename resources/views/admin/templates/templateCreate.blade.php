@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Create Template')
@section('ckeditor')

@stop
<div class="row">
<div class="col-12">
	<h1>New Template</h1>
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
					       
							
							{{ Form::open(array('url' => 'admin/template-create', 'method' => 'post','class'=>'profile form-horizontal','files'=>'true')) }}
							<div class="row">
								<div class="col-md-12 col-xs-12 field mb-4">
									{{ Form::label('Choose Language') }}
									
									<select  id="langauge"  class="form-control select2-single"  name="langauge"  data-width="100%">
										<option value=" " >Select Langauge</option>
										<option value="1" @if(old("langauge") == 1) {{'selected'}} @endif >English Only</option>
										<option value="2" @if(old("langauge") == 2) {{'selected'}} @endif >English and Arabic</option>
										<option value="3" @if(old("langauge") == 3) {{'selected'}} @endif >Arabic Only</option>
									</select>
									
									<span class="error"> {{ $errors->first('langauge')  }} </span>
								</div>
							</div>			
							<div class="row">
							<div class="form-group col-md-6 text-left" >
								<div class="row" id="english_form">
									<div class="col-md-11 row col-xs-12">
										<h2>English Content</h2>
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('title',old('title'),array('id'=>'title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>
									
									
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Slug') }}
											{{ Form::text('slug',old('slug'),array('id'=>'slug','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('slug')  }} </span>
										</div>
										
										
										<div class="clearfix"></div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Featured Image') }}
											<div class="clearfix"></div>
											{{ Form::file('image',array('class'=>'inputfile english','accept'=>"image/*",'id' => 'fileupload','data-id' => 'featured_image'))}}
											<label class="mt-2 mb-3" for="fileupload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-file d-none">
												<img src="" class="module_image" height="50px" width="50px">
												<!--<i class="glyph-icon simple-icon-trash new-module-file-trash"></i>-->
											</div>
												<span class="error"> {{ $errors->first('image')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Upload PDF(PDF Format Only)') }}
											<div class="clearfix"></div>
											{{ Form::file('pdf_image',array('class'=>'inputfile english','accept'=>'application/pdf','id' => 'fileupload_pdf','data-id' => 'pdf'))}}
											<label class="mt-2 mb-3" for="fileupload_pdf"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-pdf-file d-none"></div>
											<br>
											<span class="error"> {{ $errors->first('pdf_image')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Upload Editable File') }}
											<div class="clearfix"></div>
											{{ Form::file('editable_file',array('class'=>'inputfile english','id' => 'editable_file','data-id' => 'editable'))}}
											<label class="mt-2 mb-3" for="editable_file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-editable-file d-none"></div>
											<span class="error"> {{ $errors->first('editable_file')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Upload Slider Images(Multiple Allowed)') }}
											<div class="clearfix"></div>
											{{ Form::file('preview_images[]',array('class'=>'inputfile english','multiple'=>"multiple",'accept'=>"image/*",'id' => 'preview_images','data-id' => 'multipule_image'))}}
											<label class="mt-2 mb-3" for="preview_images"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											
											<div class="gallery"></div>
											
											<span class="error"> {{ $errors->first('preview_images')  }} </span>
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
											
											<select  id="category"  class="form-control select2-single"  name="category"  data-width="100%">
												<option value=" ">Select Category</option>
												@foreach($categories as $key=>$category)
													<option value="{{$category->id}}" @if(old("category") == $category->id) {{'selected'}} @endif >{{$category->sub_category_name}}</option>
												@endforeach	
											</select>
											{{-- Form::text('category',old('category'),array('id'=>'category','class'=>'form-control','placeholder'=>'')) --}}
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
							<div class="form-group col-md-6 text-right" id="arabic_form" style="display:none">
								<div class="row">
									<div class="col-md-12 row col-xs-12">
									
										<h2 class="text-right col-md-12">Arabic Content</h2>
										
										
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('arabic_title',old('arabic_title'),array('id'=>'arabic_title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_title')  }} </span>
										</div>
										<div class="clearfix"></div>
											
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Slug') }}
											{{ Form::text('arabic_slug',old('arabic_slug'),array('id'=>'arabic_slug','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_slug')  }} </span>
										</div>
										
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Featured Image') }}
											<div class="clearfix"></div>
											{{ Form::file('arabic_image',array('class'=>'inputfile arabic','accept'=>"image/*",'id' => 'arabic_fileupload','data-id' => 'arabic_featured_image'))}}
											<label class="mt-2 mb-3" for="arabic_fileupload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-file-arabic d-none">
												<img src="" class="module_image_arabic" height="50px" width="50px">
												<!--<i class="glyph-icon simple-icon-trash new-module-file-trash"></i>-->
											</div>
												<span class="error"> {{ $errors->first('arabic_image')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Upload PDF(PDF Format Only)') }}
											<div class="clearfix"></div>
											{{ Form::file('arabic_pdf_image',array('class'=>'inputfile arabic','accept'=>'application/pdf','id' => 'arabic_fileupload_pdf','data-id' => 'arabic_pdf'))}}
											<label class="mt-2 mb-3" for="arabic_fileupload_pdf"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-pdf-arabic-file d-none"></div>
											<br>
											<span class="error"> {{ $errors->first('arabic_pdf_image')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Upload Editable File') }}
											<div class="clearfix"></div>
											{{ Form::file('arabic_editable_file',array('class'=>'inputfile arabic','id' => 'arabic_editable_file','data-id' => 'arabic_editable'))}}
											<label class="mt-2 mb-3" for="arabic_editable_file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-editable-arabic-file d-none"></div>
											<span class="error"> {{ $errors->first('arabic_editable_file')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Upload Slider Images(Multiple Allowed)') }}
											<div class="clearfix"></div>
											{{ Form::file('arabic_preview_images[]',array('class'=>'inputfile arabic','multiple'=>"multiple",'accept'=>"image/*",'id' => 'arabic_preview_images','data-id' => 'multipule_image'))}}
											<label class="mt-2 mb-3" for="arabic_preview_images"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											
											<div class="gallery"></div>
											
											<span class="error"> {{ $errors->first('arabic_preview_images')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										
										
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Is Featured') }}
											
											<select  id="arabic_is_featured"  class="form-control select2-single"  name="arabic_is_featured"  data-width="100%">
												<option value=" ">Select Is Featured</option>
													<option value="1" @if(old("arabic_is_featured") == 1) {{'selected'}} @endif >Yes</option>
													<option value="0" @if(old("arabic_is_featured") == 0) {{'selected'}} @endif >No</option>
											</select>
											
											<span class="error"> {{ $errors->first('arabic_is_featured')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Is Content Protected') }}
											
											<select  id="arabic_is_protected"  class="form-control select2-single"  name="arabic_is_protected"  data-width="100%">
												<option value=" ">Select Is Protected</option>
													<option value="1" @if(old("arabic_is_protected") == 1) {{'selected'}} @endif >Yes</option>
													<option value="0" @if(old("arabic_is_protected") == 0) {{'selected'}} @endif >No</option>
											</select>
											
											<span class="error"> {{ $errors->first('arabic_is_protected')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Status') }}
											
											<select  id="arabic_status"  class="form-control select2-single"  name="arabic_status"  data-width="100%">
												<option value=" ">Select Status</option>
													<option value="1" @if(old("arabic_status") == 1) {{'selected'}} @endif >Published</option>
													<option value="0" @if(old("arabic_status") == 0) {{'selected'}} @endif >Draft</option>
											</select>
											
											<span class="error"> {{ $errors->first('arabic_status')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Category') }}
											
											<select  id="arabic_category"  class="form-control select2-single"  name="arabic_category"  data-width="100%">
												<option value=" ">Select Category</option>
												@foreach($categories as $key=>$category)
													<option value="{{$category->id}}" @if(old("category") == $category->id) {{'selected'}} @endif >{{$category->sub_category_name}}</option>
												@endforeach	
											</select>
											{{-- Form::text('arabic_category',old('category'),array('id'=>'arabic_category','class'=>'form-control','placeholder'=>'')) --}}
											<span class="error"> {{ $errors->first('category')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Author') }}
											{{ Form::text('arabic_author',old('arabic_author'),array('id'=>'arabic_author','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_author')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Meta Title') }}
											{{ Form::text('arabic_meta_title',old('arabic_meta_title'),array('id'=>'arabic_meta_title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('arabic_meta_title')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Meta Description') }}
											{{ Form::textarea('arabic_meta_description',old('arabic_meta_description'),array('id'=>'arabic_meta_description','class'=>'form-control','placeholder'=>'','rows'=>5)) }}
											<span class="error"> {{ $errors->first('arabic_meta_description')  }} </span>
										</div>
										<div class="clearfix arabic"></div>
											
										
									</div>

								</div>
							</div>
							</div>
							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input name="login" class="loginmodal-submit btn btn-primary" id="" value="Update" type="submit">
									 <a href="{{url('admin/listtemplates')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
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

<script src="{{ asset('js/module/templates.js')}}"></script>	
@stop
	


  
    @stop
