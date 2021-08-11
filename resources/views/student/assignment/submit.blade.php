@extends('student.layouts.app')
@section('student')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Submit Assignment</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Submit Assignment</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Submit Assignment</h4>
						</div>
						<div class="widget-inner">
							<form class="edit-profile m-b30" method="POST" action="{{ route('submit_assgnment') }}" enctype="multipart/form-data">
								@csrf
								<div class="">
									<div class="form-group row">
										<div class="col-sm-10  ml-auto">
											{{-- <h3>1. Personal Details</h3> --}}
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Faculty</label>
										<div class="col-sm-7">
                      <select disabled class="form-control" name="faculty_id">
                        @isset($faculties)
                          @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{Auth::user()->faculty_id == $faculty->id ? "selected" : ''}}>{{ $faculty->name }} ({{ $faculty->code }})</option>                            
                          @endforeach                          
                        @endisset
                      </select>
											{{-- <span class="help">If you want your invoices addressed to a company. Leave blank to use your full name.</span> --}}
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Department</label>
										<div class="col-sm-7">
                      <select disabled class="form-control" name="dept_id">
                        @isset($departments)
                          @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{Auth::user()->dept_id == $department->id ? "selected" : ''}}>{{ $department->name }}</option>                            
                          @endforeach                          
                        @endisset
                      </select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Level</label>
										<div class="col-sm-7">
                      <select disabled class="form-control" name="level_id">
                        @isset($levels)
                          @foreach ($levels as $level)
                            <option value="{{ $level->id }}" {{Auth::user()->level_id == $level->id ? "selected" : ''}}>{{ $level->name }}</option>                            
                          @endforeach                          
                        @endisset
                      </select>
											@error('level_id')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Semester</label>
										<div class="col-sm-7">
                      <select class="form-control" name="semester_id" id="semester_id" onchange="getCourse(this)">
                        @isset($semesters)
                          @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}" {{Auth::user()->semester_id == $semester->id ? "selected" : ''}}>{{ $semester->name }}</option>                            
                          @endforeach                          
                        @endisset
                      </select>
											@error('semester_id')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Course</label>
										<div class="col-sm-7">
                      <select class="form-control" name="course_id" id="course_id">
                        {{-- @isset($courses)
                          @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_title }} ({{ $course->course_code }})</option>                            
                          @endforeach                          
                        @endisset --}}
                      </select>
											<span class="invalid-feedback mb-2" role="alert" style="display: block">
													<strong id="course_error"></strong>
											</span>
											@error('course_id')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>									
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Assignment</label>
										<div class="col-sm-7">
											<input type="file" name="assignment" accept=".xlsx,.xls,image/*,.txt,.pdf,.docx,.doc">
											{{-- <input type="file" name="assignment" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf"> --}}
											@error('assignment')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
                </div>                                
								<div class="">
									<div class="">
										<div class="row">
											<div class="col-sm-2">
											</div>
											<div class="col-sm-7">
												<button type="submit" class="btn">Submit</button>
												{{-- <button type="reset" class="btn-secondry">Cancel</button> --}}
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
	<script>
		$(function () {
		var semester_id = $('#semester_id :selected').val();
		var semester_text = $('#semester_id :selected').text();
			$.ajax({
            type: "POST",
            url: "{{ url('student/fetch-course') }}",
            data: {"_token": "{{ csrf_token() }}","semester_id":semester_id},
            success: function (response) {  
                console.log(response)
                if(response != ""){
									$("#course_error").text('');
                  $("#course_id").attr('disabled', false);
                  $("#course_id").find('option').remove();
                  $.each(response, function(key, value)
                  {
                      $("#course_id").append('<option class="text-capitalize" value=' + value.id + '>' + value.course_title + ' ('+value.course_code+')</option>');
                  });
                }else{
									$("#course_error").text('No Course yet for the '+semester_text)
									console.log('Null')
								}
            }
        });
		});
		 function getCourse(sel)
        {
            //alert(sel.value);
            $.ajax({
            type: "POST",
            url: "{{ url('student/fetch-course') }}",
            data: {"_token": "{{ csrf_token() }}","semester_id":sel.value},
            success: function (response) {
                if(response != ""){
									$("#course_error").text('');
                  $("#course_id").attr('disabled', false);
                  $("#course_id").find('option').remove();
                  $.each(response, function(key, value)
                  {
                      $("#course_id").append('<option class="text-capitalize" value=' + value.id + '>' + value.course_title + ' ('+value.course_code+')</option>');
                  });
                }else{
									$("#course_error").text('No Course yet for the selected semester')
								}
            }
        });
        }
	</script>
@endsection