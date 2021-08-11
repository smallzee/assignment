<!DOCTYPE html>
<html lang="en">


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
    <title>Project : ENHANCING EDUCATIONAL TECHNOLOGY VIA DIGITAL PLATFORMS BY DEVELOPING AN ONLINE ASSIGNMENT SUBMISSION SOFTWARE </title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@include('admin.layouts.includes.alert')
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('web/assets/css/assets.css') }}">
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('web/assets/css/typography.css') }}">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('web/assets/css/shortcodes/shortcodes.css') }}">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('web/assets/css/style.css') }}">
	<link class="skin" rel="stylesheet" type="text/css" href="{{ asset('web/assets/css/color/color-1.css') }}">
	
</head>
<body id="bg">
<div class="page-wraper">
	<div id="loading-icon-bx"></div>
	<div class="account-form">
		<div class="account-head" style="background-image:url({{ asset('web/assets/images/slider/futo.jpg') }});">
			<a href="{{ url('index') }}"><img src="{{ asset('web/assets/images/logo-white-2.png') }}" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container" style="max-width:600px">
				<div class="heading-bx left">
					<h2 class="title-head">Forget <span>Password</span></h2>
					{{-- <p>Don't have an account? <a href="register.html">Create one here</a></p> --}}
				</div>
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">{{ __('Reset Password') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- External JavaScripts -->
<script src="{{ asset('web/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('web/assets/vendors/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('web/assets/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/assets/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('web/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('web/assets/vendors/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('web/assets/vendors/counter/waypoints-min.js') }}"></script>
<script src="{{ asset('web/assets/vendors/counter/counterup.min.js') }}"></script>
<script src="{{ asset('web/assets/vendors/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ asset('web/assets/vendors/masonry/masonry.js') }}"></script>
<script src="{{ asset('web/assets/vendors/masonry/filter.js') }}"></script>
<script src="{{ asset('web/assets/vendors/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('web/assets/js/functions.js') }}"></script>
<script src="{{ asset('web/assets/js/contact.js') }}"></script>
{{-- <script src='{{ asset('web/assets/vendors/switcher/switcher.js') }}'></script> --}}
</body>
</html>
