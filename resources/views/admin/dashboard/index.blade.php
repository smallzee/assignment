@extends('admin.layouts.app')
@section('admin')    
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title line-height-45">Welcome, Admin!</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item">Admin</li>
                <li>Dashboard</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end col-lg-12 -->
</div><!-- end row -->
<div class="row mt-5">
    <div class="col-lg-3 column-lg-6 column-md-6">
        <div class="overview-item">
            <div class="icon-box bg-1 mb-0 d-flex align-items-center">
                <div class="icon-element flex-shrink-0">
                    <i class="la la-user"></i>
                </div><!-- end icon-element-->
                <div class="info-content">
                    <span class="info__count">
                        {{$lecturers}}
                    </span>
                    <h4 class="info__title font-size-16 mt-2">Lecturers</h4>
                </div><!-- end info-content -->
            </div>
        </div>
    </div><!-- end col-lg-3 -->
    <div class="col-lg-3 column-lg-6 column-md-6">
        <div class="overview-item">
            <div class="icon-box bg-2 mb-0 d-flex align-items-center">
                <div class="icon-element flex-shrink-0">
                    <i class="la la-users"></i>
                </div><!-- end icon-element-->
                <div class="info-content">
                    <span class="info__count">
                        {{$students}}
                    </span>
                    <h4 class="info__title font-size-16 mt-2">Students</h4>
                </div><!-- end info-content -->
            </div>
        </div>
    </div><!-- end col-lg-3 -->
    <div class="col-lg-3 column-lg-6 column-md-6">
        <div class="overview-item">
            <div class="icon-box bg-3 mb-0 d-flex align-items-center">
                <div class="icon-element flex-shrink-0">
                    <i class="la la-book"></i>
                </div><!-- end icon-element-->
                <div class="info-content">
                    <span class="info__count">
                        {{$faculty}}
                    </span>
                    <h4 class="info__title font-size-16 mt-2">Faculty</h4>
                </div><!-- end info-content -->
            </div>
        </div>
    </div><!-- end col-lg-3 -->
    <div class="col-lg-3 column-lg-6 column-md-6">
        <div class="overview-item">
            <div class="icon-box bg-4 mb-0 d-flex align-items-center">
                <div class="icon-element flex-shrink-0">
                    <i class="la la-book"></i>
                </div><!-- end icon-element-->
                <div class="info-content">
                    <span class="info__count">
                        {{$departments}}
                    </span>
                    <h4 class="info__title font-size-16 mt-2">Departments</h4>
                </div><!-- end info-content -->
            </div>
        </div>
    </div><!-- end col-lg-3 -->
    <div class="col-lg-3 column-lg-6 column-md-6">
        <div class="overview-item">
            <div class="icon-box bg-5 mb-0 d-flex align-items-center">
                <div class="icon-element flex-shrink-0">
                    <i class="la la-book"></i>
                </div><!-- end icon-element-->
                <div class="info-content">
                    <span class="info__count">
                        {{$course}}
                    </span>                        
                    <h4 class="info__title font-size-16 mt-2">Courses</h4>
                </div><!-- end info-content -->
            </div>
        </div>
    </div><!-- end col-lg-3 -->    
    <div class="col-lg-3 column-lg-6 column-md-6">
        <div class="overview-item">
            <div class="icon-box bg-6 mb-0 d-flex align-items-center">
                <div class="icon-element flex-shrink-0">
                    <i class="la la-book"></i>
                </div><!-- end icon-element-->
                <div class="info-content">
                    <span class="info__count">
                        {{$assignment}}
                    </span>
                    <h4 class="info__title font-size-16 mt-2">Assignments</h4>
                </div><!-- end info-content -->
            </div>
        </div>
    </div><!-- end col-lg-3 -->
</div><!-- end row -->
<div class="row mt-2">
    <div class="col-12"> 
        <div class="billing-form-item">
            <div class="billing-title-wrap">
                <h3 class="widget-title pb-0">Faculties</h3>
                <div class="title-shape margin-top-10px"></div>
            </div><!-- billing-title-wrap -->       
            <div class="billing-content pb-0">
                <div class="manage-faculty-wrap">
                    <div class="table-responsive">                    
                        @isset($faculties)                                	
                            @if ($faculties->isEmpty())
                            <div class="text-center">									
                                <h4>No Faculty yet</h4>
                            </div>								
                            @else
                                <table class="table table-striped" id="" width="100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Faculty Name</th>
                                            <th>Faculty Code</th>
                                            <th>Created On</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($faculties as $faculty)                                
                                        <tr>
                                            <td>{{$sn++}}</td>
                                            <td class="text-capitalize">
                                                <div class="manage-candidate-wrap">
                                                    <h2 class="widget-title pb-0 font-size-15"><b><a class="text-success" href="{{ url('admin/view-faculty', $faculty->id) }}">{{ $faculty->name }}</a></b></h2>
                                                </div><!-- end manage-candidate-wrap -->
                                            </td>
                                            <td>                                    
                                                <div class="manage-candidate-wrap">
                                                    <h2 class="widget-title pb-0 font-size-15 text-secondary">
                                                        <b>{{$faculty->code}}</b>
                                                    </h2>
                                                </div><!-- end manage-candidate-wrap -->
                                            </td>
                                            <td>                                    
                                                <div class="manage-candidate-wrap">
                                                    <h2 class="widget-title pb-0 font-size-15">
                                                        {{  date('D, M j, Y', strtotime($faculty->created_at))}}
                                                    </h2>
                                                </div><!-- end manage-candidate-wrap -->
                                            </td>
                                            <td class="text-center">
                                                <div class="manage-candidate-wrap">
                                                    <div class="bread-action pt-0">
                                                        <ul class="info-list">
                                                            <li class="d-inline-block"><a href="{{ url('admin/view-faculty', $faculty->id) }}" ><i class="la la-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a></li>
                                                            <li class="d-inline-block"><a href="{{ url('admin/edit-faculty', $faculty->id) }}" ><i class="la la-pencil" data-toggle="tooltip" data-placement="top" title="View"></i></a></li>
                                                            <li class="d-inline-block"><a href="{{ url('admin/delete-faculty', $faculty->id) }}" onclick="return confirm('Are you sure you want to delete this Faculty?')" ><i class="la la-trash" data-toggle="tooltip" data-placement="top" title="View"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endisset
                    </div>
                </div>
            </div><!-- end billing-content -->
        </div>
    </div>
</div><!-- end row -->
@endsection