@extends('admin.layouts.app')
@section('admin')
<div class="row">
	<div class="col-lg-12">
			<div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
					<div class="section-heading">
							<h2 class="sec__title">Edit Student</h2>
					</div><!-- end section-heading -->
					<ul class="list-items d-flex align-items-center">
							<li class="active__list-item"><a href="#">Home</a></li>
							<li class="active__list-item"><a href="{{ url('admin') }}">Dashboard</a></li>
							<li><a href="{{ url('admin/faculties') }}">Edit Student</a></li>
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
								<h3 class="widget-title pb-0">Edit Student</h3>
								<div class="title-shape margin-top-10px"></div>	
							</div>
							<div class="col-2">						
								<div class="text-right">
									<a href="{{ url('admin/students') }}" class="btn btn-success">All Student</a>
								</div>
							</div>
						</div>
					</div><!-- billing-title-wrap -->
					<div class="billing-content pb-0">
							<div class="">								          
								<div class="row mt-3">
									<div class="col-lg-12">
										<div class="sidebar-widget">
												<div class="billing-form-item">
														<div class="billing-title-wrap">
																<h3 class="widget-title">{{ $student->first_name }} {{ $student->last_name }} Details</h3>
																<div class="title-shape"></div>
														</div><!-- billing-title-wrap -->
														<div class="billing-content">														
															<div class="contact-form-action mb-4">
																<form class="edit-profile m-b30" id="" method="POST" action="{{ route('admin_create_student') }}">
																		@csrf
                                    @isset($student->id)
                                      <input type="hidden"  name="id" value="{{ $student->id }}">
                                    @endisset
																		<div class="">
																				<!--Select Faculty --> 
																				<div class="form-group row mb-4">
																						<label class="col-sm-2 col-form-label">Select Faculty</label>
																						<div class="col-sm-10">
																							<select class="form-control faculty-option-field" id="faculty" name="faculty_id" onchange="getDeptSingle(this)">
																								<option value="">Open this select menu</option>
																								@foreach ($faculties as $faculty)
																								<option class="text-capitalize" @isset($student) {{ $student->faculty_id == $faculty->id ? "selected" : "" }} @else {{ old('faculty_id') == $faculty->id ? "selected" : "" }} @endisset value="{{$faculty->id}}">{{$faculty->name}} ({{$faculty->code}})</option>                                                
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
																						<label class="col-sm-2 col-form-label">Select Dept.</label>
																						<div class="col-sm-10">
																							<select name="department_id" id="department_single" class="form-control department-option-field">
																								<option value="">Open this select menu</option>
																								@foreach ($departments as $department)
																								<option class="text-capitalize" @isset($student) {{ $student->dept_id == $department->id ? "selected" : "" }} @else {{ old('department_id') == $department->id ? "selected" : "" }} @endisset value="{{$department->id}}">{{$department->name}}</option>                                                
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
																							<select class="form-control level-option-field" id="level_single" name="level_id">
																								<option value="">Open this select menu</option>
																								@foreach ($levels as $level)
																								<option class="text-capitalize" @isset($student) {{ $student->level_id == $level->level ? "selected" : "" }} @else {{ old('level_id') == $level->level ? "selected" : "" }} @endisset  @isset($course) value="{{ $course->level }}" @else value="{{$level->level}}" @endisset >{{$level->name}}</option>                                                
																								@endforeach
																							</select>
																							@error('level_id')
																								<span class="invalid-feedback mb-2" role="alert" style="display: block">
																									<strong>{{ $message }}</strong>
																								</span>
																							@enderror
																						</div>
																				</div>			
																				<!--Select Semester --> 
																				<div class="form-group row mb-4">
																						<label class="col-sm-2 col-form-label">Matric No.</label>
																						<div class="col-sm-10">
																							<input class="form-control @error('matric_number') is-invalid @enderror" name="matric_number" type="text" @isset($student) value="{{ $student->matric_number }}" @else value="{{ old('matric_number') }}" @endisset placeholder="Student Matic Number">
																							@error('matric_number')
																								<span class="invalid-feedback mb-2" role="alert" style="display: block">
																									<strong>{{ $message }}</strong>
																								</span>
																							@enderror
																						</div>
																				</div>	
																				<div class="form-group row mb-4">
																						<label class="col-sm-2 col-form-label">Email</label>
																						<div class="col-sm-10">
																							<input class="form-control @error('email') is-invalid @enderror" name="email" type="email" @isset($student) value="{{ $student->email }}" @else value="{{ old('email') }}" @endisset placeholder="Student Email">
																							@error('email')
																								<span class="invalid-feedback mb-2" role="alert" style="display: block">
																									<strong>{{ $message }}</strong>
																								</span>
																							@enderror
																						</div>
																				</div>	
																				<div class="form-group row mb-4">
																						<label class="col-sm-2 col-form-label">First Name</label>
																						<div class="col-sm-10">
																							<input class="form-control @error('first_name') is-invalid @enderror" name="first_name" type="text" @isset($student) value="{{ $student->first_name }}" @else value="{{ old('first_name') }}" @endisset placeholder="Student First Name">
																							@error('first_name')
																								<span class="invalid-feedback mb-2" role="alert" style="display: block">
																									<strong>{{ $message }}</strong>
																								</span>
																							@enderror
																						</div>
																				</div>	
																				<div class="form-group row mb-4">
																						<label class="col-sm-2 col-form-label">Last Name</label>
																						<div class="col-sm-10">
																							<input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" @isset($student) value="{{ $student->last_name }}" @else value="{{ old('last_name') }}" @endisset placeholder="Student Last Name">
																							@error('last_name')
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
																											Update Student
																										</button>
																								</div>
																						</div>
																				</div>
																		</div>
																</form>
															</div>
														</div>
												</div>
										</div>
									</div>
								</div><!-- end col-lg-3 -->
								</div><!-- end billing-content -->
						</div><!-- end billing-form-item -->
			</div><!-- end col-lg-12 -->
		</div><!-- end row -->
</div>
<script>
			function getDeptSingle(sel)
			{
					//alert(sel.value);
					$.ajax({
					type: "POST",
					url: "{{ url('admin/fetch-dept') }}",
					data: {"_token": "{{ csrf_token() }}","id":sel.value},
					success: function (response) {  
							console.log(response)
								$("#department_single").attr('disabled', false);
								$("#department_single").find('option').remove();
								$.each(response, function(key, value)
								{
										$("#department_single").append('<option class="text-capitalize" value=' + value.id + '>' + value.name + '</option>');
								});
					}
			});
			}
</script>
@endsection