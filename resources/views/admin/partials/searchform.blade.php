 <form action="#" method="POST" id="searchForm" >
		@csrf
<div class="row">
	<div class="col-md-12 mb-4">
	<div class="card h-100">
		<div class="card-body">
			<div class="row">
				<div class=" col-md-6">
					<div class="row">
						<div class="form-group col-lg-6">
							<input type="text" name="title" id="title" class="form-control" placeholder="{{trans('global.title')}}">
							<input type="hidden" name="lang" id="lang" class="form-control" value="{{$language}}">
						</div>
					</div>
				</div>	
				 <div class="col-md-6">
					<div class="row">
					<div class="form-group col-lg-6">
					<select class="form-control" id="perPage" name="per_page">

						<!-- all option missing value="" -->
						<!-- example -->
					
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
					</div>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="form-group col-lg-6">
					<button type="submit" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto">{{trans('global.submit')}}</button>
					<button type="button" id="export_forms" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto">Export Forms</button>
					<!--<span class="fl_right balance"><a id="export_forms" class="btn btn-primary" href="javascript:void(0)">Export Forms</a></span>
					<button class="fl_right balance"><a id="export_templates" class="btn btn-primary" href="javascript:void(0)">Export Templates</a></button>-->
					<div class="spinner-border text-primary search_spinloder" style="display:none"></div>
				</div>	
			</div>
		</div>
	</div>				
	</div>
	</div>	
</form>