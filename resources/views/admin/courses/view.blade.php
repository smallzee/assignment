@extends('admin.layouts.app')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title">{{$course->course_title}}</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item"><a href="#">Dashboard</a></li>
                <li>{{$course->course_title}}</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end col-lg-12 -->
</div><!-- end row -->
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="billing-form-item">
            <div class="billing-title-wrap">
				<div class="row">
					<div class="col-10">
						<h3 class="widget-title pb-0">{{$course->course_title}}</h3>
						<div class="title-shape margin-top-10px"></div>	
					</div>
				</div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">                
                <div class="widget-inner">					
                  <div class="">                    
                    <div class="row mt-3">
                      <div class="col-lg-12">
                        <div class="sidebar-widget">
                            <div class="billing-form-item">
                                <div class="billing-title-wrap">
                                    <h3 class="widget-title">Course Details</h3>
                                    <div class="title-shape"></div>
                                </div><!-- billing-title-wrap -->
                                <div class="billing-content">
                                    <div class="info-list static-info">
                                        <ul>
                                          <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Course Title: </span><b style="font-size:20px">{{$course->course_title}}</b></li>
                                          <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Course Code: </span><b style="font-size:20px">{{$course->course_code}}</b></li>
                                          <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Faculty: </span><b style="font-size:20px">{{$faculty->name}}</b></li>
                                            @isset ($department->name)
                                            <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Department: </span><b style="font-size:20px">{{$department->name}}</b></li>                                                
                                            @else
                                            <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Department: </span><b style="font-size:20px">Faculty Course</b></li>                                                
                                            @endisset
                                          <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Level: </span><b style="font-size:20px">{{$level->name}}</b></li>
                                          <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Semester: </span> <b style="font-size:20px">{{$semester->name}}</b></li>
                                          <li class="mb-3 d-flex align-items-center"><p><i class="la la-user"></i> <span class="color-text-2 font-weight-medium mr-1">Lecturer Incharge: </span> <b style="font-size:20px">{{$course->course_code}}</b></li>
                                          <li class="mb-3 d-flex align-items-center"><p><i class="la la-clock-o"></i> <span class="color-text-2 font-weight-medium mr-1">Course Added On: </span> <b style="font-size:20px">{{ date('D, M j, Y', strtotime(Auth::user()->created_at))}}</b></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                  </div><!-- end billing-content -->
                </div>
        	</div><!-- end billing-form-item -->
    	</div><!-- end col-lg-12 -->
	</div><!-- end row -->
</div>
	<script>
		let rows = []
		$('table tbody tr').each(function(i, row) {
			return rows.push(row);
		});
		function searchTable() {			
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("showTable");
            tr = table.getElementsByTagName("tr");
			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
				if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
				}
			}
		}
	</script>
@endsection