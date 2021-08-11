<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:08:15 GMT -->
<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="Project : ENHANCING EDUCATIONAL TECHNOLOGY VIA DIGITAL PLATFORMS BY DEVELOPING AN ONLINE ASSIGNMENT SUBMISSION SOFTWARE" />
	
	<!-- OG -->
	<meta property="og:title" content="Project : ENHANCING EDUCATIONAL TECHNOLOGY VIA DIGITAL PLATFORMS BY DEVELOPING AN ONLINE ASSIGNMENT SUBMISSION SOFTWARE" />
	<meta property="og:description" content="Project : ENHANCING EDUCATIONAL TECHNOLOGY VIA DIGITAL PLATFORMS BY DEVELOPING AN ONLINE ASSIGNMENT SUBMISSION SOFTWARE" />
	<meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">
    
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="{{ asset('web/assets/images/favicon.ico') }}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/images/favicon.png') }}" />
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>Lecturer Dashboard - {{$title ?? ''}} </title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
    @include('lecturer.layouts.includes.style')
    @include('lecturer.layouts.includes.alert')
	
</head>
<body class="ttr-opened-sidebar ttr-pinned-sidebar">
	
	<!-- header start -->
    @include('lecturer.layouts.includes.header')
	<!-- header end -->
	<!-- Left sidebar menu start -->
    @include('lecturer.layouts.includes.sidemenu')
	<!-- Left sidebar menu end -->

	<!--Main container start -->
    @yield('lecturer')
	<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
@include('lecturer.layouts.includes.script')
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->
</html>