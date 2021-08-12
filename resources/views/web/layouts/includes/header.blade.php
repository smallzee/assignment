<header class="header rs-nav header-transparent">
  <div class="top-bar">
    <div class="container">
      <div class="row d-flex justify-content-between">
        <div class="topbar-left">
           <ul>
            <li><a href="#"><i class="fa fa-question-circle"></i>Ask a Question</a></li>
            <li><a href="javascript:;"><i class="fa fa-envelope-o"></i>Support@website.com</a></li>
          </ul> 
        </div>
        <div class="topbar-right">
          <ul>
            {{--<li>--}}
              {{--<select class="header-lang-bx">--}}
                {{--<option data-icon="flag flag-">Nigeria NGN</option>--}}
                {{--<option data-icon="flag flag-uk">English UK</option>--}}
                {{--<option data-icon="flag flag-us">English US</option>--}}
              {{--</select>--}}
            {{--</li> --}}
            <li><a href="{{ url('login') }}">Login</a></li>
            {{-- <li><a href="#">Register</a></li> --}}
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="sticky-header navbar-expand-lg">
    <div class="menu-bar clearfix">
      <div class="container clearfix">
        <!-- Header Logo ==== -->
        <div class="menu-logo">
          <a href="{{ url('/') }}">
            <img class="ttr-logo-desktop" alt="" src="{{ asset('web/assets/images/logo-white.png') }}" width="160" height="27">
          </a>
        </div>
        <!-- Mobile Nav Button ==== -->
        <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <!-- Author Nav ==== -->
        <div class="secondary-menu">
          <div class="secondary-inner">
            <ul>
              {{--<li><a href="javascript:;" class="btn-link"><i class="fa fa-facebook"></i></a></li>--}}
              {{--<li><a href="javascript:;" class="btn-link"><i class="fa fa-google-plus"></i></a></li>--}}
              {{--<li><a href="javascript:;" class="btn-link"><i class="fa fa-linkedin"></i></a></li>--}}
              <!-- Search Button ==== -->
              <!-- <li class="search-btn"><button id="quik-search-btn" type="button" class="btn-link"><i class="fa fa-search"></i></button></li> -->
            </ul>
          </div>
        </div>
        <!-- Search Box ==== -->
        <div class="nav-search-bar">
          <form action="#">
            <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
            <span><i class="ti-search"></i></span>
          </form>
          <span id="search-remove"><i class="ti-close"></i></span>
        </div>
        <!-- Navigation Menu ==== -->
        <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
          <div class="menu-logo">
            <a href="{{url('/')}}"><img src="{{ asset('web/assets/images/logo.png') }}" alt=""></a>
          </div>
          <ul class="nav navbar-nav">
            {{--<li class="{{ request()->is('/*')  ? 'active' : '' }}"><a href="{{ url('/') }}">HOME</a></li>--}}
            {{--@foreach ($faculties as $faculty)--}}
							{{--<li class=""><a href="javascript:;">{{$faculty->code}} <i class="fa fa-chevron-down"></i></a>--}}
								{{--<ul class="sub-menu">                  --}}
                  {{--@foreach ($departments as $department)--}}
                  {{--@if ($faculty->id == $department->faculty_id)                      --}}
                      {{--<li><a href="{{ url('department/'.$faculty->id, $department->id) }}">{{$department->name}}</a></li>--}}
                  {{--@endif--}}
                  {{--@endforeach--}}
								{{--</ul>--}}
							{{--</li>--}}
            {{--@endforeach--}}
          </ul>
          <div class="nav-social-link">
            <a href="javascript:;"><i class="fa fa-facebook"></i></a>
            <a href="javascript:;"><i class="fa fa-google-plus"></i></a>
            <a href="javascript:;"><i class="fa fa-linkedin"></i></a>
          </div>
        </div>
        <!-- Navigation Menu END ==== -->
      </div>
    </div>
  </div>
</header>