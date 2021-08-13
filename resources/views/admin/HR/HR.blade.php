@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','HR')
	<div class="row">
		<div class="col-12">
			<h1>Employees </h1>
			@if(check_role_access('customer_create'))
				<span class="fl_right balance"><a id="create_user" class="btn btn-primary" href="{{url('admin\add')}}">Create New Employee</a></span>

                
			@endif

			
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
		
        @include('admin.partials.searchEmployeeHRForm')
							
			<div class="card">
				<div class="card-body">
				<div class="table-responsive customers_full"  id="tag_container">
					 @include('admin.HR.HRpagination')
				</div>
				</div>
			</div>

		</div>
	</div>
	<div class="modal fade modal-right employeeviewmodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>

	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>

@section('hrjs')
<script src="{{ asset('js/module/Hrmenu.js')}}"></script>	
@stop
@endsection

