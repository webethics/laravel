@if(isset($tempmedia) && $tempmedia !== NULL)
	@foreach($tempmedia as $media)
		@php $imageType='temp'; @endphp
		@include('admin.auctions.imageGallery')
	@endforeach
@endif