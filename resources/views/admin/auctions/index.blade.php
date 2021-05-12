@extends('admin.layouts.admin')
@section('headtitle')
| Listing
@endsection
@section('content')
@section('pageTitle','Listing')
	<div class="row">
		<div class="col-12">
			<h1>Listing</h1>
			@if(check_role_access('auction_create'))
				<span class="fl_right balance"><a id="create_auction" class="btn btn-primary" href="{{'/admin/auctions/create'}}">Create Listing</a></span>
			@endif
			
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
		
			<!--@include('admin.partials.searchAuctionForm') -->
							
			<div class="card">
				<div class="card-body">
				<div class="table-responsive auction_full"  id="tag_container">
					 @include('admin.auctions.auctionPagination')
				</div>
				</div>
			</div>

		</div>
	</div>
	<div class="modal fade modal-right bidListing"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-right auctionEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-right auctionViewModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-right auctionCreateModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
@stop

@section('additionJs')
<script src="{{ asset('js/module/auctions.js')}}"></script>	
@stop