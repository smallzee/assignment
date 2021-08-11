@extends('admin.layouts.app')
@section('admin')
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
						<h3 class="widget-title pb-0">All Departments</h3>
						<div class="title-shape margin-top-10px"></div>	
					</div>
					<div class="col-2">						
						<div class="text-right">
							<a href="{{ url('admin/create-department') }}" class="btn btn-success">Add New</a>
						</div>
					</div>
				</div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">
                <div class="">
                    <div class="table-responsive">
						@isset($departments)                                	
							@if ($departments->isEmpty())
								<div class="text-center mb-4">									
									<h4>No Department Created yet</h4>
								</div>								
							@else
								<table class="table paginated table-striped" id="myTable" width="100%">
									<thead class="table-dark">
										<tr>
											<th>S/N</th>
											<th>Department Name</th>
											<th width="20%">Faculty</th>
											<th>No. Of Course(s)</th>
											<th>Created On</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									@foreach ($departments as $department)                                
										<tr>
											<td>{{$sn++}}</td>
											<td class="text-capitalize">
												<div class="manage-candidate-wrap">
													<h2 class="widget-title pb-0 font-size-15"><b><a class="text-success" href="{{  url('admin/view-department-level', $department->id) }}">{{ $department->name }}</a></b></h2>
												</div><!-- end manage-candidate-wrap -->
											</td>
											<td>                                    
												<div class="manage-candidate-wrap">
													<h2 class="widget-title pb-0 font-size-15 text-secondary">
														{{ $department->faculty->name }} ({{ $department->faculty->code }})
													</h2>
												</div><!-- end manage-candidate-wrap -->
											</td>
											<td>                                    
												<div class="manage-candidate-wrap">
													<h2 class="widget-title pb-0 font-size-15 text-secondary">
														{{$department->course_count}} Course(s)
													</h2>
												</div><!-- end manage-candidate-wrap -->
											</td>
											<td>                                    
												<div class="manage-candidate-wrap">
													<h2 class="widget-title pb-0 font-size-15 text-secondary">
														{{  date('D, M j, Y', strtotime($department->created_at))}}
													</h2>
												</div><!-- end manage-candidate-wrap -->
											</td>
											<td class="">
												<!-- Example single danger button -->
												<div class="btn-group" role="group" aria-label="Basic example">
													<a href="{{ url('admin/view-department-level', $department->id) }}" class="btn btn-success m-1"><i class="la la-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
													<a href="{{ url('admin/edit-department', $department->id) }}" class="btn btn-dark m-1"><i class="la la-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
													<a href="{{ url('admin/delete-department', $department->id) }}"class="btn btn-danger m-1" onclick="return confirm('Are you sure you want to delete this Faculty?')" ><i class="la la-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
												</div>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							@endif
						@endisset
                	</div>
            	</div><!-- end billing-content -->
        	</div><!-- end billing-form-item -->
    	</div><!-- end col-lg-12 -->
	</div><!-- end row -->
</div>
@endsection