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
.card{
	border-radius: 10px;
	box-shadow: 0 0 25px 0 rgb(29 25 0 / 25%);
    border-radius: 4px;
    overflow: hidden;
}
.card:hover{
	border-radius: 10px;
	box-shadow: 0 0 25px 0 rgb(29 25 0 / 25%);
    border-radius: 4px;
    overflow: hidden;
	background-color: rgba(7, 146, 65, 0.647);
}
.card:hover .cours-bx .info-bx .text-success{
	color: black !important
}
.level{
	padding-bottom: 25px
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title">Department</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/departments') }}">Departments</a></li>
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
						<h3 class="widget-title pb-0">Department of {{$department->name}}</h3>
						<div class="title-shape margin-top-10px"></div>	
					</div>
				</div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">                
                <div class="widget-inner">
					<div class="row mb-3">
						@isset($levels)
						<tbody>
							@foreach ($levels as $level)  
								<div class="col-md-4 col-lg-3 col-sm-4 m-b30 level">
									<a href="{{ url('admin/view-dept-level/'.$department->faculty->id.'/'.$department->id, $level->level) }}">
										<div class="card pt-3 pb-3">
											<div class="cours-bx pt-4 pb-4">
												<div class="info-bx text-center pb-4 pt-4">
													<h3 class="text-success">{{ $level->name }}</h3>
												</div>
											</div>
										</div>
									</a>
								</div>
							@endforeach
						@endisset
					</div>
                </div>
        	</div><!-- end billing-form-item -->
    	</div><!-- end col-lg-12 -->
	</div><!-- end row -->
</div>
@endsection