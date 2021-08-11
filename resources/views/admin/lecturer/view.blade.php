@extends('admin.layouts.app')
@section('admin')
<div class="row">
  <div class="col-lg-12">
    <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
      <div class="section-heading">
        <h2 class="sec__title">Lecturer Profile</h2>
      </div><!-- end section-heading -->
      <ul class="list-items d-flex align-items-center">
        <li class="active__list-item"><a href="#">Home</a></li>
        <li class="active__list-item">Dashboard</li>
        <li>Lecturer Profile</li>
      </ul>
    </div><!-- end breadcrumb-content -->
  </div><!-- end col-lg-12 -->
</div><!-- end row -->
<div class="breadcrumb-wrap">
  <div class="container text-black">
      <div class="row">
          <div class="col-lg-12">
              <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center text-left">
                  <div class="bread-details d-flex">
                      <div class="bread-img">
                          <img src="{{$lecturer->avatar != null ? asset('uploads/profile_pictures/'.$lecturer->avatar) : asset('web2/images/avatar.png')}}" alt="{{$lecturer->first_name}} {{$lecturer->last_name}}">
                      </div>
                      <div class="employer-content">
                          <h2 class="widget-title font-size-30  pb-1">{{$lecturer->first_name}} {{$lecturer->last_name}}</h2>
                          <p class="font-size-16 mt-1 ">
                            <span class="mr-2"><i class="fa fa-user mr-1"></i> {{$lecturer->matric_number}}</span><br>
                            <span class="mr-2"><i class="fa fa-envelope mr-1"></i> {{$lecturer->email}}</span><br>
                              <span class="mr-2"><i class="la la-phone mr-1"></i> {{$lecturer->mobile != null ? $lecturer->mobile : 'Not Uploaded'}}</span>
                          </span>
                          </p>
                    </div><!-- end employer-content -->
                  </div><!-- end bread-details -->
                  <div class="bread-action">
                      <ul class="">
                          <li>
                              <a href="{{ url('admin/edit-lecturer', $lecturer->id) }}" class="theme-btn border-0"><i class="la la-user font-size-16"></i> Edit Profile</a>
                          </li>
                      </ul>
                  </div><!-- end bread-action -->
              </div><!-- end breadcrumb-content -->
          </div><!-- end col-lg-12 -->
      </div><!-- end row -->
  </div><!-- end container -->
</div>
<div class="billing-content pb-0">                
    <div class="widget-inner">					
      <div class="">                    
        <div class="row mt-3">
          <div class="col-lg-12">
            <div class="sidebar-widget">
                <div class="billing-form-item">
                    <div class="billing-title-wrap">
                        <h3 class="widget-title">Lecturer Details</h3>
                        <div class="title-shape"></div>
                    </div><!-- billing-title-wrap -->
                    <div class="billing-content">
                        <div class="info-list static-info">
                            <ul>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-user"></i> <span class="color-text-2 font-weight-medium mr-1">Lecturer ID: </span><b style="font-size:20px">{{$lecturer->matric_number}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-envelope"></i> <span class="color-text-2 font-weight-medium mr-1">Lecturer Email: </span><b style="font-size:20px">{{$lecturer->email}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-envelope"></i> <span class="color-text-2 font-weight-medium mr-1">Lecturer Mobile Number: </span><b style="font-size:20px">{{$lecturer->mobile != null ? $lecturer->mobile : 'Not Uploaded'}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Lecturer Faculty: </span><b style="font-size:20px">{{$lecturer->faculty->name}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Lecturer Department: </span><b style="font-size:20px">{{$lecturer->dept->name}}</b></li>   
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-book"></i> <span class="color-text-2 font-weight-medium mr-1">Level: </span><b style="font-size:20px">{{$lecturer->level->name}}</b></li>
                              <li class="mb-3 d-flex align-items-center"><p><i class="la la-clock-o"></i> <span class="color-text-2 font-weight-medium mr-1">Registerred On: </span> <b style="font-size:20px">{{ date('D, M j, Y', strtotime($lecturer->created_at))}}</b></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div><!-- end col-lg-3 -->
      </div><!-- end billing-content -->
    </div>
</div><!-- end billing-form-item -->
@endsection