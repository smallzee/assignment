@extends('admin.layouts.app')
@section('admin')    
<div class="row">
    <div class="col-lg-12">
        <div class="breadcrumb-content d-flex flex-wrap justify-content-between align-items-center">
            <div class="section-heading">
                <h2 class="sec__title line-height-45">Users</h2>
            </div><!-- end section-heading -->
            <ul class="list-items d-flex align-items-center">
                <li class="active__list-item"><a href="#">Home</a></li>
                <li class="active__list-item">Dashboard</li>
                <li>Users</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end col-lg-12 -->
</div><!-- end row -->
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="billing-form-item">
            <div class="billing-title-wrap">
                <h3 class="widget-title pb-0">All Users</h3>
                <div class="title-shape margin-top-10px"></div>
            </div><!-- billing-title-wrap -->
            <div class="billing-content pb-0">
                <div class="manage-job-wrap">
                    <div class="table-responsive">
                        <table class="table" id="myTable" width="100%">
                            <thead>
                            <tr>
                                <th>User Details</th>
                                <th>Type</th>
                                <th>Date Registered</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="bread-details d-flex">
                                                <div class="bread-img flex-shrink-0">
                                                    <a href="{{ url('admin/user-profile', $user->id) }}" class="d-block">
                                                        @if ($user->avatar != null)
                                                        <img src="{{ asset('uploads/profile_pictures/'.$user->avatar) }}" alt="" style="max-height: 110px">                                                            
                                                        @else
                                                        <img src="{{ asset('web/images/avatar.png') }}" alt="">                                                            
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="manage-candidate-content">
                                                    <h2 class="widget-title pb-2"><a href="{{ url('admin/user-profile', $user->id) }}" class="color-text-2">{{$user->first_name}} {{$user->last_name}}</a></h2>
                                                    <p class="font-size-15">
                                                        <span class="mr-2"><i class="la la-mail-bulk mr-1"> {{$user->email}} </i></span>
                                                    </p>
                                                    <p class="font-size-15">
                                                        <span class="mr-2"><i class="la la-phone mr-1"> {{$user->mobile ?? 'Not Uploaded'}}</i></span>
                                                    </p>
                                                    <p class="mt-2 font-size-15">
                                                        <span class="mr-2"><i class="la la-map-marker mr-1"></i>{{$user->city ?? 'Not Uploaded'}}, </span>
                                                        <span class="mr-2">{{$user->address ?? 'Not Uploaded'}}</span>
                                                    </p>
                                                </div><!-- end manage-candidate-content -->
                                            </div>
                                        </td>
                                        <td>
                                            @if ($user->type == 1)
                                                <span class="badge badge-success note-badge note-badge-bg-2 p-2">Employer</span>
                                            @elseif ($user->type == 2)
                                                <span class="badge badge-success note-badge note-badge-bg-2 p-2">Care Giver</span>
                                            @endif
                                        </td>
                                        <td>{{  date('D, M j, Y \a\t g:ia', strtotime($user->created_at))}}</td>
                                        <td>
                                            @if ($user->status == 'Active')
                                                <span class="badge badge-success note-badge note-badge-bg-2 p-2">{{$user->status}}</span>
                                            @elseif ($user->status == 'Blocked' || $user->status == 'Deleted')
                                                <span class="badge badge-danger note-badge note-badge-bg-2 p-2">{{$user->status}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="manage-candidate-wrap">
                                                <div class="bread-action pt-0">
                                                    <ul class="info-list">
                                                        <li class="d-inline-block"><a href="{{ url('admin/user-profile', $user->id) }}"><i class="la la-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a></li>
                                                        <li class="d-inline-block"><a href="#"><i class="la la-trash" data-toggle="modal" data-target="#delete{{$user->id}}" data-placement="top" title="" data-original-title="Delete"></i></a></li>
                                                        @if ($user->status == 'Active')
                                                        <li class="d-inline-block"><a href="{{ url('admin/block-user', $user->id) }}"><i class="la la-lock" data-toggle="tooltip" data-placement="top" title="" data-original-title="Block"></i></a></li>                                                            
                                                        @elseif ($user->status == 'Blocked')
                                                        <li class="d-inline-block"><a href="{{ url('admin/unblock-user', $user->id) }}"><i class="la la-unlock" data-toggle="tooltip" data-placement="top" title="" data-original-title="Unblock"></i></a></li>                                                            
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body mt-2 mb-2 text-center">
                                                    <h2>Are you sure you want to delete this User?</h2>
                                                <form method="POST" action="{{ url('admin/delete-user') }}">
                                                    @csrf                                                        
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn btn-success m-2">Yes</button> 
                                                    <button type="button" class="btn btn-dark m-2" data-dismiss="modal" aria-label="Close">No</button>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- end billing-form-item -->
    </div><!-- end col-lg-12 -->
</div><!-- end row -->

@endsection