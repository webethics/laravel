@extends('frontend.layouts.landing')
@section('pageTitle','Edit Profile')
@section('content')

@include('frontend.pages.account.edit_profile')


@include('frontend.common.footer')
@section('userJs')
<link rel="stylesheet" href="{{ url('frontend/css/croppie.min.css')}}">
<script src="{{ url('frontend/js/croppie.js')}}"></script>
<script src="{{ url('frontend/js/module/user.js')}}"></script>	
<script src="{{ url('frontend/js/module/plan.js')}}"></script>	

 
@stop
@stop
