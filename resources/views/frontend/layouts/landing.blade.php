<!doctype html>

@php 

$language = session('language'); 
$rtl = array('ar');
$textdir = 'ltr';
if(in_array($language,$rtl)){
    $textdir = 'rtl';
}
@endphp 

 @php $lang = 'en'; @endphp
@if(Session::get('language') == 'ar')
	@php $lang = 'ar';@endphp
@endif	

<html dir="{{ $textdir}}" lang="{{$language}}">
<head>
      <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
			
			
		
	@if(collect(request()->segments())->first() == 'infographic-details')
		<link rel="image_src" href="{{ asset('/uploads/infographics/output').$infographic->id.'0.jpg' }}" />
		<meta property="og:url" content="{{url('infographic-details')}}/{{$infographic->id}}/{{$lang}}" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{$infographic->title ?? ''}}" />
		<meta property="og:description" content="<?php echo $infographic->title; ?>  compatible with Powerpoint, Keynote and Google Slides.Use these <?php echo $infographic->title; ?> diagrams for any project presentation.Includes circle and charts diagrams easy to edit." />
		<meta property="og:image" content="{{ asset('/uploads/infographics/output').$infographic->id.'0.jpg' }}" />
	@endif

    @if(collect(request()->segments())->first() == 'slide-details')
		<link rel="image_src" href="{{ asset('/uploads/templates/output').$template->id.'0.jpg' }}" />
		<meta property="og:url" content="{{url('slide-details')}}/{{$template->id}}/{{$lang}}" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{$template->title ?? ''}}" />
		<meta property="og:description" content="<?php echo $template->title; ?>  compatible with Powerpoint, Keynote and Google Slides.Use these <?php echo $template->title; ?> diagrams for any project presentation.Includes circle and charts diagrams easy to edit." />
		<meta property="og:image" content="{{ asset('/uploads/templates/output').$template->id.'0.jpg' }}" />
	@endif

    @if(collect(request()->segments())->first() == 'form-details')
		<link rel="image_src" href="{{ asset('/uploads/forms/output').$form->id.'0.jpg' }}" />
		<meta property="og:url" content="{{url('form-details')}}/{{$form->id}}/{{$lang}}" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{$form->title ?? ''}}" />
		<meta property="og:description" content="<?php echo $form->title; ?>  compatible with Powerpoint, Keynote and Google Slides.Use these <?php echo $form->title; ?> diagrams for any project presentation.Includes circle and charts diagrams easy to edit." />
		<meta property="og:image" content="{{ asset('/uploads/forms/output').$form->id.'0.jpg' }}" />
	@endif

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="stylesheet" href="{{ url('/css/vendor/dataTables.bootstrap4.min.css') }}" />	
	<link rel="stylesheet" href="{{ url('/css/vendor/datatables.responsive.bootstrap4.min.css') }}" />
      <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ url('frontend/css/bootstrap-select.min.css')}}">
	
      <link rel="stylesheet" href="{{url('frontend/css/fontawesome.min.css')}}" type="text/css">
      <link rel="icon" href="{{ url('frontend/images/favicon.png') }}" type="image">
	  <link rel="stylesheet" href="{{ url('frontend/css/animate.css')}}" type="text/css">
	     <!--link rel="stylesheet" href="{{ url('frontend/css/dore.light.blue.min.css')}}" /-->
	@if($language == 'ar')
		<link rel="stylesheet" href="{{ url('frontend/css/arabic-style.css')}}" type="text/css">
	@else
		<link rel="stylesheet" href="{{ url('frontend/css/style.css')}}" type="text/css">
		<link rel="stylesheet" href="{{ url('frontend/css/popup.css')}}" type="text/css">
		
	@endif 
		
	 
      <link rel="stylesheet" href="{{ url('frontend/css/custom.css')}}" type="text/css">
      <link rel="stylesheet" href="{{ url('frontend/css/slick.css')}}" type="text/css" />
      <link rel="stylesheet" href="{{ url('frontend/css/vendor/notifications.css')}}" type="text/css" />
      <link rel="stylesheet" href="{{url('frontend/css/slick-theme.css')}}" type="text/css" />
	  
	  <link rel="stylesheet" href="{{ url('frontend/css/owl.carousel.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{ url('frontend/css/owl.theme.default.min.css')}}" type="text/css">
	  <link rel="stylesheet" href="{{ url('frontend/css/custom-blog.css')}}" type="text/css">
   
      <title>{{ showSiteTitle('title') }} | @yield('pageTitle')</title>
	  <script> 
		base_url ="{{ url('/') }}";
	</script > 
   </head>
   <body>
		@include('frontend.common.header')	
		@yield('content')
		@include('frontend.common.footer')

		<script src="{{ url('frontend/js/jquery-2.2.0.min.js')}}" type="text/javascript"></script>
		<script src="{{ url('frontend/js/bootstrap.bundle.min.js')}}"></script> 
		<script src="{{ url('frontend/js/bootstrap-select.min.js')}}"></script> 
		<script src="{{ url('frontend/js/slick.js')}}"></script>
		<script src="{{ url('frontend/js/wow.js')}}"></script>
		<script src="{{ url('frontend/js/vendor/notifications.js')}}"></script>
		<script src="{{ url('frontend/js/module/login.js')}}"></script>	 
		<script src="{{ url('frontend/js/dore.script.js')}}"></script>	
		<script src="{{ url('frontend/js/custom.js')}}"></script>	
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="{{ url('frontend/js/module/profile.js')}}"></script>
		<script src="{{ url('frontend/js/croppie.js')}}"></script>
		
		
<script src="{{ url('frontend/js/owl.carousel.js')}}"></script>	

			
	
<!---    UserJs module/user.js  -->
@yield('userJs')
@yield('postJs')
@yield('planJs')

   
  </body>
</html>