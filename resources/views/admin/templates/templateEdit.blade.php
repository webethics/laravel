@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Edit Template')
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
	<h1>Edit Template</h1>
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
								<h2 >{{ $template->title }}</h2>
							</div>

							{{ Form::open(array('url' => 'admin/template-update', 'method' => 'post','class'=>'profile form-horizontal','files'=>'true')) }}


							<div class="form-group col-md-12">
								<div class="row" id="english_form">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('title',$template->title,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Slug') }}
											{{ Form::text('slug',$template->slug,array('id'=>'slug','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('slug')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										<div class="col-md-4 col-xs-12 field mb-4">
											{{ Form::label('Featured Image') }}
											<div class="clearfix"></div>
											{{ Form::file('image',array('class'=>'inputfile english','id' => 'fileupload','accept'=>'image/*','data-id' => 'featured_image'))}}
											<label class="mt-2 mb-3" for="fileupload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-file d-none">
												<img src="" class="module_image" height="50px" width="50px">
												<!--<i class="glyph-icon simple-icon-trash new-module-file-trash"></i>-->
											</div>
										</div>
										<div class="col-md-8 col-xs-12 field mb-4">
											@php
												$photo = asset('/uploads/templates/').'/'.$template->featured_image;
											@endphp
											<img src="{{timthumb($photo,60,60)}}" />
										</div>
										
										
										
										
										<div class="clearfix"></div>
										<div class="col-md-4 col-xs-12 field mb-4">
											{{ Form::label('Upload PDF(PDF Format Only)') }}
											<div class="clearfix"></div>
											{{ Form::file('pdf_image',array('class'=>'inputfile english','id' => 'fileupload_pdf','accept'=>'application/pdf','data-id' => 'pdf'))}}
											<label class="mt-2 mb-3" for="fileupload_pdf"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="new-pdf-file"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span id="pdf_file_name">{{$template->files}}</span></div>
										
											<span class="error"> {{ $errors->first('pdf_image')  }} </span>
										</div>
										{{--@if($template->featured_image)--}}
										<div class="col-md-8 col-xs-12 field mb-4">
											@php
												$photo = url('/uploads/templates/').'/'.$template->files;
											@endphp
											<a href="<?php echo $photo; ?>" download ><i style="font-size:28px" class="simple-icon-cloud-download"></i></a>
										</div>
										
										{{--@endif--}}
										<div class="clearfix"></div>
										
										<div class="col-md-4 col-xs-12 field mb-4">
											{{ Form::label('Upload Editable File') }}
											<div class="clearfix"></div>
											{{ Form::file('editable_file',array('class'=>'inputfile english','id' => 'editable_file','data-id' => 'editable'))}}
											<label class="mt-2 mb-3" for="editable_file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											
												<div class="new-editable-file"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span id="pdf_file_name">{{$template->editableFile}}</span></div>
											
											
											<span class="error"> {{ $errors->first('editable_file')  }} </span>
										</div>
										<div class="col-md-8 col-xs-12 field mb-4">
											@php
												$file = url('/uploads/templates/editable/').'/'.$template->editableFile;
											@endphp
											<a href="<?php echo $file; ?>" download ><i style="font-size:28px" class="simple-icon-cloud-download"></i></a>
										</div>
										
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Upload Slider Images') }}
											<div class="clearfix"></div>
											{{ Form::file('preview_images[]',array('class'=>'inputfile english','multiple'=>"multiple",'id' => 'preview_images','accept'=>"image/*",'data-id' => 'multipule_image'))}}
											<label class="mt-2 mb-3" for="preview_images"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
											
											<div class="gallery"></div>
											
											<span class="error"> {{ $errors->first('preview_images')  }} </span>
										</div>
										<div class="col-md-8 col-xs-12 field mb-4">
											@if($template->slideshow)
												@php $slideimages = explode(',',$template->slideshow);@endphp
												@foreach($slideimages as $image)
												@php
													$slide = url('/uploads/templates/slideshow/').'/'.$image;
												@endphp
													<img src="{{timthumb($slide,60,60)}}" />
												@endforeach
											@endif
											
										</div>
										
										
										<div class="clearfix"></div>
										
										
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Is Featured') }}
											
											<select  id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
												<option value=" ">Select Is Featured</option>
													<option value="1" @if($template->is_featured == 1) {{'selected'}} @endif >Yes</option>
													<option value="0" @if($template->is_featured == 0) {{'selected'}} @endif >No</option>
											</select>
											
											<span class="error"> {{ $errors->first('is_featured')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Is Content Protected') }}
											
											<select  id="is_protected"  class="form-control select2-single"  name="is_protected"  data-width="100%">
												<option value=" ">Select Is Protected</option>
													<option value="1" @if($template->is_protected == 1) {{'selected'}} @endif >Yes</option>
													<option value="0" @if($template->is_protected == 0) {{'selected'}} @endif >No</option>
											</select>
											
											<span class="error"> {{ $errors->first('is_featured')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Status') }}
											
											<select  id="status"  class="form-control select2-single"  name="status"  data-width="100%">
												<option value=" ">Select Status</option>
													<option value="1" @if($template->status == 1) {{'selected'}} @endif >Published</option>
													<option value="0" @if($template->status == 0) {{'selected'}} @endif >Draft</option>
											</select>
											
											<span class="error"> {{ $errors->first('is_featured')  }} </span>
										</div>
										<div class="clearfix"></div>
										
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('Category') }}
											<select  id="category"  class="form-control select2-single"  name="category"  data-width="100%">
												<option value=" ">Select Category</option>
												@foreach($categories as $key=>$category)
													<option value="{{$category->id}}" @if($template->category == $category->id) {{'selected'}} @endif >{{$category->sub_category_name}}</option>
												@endforeach	
											</select>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Author') }}
											{{ Form::text('author',$template->author,array('id'=>'author','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('author')  }} </span>
										</div>
										
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Meta Title') }}
											{{ Form::text('meta_title',$template->meta_title,array('id'=>'meta_title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('meta_title')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Meta Description') }}
											{{ Form::textarea('meta_description',$template->meta_description,array('id'=>'meta_description','class'=>'form-control','placeholder'=>'','rows'=>5)) }}
											<span class="error"> {{ $errors->first('meta_description')  }} </span>
										</div>
										<div class="clearfix"></div>
											
										
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input type="hidden" value="{{$template->id}}" name="article_id" id="article_id" >
									<input type="hidden" value="{{$lang}}" name="lang" id="lang" >
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
