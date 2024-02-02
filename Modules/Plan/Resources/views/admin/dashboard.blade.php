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
                                    <i class="fas fa-briefcase avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$not_started_project_count}}</span></h3>
                                <p class="text-muted font-15 mb-0">शुरु नभएका योजनाहरु</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-briefcase avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$in_progress_project_count}}</span></h3>
                                <p class="text-muted font-15 mb-0 text-truncate">चालु योजनाहरु</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-briefcase avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$completed_project_count}}</span></h3>
                                <p class="text-muted font-15 mb-0">सम्पन्न योजनाहरू</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-briefcase avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$deadline_extended_project_count}}</span></h3>
                                <p class="text-muted font-15 mb-0">म्याद थप योजनाहरु</p>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    {{-- <div class="row mt-2" id="charts" data-chart-url="{{route('admin.plan.dashboard')}}">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="budgetHeadWiseProjects" chart-type="pie" chart-title="चालु आर्थिक({{ $officeSetting->fiscalYear->title ?? '' }}) वर्षका बजेट शिर्षक अनुसारका सम्पूर्ण योजनाहरु"></div>
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
                    <div id="planLevelWiseProjects" chart-type="pie" chart-title="चालु आर्थिक({{ $officeSetting->fiscalYear->title ?? '' }}) वर्षका योजना स्तर अनुसारका योजनाहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="planAreaWiseProjects" chart-type="column" chart-title="चालु आर्थिक({{ $officeSetting->fiscalYear->title ?? '' }}) वर्षका योजनाको क्षेत्रअनुसारका सम्पूर्ण योजनाहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="wardWiseProjects" chart-type="column" chart-title="चालु आर्थिक({{ $officeSetting->fiscalYear->title ?? '' }}) वर्षका वडा अनुसार योजनाहरुको विवरण"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">
                <h4>
                    महिना अनुसार सूचना समाचार
                </h4>
                <div class="card-body">
                    <canvas id="barChart1"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    चालु आर्थिक वर्षाका वडा अनुसार जम्मा सिफारिस विवरण
                </h4>
                <div class="card-body">
                    <canvas id="steppedlineChart"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h4>
                    कुल राजस्व विवरण
                </h4>
                <div class="card-body">
                    <canvas id="doughNut1"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h4>
                    भुक्तानी अनुसार कुल राजस्व विवरण
                </h4>
                <div class="card-body">
                    <canvas id="pieChart1"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h4>
                    विषय अनुसार तालिम विवरण
                </h4>
                <div class="card-body">
                    <canvas id="polarAreaChart1"></canvas>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-6">
            <div class="card">
                <h4>
                    आर्थिक वर्ष अनुशारको घरनाक्स विवरण
                </h4>
                <div class="card-body">
                    <canvas id="barChartHorizontal" height="170"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <h4>
                    आर्थिक वर्ष अनुसार व्यवसाय विवरण
                </h4>
                <div class="card-body">
                    <canvas id="lineChart1" height="170"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-6">
            <div class="card">
                <h4>
                    वर्ग अनुसार अपांगता विवरण
                </h4>
                <div class="card-body">
                    <canvas id="bubbleChart" ></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <h4>
                    चालु अर्थिक अनुसार दर्ता/चलानी विवरण
                </h4>
                <div class="card-body">
                    <canvas id="barChart2" height="170"></canvas>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{asset('assets/backend/js/chart.js')}}"></script>
    <script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
@endpush
@endsection
