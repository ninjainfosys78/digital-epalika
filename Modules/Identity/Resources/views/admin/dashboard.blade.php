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
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup"> {{$disabilityIdentityCardCount}}</span></h3>
                            <p class="text-muted font-15 mb-0">जम्मा अपांग</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-redo avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$seniorCitizenDetailCount}}</span></h3>
                            <p class="text-muted font-15 mb-0">जम्मा जेष्ठ नागरिक</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-clipboard avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$fiscalYearWiseDisabilityCount}}</span></h3>
                            <p class="text-muted font-15 mb-0 text-truncate">आर्थिक {{ $officeSetting->fiscalYear->title ?? '' }} मा जम्मा अपांग</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-clipboard avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$fiscalYearWiseSeniorCitizenDetail}}</span></h3>
                            <p class="text-muted font-15 mb-0">आर्थिक {{ $officeSetting->fiscalYear->title ?? '' }} मा जम्मा जेष्ठ नागरिक </p>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

<!-- <div class="row" id="charts" data-chart-url="{{route('identity.admin.dashboard')}}">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="wardWise" chart-type="column"
                         chart-title="चालु आर्थिक ({{ $officeSetting->fiscalYear->title ?? '' }})   अनुसार अपाङ्गताको विवरण"></div>
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
                    <div id="SeniorDetailWardWise" chart-type="column"
                         chart-title="चालु आर्थिक ({{ $officeSetting->fiscalYear->title ?? '' }})अनुसार जेष्ठ नागरिक को विवरण"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row mt-2" id="charts" data-chart-url="{{route('identity.admin.dashboard.ajax')}}">        
        <div class="col-md-12">
            <div class="card">
                <h4>
                    चालु आर्थिक (2080/081) अनुसार अपाङ्गताको विवरण
                </h4>
                <div class="card-body">
                    <canvas id="wardWise" chart-type="bar"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                    चालु आर्थिक (2080/081)अनुसार जेष्ठ नागरिक को विवरण
                </h4>
                <div class="card-body">
                    <canvas id="SeniorDetailWardWise" chart-type="bar"></canvas>
                </div>

            </div>
        </div>

    </div>

    @push('scripts')
        <script src="{{asset('assets/backend/js/chart.js')}}"></script>
        <script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
    @endpush
@endsection