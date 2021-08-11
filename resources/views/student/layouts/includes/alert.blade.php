{{-- <script src="{{ asset('vendor/jquery.2.2.3.min.js')}}"></script> --}}
<div class="flash-container">
	{{-- @if(Session::has('message'))
	  <div class="alert {{ Session::get('alert-class') }} text-center" style="margin-bottom:10px;" role="alert">
	    {{ Session::get('message') }}
	    <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
	  </div>
	@endif

	@if (session('status'))
	    <div class="alert alert-success font-weight-700">
	        {!! session('status') !!}
	        <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
	    </div>
	@endif --}}
{{-- 
	@if (session('warning'))
	    <div class="alert alert-warning font-weight-700">
	        {{ session('warning') }}
	        <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
	    </div>
	@endif

	@if (session('success'))
	    <div class="alert alert-success font-weight-700">
	        {{ session('success') }}
	        <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
	    </div>
	@endif

	@if (session('error'))
	    <div class="alert alert-danger font-weight-700">
	        {{ session('error') }}
	        <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
	    </div>
	@endif --}}
</div>
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
	@if(Session::has('info'))
		toastr.info("{{ session('error') }}");
	@elseif(Session::has('success'))
		toastr.success("{{ session('success') }}", "Success");
	@elseif(Session::has('error'))
		toastr.error("{{ session('error') }}", "Something Went Wrong!");
	@elseif(Session::has('warning'))
		toastr.warning("{{ session('warning') }}", "Try Again!");
	@elseif(Session::has('status'))
		toastr.success("{{ session('status') }}", "Success");
	@elseif(Session::has('permission_warning'))
		toastr.warning("{{ session('permission_warning') }}", "Warning!");
	@elseif(Session::has('block'))
		toastr.error("{{ session('block') }}", "Warning!");
	@endif
  </script>