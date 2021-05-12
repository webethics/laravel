<table class="table table-hover mb-0">
	<thead class="bg-primary">
		<tr>
		<th scope="col">#No.</th>
		<th scope="col">{{ trans('global.title') }}</th>
		<th scope="col">Date Published</th>
		<th scope="col">Date Modified</th>
		<th scope="col">Status</th>
		<th scope="col">Number of Downloads</th>
		<th scope="col">Number of Views</th>
		<th scope="col">Source of Payment</th>
		<th scope="col"># of Times Shared</th>
		<th scope="col">{{ trans('global.actinos') }}</th>								
		</tr>
	</thead>
	<tbody>
	 @if(is_object($listArticles) && !empty($listArticles) && $listArticles->count())
		 @php $sno = 1;$sno_new = 0  @endphp
	 
		 @php $i=1;  @endphp
	  @foreach($listArticles as $key => $article)
		<tr data-user-id="{{ $article->id }}" class="user_row_{{$article->id}}" >
			<td id="sno_{{$article->id}}">{{(($page_number-1) * 10)+$sno}} 
				<input type="hidden" name="page_number" value="{{$page_number}}" id="page_number_{{$article->id}}"/>
				<input type="hidden" name="sno" value="{{$sno}}" id="s_number_{{$article->id}}"/>
			</td>
			<td id="name_{{$article->id}}">{{ $article->title ?? '' }} </td>
			<td id="email_{{$article->id}}"> {{ $article->created_at  ?? '' }}</td>
			
			<td id="email_{{$article->id}}"> {{ $article->created_at  ?? '' }}</td>
			
			<td id="email_{{$article->id}}"> {{ $article->status  == 1 ? 'Published' : 'Draft' }}</td>
			
			<td id="email_{{$article->id}}"> {{ $article->total_dwlnd_pdf  ?? '' }}</td>
			
			<td id="email_{{$article->id}}"> {{ $article->total_viewed  ?? '' }}</td>
			
			<td id="email_{{$article->id}}"> {{ $article->payment  ?? '' }}</td>
			
			<td id="email_{{$article->id}}"> {{ $article->views  ?? '' }}</td>
			
			<td>
				
				<a class="action" href ="{{url('admin/articles/edit')}}/{{$article->id}}" title="Edit"><i class="simple-icon-note"></i></a>
				
				<a title="Delete Article"  data-id="{{ $article->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Article?"  data-left_button_name ="Yes" data-left_button_id ="delete_article" data-left_button_cls="btn-primary" class="open_confirmBox action deleteArticle"  href="javascript:void(0)" data-role_id="{{ $article->id }}"><i class="simple-icon-trash"></i></a>
				
			
			</td>
		</tr>
		@php $sno++ @endphp
		@php $i++;  @endphp
	 @endforeach
	@else
		<tr><td colspan="4" class="error" style="text-align:center">No Data Found.</td></tr>
	@endif	
	</tbody>
</table> 
	<!------------ Pagination -------------->
		@if(is_object($listArticles) && !empty($listArticles) && $listArticles->count()) 
		 {!! $listArticles->render() !!}  
		 @endif	