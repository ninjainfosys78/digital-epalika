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
                                    <i class="fas fa-clipboard-check avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup"> {{$totalRegistrations}}</span></h3>
                                <p class="text-muted font-15 mb-0">जम्मा दर्ताहरु</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-clipboard-check avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup"> {{$monthlyRegistrations}}</span></h3>
                                <p class="text-muted font-15 mb-0">मासिक दर्ताहरु</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-clipboard-check avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$weeklyRegistrations}}</span></h3>
                                <p class="text-muted font-15 mb-0">साप्ताहिक दर्ताहरु</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-clipboard-check avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$yearlyRegistrations}}</span></h3>
                                <p class="text-muted font-15 mb-0 text-truncate">वार्षिक दर्ताहरु</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> 
        </div>
    </div>
    {{-- <div class="row" id="charts" data-chart-url="{{route('admin.listRegistrations.dashboard')}}">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="applicantTypeWiseData" chart-type="pie" chart-title="चालु आ.व. आवेदक प्रकार अनुसारका सुची दर्ताहरु"></div>
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
                    <div id="businessNatureWiseData" chart-type="pie" chart-title="चालु आ.व. खरिद प्रकृति अनुसारका सुची दर्ताहरु"></div>
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
                    <div id="monthWise" chart-type="column" chart-title="चालु आ.व.को महिना अनुसारका सुची दर्ताहरु"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    
    <div class="row mt-2" id="charts"data-chart-url="{{route('admin.listRegistrations.dashboard.ajax')}}">

        <div class="col-md-6">
            <div class="card">
                <h4>
                    कुल राजस्व विवरण
                </h4>
                <div class="card-body">
                    <canvas id="applicantTypeWiseData" chart-type="pie"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    भुक्तानी अनुसार कुल राजस्व विवरण
                </h4>
                <div class="card-body">
                    <canvas id="businessNatureWiseData" chart-type="doughnut"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                    महिना अनुसार सूचना समाचार
                </h4>
                <div class="card-body">
                    <canvas id="monthWise" chart-type="bar"></canvas>
                </div>

            </div>
        </div>

    </div>

    @push('scripts')
    <script src="{{asset('assets/backend/js/chart.js')}}"></script>
    <script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
@endpush
@endsection

