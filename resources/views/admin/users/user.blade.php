@extends('admin.layouts.app')
@section('admin')
<div class="row">
  <div class="col-lg-12">
    <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
      <div class="section-heading">
        <h2 class="sec__title">User's Profile</h2>
      </div><!-- end section-heading -->
      <ul class="list-items d-flex align-items-center">
        <li class="active__list-item"><a href="#">Home</a></li>
        <li class="active__list-item"><a href="#">Dashboard</a></li>
        <li>User's Profile</li>
      </ul>
    </div><!-- end breadcrumb-content -->
  </div><!-- end col-lg-12 -->
</div><!-- end row -->

<div class="row mt-5">
  <div class="col-lg-12">
    <div class="billing-form-item">
      <div class="billing-title-wrap">
        <h3 class="widget-title pb-0">{{$user->first_name}} {{$user->last_name}} Profile</h3>
        <div class="title-shape margin-top-10px"></div>
      </div><!-- billing-title-wrap -->
      <div class="billing-content pb-0">
        <div class="manage-job-wrap">
          <div class="row mb-5">
            <div class="col-lg-12 mb-2">
              <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
                <div class="bread-details d-flex">
                  <div class="bread-img flex-shrink-0">
                    <img src="{{ $user->avatar != null ? asset('uploads/profile_pictures/'.$user->avatar) : asset('web/images/avatar.png') }}" alt="">
                  </div>
                  <div class="job-detail-content">
                    <h2 class="widget-title font-size-30 text-black pb-1">{{$user->first_name}} {{$user->last_name}}</h2>
                    <p class="font-size-16 mt-1 text-black">
                      <span class="mr-2 mb-2 d-inline-block"><i class="la la-envelope mr-1"></i>{{$user->email}}</span>
                      <br>
                      <span class="mr-2 mb-2 d-inline-block"><i class="la la-phone mr-1"></i>{{$user->mobile ?? 'Not Uploaded'}}</span>
                      <br>
                      <span class="mr-2 mb-2 d-inline-block"><i class="la la-map-marker mr-1"></i>{{$user->address ?? 'Not Uploaded'}}</span>
                    </p>
                  </div><!-- end job-detail-content -->
                </div><!-- end bread-details -->
                <div class="bread-action">
                  <ul class="listing-info">
                  </ul>
                </div><!-- end bread-action -->
              </div><!-- end breadcrumb-content -->
            </div>
            <div class="col-lg-12">
              <div class="single-job-wrap">
                <div class="job-description padding-bottom-35px">
                  <h2 class="widget-title">Reviews:</h2>
                  <div class="title-shape"></div>
                  @if ($reviews->count() > 0)                      
                    @foreach ($reviews as $review)
                    <div class="media mb-4 mt-4">
                        <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object mr-3" style="width: auto; height: 50px;" src="{{ $review->employer->avatar != null ? asset('uploads/profile_pictures/'.$review->employer->avatar) : asset('web/images/avatar.png') }}" alt="{{$review->employer->first_name}}">
                        </a>
                        </div>
                        <div class="media-body">
                        <h5 class="media-heading">{{$review->employer->first_name}} {{$review->employer->last_name}}</h5>
                        <p>{{$review->review}}</p>
                        <small><i>{{ $review->created_at->diffForHumans() }}</i></small>
                        </div>
                    </div>
                    @endforeach
                  @else                      
                  <p class="mt-3 mb-3">
                      No Review Yet
                  </p>
                  @endif                  
                  @if (isset($review2))
                    @if ($reviews2->count() > 0)                      
                    @foreach ($reviews2 as $review22)
                    <div class="media mb-4 mt-4">
                        <div class="media-left media-middle">
                        <a href="#">
                            <img class="media-object mr-3" style="width: auto; height: 50px;" src="{{ $review2->care_giver->avatar != null ? asset('uploads/profile_pictures/'.$review->care_giver->avatar) : asset('web/images/avatar.png') }}" alt="{{$review->care_giver->first_name}}">
                        </a>
                        </div>
                        <div class="media-body">
                        <h5 class="media-heading">{{$review2->care_giver->first_name}} {{$review2->care_giver->last_name}}</h5>
                        <p>{{$review2->review}}</p>
                        <small><i>{{ $review2->created_at->diffForHumans() }}</i></small>
                        </div>
                    </div>
                    @endforeach
                    @else                      
                    <p class="mt-3 mb-3">
                        No Review Yet
                    </p>
                    @endif
                  @endif
                </div><!-- end job-description -->
              </div><!-- end single-job-wrap -->
            </div><!-- end col-lg-8 -->
            {{-- <div class="col-lg-5">
              <div class="sidebar mt-0">
                <div class="sidebar-widget">
                  <div class="billing-form-item mb-0">
                    <div class="billing-title-wrap">
                      <h3 class="widget-title">Job Details</h3>
                      <div class="title-shape"></div>
                    </div><!-- billing-title-wrap -->
                  </div>
                </div><!-- end sidebar-widget -->
              </div><!-- end sidebar -->
            </div><!-- end col-lg-4 --> --}}
          </div>
        </div>
      </div><!-- end billing-content -->
    </div><!-- end billing-form-item -->
  </div><!-- end col-lg-12 -->
</div><!-- end row -->
@endsection