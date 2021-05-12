 <table class="table table-hover mb-0" id="template_table">
	<thead class="bg-primary">
		<tr>
		<th scope="col">#No.</th>
		<th scope="col">{{ trans('global.title') }}</th>
		<th scope="col">Date Published</th>
		<th scope="col">Date Modified</th>
		<th scope="col" class="no-sort">Status</th>
		<th scope="col" class="no-sort">Number of Downloads</th>
		<th scope="col" class="no-sort">Number of Views</th>
		<th scope="col" class="no-sort">Source of Payment</th>
		<th scope="col" class="no-sort"># of Times Shared</th>		
		
		<th scope="col" class="no-sort">{{ trans('global.actinos') }}</th>								
		</tr>
	</thead>
	<tbody id="sortable">
	 @if(is_object($listTemplates) && !empty($listTemplates) && $listTemplates->count())
		@php $sno = 1;$sno_new = 0  @endphp
	  @foreach($listTemplates as $key => $template)
		<tr data-user-id="{{ $template->id }}" class="user_row_{{$template->id}}" >
			<td id="sno_{{$template->id}}">{{(($page_number-1) *  $number_of_records)+$sno}} 
				<input type="hidden" name="page_number" value="{{$page_number}}" id="page_number_{{$template->id}}"/>
				<input type="hidden" name="sno" value="{{$sno}}" id="s_number_{{$template->id}}"/>
			</td>
			<td id="name_{{$template->id}}">{{ $template->title ?? '' }} </td>
			
			<td id="email_{{$template->id}}"> {{ $template->created_at  ?? '' }}</td>
			
			<td id="email_{{$template->id}}"> {{ $template->created_at  ?? '' }}</td>
			
			<td id="status_{{$template->id}}"> 
			@php  $selected=''; @endphp
			@if($template->status==1)
			@php	$selected = 'checked=checked'@endphp
			@endif
			
			<div class="custom-switch  custom-switch-primary custom-switch-small">
			<input class="custom-switch-input switch_status" id="switch{{ $template->id }} " data-language="ar"  type="checkbox" data-user_id="{{ $template->id }}" {{$selected}}>
			   <label class="custom-switch-btn" for="switch{{ $template->id }}"></label>

		  </div></td>
			
			<td id="email_{{$template->id}}"> {{ $template->total_dwlnd_pdf + $template->total_dwlnd_editable  ?? '' }}</td>
			
			<td id="email_{{$template->id}}"> {{ $template->total_viewed  ?? '' }}</td>
			
			<td id="email_{{$template->id}}"> {{ $template->payment  ?? '' }}</td>
			
			<td id="email_{{$template->id}}"> {{ $template->views  ?? '' }}</td>
			
			

			<td>
				<a class="action" href ="{{url('admin/templates/edit')}}/{{$template->id}}/ar" title="Edit"><i class="simple-icon-note"></i></a>
				
			<a title="Delete Template"  data-id="{{ $template->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Template?"  data-left_button_name ="Yes" data-language="ar"  data-left_button_id ="delete_template" data-left_button_cls="btn-primary" class="open_confirmBox action deleteTemplate"  href="javascript:void(0)" data-role_id="{{ $template->id }}"><i class="simple-icon-trash"></i></a>
			<input type="hidden" name="per_page" value="{{$number_of_records}}" id="per_page"/>
			<input type="hidden" name="page_language" value="ar" id="page_number_{{$template->id}}"/>
			</td>
		</tr>
		@php $sno++ @endphp
	 @endforeach
	@else
		<tr><td colspan="10" class="error" style="text-align:center">No Data Found.</td></tr>
	@endif	
	</tbody>
</table> 
<!------------ Pagination -------------->
		@if(is_object($listTemplates) && !empty($listTemplates) && $listTemplates->count()) 
		 {!! $listTemplates->render() !!}  
		 @endif	