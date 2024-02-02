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
                                    <i class="fas fa-id-card avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup"> {{$registrationDetailCount}}</span></h3>
                                <p class="text-muted font-15 mb-0">जम्मा सिफारिस</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-id-card avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$todayRegistrationDetailCount}}</span></h3>
                                <p class="text-muted font-15 mb-0 text-truncate">आज दर्ता भएका सिफारिस</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-user avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$totalPersonalDetailCount}}</span></h3>
                                <p class="text-muted font-15 mb-0">जम्मा व्यक्ति</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-file avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$totalYealyRegistrationDetailCount}}</span></h3>
                                <p class="text-muted font-15 mb-0">आर्थिक वर्षमा दर्ता भएका सिफारिस</p>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <div class="row mt-2" id="charts" data-chart-url="{{route('admin.recommendation.dashboard.ajax')}}">
    <div class="col-md-12">
        <div class="card">
            <h4>
                वडा अनुसार  सिफारिस दर्ता विवरण
            </h4>
            <div class="card-body">
                <canvas id="wardWiseRegistration" chart-type="bar"></canvas>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <h4>
                चालु आर्थिक(2080/081) वर्षका महिना अनुसार सिफारिस दर्ता विवरण
            </h4>
            <div class="card-body">
                <canvas id="monthlyWiseRegistration" chart-type="bar"></canvas>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                    विषय अनुसार सिफारिस विवरण
                </h4>
                <div class="card-body">
                    <canvas id="categoryWise" chart-type="doughnut"></canvas>
                </div>

            </div>
        </div>
    </div>
    </div>
    @push('scripts')
    <script src="{{asset('assets/backend/js/chart.js')}}"></script>
    <script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
    @endpush
@endsection
