<table class="table table-hover mb-0 " id="filtered-data">
	<thead class="bg-primary">
		<tr>
		<th scope="col">Date</th>
		<th scope="col">Upwork Account</th>
		<th scope="col">Bidder Name</th>
		<th scope="col">Title</th>
		
		<th scope="col">Client Budget</th>
        <th scope="col">Client Name</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>

	
		 @if($leads->count()!='')

		 @foreach($leads as $key => $lead)
		
		 @include('admin.leads.leadsSingleRow')

		 
		 @endforeach
		@else		
	<tr><td colspan="7" class="error" style="text-align:center;font-size:15px;">No data found.</td></tr>
 @endif	
   
	</tbody>
</table> 
	<!------------ Pagination -------------->
	@if(is_object($leads) && !empty($leads) && $leads->count()) 
		 {!! $leads->render() !!}  
		 @endif	