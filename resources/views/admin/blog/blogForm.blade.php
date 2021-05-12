@extends('admin.layouts.admin')
@section('additionalCss')
	<style type="text/css">
		.bootstrap-datetimepicker-widget{z-index:9999;}
	</style>
	<link rel="stylesheet" href="{{ asset('frontend/multiselect/bootstrap-multiselect.min.css')}}" type="text/css">
@stop
@section('content')
	@section('ckeditor')
	<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
	<script>
	        CKEDITOR.replace( 'content',{
	    allowedContent: true
	} );
	</script>
	@stop
{{-- Check if New Blog or Edit Blog, if $newBlog set 1 then new Blog else Edit Blog --}}
@php
	$newBlog = 1;
	$blogTitle = 'Add';
	$action = 'Add'
@endphp
@if(isset($blog))
	@php
		$newBlog = 2;
		$blogTitle = 'Edit';
		$action = 'Update'
	@endphp
@endif


@section('headtitle')
| {{$blogTitle}} Blog
@endsection
@section('pageTitle', $blogTitle.'  Blogs')


	<div class="row">
		<div class="col-12">
			<h1>{{$blogTitle}} Blog</h1>
			<div class="separator mb-5"></div>
		</div>
	</div>
   <!-- Main content -->
	<div class="card">
		<div class="card-body">
			<div id="tag_container">
				<div class="col-lg-12">
					<div class="box box-primary">
						<div class="box-body">
							@include('flash-message')	

								@if($newBlog == 2)
									@if($errors->first('blog_id'))
										<span class="error"> {{ $errors->first('blog_id')  }} </span>
									@endif
								@endif	
					        
					        	@if($newBlog == 1)
									{{ Form::open(array('url' => 'admin/blog/create', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
								@else
									{{ Form::open(array('url' => 'admin/blog/update/', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
								@endif


								<div class="form-group col-md-12">
									<div class="row">
										<div class="col-md-8 row col-xs-12">
											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('title') }}
												@if($newBlog == 1)
													{{ Form::text('title',old('title'),array('class'=>'form-control','placeholder'=>'Title')) }}
												@else
													{{ Form::text('title',old('title', $blog->title),array('class'=>'form-control','placeholder'=>'Title')) }}
												@endif
													<span class="error"> {{ $errors->first('title')  }} </span>
											</div>

											<div class="clearfix"></div>
											
											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Select Category') }}
												@php $getAllCategory = getAllCategory() @endphp 
												@if($newBlog == 1)
													<select class="form-control input-sm" name="auction_cat[]" id="pro_category" multiple="multiple">
										                @foreach($getAllCategory as $category1)
															<option value="{{ $category1->id ?? ''}}" {{ old('auction_cat') == $category1->id ? 'selected' : '' }}>{{ $category1->name ?? ''}}</option>
										                @endforeach
										            </select>
												@else
													<select class="form-control input-sm" name="auction_cat[]" id="pro_category" multiple="multiple" >
														@foreach($getAllCategory as $category1)
														@php
															$blogIdArr = explode(", ", $blog->auction_cat );
														@endphp
										               <option value="{{ $category1->id ?? ''}}" {{  in_array($category1->id, $blogIdArr) ? 'selected' : '' }}>{{ $category1->name ?? ''}}</option>
										                @endforeach
										            </select>
												@endif
													<span class="error"> {{ $errors->first('a_category_id')  }} </span>
											</div>


											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Image') }}

												<div class="clearfix"></div>
												<input id="fileupload" class="inputfile" type="file" name="image">
												<label class="mt-2 mb-3" for="fileupload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>

												@if($newBlog == 2)
													@if($blog->image != NULL)
													
														<div class="inputfile-preview old-file">
															<img src="{{$blog->image_url}}" class="blog_image blog_new_image">
															<a href="{{url('/admin/blog/image_downlad')}}/{{$blog->id}}" class="filedownlad filedownlad-blog">
																<i class="glyph-icon simple-icon-cloud-download"></i>
															</a>

															<a title="Delete Media"  data-id="{{ $blog->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Image?"  data-left_button_name ="Yes" data-left_button_id ="delete_blog_image" data-left_button_cls="btn-primary" class="open_confirmBox action deletecImageategory"  href="javascript:void(0)" data-blog_id="{{ $blog->id }}">
																<i class="glyph-icon simple-icon-trash"></i>
															</a>
														</div>
													@endif
												@endif
												<div class="inputfile-preview new-file d-none">
													<img src="" class="blog_image">
													<i class="glyph-icon simple-icon-trash new-blog-file-trash"></i>
												</div>
												<input type="hidden" name="feature_image" id="feature_image" value="{{old('feature_image')}}" />
												<span class="error upload_feature_file_error"> </span> 
												<span class="error"> {{ $errors->first('image')  }} </span> 
											</div>

											<div class="clearfix"></div>
											
											
											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Content') }}
												@if($newBlog == 1)
													{{ Form::textarea('content',old('content'),array('class'=>'form-control','placeholder'=>'Short Description','rows' => 3)) }}
												@else
													{{ Form::textarea('content',old('content', $blog->content),array('class'=>'form-control','placeholder'=>'Content','rows' => 3)) }}
												@endif
													<span class="error"> {{ $errors->first('content')  }} </span>
											</div>
											
											

										</div>

									</div>
								</div>


								<div class="form-group col-md-12">
									 <div class="sign-up-btn ">
									 	@if($newBlog == 2)
											<input type="hidden" value="{{$blog->id}}" name="blog_id" id="blog_id" >
										@endif
										<input type="hidden" value="{{auth::user()->id}}" name="user_id" id="user_id">
										 <input name="submit" class="loginmodal-submit btn btn-primary" id="auction_update" value="{{$action}}" type="submit">
										 <a href="{{url('admin/blogs')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
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
 @stop

@section('additionJs')
	<script src="{{ asset('js/module/blogs.js')}}"></script>
	<script src="{{ asset('frontend/multiselect/bootstrap-multiselect.min.js')}}"></script>
	<script>
	 $(document).ready(function() {
		$('#pro_category').multiselect({
			enableHTML: true
		});
	});
	</script>
@stop

