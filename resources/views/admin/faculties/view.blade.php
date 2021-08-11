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
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title">Faculty</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/faculties') }}">Faculties</a></li>
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
						<h3 class="widget-title pb-0">All Departments in Faculty of {{$faculty->name}} ({{$faculty->code}})</h3>
						<div class="title-shape margin-top-10px"></div>	
					</div>
				</div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">                
                <div class="widget-inner">
					
					<div class="">
						<div class="table-responsive">
							@isset($departments)                                	
								@if ($departments->isEmpty())
									<div class="text-center mb-4">							
										<h4>No Department Created yet for this Faculty</h4>
									</div>								
								@else
									<input type="text" id="myInput" onkeyup="searchTable()" placeholder="Search for Department name..">
									<table class="table paginated table-striped" id="showTable" width="100%">
										<thead class="table-dark">
											<tr>
												<th>S/N</th>
												<th>Department Name</th>
												<th>No. Of Course(s)</th>
												<th>Created On</th>
												<th class="">Action</th>
											</tr>
										</thead>
										<tbody>
										@foreach ($departments as $department)                                
											<tr>
												<td>{{$sn++}}</td>
												<td class="text-capitalize">
													<div class="manage-candidate-wrap">
														<h2 class="widget-title pb-0 font-size-15"><b><a class="text-success" href="{{ url('admin/view-department-level', $department->id) }}">{{ $department->name }}</a></b></h2>
													</div><!-- end manage-candidate-wrap -->
												</td>
												<td>                                    
													<div class="manage-candidate-wrap">
														<h2 class="widget-title pb-0 font-size-15">
															<b>{{$department->course_count}} Course(s)</b>
														</h2>
													</div><!-- end manage-candidate-wrap -->
												</td>
												<td>                                    
													<div class="manage-candidate-wrap">
														<h2 class="widget-title pb-0 font-size-15">
															{{  date('D, M j, Y', strtotime($department->created_at))}}
														</h2>
													</div><!-- end manage-candidate-wrap -->
												</td>
												<td class="text-center">
													<div class="manage-candidate-wrap">
														<div class="bread-action pt-0">
															<ul class="info-list">
																<li class="d-inline-block"><a href="{{ url('admin/view-department-level', $department->id) }}" ><i class="la la-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a></li>
															</ul>
														</div>
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