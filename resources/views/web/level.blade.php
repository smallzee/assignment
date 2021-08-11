@extends('web.layouts.app')
@section('content')
<style>
    .cours-bx:hover{
	border-radius: 10px;
	box-shadow: 0 0 25px 0 rgb(29 25 0 / 25%);
    border-radius: 4px;
    overflow: hidden;
	background-color: rgba(7, 146, 65, 0.647);
}
</style>
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('web/assets/images/slider/futo.jpg')}});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white text-uppercase">{{$department->name}}</h1>
             </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="#" class="text-capitalize">{{$department->faculty->name}} ({{$department->faculty->code}})</a></li>
                <li class="text-capitalize">{{$department->name}}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area section-sp1">
            <div class="container">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            @foreach ($levels as $level)
                            <div class="col-md-4 col-lg-3 col-sm-4 m-b30">
                                <a href="{{ url('level/'.$department->faculty->id.'/'.$department->id, $level->id) }}">
                                    <div class="cours-bx pt-4 pb-4">
                                        <div class="info-bx text-center">
                                            <h5>{{$level->name}}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area END -->
    
</div>
@endsection