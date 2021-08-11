
	<!-- header start -->
	<header class="ttr-header">
		<div class="ttr-header-wrapper">
			<!--sidebar menu toggler start -->
			<div class="ttr-toggle-sidebar ttr-material-button">
				<i class="ti-close ttr-open-icon"></i>
				<i class="ti-menu ttr-close-icon"></i>
			</div>
			<!--sidebar menu toggler end -->
			<!--logo start -->
			<div class="ttr-logo-box">
				<div>
					<a href="{{ url('/') }}" class="ttr-logo">
						<img class="ttr-logo-mobile" alt="" src="{{ asset('dashboard/assets/images/logo-mobile.png') }}" width="30" height="30">
						<img class="ttr-logo-desktop" alt="" src="{{ asset('dashboard/assets/images/logo-white.png') }}" width="160" height="27">
					</a>
				</div>
			</div>
			<!--logo end -->
			<div class="ttr-header-menu">
				<!-- header left menu start -->
				<ul class="ttr-header-navigation">
					<li>
						<a href="{{ url('index') }}" class="ttr-material-button ttr-submenu-toggle">HOME</a>
					</li>
				</ul>
				<!-- header left menu end -->
			</div>
			<div class="ttr-header-right ttr-with-seperator">
				<!-- header right menu start -->
				<ul class="ttr-header-navigation">
					<li>
						<a href="#" class="ttr-material-button ttr-submenu-toggle"><span class="ttr-user-avatar">
							@if (Auth::user()->avatar != null)
								<img alt="" src="{{ asset('uploads/student_avatar/'.Auth::user()->avatar) }}" width="32" height="32">								
							@else
								<img alt="" src="{{ asset('uploads/avatar_pics.jpg') }}" width="32" height="32">							
							@endif
						</span></a>
						<div class="ttr-header-submenu">
							<ul>
								<li><a href="{{ url('lecturer/profile') }}">My profile</a></li>
								<li><a href="{{ url('lecturer/assignments') }}">Assignments</a></li>
								<li><a href="{{ url('logout') }}">Logout</a></li>
							</ul>
						</div>
					</li>
					{{-- <li class="ttr-hide-on-mobile">
						<a href="#" class="ttr-material-button"><i class="ti-layout-grid3-alt"></i></a>
						<div class="ttr-header-submenu ttr-extra-menu">
							<a href="#">
								<i class="fa fa-music"></i>
								<span>Musics</span>
							</a>
							<a href="#">
								<i class="fa fa-youtube-play"></i>
								<span>Videos</span>
							</a>
							<a href="#">
								<i class="fa fa-envelope"></i>
								<span>Emails</span>
							</a>
							<a href="#">
								<i class="fa fa-book"></i>
								<span>Reports</span>
							</a>
							<a href="#">
								<i class="fa fa-smile-o"></i>
								<span>Persons</span>
							</a>
							<a href="#">
								<i class="fa fa-picture-o"></i>
								<span>Pictures</span>
							</a>
						</div>
					</li> --}}
				</ul>
				<!-- header right menu end -->
			</div>
			<!--header search panel start -->
			{{-- <div class="ttr-search-bar">
				<form class="ttr-search-form">
					<div class="ttr-search-input-wrapper">
						<input type="text" name="qq" placeholder="search something..." class="ttr-search-input">
						<button type="submit" name="search" class="ttr-search-submit"><i class="ti-arrow-right"></i></button>
					</div>
					<span class="ttr-search-close ttr-search-toggle">
						<i class="ti-close"></i>
					</span>
				</form>
			</div> --}}
			<!--header search panel end -->
		</div>
	</header>
	<!-- header end -->