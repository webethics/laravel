<table class="table table-hover mb-0" >
	<thead class="bg-primary">
		<tr>
		<th scope="col">EMP ID</th>
		<th scope="col">Name</th>
		<th scope="col">Email</th>
		<th scope="col">Phone</th>
        <th scope="col">Salary</th>
        <th scope="col">Action</th>
		</tr>
	</thead>
	<tbody id="filtered-data">

	@if($employees->count()!='')
	@foreach($employees as $key => $employee)
    @include('admin.HR.HRsinglerow')
	@endforeach
	@else		
	<tr><td colspan="7" class="error" style="text-align:center;font-size:15px;">No data found.</td></tr>
	@endif	
 
	</tbody>
</table> 
	<!------------ Pagination -------------->
	







