@extends('admin.layouts.app')
@section('admin')
<div class="row">
  <div class="col-lg-12">
    <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
      <div class="section-heading">
        <h2 class="sec__title">Student Profile</h2>
      </div><!-- end section-heading -->
      <ul class="list-items d-flex align-items-center">
        <li class="active__list-item"><a href="#">Home</a></li>
        <li class="active__list-item">Dashboard</li>
        <li>Student</li>
      </ul>
    </div><!-- end breadcrumb-content -->
  </div><!-- end col-lg-12 -->
</div><!-- end row -->
<div class="breadcrumb-wrap">
  <div class="container text-black">
      <div class="row">
          <div class="col-lg-12">
              <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center text-left">
                  <div class="bread-details d-flex">
                      <div class="bread-img">
                          <img src="{{$student->avatar != null ? asset('uploads/profile_pictures/'.$student->avatar) : asset('web2/images/avatar.png')}}" alt="{{$student->first_name}} {{$student->last_name}}">
                      </div>
                      <div class="employer-content">
                          <h2 class="widget-title font-size-30  pb-1">{{$student->first_name}} {{$student->last_name}}</h2>
                          <p class="font-size-16 mt-1 ">
                            <span class="mr-2"><i class="fa fa-user mr-1"></i> {{$student->matric_number}}</span><br>
                            <span class="mr-2"><i class="fa fa-envelope mr-1"></i> {{$student->email}}</span><br>
                              <span class="mr-2"><i class="la la-phone mr-1"></i> {{$student->mobile != null ? $student->mobile : 'Not Uploaded'}}</span>
                          </span>
                          </p>
                    </div><!-- end employer-content -->
                  </div><!-- end bread-details -->
                  <div class="bread-action">
                      <ul class="">
                          <li>
                              <a href="{{ url('admin/edit-student', $student->id) }}" class="theme-btn border-0"><i class="la la-user font-size-16"></i> Edit Profile</a>
                          </li>
                      </ul>
                  </div><!-- end bread-action -->
              </div><!-- end breadcrumb-content -->
          </div><!-- end col-lg-12 -->
      </div><!-- end row -->
  </div><!-- end container -->
</div>
<div class="billing-content pb-0">                
    <div class="widget-inner">					
      <div class="">                    
        <div class="row mt-3">
          <div class="col-lg-12">
            <div class="sidebar-widget">
                <div class="billing-form-item">
                    <div class="billing-title-wrap">
                        <h3 class="widget-title">Student Details</h3>
                        <div class="title-shape"></div>
                    </div><!-- billing-title-wrap -->
                    <div class="billing-content">
                        <div class="info-list static-info">
                            <ul>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-user"></i> <span class="color-text-2 font-weight-medium mr-1">Matric Number: </span><b style="font-size:20px">{{$student->matric_number}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-envelope"></i> <span class="color-text-2 font-weight-medium mr-1">Email: </span><b style="font-size:20px">{{$student->email}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-envelope"></i> <span class="color-text-2 font-weight-medium mr-1">Mobile Number: </span><b style="font-size:20px">{{$student->mobile != null ? $student->mobile : 'Not Uploaded'}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Faculty: </span><b style="font-size:20px">{{$student->faculty->name}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Department: </span><b style="font-size:20px">{{$student->dept->name}}</b></li>   
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Level: </span><b style="font-size:20px">{{$student->level->name}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-clock-o"></i> <span class="color-text-2 font-weight-medium mr-1">Registerred On: </span> <b style="font-size:20px">{{ date('D, M j, Y', strtotime($student->created_at))}}</b></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="sidebar-widget">
                <div class="billing-form-item">
                    <div class="billing-title-wrap">
                        <h3 class="widget-title">Assignment History</h3>
                        <div class="title-shape"></div>
                    </div><!-- billing-title-wrap -->
                    <div class="billing-content">
                        
                    <div class="table-responsive">
                      @isset($students)                                	
                        @if ($students->isEmpty())
                          <div class="text-center mb-4">									
                            <h4>No Student Created yet</h4>
                          </div>								
                        @else
                          <table class="table paginated table-striped" id="myTable" width="100%">
                            <thead class="table-dark">
                              <tr>
                                <th>S/N</th>
                                <th>Matric Number</th>
                                <th>Student Name</th>
                                <th>Status</th>
                                <th>Faculty</th>
                                <th>Department</th>
                                <th class="">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)                                
                              <tr>
                                <td>{{$sn++}}</td>
                                <td>                                    
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15">
                                      <b>{{$student->email}}</b>
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td class="text-capitalize">
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15"><b><a class="text-success" href="{{ url('admin/view-student', $student->id) }}">{{$student->first_name}} {{$student->last_name}}</a></b></h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td>                                    
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15">
                                      @if ($student->status == 'Active')
                                          <span class="new-users-info"><span class="btn btn-success btn-sm">{{$student->status}}</span></span><br>   													
                                        @else
                                          <span class="new-users-info"><span class="btn btn-danger btn-sm">{{$student->status}}</span></span><br>   													
                                      @endif          
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td> 
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15">
                                      <b>{{$student->faculty->name}}</b>
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td> 
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15">
                                      <b>{{$student->dept->name}}</b>
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td>
                                  <!-- Example single danger button -->
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('admin/view-student', $student->id) }}"  title="View Student" class="btn btn-success m-1"><i class="la la-eye" data-toggle="tooltip" data-placement="top"></i></a>
                                    @if ($student->status == 'Active')
                                    <a href="{{ url('admin/block-student', $student->id) }}" title="Deny Access" onclick="return confirm('Are you sure you want to Deny Access for this Student?')" class="btn btn-danger m-1"><i class="la la-lock" data-toggle="tooltip" data-placement="top"></i></a>
                                    @else
                                    <a href="{{ url('admin/unblock-student', $student->id) }}" title="Grant Access" onclick="return confirm('Are you sure you want to  Grant this Student Access?')" class="btn btn-success m-1"><i class="la la-unlock" data-toggle="tooltip" data-placement="top"></i></a>
                                    @endif
                                    <a href="{{ url('admin/edit-student', $student->id) }}" title="Edit Student" class="btn btn-dark m-1"><i class="la la-pencil" data-toggle="tooltip" data-placement="top"></i></a>
                                    <a href="{{ url('admin/delete-student', $student->id) }}" title="Delete Student" class="btn btn-danger m-1" onclick="return confirm('Are you sure you want to delete this Student?')" ><i class="la la-trash" data-toggle="tooltip" data-placement="top"></i></a>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>		  
                          {{-- <div id="pagination" class="text-center" style="display:inline"></div> --}}
                        @endif
                      @endisset
                	  </div>
                    </div>
                </div>
            </div>
          </div>
        </div><!-- end col-lg-3 -->
      </div><!-- end billing-content -->
    </div>
</div><!-- end billing-form-item -->
@endsection