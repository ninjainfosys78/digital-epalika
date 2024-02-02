{{--@extends('admin.layouts.master')--}}
{{--@section('content')--}}
{{-- <div class="row mt-2">--}}
{{-- <div class="col-12">--}}
{{-- <div class="page-title-box">--}}
{{-- <div class="page-title-right">--}}
{{-- <ol class="breadcrumb m-0">--}}
{{-- <li class="breadcrumb-item">--}}
{{-- <a href="{{route('admin.grant.dashboard')}}">--}}
{{-- <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
गृहपृष्ठ--}}
{{-- </a>--}}
{{-- </li>--}}
{{-- <li class="breadcrumb-item">--}}
{{-- <a href="{{route('admin.grant.dashboard')}}">अनुदान व्यवस्थापन</a>--}}
{{-- </li>--}}
{{-- </ol>--}}
{{-- </div>--}}
{{-- <h4 class="page-title">गृहपृष्ठ </h4>--}}
{{-- </div>--}}

{{-- <div class="row">--}}
{{-- <div class="col-md-2">--}}
{{-- <div class="widget-rounded-circle card-primary">--}}
{{-- <div class="card-body" style="padding: 10px 20px;">--}}
{{-- <div class="row">--}}
{{-- <div class="col">--}}
{{-- <div class="avatar-lg rounded-circle bg-light border">--}}
{{-- <h3 class="mt-1 text-center"><span data-plugin="counterup">--}}
{{-- {{count(\Modules\Grant\Entities\Farmer::all())}}--}}
{{-- </span>--}}
{{-- </h3>--}}
{{-- </div>--}}
{{-- <p class="text my-1">जम्मा कृषकहरु</p>--}}
{{-- </div>--}}
{{-- </div> <!-- end row-->--}}
{{-- </div>--}}
{{-- </div> <!-- end widget-rounded-circle-->--}}
{{-- </div> <!-- end col-->--}}

{{-- <div class="col-md-2">--}}
{{-- <div class="widget-rounded-circle card-secondary">--}}
{{-- <div class="card-body" style="padding: 10px 20px;">--}}
{{-- <div class="row">--}}
{{-- <div class="col">--}}
{{-- <div class="avatar-lg rounded-circle bg-light border">--}}
{{-- <h3 class="mt-1 text-center"><span data-plugin="counterup">--}}
{{-- {{count(\Modules\Grant\Entities\Cooperative::all())}}--}}
{{-- </span>--}}
{{-- </h3>--}}
{{-- </div>--}}
{{-- <p class="text my-1">जम्मा सहकारीहरु</p>--}}
{{-- </div>--}}
{{-- </div> <!-- end row-->--}}
{{-- </div>--}}
{{-- </div> <!-- end widget-rounded-circle-->--}}
{{-- </div> <!-- end col-->--}}

{{-- <div class="col-md-2">--}}
{{-- <div class="widget-rounded-circle card-primary" >--}}
{{-- <div class="card-body" style="padding: 10px 20px;">--}}
{{-- <div class="row">--}}
{{-- <div class="col">--}}
{{-- <div class="avatar-lg rounded-circle bg-light border">--}}
{{-- <h3 class="mt-1 text-center"><span data-plugin="counterup">--}}
{{-- {{count(\Modules\Grant\Entities\Group::all())}}--}}
{{-- </span></h3>--}}
{{-- </div>--}}
{{-- <p class="text my-1">जम्मा समूहहरु</p>--}}
{{-- </div>--}}
{{-- </div> <!-- end row-->--}}
{{-- </div>--}}
{{-- </div> <!-- end widget-rounded-circle-->--}}
{{-- </div> <!-- end col-->--}}
{{-- <div class="col-md-2">--}}
{{-- <div class="widget-rounded-circle card-secondary">--}}
{{-- <div class="card-body" style="padding: 10px 20px;">--}}
{{-- <div class="row">--}}
{{-- <div class="col">--}}
{{-- <div class="avatar-lg rounded-circle bg-light border">--}}
{{-- <h3 class="mt-1 text-center"><span data-plugin="counterup">--}}
{{-- {{count(\Modules\Grant\Entities\Enterprise::all())}}--}}
{{-- </span></h3>--}}
{{-- </div>--}}
{{-- <p class="text my-1">जम्मा उद्यमहरु</p>--}}
{{-- </div>--}}
{{-- </div> <!-- end row-->--}}
{{-- </div>--}}
{{-- </div> <!-- end widget-rounded-circle-->--}}
{{-- </div> <!-- end col-->--}}
{{-- <div class="col-md-2">--}}
{{-- <div class="widget-rounded-circle card-primary" >--}}
{{-- <div class="card-body" style="padding: 10px 20px;">--}}
{{-- <div class="row">--}}
{{-- <div class="col">--}}
{{-- <div class="avatar-lg rounded-circle bg-light border">--}}
{{-- <h3 class="mt-1 text-center">--}}
{{-- <span data-plugin="counterup">--}}
{{-- {{count(\Modules\Grant\Entities\GrantDetail::all())}}--}}
{{-- </span></h3>--}}
{{-- </div>--}}
{{-- <p class="text my-1">जारी भएका अनुदान</p>--}}
{{-- </div>--}}
{{-- </div> <!-- end row-->--}}
{{-- </div>--}}
{{-- </div> <!-- end widget-rounded-circle-->--}}
{{-- </div> <!-- end col-->--}}
{{-- <div class="col-md-2">--}}
{{-- <div class="widget-rounded-circle card-secondary">--}}
{{-- <div class="card-body" style="padding: 10px 20px;">--}}
{{-- <div class="row">--}}
{{-- <div class="col">--}}
{{-- <div class="avatar-lg rounded-circle bg-light border">--}}
{{-- <h3 class="mt-1 text-center">--}}
{{-- <span data-plugin="counterup">--}}
{{-- {{count(\Modules\Grant\Entities\Grant::all())}}--}}
{{-- </span></h3>--}}
{{-- </div>--}}
{{-- <p class="text my-1">जम्मा अनुदान कार्यक्रम</p>--}}
{{-- </div>--}}
{{-- </div> <!-- end row-->--}}
{{-- </div>--}}
{{-- </div> <!-- end widget-rounded-circle-->--}}
{{-- </div> <!-- end col-->--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--@endsection--}}


@extends('admin.layouts.master')
@section('content')
<div class="row mt-2">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-building avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup"> {{$farmers_count}}</span></h3>
                            <p class="text-muted font-15 mb-0">जम्मा कृषकहरु</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-redo avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$cooperative_count}}</span></h3>
                            <p class="text-muted font-15 mb-0">जम्मा सहकारीहरु</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-clipboard avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$groups_count}}</span></h3>
                            <p class="text-muted font-15 mb-0 text-truncate">जम्मा समूहहरु </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-clipboard avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$enterprise_count}}</span></h3>
                            <p class="text-muted font-15 mb-0">जम्मा उद्यमहरु </p>
                        </div>
                    </div>

                    {{-- <div class="col-sm-6 col-xl-3">--}}
                    {{-- <div class="d-flex flex-column align-items-center">--}}
                    {{-- <div class="avatar-sm bg-blue rounded-circle">--}}
                    {{-- <i class="fas fa-clipboard avatar-title font-18 text-white"></i>--}}
                    {{-- </div>--}}
                    {{-- <h3 class="mb-0 mt-1"><span--}}
                    {{-- data-plugin="counterup">{{$grant_detail_count}}</span></h3>--}}
                    {{-- <p class="text-muted font-15 mb-0">जारी भएका अनुदान  </p>--}}
                    {{-- </div>--}}
                    {{-- </div>--}}

                    {{-- <div class="col-sm-6 col-xl-3">--}}
                    {{-- <div class="d-flex flex-column align-items-center">--}}
                    {{-- <div class="avatar-sm bg-blue rounded-circle">--}}
                    {{-- <i class="fas fa-clipboard avatar-title font-18 text-white"></i>--}}
                    {{-- </div>--}}
                    {{-- <h3 class="mb-0 mt-1"><span--}}
                    {{-- data-plugin="counterup"></span></h3>--}}
                    {{-- <p class="text-muted font-15 mb-0">जम्मा अनुदान कार्यक्रम </p>--}}
                    {{-- </div>--}}
                    {{-- </div>--}}
                </div> <!-- end row -->
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

<!-- <div class="row" id="charts" data-chart-url="{{route('admin.grant.dashboard')}}">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="wardWiseData" chart-type="column"
                         chart-title="चालु आर्थिक ({{ $officeSetting->fiscalYear->title ?? '' }}) तथा वडा अनुसार जारि अनुदान"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="grant" chart-type="column"
                         chart-title="चालु आर्थिक ({{ $officeSetting->fiscalYear->title ?? '' }}) अनुसार जारि अनुदान"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> -->

    <div class="row mt-2" id="charts" data-chart-url="{{route('admin.grant.dashboard.ajax')}}">
        <div class="col-md-12">
            <div class="card">
                <h4>
                   चालु आर्थिक (2080/081) तथा वडा अनुसार जारि अनुदान
                </h4>
                <div class="card-body">
                    <canvas id="wardWiseData" chart-type="bar"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                   चालु आर्थिक (2080/081) अनुसार जारि अनुदान
                </h4>
                <div class="card-body">
                    <canvas id="grant" chart-type="line"> </canvas>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{asset('assets/backend/js/chart.js')}}"></script>
    <script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
@endpush
@endsection