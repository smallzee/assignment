@extends('admin.layouts.app')
@section('admin')
<style>
	#myInput {
                background-image: url('/css/searchicon.png'); /* Add a search icon to input */
                background-position: 10px 12px; /* Position the search icon */
                background-repeat: no-repeat; /* Do not repeat the icon image */
                width: 100%; /* Full-width */
                font-size: 16px; /* Increase font-size */
                padding: 12px 20px 12px 40px; /* Add some padding */
                border: 1px solid #ddd; /* Add a grey border */
                margin-bottom: 12px; /* Add some space below the input */
                border-radius: 10px;
}

label.error {
    color: red;
    font-size: 1rem;
    display: block;
    margin-top: 5px;
}

input.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title">Departments</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item"><a href="#">Dashboard</a></li>
                <li>Departments</li>
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
                        @isset($department)
						    <h3 class="widget-title pb-0">Edit Department</h3>
                            @else
                            <h3 class="widget-title pb-0">Create New Department</h3>
                        @endisset
						<div class="title-shape margin-top-10px"></div>	
					</div>
				</div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">                
                <div class="widget-inner">
                    <div class="contact-form-action mb-4">
                        <form class="edit-profile m-b30" id="departmentForm" method="POST" action="{{ route('admin_create_department') }}">
                            @csrf
                            <div class="">
                                @isset($department) 
                                    <input type="hidden" name="id" value="{{ $department->id }}">
                                @endisset                                
                                <div class="form-group row mb-4">
                                    <label class="col-sm-2 col-form-label">Choose Faculty</label>
                                    <div class="col-sm-10">
                                        <select class="faculty-option-field @error('faculty_id') is-invalid @enderror" name="faculty_id">
                                            <option value="">Select Faculty</option>
                                            @foreach ($faculties as $faculty)
                                                <option value="{{$faculty->id}}" @isset($department) {{$department->faculty_id == $faculty->id ? "selected" : ''}} @endisset>{{$faculty->name}} ({{$faculty->code}})</option>													
                                            @endforeach
                                        </select>
                                        @error('faculty_id')
                                            <span class="invalid-feedback mb-2" role="alert" style="display: block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-2 col-form-label">Department Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required @isset($department) value="{{ $department->name }}" @else value="{{ old('name') }}" @endisset placeholder="School of Agriculture and Agricultural Technology">
                                        @error('name')
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
                                                @isset($department)
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
@endsection