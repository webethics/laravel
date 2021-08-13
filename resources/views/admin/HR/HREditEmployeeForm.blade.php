@extends('admin.layouts.admin')
@section('additionalCss')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
	.ui-draggable, .ui-droppable {
		background-position: top;
	}
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	/*#sortable .auction-media-row { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable .auction-media-row { height: 1.5em; line-height: 1.2em; }*/
	.ui-state-highlight { height: 1.5em; line-height: 1.5em; }
</style>
@stop
@section('content')
	@section('ckeditor')
	<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
	<script>
	        CKEDITOR.replace( 'description',{
	    allowedContent: true
	} );
	</script>
	@stop
{{-- Check if New Auction or Edit Auction, if $newAuction set 1 then new Auction else Edit Auction --}}
@php
	$newAuction = 1;
	$auctionTitle = 'Add';
	$action = 'Add';
@endphp
@if(isset($auction))
	@php
		$newAuction = 2;
		$auctionTitle = 'Edit';
		$action = 'Update';
	@endphp
@endif

@section('headtitle')
| {{$auctionTitle}} Listing
@endsection
@section('pageTitle', $auctionTitle.' Listing')

	<div class="row">
		<div class="col-12">
			<h1>Edit Employee</h1>
			<div class="separator mb-5"></div>
		</div>
	</div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active tabbutn" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"  aria-selected="true">Basic Info</a>
			</li>
			<li class="nav-item">
				<a class="nav-link tabbutn" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">HR</a>
			</li>
			<li class="nav-item">
				<a class="nav-link tabbutn" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Documents</a>
			</li>
			</ul>
				<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				@include('admin.partials.editemployee') 

				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> @include('admin.partials.addhr')       </div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">  @include('admin.partials.adddocuments') </div>
				</div>
				
					<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
    @stop

    @section('additionJs')
    	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    	<script src="{{ asset('js/module/auctions.js')}}"></script>
	@stop