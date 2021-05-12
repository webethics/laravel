<tr data-blog-id="{{ $blog->id }}" class="user_row_{{$blog->id}}" >		
	<td id="sno_{{$blog->id}}"><span>{{(($page_number-1) * 10)+$sno}} </span>
		<input type="hidden" name="page_number" value="{{$page_number}}" id="page_number_{{$blog->id}}"/>
		<input type="hidden" name="sno" value="{{$sno}}" id="s_number_{{$blog->id}}"/>
	</td>
	<td id="title_{{$blog->id}}">
		@if(check_role_access('blog_edit')) 
			<a class="action editblog action_title" href="{{'/admin/blog/edit/'}}{{$blog->id}}" data-blogId="{{ $blog->id }}" title="{{$blog->title}}">{{$blog->title}} </a> 
		@else
			{{$blog->title}}
		@endif
	</td>
	
	<td id="status_{{$blog->id}}">
		@php  $selected=''; @endphp
		@if($blog->status==1)
		@php	$selected = 'checked=checked'@endphp
		@endif	
		<div class="custom-switch  custom-switch-primary custom-switch-small">
			<input class="custom-switch-input switch_status" id="switch{{ $blog->id }}" type="checkbox" data-blog_id="{{ $blog->id }}" {{$selected}}>
			   <label class="custom-switch-btn" for="switch{{ $blog->id }}"></label>

		  </div>
	</td>
	<td id="action_{{$blog->id}}">
		
		@if(check_role_access('blog_edit'))
			<a class="action editBlog" href="{{'/admin/blog/edit/'}}{{$blog->id}}" data-blog_id="{{ $blog->id }}" title="Edit Blog"><i class="simple-icon-note"></i> </a>
		@endif
		
		@if(check_role_access('blog_delete'))
			<a title="Delete Auction"  data-id="{{ $blog->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the blog?"  data-left_button_name ="Yes" data-left_button_id ="delete_blog" data-left_button_cls="btn-primary" class="open_confirmBox action deleteblog"  href="javascript:void(0)" data-blog_id="{{ $blog->id }}"><i class="simple-icon-trash"></i></a>
		@endif	
		
	</td>	
</tr>