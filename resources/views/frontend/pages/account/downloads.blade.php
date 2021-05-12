@extends('frontend.layouts.landing')
@section('pageTitle','Subscription')
@section('content')
@section('extraJsCss')

@stop
  <main class="site-content profilecontent">
	 @include('frontend.pages.account.profile_top_section')
	 @include('frontend.pages.account.profile_menu')
	 <section class="homesection plansection innerplansection whitebg">
		<div class="container">
		   <div class="plansection_cont">
			  <h2 class="text-center">{{trans('profile.my_account')}}</h2>
			  
				<table class="table table-striped" id="download_table">
					<thead>
					<tr>
						<th>{{trans('profile.sno')}}.</th>
						<th>{{trans('profile.type')}}</th>
						<th>{{trans('profile.title')}}</th>
						<th>{{trans('profile.download_date')}}</th>
						
					</tr>
					</thead>
					<tbody>
					@php $sno = 1; @endphp
					@foreach($downloads as $key=>$value)
						
						<tr>
							<td>{{$sno}}</td>
							<td>{{ucfirst($value->type)}}</td>
							@if($value->language == 'ar')
								<td>{{$value->arabic_articles[0]->title ?? ''}}</td>
							@else
								<td>{{$value->articles[0]->title ?? ''}}</td>
							@endif
							<td>{{date('d M, Y',strtotime($value->created_at))}}</td>
							
						</tr>
						@php $sno++; @endphp
					@endforeach
					</tbody>
				</table>
		   </div>
		</div>
	 </section>
  </main>
@include('frontend.pages.account.profile_image_upload')

@section('userJs')
<link rel="stylesheet" href="{{ url('frontend/css/croppie.min.css')}}">
	
<script src="{{ url('frontend/js/croppie.js')}}"></script>
<script src="{{ url('frontend/js/module/user.js')}}"></script>	
<script src="{{ url('frontend/js/module/plan.js')}}"></script>	
<script src="{{ url('js/vendor/datatables.min.js')}}"></script>	
<script type="text/javascript">
$(document).ready(function(){
	$('#download_table').DataTable({
		"pageLength": 50,
		"pagingType": "full_numbers",
		"ordering": false,
		"searching": false,
		"paging": true,
		
	});
});

	
</script>
<style>
#download_table_wrapper a{
	padding:10px;
	border:1px solid #ccc;
}
</style>
@stop
  @endsection