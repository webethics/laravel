@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Leads')

	<div class="row">
		<div class="col-12">
			<h1>Leads </h1>
			
				<span class="fl_right balance"><a id="create_user" class="btn btn-primary" href="#" data-toggle="modal" data-target="#AddLead">Create New Lead</a></span>

                @include('modal.leadAdd')
		
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
		
        @include('admin.partials.searchLeadsForm')
							
			<div class="card">
				<div class="card-body">
					<div class="table-responsive customers_full"  id="tag_container">
						@include('admin.leads.leadsPagination')
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade modal-right leadViewModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>



	<div class="modal fade modal-right leadEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>

	<div class="modal fade leadEditCommentsmodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>


	<div class="modal fade  leadAddCommentsmodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>

	<div class="modal fade  leadAddReasonsmodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>

	
	
	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
	
					

						
@section('leadjs')


<script src="{{ asset('js/module/leads.js')}}"></script>	
<script>
   $('#upwork_id2,#bidder_id2,#status2').select2({
        dropdownParent: $('#AddLead')
				
    });
</script>

@stop
@section('CommentJS')
<script src="{{ asset('js/module/comment.js')}}"></script>	
@stop
@endsection