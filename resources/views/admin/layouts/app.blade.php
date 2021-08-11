<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from techydevs.com/demos/themes/html/zobstar/employer-dashboard.html by HTTrack userssite Copier/3.x [XR&CO'2014], Thu, 22 Oct 2020 09:20:23 GMT -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Ehruoghene">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Project - {{ $title  ?? '' }}</title>
    <!-- Favicon -->
    
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="{{ asset('web/assets/images/favicon.ico') }}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/images/favicon.png') }}" />

    <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:100,300,400,500,700,900&amp;display=swap" rel="stylesheet">

    <!-- Template CSS Files -->
    @include('admin.layouts.includes.style')
    @include('admin.layouts.includes.alert')
</head>
<body>
<!-- start per-loader -->
{{-- <div class="loader-container">
    <div class="loader-circle">
        <div class="loader">
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
        </div>
    </div>
</div> --}}
<!-- end per-loader -->

<!-- ================================
            START HEADER AREA
================================= -->
@include('admin.layouts.includes.header')
<!-- ================================
         END HEADER AREA
================================= -->

<!-- ================================
    START DASHBOARD AREA
================================= -->

<section class="dashboard-area">
    @include('admin.layouts.includes.sidemenu')
    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @yield('admin')
            @include('admin.layouts.includes.footer')
        </div><!-- end container-fluid -->
    </div>
</section><!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->

<!-- start back-to-top -->
<div id="back-to-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end back-to-top -->

<!-- Template JS Files -->
@include('admin.layouts.includes.script')

</body>

<!-- Mirrored from techydevs.com/demos/themes/html/zobstar/employer-dashboard.html by HTTrack userssite Copier/3.x [XR&CO'2014], Thu, 22 Oct 2020 09:20:47 GMT -->
</html>