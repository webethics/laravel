@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Bugs')
	<div class="row">
		<div class="col-12">
			<h1>Bugs </h1>
			@if(check_role_access('customer_create'))
				<span class="fl_right balance ml-2"><a id="create_user" class="btn btn-primary" href="#" data-toggle="modal" data-target="#addbug">Create New Bug</a></span>

                @include('modal.addbug')

                <span class="fl_right balance"><a id="create_user" class="btn btn-primary" href="#"  data-toggle="modal" data-target="#addproject">Add Project</a></span>


                @include('modal.addprojectmodal')
			@endif
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
		
        @include('admin.partials.searchbugs')
							
			<div class="card">
				<div class="card-body">
				<div class="table-responsive customers_full"  id="tag_container">
					 @include('admin.bugs.bugspagination')
				</div>
				</div>
			</div>

		</div>
	</div>
	<div class="modal fade modal-right customerEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-right customerViewModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-right userCreateModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
@section('leadjs')
<script src="{{ asset('js/module/leads.js')}}"></script>	
@stop
@endsection