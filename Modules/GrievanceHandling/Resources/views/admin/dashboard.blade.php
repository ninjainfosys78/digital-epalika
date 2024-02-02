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
                                    <i class="fas fa-comment-alt avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$grievanceCount}}</span></h3>
                                <p class="text-muted font-15 mb-0">प्राप्त गुनासोहरु</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-comment-dots avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$registeredGrievanceCount}}</span>
                                </h3>
                                <p class="text-muted font-15 mb-0 text-truncate">दर्ता भएका गुनासोहरु</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-comment-slash avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$closedGrievanceCount}}</span>
                                </h3>
                                <p class="text-muted font-15 mb-0">फर्छ्यौट भएका</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-comment-medical avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span
                                        data-plugin="counterup">{{$investigatedGrievanceCount}}</span></h3>
                                <p class="text-muted font-15 mb-0">अनुसन्धान गरिदै</p>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
   {{-- <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <div class="avatar-md bg-info rounded-circle">
                                <i class="fas fa-comment avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="text-end">
                                <h3 class="my-1"><span data-plugin="counterup">{{ $seenGrievanceCount }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">हेरिएको गुनासोहरु</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <div class="avatar-md bg-info rounded-circle">
                                <i class="fas fa-comment-slash avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="text-end">
                                <h3 class="my-1"><span data-plugin="counterup">{{ $unseenGrievanceCount }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">नहेरिएका गुनासोहरु</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <div class="avatar-md bg-info rounded-circle">
                                <i class="fas fa-comment-alt avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="text-end">
                                <h3 class="my-1"><span data-plugin="counterup">{{ $publicGrievanceCount }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">सार्वजनिक गुनासोहरु</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div>
    </div>--}}
    {{-- <div class="row" id="charts" data-chart-url="{{route('admin.grievanceHandling.dashboard')}}">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div id="dataAccordingToGrievanceType" chart-type="pie" chart-title="गुनासोको प्रकार अनुसार"></div>
                <div class="loading">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="row mt-2" id="charts" data-chart-url="{{route('admin.grievanceHandling.dashboard.ajax')}}">

        <div class="col-md-6">
            <div class="card">
                <h4>
                    गम्भिरता अनुसार गुनासो विवरण
                </h4>
                <div class="card-body">
                    <canvas id="grievanceCountAccordingToSeverity" chart-type="pie"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    स्थिति अनुसार गुनासो  विवरण
                </h4>
                <div class="card-body">
                    <canvas id="grievanceCountAccordingToStatus" chart-type="doughnut"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    विषय अनुसार  गुनासो विवरण
                </h4>
                <div class="card-body">
                    <canvas id="dataAccordingToGrievanceType" chart-type="polarArea"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                   
                    तथ्याङ्क अनुसार गुनासो विवरण
                </h4>
                <div class="card-body">
                    <canvas id="dataAccordingToGrievanceOffice" chart-type="doughnut"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                    महिना अनुसार  गुनासोहरु
                </h4>
                <div class="card-body">
                    <canvas id="getDataAccordingToMonth" chart-type="bar"></canvas>
                </div>

            </div>
        </div>

    </div>

    @push('scripts')
        <script src="{{asset('assets/backend/js/chart.js')}}"></script>
        <script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
    @endpush
@endsection
