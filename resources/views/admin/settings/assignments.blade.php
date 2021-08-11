@extends('admin.layouts.app')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title">Assignment</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/faculties') }}">Assignment</a></li>
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
                  <h3 class="widget-title pb-0">All Assignment</h3>
                  <div class="title-shape margin-top-10px"></div>	
                </div>
                <div class="col-2">
                </div>
              </div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">
                <div class="">
                    <div class="table-responsive">
                      @isset($assignments)                                	
                        @if ($assignments->isEmpty())
                          <div class="text-center mb-4">									
                            <h4>No Assignment submitted yet</h4>
                          </div>								
                        @else
                          <table class="table paginated table-striped" id="myTable" width="100%">
                            <thead class="table-dark">
                              <tr>
                                <th>S/N</th>
                                <th>Matric Number</th>
                                <th>Student Name</th>
                                <th>Faculty</th>
                                <th>Department</th>
                                <th>Level</th>
                                <th>Semester</th>
                                <th>Course</th>
                                <th class="">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($assignments as $assignment)                                
                              <tr>
                                <td>{{$sn++}}</td>
                                <td>                                    
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15">
                                      <b>{{$assignment->student->matric_number}}</b>
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td class="text-capitalize">
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15"><b>{{$assignment->student->first_name}} {{$assignment->student->last_name}}</b></h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td> 
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15">
                                      <b>{{$assignment->faculty->name}}</b>
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td> 
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15">
                                      <b>{{$assignment->dept->name}}</b>
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>
                                <td>                                    
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15"> 
                                      <b>{{$assignment->level->name}}</b>        
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td>  
                                <td>                                    
                                  <div class="manage-candidate-wrap">
                                    <h2 class="widget-title pb-0 font-size-15"> 
                                      <b>{{$assignment->semester->name}}</b>        
                                    </h2>
                                  </div><!-- end manage-candidate-wrap -->
                                </td><!-- end manage-candidate-wrap -->
                                <td>                                 
                                <div class="manage-candidate-wrap">
                                  <h2 class="widget-title pb-0 font-size-15"> 
                                    <b>{{$assignment->course->course_title}} {{ $assignment->course->course_code }}</b>        
                                  </h2>
                                </div>
                                </td>
                                <td>
                                  <!-- Example single danger button -->
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ asset('uploads/student_assignment/'.$assignment->assignment) }}" target="_blank" title="View Assignment" class="btn btn-success m-1" onclick="return confirm('Thee Assignment will be open in new Tab?')" ><i class="la la-eye" data-toggle="tooltip" data-placement="top"></i></a>                                  
                                    <a href="{{ url('admin/delete-assignment', $assignment->id) }}" title="Delete Assignment" class="btn btn-danger m-1" onclick="return confirm('Are you sure you want to delete this Student?')" ><i class="la la-trash" data-toggle="tooltip" data-placement="top"></i></a>
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
            	    </div><!-- end billing-content -->
        	    </div><!-- end billing-form-item -->
    	  </div><!-- end col-lg-12 -->
	    </div><!-- end row -->
</div>
@endsection