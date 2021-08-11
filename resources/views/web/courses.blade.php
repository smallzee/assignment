@extends('web.layouts.app')
@section('content')
<style>
  .cours-bx:hover{
	border-radius: 10px;
	box-shadow: 0 0 25px 0 rgb(29 25 0 / 25%);
    border-radius: 4px;
    overflow: hidden;
	background-color: rgba(7, 146, 65, 0.647);
}
</style>
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('web/assets/images/slider/futo.jpg')}});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white text-uppercase">{{$department->name}}</h1>
             </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="#" class="text-capitalize">{{$department->faculty->name}} ({{$department->faculty->code}})</a></li>
                <li><a href="#" class="text-capitalize">{{$department->name}}</a></li>
                <li class="text-capitalize">{{$level->name}}</li>
                <li class="text-capitalize">{{$semester->name}}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area section-sp1">
            <div class="container">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                          @isset($courses)                            
                            @if($courses->count() > 0)
                              <table class="table">
                                <thead>
                                  <tr>
                                    <td>S/N</td>
                                    <td>Course Title</td>
                                    <td>Course Code</td>
                                    <td>Action</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  @isset($courses)
                                    @foreach ($courses as $course)
                                      <tr>
                                        <td>{{ $sn++ }}</td>
                                        <td>{{ $course->course_title }}</td>
                                        <td>{{ $course->course_code }}</td>
                                        <td>
                                          <a href="{{ url('student/submit-assignment') }}" class="btn btn-success">Submit Assignment</a>
                                        </td>
                                      </tr>
                                    @endforeach
                                  @endisset
                                </tbody>
                              </table>
                            @else 
                            <h5 class="ml-3 mr-3">No Courses available yet For Department of {{$department->name}} - {{$level->name}} under Faculty of {{$department->faculty->name}}  ({{$department->faculty->code}})</h5>                             
                            @endif
                          @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area END -->
    
</div>
@endsection