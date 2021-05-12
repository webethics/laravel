<table class="table table-hover mb-0">
	<thead class="bg-primary">
		<tr>
		<th scope="col">Sort ID</th>
		<th scope="col">Title</th>
		<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody id="sortable">
	 @if(is_object($blogs) && !empty($blogs) && $blogs->count())
		 @php $sno = 1;$sno_new = 0  @endphp
		
	  @foreach($blogs as $key => $blog)
		@include('admin.blog.blogCategorySingleRow')
		@php $sno++ @endphp
	 @endforeach
 @else
<tr><td colspan="7" class="error" style="text-align:center">No Data Found.</td></tr>
 @endif	
		
	</tbody>
</table> 
