@extends('admin.layouts.admin')
@section('headtitle')
| Auction
@endsection
@section('additionalCss')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
	.ui-draggable, .ui-droppable {
		background-position: top;
	}
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
@stop
@section('content')
@section('pageTitle', 'Blogs')
	<div class="row">
		<div class="col-12">
			<h1>Blogs</h1>
			@if(check_role_access('blog_create'))
				<span class="fl_right balance">
					<a id="create_blog" class="btn btn-primary" href="{{'/admin/blog/create'}}">Create Blog</a>
				</span>
			@endif
			@if(check_role_access('blog_categories_listing'))
				<span class="fl_right balance" style="margin-right:10px;">
					<a id="listing__blog_categories" class="btn btn-primary" href="{{'/admin/blog-categories'}}"> Categories</a>
				</span>
			@endif
			
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
		
			@include('admin.partials.searchBlogForm')
							
			<div class="card">
				<div class="card-body">
				<div class="table-responsive blogs_full"  id="tag_container">
					 @include('admin.blog.blogPagination')
				</div>
				</div>
			</div>

		</div>
	</div>
	<div class="modal fade modal-right blogEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-right blogViewModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-right blogCreateModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
@stop

@section('additionJs')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/module/blogs.js')}}"></script>	
@stop