<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Shopinpager</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
@if(Request::segment(1)=="product")
	@include('social::meta-article', [
           'title'         => $product_details->name,
           'description'   => substr($product_details->description,0,10),
           'image'         => URL::asset('public/admin/uploads/product/'.$product_details->product_image[0]->image),
           'author'        => 'Saleplus Style'
       ])
@endif
	<!-- all css here -->
	<!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/assets/img/favicon.png') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/animate.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{URL::asset('public/css/jquery-ui.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/chosen.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/meanmenu.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/bundle.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
	<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link rel="stylesheet" href="{{ URL::asset('public/css/responsive.css') }}">
	<script src="{{ URL::asset('public/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>