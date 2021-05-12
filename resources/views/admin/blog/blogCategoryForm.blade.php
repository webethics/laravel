@extends('admin.layouts.admin')
@section('additionalCss')
	<style type="text/css">
		.bootstrap-datetimepicker-widget{z-index:9999;}
	</style>
@stop
@section('content')

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
| {{$blogTitle}} Blog Category
@endsection


	<div class="row">
		<div class="col-12">
			<h1>{{$blogTitle}} Blog Category</h1>
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
									{{ Form::open(array('url' => 'admin/blog-categories/save', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
								@else
									{{ Form::open(array('url' => 'admin/blog-categories/update/', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
								@endif


								<div class="form-group col-md-12">
									<div class="row">
										<div class="col-md-8 row col-xs-12">
											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('title') }}
												@if($newBlog == 1)
													{{ Form::text('title',old('title'),array('class'=>'form-control','placeholder'=>'Title')) }}
												@else
													{{ Form::text('title',old('title', $blog->name),array('class'=>'form-control','placeholder'=>'Title')) }}
												@endif
													<span class="error"> {{ $errors->first('title')  }} </span>
											</div>

											<div class="clearfix"></div>
											
											
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
@stop
 
