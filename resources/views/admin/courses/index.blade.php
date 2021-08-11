@extends('admin.layouts.app')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title">Courses</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item"><a href="#">Dashboard</a></li>
                <li>Courses</li>
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
						<h3 class="widget-title pb-0">All Courses</h3>
						<div class="title-shape margin-top-10px"></div>	
					</div>
					<div class="col-2">						
						<div class="text-right">
							<a href="{{ url('admin/create-course') }}" class="btn btn-success">Add New</a>
						</div>
					</div>
				</div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">                
                <div class="widget-inner">
					
					<div class="">
						<div class="table-responsive">
							@isset($courses)                                	
								@if ($courses->isEmpty())
									<div class="text-center mb-4">							
										<h4>No Course Created for yet</h4>
									</div>								
								@else								
									<table class="table paginated table-striped" id="myTable" width="100%">
										<thead class="table-dark">
											<tr>
												<th scope="col">#</th>
												<th scope="col">Course Name</th>
												<th scope="col">Course Code</th>
												<th scope="col">Level</th>
												<th scope="col">Semester</th>
												<th scope="col">Department</th>
												<th scope="col">Faculty</th>
												<th scope="col">Created On</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>			
											@foreach ($courses as $course)
											  <tr>
												<th scope="row">{{$sn++}}</th>
												<td class="text-capitalize"><b>{{ $course->course_title }}</b></td>
												<td><b>{{ $course->course_code }}</b></td>
												<td>{{ $course->level_get->name }}</td>
												<td>{{ $course->semester_get->name }}</td>
												@if (isset($course->dept->name))
													<td>Department of {{ $course->dept->name }}</td>											
												@else
													<td>Faculty Course</td>							
												@endif
												<td>Faculty of {{ $course->faculty->name }} ({{ $course->faculty->code }})</td>
												<td><span class="orders-info">Created On: {{ date('D, M j, Y \a\t g:ia', strtotime($course->created_at))}}</span></td>
												<td>
													
												<div class="btn-group" role="group" aria-label="Basic example">
													@if ($course->dept == null)
															<a href="{{ url('admin/view-course/'.$course->faculty->id.'/0/'.$course->level_get->id.'/'.$course->semester_get->id, $course->id) }}" class="btn btn-success m-1"><i class="la la-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
														@else
															<a href="{{ url('admin/view-course/'.$course->faculty->id.'/'.$course->dept->id.'/'.$course->level_get->id.'/'.$course->semester_get->id, $course->id) }}" class="btn btn-success m-1"><i class="la la-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>													
													@endif
													<a href="{{ url('admin/edit-course', $course->id) }}" class="btn btn-dark m-1"><i class="la la-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
													<a href="{{ url('admin/delete-course', $course->id) }}" class="btn btn-danger m-1" onclick="return confirm('Are you sure you want to delete this Course?')" ><i class="la la-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
												</div>

													{{-- <a href="{{ url('admin/edit-course', $course->id) }}" class="btn button-sm green" title="Edit"><span class="fa fa-pencil"></span></a>
													<a href="{{ url('admin/view-course', $course->id) }}" class="btn button-sm green" title="View"><span class="fa fa-eye"></span></a>
													<a href="{{ url('admin/delete-course', $course->id) }}" onclick="return confirm('Are you sure you want to delete this course?')" class="btn button-sm red" title="Delete"><span class="fa fa-trash"></span></a> --}}
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
                </div>
        	</div><!-- end billing-form-item -->
    	</div><!-- end col-lg-12 -->
	</div><!-- end row -->
</div>
	<script>
		let rows = []
		$('table tbody tr').each(function(i, row) {
			return rows.push(row);
		});
		function searchTable() {			
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("showTable");
            tr = table.getElementsByTagName("tr");
			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
				if (td) {
				txtValue = td.textContent || td.innerText;
				if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
				}
			}
		}
	</script>
@endsection