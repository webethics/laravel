<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header py-1">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form action="{{ url('update-customer/') }}/{{ $article->id }}" method="POST" id="updateUser" >
	 @csrf
		
		<div class="form-group form-row-parent">
			<label class="col-form-label">{{ trans('global.title') }}<em>*</em></label>
			<div class="d-flex control-group">
				<input type="text" name="title" value="{{$article->title}}" class="form-control" placeholder="Title">									
			</div>	
			<div class="first_name_error errors"></div>	
		</div>
		
		
	
		<div class="form-group form-row-parent">
			<label class="col-form-label">{{ trans('global.slug') }}<em>*</em></label>
			<div class="d-flex control-group">
				<input type="text" name="slug" value="{{$article->slug}}" class="form-control" placeholder="Slug">									
			</div>	
			<div class="last_name_error errors"></div>	
		</div>
		
		
		
		<!--<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.email') }}</label>
		<div class="d-flex control-group">
		<input type="email" name="email" disabled="disabled" value="{{$article->email}}" readonly class="form-control" placeholder="{{ trans('global.email') }}">								
		</div>								
		</div>	-->
	
		
		
		
		<div class="form-row mt-4">
		<div class="col-md-12">
		<input id ="article_id" class="form-check-input" type="hidden" value="{{$article->id}}">
		<button type="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto">{{ trans('global.submit') }}</button>
		<div class="spinner-border text-primary request_loader" style="display:none"></div>
		</div>
		</div>
		
		</form>

				</div>
			</div>
		</div>