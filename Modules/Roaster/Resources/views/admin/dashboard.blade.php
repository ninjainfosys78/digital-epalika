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
                                    <i class="fas fa-chalkboard-teacher avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup"> {{ $trainerCount }}</span></h3>
                                <p class="text-muted font-15 mb-0">प्रसिक्षकहरु</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-hands-helping avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{ $trainingCount }}</span></h3>
                                <p class="text-muted font-15 mb-0 text-truncate">तालिमहरु</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-users avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{ $traineeCount }}</span></h3>
                                <p class="text-muted font-15 mb-0">प्रशिक्षार्थीहरु</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-users-cog avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{ $technicalTraineeCount }}</span></h3>
                                <p class="text-muted font-15 mb-0">प्रभिधिक प्रशिक्षार्थीहरु</p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

    {{-- <div class="row" id="charts" data-chart-url="{{route('admin.roaster.dashboard')}}">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="trainerAccordingToSubject" chart-type="pie" chart-title="बिषय अनुसार तालिमहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="trainingAccordingToType" chart-type="pie" chart-title="चालु आ.व.को प्रकार अनुसार तालिमहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="trainingAccordingToMonth" chart-type="column" chart-title="चालु आ.व.को महिना अनुसार तालिमहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="trainerAccordingToDepartment" chart-type="pie" chart-title="सेवा समूह अनुसार प्रसिक्षकहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="trainingAccordingToFiscalYear" chart-type="column" chart-title="आर्थिक वर्ष अनुसार तालिमहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row mt-2" id="charts" data-chart-url="{{ route('admin.roaster.dashboard.ajax') }}">

        <div class="col-md-6">
            <div class="card">
                <h4>
                    विषय अनुसार तालिमहरु
                </h4>
                <div class="card-body">
                    <canvas id="trainerAccordingToSubject" chart-type="pie"></canvas>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h4>
                    चालु आ.व.को प्रकार अनुसार तालिमहरु
                </h4>
                <div class="card-body">
                    <canvas id="trainingAccordingToFiscalYear" chart-type="pie"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                    चालु आ.व.को महिना अनुसार तालिमहरु
                </h4>
                <div class="card-body">
                    <canvas id="trainingAccordingToMonth" chart-type="bar"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    सेवा समूह अनुसार प्रसिक्षकहरु
                </h4>
                <div class="card-body">
                    <canvas id="trainerAccordingToDepartment" chart-type="pie"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    आर्थिक वर्ष अनुसार तालिमहरु
                </h4>
                <div class="card-body">
                    <canvas id="trainingAccordingToType" chart-type="bar"></canvas>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/backend/js/chart.js') }}"></script>
        <script type="module" src="{{ asset('assets/backend/js/chartInit.js') }}"></script>
    @endpush
@endsection
