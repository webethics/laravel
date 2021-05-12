@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Templates')
@section('additionalCss')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
	.ui-draggable, .ui-droppable {
		background-position: top;
	}
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
@stop
<div class="row">
	<div class="col-12">
		<h1>Templates</h1>
		<span class="fl_right balance"><a id="create_templates" class="btn btn-primary" href="/admin/templates/create">Create Template</a></span>
		
		<!---->
		<div class="separator mb-5"></div>
	</div>
</div>
            <div class="row mb-4">
                <div class="col-12 mb-4">
				
				@include('admin.partials.searchtemplate')
				
					<div class="card">
						<div class="card-body">
						<div class="table-responsive"  id="tag_container">
							 @include('admin.templates.templatePagination-arabic') 
						</div>
						</div>
					</div>
                </div>
            </div>
			<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
<div class="modal fade modal-right templateEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
 </div>
@section('userJs')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/module/templates.js')}}"></script>	
@stop
@endsection