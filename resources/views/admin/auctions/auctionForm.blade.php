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
			<h1>{{$auctionTitle}} Listings</h1>
			<div class="separator mb-5"></div>
		</div>
	</div>
   <!-- Main content -->
	<div class="card">
		<div class="card-body">
			<div class="row"  id="tag_container">
					<div class="box box-primary">
						<div class="box-body">
							@include('flash-message')	

								@if($newAuction == 2)
									@if($errors->first('auction_id'))
										<span class="error"> {{ $errors->first('auction_id')  }} </span>
									@endif
								@endif	
					        
					        	@if($newAuction == 1)
									{{ Form::open(array('url' => 'admin/auctions/create', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
								@else
									{{ Form::open(array('url' => 'admin/auctions/update/', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
								@endif


								<div class="form-group col-md-12">
									<div class="row">
										<div class="col-md-8 row col-xs-12">

											@if($newAuction == 2)
												<div class="col-md-12 col-xs-12 field mb-4">
													{{ Form::label('Sale Item No') }}
														{{ Form::text('sale_no',old('sale_no',$auction->sale_no),array('class'=>'form-control','placeholder'=>'Sale Item no','readonly'=>'readonly')) }}
												
													<span class="error"> {{ $errors->first('sale_no')  }} </span>
												</div>

												<div class="clearfix"></div>
											@endif

											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('title') }}
												@if($newAuction == 1)
													{{ Form::text('title',old('title'),array('class'=>'form-control','placeholder'=>'Title')) }}
												@else
													{{ Form::text('title',old('title', $auction->title),array('class'=>'form-control','placeholder'=>'Title')) }}
												@endif
													<span class="error"> {{ $errors->first('title')  }} </span>
											</div>

											<div class="clearfix"></div>

											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Category') }}
												@if($newAuction == 1)
													<select class="form-control input-sm" name="category_id" id="pro_category">
										                <option value="">--Select Category--</option>
										                @foreach($categories as $category)
										               <option value="{{ $category->id ?? ''}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title ?? ''}}</option>
										                @endforeach
										            </select>
												@else
													<select class="form-control input-sm" name="category_id" id="pro_category">
										                <option value="">--Select Game--</option>
										                @foreach($categories as $category)
										               <option value="{{ $category->id ?? ''}}" {{ old('category_id', $auction->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title ?? ''}}</option>
										                @endforeach
										            </select>
												@endif
													<span class="error"> {{ $errors->first('category_id')  }} </span>
											</div>
											
											
											<div class="clearfix"></div>
											
											<div class="col-md-12 col-xs-12 field mb-4">
												
												{{ Form::label('Is Featured') }} 
											
											
											
											<span class="error"> {{ $errors->first('is_featured')  }}  </span>
											
											
												@if($newAuction == 1)
													<select id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
														<option value="">--Select Is Featured--</option>
														<option value="1" @if(old("is_featured") == '1') {{'selected'}} @endif >Yes</option>
														<option value="0" @if(old("is_featured") == '0') {{'selected'}} @endif >No</option>
													</select>
												@else
													<select id="is_featured"  class="form-control select2-single"  name="is_featured"  data-width="100%">
														<option value="">--Select Is Featured--</option>
														<option value="1" @if($auction->featured == '1') {{'selected'}} @endif >Yes</option>
														<option value="0" @if($auction->featured == '0') {{'selected'}} @endif >No</option>
													</select>
													
												@endif
													<span class="error"> {{ $errors->first('title')  }} </span>
											</div>

											<div class="clearfix"></div>



											
											<div class="clearfix"></div>
											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Short Description') }}
												@if($newAuction == 1)
													{{ Form::textarea('short_description',old('short_description'),array('class'=>'form-control','placeholder'=>'Short Description','rows' => 3)) }}
												@else
													{{ Form::textarea('short_description',old('short_description', $auction->short_description),array('class'=>'form-control','placeholder'=>'Short Description','rows' => 3)) }}
												@endif
													<span class="error"> {{ $errors->first('short_description')  }} </span>
											</div>
											<div class="clearfix"></div>
											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Highlights') }}
												@if($newAuction == 1)
													{{ Form::textarea('description',old('description'),array('class'=>'form-control','placeholder'=>'')) }}
												@else
													{{ Form::textarea('description',old('description', $auction->highlights),array('class'=>'form-control','placeholder'=>'')) }}
												@endif
												<span class="error"> {{ $errors->first('description')  }} </span>
											</div>
											<div class="clearfix"></div>

											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('First Bid') }}
												@if($newAuction == 1)
													{{ Form::text('amount',old('amount'),array('class'=>'form-control','placeholder'=>'Amount')) }}
												@else
													{{ Form::text('amount',old('amount', $auction->amount),array('class'=>'form-control','placeholder'=>'Amount')) }}
												@endif
													<span class="error"> {{ $errors->first('amount')  }} </span>
											</div>

											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Min Estimation') }}
												@if($newAuction == 1)
													{{ Form::text('min_bid',old('min_bid'),array('class'=>'form-control','placeholder'=>'Min Bid')) }}
												@else
													{{ Form::text('min_bid',old('min_bid', $auction->min_bid),array('class'=>'form-control','placeholder'=>'Min Bid')) }}
												@endif
													<span class="error"> {{ $errors->first('min_bid')  }} </span>
											</div>

											<div class="col-md-12 col-xs-12 field mb-4">
												{{ Form::label('Max Estimation') }}
												@if($newAuction == 1)
													{{ Form::text('max_bid',old('max_bid'),array('class'=>'form-control','placeholder'=>'Max Bid')) }}
												@else
													{{ Form::text('max_bid',old('max_bid', $auction->max_bid),array('class'=>'form-control','placeholder'=>'Amount')) }}
												@endif
													<span class="error"> {{ $errors->first('max_bid')  }} </span>
											</div>
											<div class="col-md-12">
												{{ Form::label('Feature Images') }}
												
												<div class="clearfix"></div>
												<input id="fileupload" class="inputfile" type="file" name="image">
												<label class="mt-2 mb-3" for="fileupload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file</span></label>
												

												@if($newAuction == 2)
													@if($auction->feature_image != NULL)
													
														<div class="inputfile-preview old-file">
															<img src="{{$auction->feature_image_url}}" class="category_image auction_new_image auction_image">
															<a href="{{url('/admin/auctions/image_downlad')}}/{{$auction->id}}" class="filedownlad filedownlad-auction">
																<i class="glyph-icon simple-icon-cloud-download"></i>
															</a>

															<a title="Delete Media"  data-id="{{$auction->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Image?"  data-left_button_name ="Yes" data-left_button_id ="delete_auction_image" data-left_button_cls="btn-primary" class="open_confirmBox action deleteImageAuction"  href="javascript:void(0)" data-auction_id="{{ $auction->id }}">
																<i class="glyph-icon simple-icon-trash"></i>
															</a>
														</div>
													@endif
												@endif
												<div class="inputfile-preview new-file d-none">
													<img src="" class="category_image auction_image">
													<i class="glyph-icon simple-icon-trash new-auction-file-trash"></i>
												</div>
												<input type="hidden" name="feature_image" id="feature_image" value="{{old('feature_image')}}" />	
											</div>
											<div class="clearfix"></div>
											<div class="col-md-12 col-xs-12 field mt-4">
												{{ Form::label('Images') }}
												<div class="clearfix"></div>
				                                <a class="btn btn-outline-primary default mb-2 add_collapse" data-toggle="collapse" href="#add"> 
				                                    <i class="glyph-icon simple-icon-plus mr-1"></i> Add
				                                </a>
												<div class="collapse" id="add">
													<div class="mt-4">
													
													<form action="/file-upload">
														<div class="dropzone" id="drop_here_auction">
														</div>
													</form>
													</div>
												</div>
												<span class="error"> {{ $errors->first('temp_images')  }} </span>
												<div class="dropzoneError errors" id="file_error"></div>
												<input type="hidden" name="temp_images" id="temp_images" value="{{old('temp_images')}}">											
											</div>

										{{--<div class="col-md-12 mt-4 media_uploaded" id="sortable">
											@if($newAuction == 2)
												@if(isset($auction->media) && $auction->media !== NULL)
													@foreach($auction->media as $media)
														@php $imageType='original'; @endphp
														@include('admin.auctions.imageGallery')
													@endforeach
												@endif
											@endif

											
										</div>--}}
										
											<div class="col-md-12 mt-4 media_uploaded">										
												<table class="table table-bordered media_uploaded_table">
												   <thead class="thead-dark">
													  <tr>
														 <th scope="col">Media</th>
														 <th scope="col" class="text-center">Download</th>
														 <th scope="col" class="text-center">Remove</th>
													  </tr>
												   </thead>
												   <tbody id="sortable">
												   		@if($newAuction == 2)
															@if(isset($auction->media) && $auction->media !== NULL)
																@foreach($auction->media as $media)
																	@php $imageType='original'; @endphp
																	@include('admin.auctions.imageGallery')
																@endforeach
															@endif
														@endif
													  {{--<tr>
														 <td><img alt="Thumbnail" src="https://auction.webethics.online/uploads/auctions/1/1484777845_auction_Rectangle4.png" class="list-thumbnail responsive border-0 card-img-left"></td>
														 <td><i class="glyph-icon simple-icon-cloud-download"></i></td>
														 <td><i class="glyph-icon simple-icon-trash"></i></td>
													  </tr>---}}
												   </tbody>
												</table>
											</div>
										
										

										</div>

									</div>


									<div class="form-group col-md-12">
										 <div class="sign-up-btn ">
										 	@if($newAuction == 2)
												<input type="hidden" value="{{$auction->id}}" name="auction_id" id="auction_id">
											@endif
											<input type="hidden" value="{{auth::user()->id}}" name="user_id" id="user_id">
											<input type="hidden" value="" name="sort_order" id="sort_order">
											 <input name="submit" class="loginmodal-submit btn btn-primary" id="auction_update" value="{{$action}}" type="submit">
											 <a href="{{url('admin/auctions')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
										</div>
									</div>

								</div>
							
							{{ Form::close() }}
						</div>
					</div>
			</div>
		</div>
	</div>
	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
    @stop

    @section('additionJs')
    	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    	<script src="{{ asset('js/module/auctions.js')}}"></script>
	@stop