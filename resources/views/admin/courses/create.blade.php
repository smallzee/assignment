@extends('admin.layouts.app')
@section('admin')
<style>
  /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #188d25;
}

input:focus + .slider {
  box-shadow: 0 0 1px #188d25;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title">Add New Course</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item"><a href="#">Dashboard</a></li>
                <li>Add New Course</li>
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
                      @isset($course)
                          <h3 class="widget-title pb-0">Edit Course</h3>
                        @else
                          <h3 class="widget-title pb-0">Add New Course</h3>
                      @endisset
          <div class="title-shape margin-top-10px"></div>	
        </div>
      </div>
          </div><!-- billing-title-wrap -->
          <div class="billing-content pb-0">                
              <div class="widget-inner">
                  <div class="contact-form-action mb-4">
                      <form class="edit-profile m-b30" id="" method="POST" action="{{ route('admin_create_course') }}">
                          @csrf
                          <div class="">
                              @isset($department) 
                                  <input type="hidden" name="id" value="{{ $department->id }}">
                              @endisset
                              @isset($course)                              
                              <input type="hidden" name="course_id" value="{{ $course->id }}">
                              @endisset
                              <!--Faculty Course -->                       
                              <div class="form-group row mb-4">
                                  <label class="col-sm-2 col-form-label">Faculty Course</label>
                                  <div class="col-sm-10">                                      
                                    <label class="switch">
                                      <input type="checkbox" name="check" @isset($course) {{ $course->department_id == "0" ? 'checked' : '' }} @else {{ old('check') == "on" ? 'checked' : '' }} @endisset onclick="test()" id="toggle">
                                      <span class="slider round pb-4"></span>
                                    </label>
                                  </div>
                              </div>
                              <!--Select Faculty --> 
                              <div class="form-group row mb-4">
                                  <label class="col-sm-2 col-form-label">Select Faculty</label>
                                  <div class="col-sm-10">
                                    <select class="form-control faculty-option-field" id="faculty" name="faculty_id" onchange="getDept(this)">
                                      <option value="">Open this select menu</option>
                                      @foreach ($faculties as $faculty)
                                      <option class="text-capitalize" @isset($course) {{ $course->faculty_id == $faculty->id ? "selected" : "" }} @else {{ old('faculty_id') == $faculty->id ? "selected" : "" }} @endisset value="{{$faculty->id}}">{{$faculty->name}} ({{$faculty->code}})</option>                                                
                                      @endforeach
                                    </select>
                                    @error('faculty_id')
                                      <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                              </div>		
                              <!--Select Department --> 
                              <div class="form-group row mb-4" id="dept">
                                  <label class="col-sm-2 col-form-label">Select Department</label>
                                  <div class="col-sm-10">
                                    <select id="department" name="department_id" id="department" class="form-control department-option-field">
                                      <option value="">Open this select menu</option>
                                      @foreach ($departments as $department)
                                      <option class="text-capitalize" @isset($course) {{ $course->department_id == $department->id ? "selected" : "" }} @else {{ old('department_id') == $department->id ? "selected" : "" }} @endisset value="{{$department->id}}">{{$department->name}}</option>                                                
                                      @endforeach
                                    </select>
                                    @error('department_id')
                                      <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                              </div>	
                              <!--Select Level --> 
                              <div class="form-group row mb-4">
                                  <label class="col-sm-2 col-form-label">Select Level</label>
                                  <div class="col-sm-10">
                                    <select class="form-control level-option-field" id="level" name="level">
                                      <option value="">Open this select menu</option>
                                      @foreach ($levels as $level)
                                      <option class="text-capitalize" @isset($course) {{ $course->level == $level->level ? "selected" : "" }} @else {{ old('level') == $level->level ? "selected" : "" }} @endisset  @isset($course) value="{{ $course->level }}" @else value="{{$level->level}}" @endisset >{{$level->name}}</option>                                                
                                      @endforeach
                                    </select>
                                    @error('level')
                                      <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                              </div>			
                              <!--Select Semester --> 
                              <div class="form-group row mb-4">
                                  <label class="col-sm-2 col-form-label">Select Semester</label>
                                  <div class="col-sm-10">
                                    <select class="form-control semester-option-field" name="semester" id="semester">
                                      <option value="">Open this select menu</option>
                                      @foreach ($semesters as $semester)
                                      <option class="text-capitalize" @isset($course) {{ $course->semester == $semester->semester ? "selected" : "" }} @else {{ old('semester') == $semester->semester ? "selected" : "" }} @endisset   @isset($course) value="{{ $course->semester }}" @else  value="{{$semester->semester}}"  @endisset>{{$semester->name}}</option>                                                
                                      @endforeach
                                    </select>
                                    @error('semester')
                                      <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                              </div>	
                              <!--Course Title --> 
                              <div class="form-group row mb-4">
                                  <label class="col-sm-2 col-form-label">Course Title</label>
                                  <div class="col-sm-10">
                                    <input type="type" name="course_title" class="form-control" @isset($course) value="{{ $course->course_title }}" @else value="{{ old('course_title') }}"  @endisset placeholder="Course Title">
                                    @error('course_title')
                                      <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                              </div>	
                              <!--course Code --> 
                              <div class="form-group row mb-4">
                                  <label class="col-sm-2 col-form-label">Course Code</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="course_code" class="form-control" @isset($course) value="{{ $course->course_code }}" @else value="{{ old('course_code') }}" @endisset placeholder="Course Code">
                                    @error('course_code')
                                      <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                              </div>				
                              <div class="seperator"></div>
                          </div>
                          
                          <div class="">
                              <div class="">
                                  <div class="row">
                                      <div class="col-sm-2">
                                      </div>
                                      <div class="col-sm-7">
                                          <button type="submit" class="theme-btn border-0">
                                              @isset($course)
                                                  Update
                                                  @else
                                                  Submit
                                              @endisset
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
        </div><!-- end billing-form-item -->
    </div><!-- end col-lg-12 -->
</div><!-- end row -->
</div>
<input type="hidden" id="toggle_check">
	<script>
    
    if (document.getElementById('toggle').checked) {
        document.getElementById("dept").style.display = 'none';
        document.getElementById("department").disabled = true;  
        document.getElementById("toggle_check").value = 1;  
      } else {
        document.getElementById("dept").style.display = 'flex';
        document.getElementById("department").disabled = false; 
        document.getElementById("toggle_check").value = 0;  
      }
    function test(){
       if (document.getElementById('toggle').checked) {
         console.log('none')
        document.getElementById("dept").style.display = 'none';
        document.getElementById("department").disabled = true; 
        document.getElementById("toggle_check").value = 1;  
      } else {
         console.log('show')
        document.getElementById("dept").style.display = 'flex';
        document.getElementById("department").disabled = false;  
        document.getElementById("toggle_check").value = 0;
      }
    }
        
        function getDept(sel)
        {
            //alert(sel.value);
            $.ajax({
            type: "POST",
            url: "{{ url('admin/fetch-dept') }}",
            data: {"_token": "{{ csrf_token() }}","id":sel.value},
            success: function (response) {  
                // console.log(response)
                var get = $("#toggle_check").val();
                console.log(get)
                if(get == 0){
                  $("#department").attr('disabled', false);
                  $("#department").find('option').remove();
                  $.each(response, function(key, value)
                  {
                      $("#department").append('<option class="text-capitalize" value=' + value.id + '>' + value.name + '</option>');
                  });
                }
            }
        });
        }
	</script>
@endsection