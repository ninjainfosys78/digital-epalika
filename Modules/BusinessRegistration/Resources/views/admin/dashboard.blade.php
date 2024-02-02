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
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup"> {{$totalBusinessCount}}</span></h3>
                            <p class="text-muted font-15 mb-0">दर्ता भएका व्यवसायहरु</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-redo avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$businessRenewCount}}</span></h3>
                            <p class="text-muted font-15 mb-0">चालु
                                आ.व {{ $officeSetting->fiscalYear->title ?? '' }} मा जम्मा नविकरण</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-clipboard avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$totalBusinessDetailNatureCount}}</span></h3>
                            <p class="text-muted font-15 mb-0 text-truncate">व्यवसायको प्रकृतिहरु</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-clipboard avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$totalObjectTransactionCategoryCount}}</span></h3>
                            <p class="text-muted font-15 mb-0">कारोबार गर्ने वस्तु</p>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!--
<div class="row" id="charts" data-chart-url="{{route('admin.businessRegistration.dashboard')}}">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div id="businessRegistration" chart-type="pie" chart-title="आर्थिक वर्ष अनुसार व्यवसाय दर्ता विवरण"></div>
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
                <div id="businessNature" chart-type="pie" chart-title="व्यवसायको प्रकृति"></div>
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
                <div id="wardWise" chart-type="column" chart-title="चालु आर्थिक({{ $officeSetting->fiscalYear->title ?? '' }}) वर्षका वडा अनुसार  व्यवसाय दर्ता विवरण"></div>
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
                <div id="monthWise" chart-type="column" chart-title="चालु आर्थिक({{ $officeSetting->fiscalYear->title ?? '' }}) वर्षका महिना अनुसार व्यवसाय दर्ता विवरण"></div>
                <div class="loading">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="row mt-2" id="charts" data-chart-url="{{route('admin.businessRegistration.dashboard.ajax')}}">

    <div class="col-md-6">
        <div class="card">
            <h4>
                आर्थिक वर्ष अनुसार व्यवसाय दर्ता विवरण
            </h4>
            <div class="card-body">
                <canvas id="businessRegistration" chart-type="pie"></canvas>
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <h4>
                व्यवसायको प्रकृति
            </h4>
            <div class="card-body">
                <canvas id="businessNature" chart-type="doughnut"></canvas>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <h4>
                चालु आर्थिक(2080/081) वर्षका वडा अनुसार  व्यवसाय दर्ता विवरण
            </h4>
            <div class="card-body">
                <canvas id="wardWise" chart-type="bar"></canvas>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <h4>
                चालु आर्थिक(2080/081) वर्षका महिना अनुसार व्यवसाय दर्ता विवरण
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