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
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup"> {{ $organization_count }}</span></h3>
                                <p class="text-muted font-15 mb-0">दर्ता भएका संगठन</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-map avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{ $map_apply_count }}</span></h3>
                                <p class="text-muted font-15 mb-0 text-truncate">जम्मा दर्ता नक्सा</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-map avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{ $map_apply_count }}</span></h3>
                                <p class="text-muted font-15 mb-0">वार्षिक दर्ता नक्सा</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-map avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{ $map_apply_count }}</span></h3>
                                <p class="text-muted font-15 mb-0">मासिक दर्ता नक्सा</p>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <div class="row mt-2" id="charts" data-chart-url="{{ route('emap.admin.dashboard.ajax') }}">
        <div class="col-md-6">
            <div class="card">
                <h4>
                    आर्थिक बर्ष 2080/081 अनुसार प्रयोजन
                </h4>
                <div class="card-body">
                    <canvas id="mapApply" chart-type="bar"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    आर्थिक बर्ष 2080/081 अनुसार भवन वर्गीकरण
                </h4>
                <div class="card-body">
                    <canvas id="buildingCategory" chart-type="line"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    आर्थिक बर्ष 2080/081 अनुसार भवन निर्माण कार्यको किसिम
                </h4>
                <div class="card-body" style="height:350px; width:350px;">
                    <canvas id="constructionType" chart-type="doughnut"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    आर्थिक बर्ष 2080/081 इस्टकचर अनुसार भवनको किसिम
                </h4>
                <div class="card-body">
                    <canvas id="structureType" chart-type="doughnut"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                    चालु आर्थिक बर्षको महिना अनुसारले नक्सा बिवरण
                </h4>
                <div class="card-body">
                    <canvas id="mapAccordingToMonth" chart-type="bar"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <h4>
                    आर्थिक बर्ष अनुसारले नक्सा बिवरण
                </h4>
                <div class="card-body">
                    <canvas id="buildingUsage" chart-type="pie"> </canvas>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/backend/js/chart.js') }}"></script>
        <script type="module" src="{{ asset('assets/backend/js/chartInit.js') }}"></script>
    @endpush
    
@endsection
