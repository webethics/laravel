@extends('frontend.layouts.master')
@section('headtitle')
| {{$blog->title}}
@endsection
@section('content')
	@include('frontend.common.header')
    
	
	
<section Class="about-container terms-container">
	<div class="container">
	   <div class="row">
		<div class="abt-cont1 mt-0 mt-md-5 mb-4">
			 @php 
			  $image =  url('uploads/blog/').'/'.$blog->id.'/'.$blog->image
			 @endphp
				<div class="innerbanner_sec" style="background: url({{$image}})"> </div>
        		<div class="abt-cont1 mt-5 mb-4">
					<h1 class="mb-4">{!! $blog->title !!}  </h1>
					{!! $blog->content !!}
				</div>
		</div>
		<div class="blog_nav">
		@if($previous)
			 <a href="{{ url('blog')}}/{{$previous->slug  }}" class="previous">&laquo; Previous</a> 
		@endif
		
		@if($next)
	   	<a href="{{ url('blog')}}/{{$next->slug  }}"class="next">Next &raquo;</a> 
		@endif
		</div>
	</div>
	</div>
</section>
<style>
a.previous,a.next {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a.previous:hover ,a.next:hover{
  background-color: #F6B21B;
  color: black;
}

.previous {
  background-color: #f1f1f1;
  color: black;
  margin : 0px 10px 10px 0px;
}

.next {
  background-color: #F6B21B;
  color: white;
  margin : 0px 0px 10px 10px

}
.blog_nav {
    padding: 0px 0px 30px;
}

</style>
@include('frontend.common.footer')
@stop