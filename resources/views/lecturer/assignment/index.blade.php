@extends('lecturer.layouts.app')
@section('lecturer')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Assignments</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Assignments</li>
				</ul>
			</div>	
			<div class="row">
                <div class="text-center">                    
                    @if (session('success'))
                    <div class="alert alert-success font-weight-700">
                        {{ session('success') }}
                        <a href="#" style="float:right;" class="alert-close" data-dismiss="alert">&times;</a>
                    </div>
                @endif
                </div>
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h2>All Submitted Assignments for {{ $lecturer->course->course_title }} ({{ $lecturer->course->course_code }})</h2>
						</div>
						
						<div class="widget-inner">
							<div class="orders-list">
                                <table class="table" id="myTable" width="100%">
                                    <thead style="font-weight:bolder">
                                        <tr>                                            
                                            <td>S/N</td>
                                            <td>Matric Number</td>
                                            <td>Student Name</td>
                                            <td>Course</td>
                                            <td>Semester</td>
                                            <td>Assignment</td>
                                            <td>Date submitted</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($assignments)                                            
                                            @foreach ($assignments as $assignment)                                            
                                                <tr>        
                                                    <td>{{$sn++}}</td>                           
                                                    <td><b>{{$assignment->student->matric_number}}</b></td>  
                                                    <td><b>{{$assignment->student->first_name}} {{ $assignment->student->last_name }}</b></td>       
                                                    <td><b>{{$assignment->course->course_title}} ({{ $assignment->course->course_code }})</b></td>
                                                    <td><b>{{$assignment->semester->name ?? '0'}}</b></td>
                                                    <td><a href="{{ asset('uploads/student_assignment/'.$assignment->assignment) }}" target="_blank" class="btn btn-sm btn-success">View</a></td>
                                                    <td>{{ date('D, M j, Y', strtotime($assignment->created_at))}}</td>
                                                    <td><a href="{{ url('lecturer/delete-assignment', $assignment->id) }}" onclick="return confirm('Are you sure you want to delete this Assignment?')" class="btn btn-sm btn-danger" >Delete</a></td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>                                   
							</div>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
@endsection