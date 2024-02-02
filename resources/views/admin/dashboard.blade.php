@extends('admin.layouts.master')
@section('content')
    <div class="row mt-2">
        <div class="card">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <div
                                        class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                        <img class="sidebar-icon" src="{{ asset('assets/backend/images/document.png') }}"
                                            height="25" loading="lazy" alt="">
                                    </div>
                                    <p class="text-body font-15 mb-0 ms-2">प्रयोगकर्ताहरु</p>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">33</span></h3>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <div
                                        class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                        <img class="sidebar-icon" src="{{ asset('assets/backend/images/document.png') }}"
                                            height="25" loading="lazy" alt="">
                                    </div>
                                    <p class="text-body font-15 mb-0 ms-2">योजना/कार्यक्रमहरु</p>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">265</span></h3>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <div
                                        class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                        <img class="sidebar-icon" src="{{ asset('assets/backend/images/document.png') }}"
                                            height="25" loading="lazy" alt="">
                                    </div>
                                    <p class="text-body font-15 mb-0 ms-2">सम्पन्न बैठक</p>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">35</span></h3>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <div
                                        class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                        <img class="sidebar-icon" src="{{ asset('assets/backend/images/document.png') }}"
                                            height="25" loading="lazy" alt="">
                                    </div>
                                    <p class="text-body font-15 mb-0 ms-2">मुद्दा दर्ता</p>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">21</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2" id="charts" data-chart-url="{{ route('admin.dashboard.ajax') }}">
        <div class="col-md-6">
            <div class="card">
                <h4>
                    महिना अनुसार सूचना समाचार
                </h4>
                <div class="card-body">
                    <canvas id="allNoticeAccordingMonth" chart-type="bar"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4>
                    वडा अनुसार  सिफारिस दर्ता विवरण
                </h4>
                <div class="card-body">
                    <canvas id="wardWiseRegistration" chart-type="bar"></canvas>
                </div>
    
            </div>
        </div> 
        <div class="col-md-4">
            <div class="card">
                <h4>
                    कुल राजस्व विवरण
                </h4>
                <div class="card-body">
                    <canvas id="totalRevenue" chart-type="pie"></canvas>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h4>
                    भुक्तानी अनुसार कुल राजस्व विवरण
                </h4>
                <div class="card-body">
                    <canvas id="totalCashBankRevenue" chart-type="pie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h4>
                    विषय अनुसार तालिमहरु
                </h4>
                <div class="card-body">
                    <canvas id="trainerAccordingToSubject" chart-type="pie"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="card">
                    <h4>
                        चालु आर्थिक बर्षको महिना अनुसारले नक्सा बिवरण
                    </h4>
                    <div class="card-body">
                        <canvas id="mapAccordingToMonth" chart-type="bar"></canvas>
                    </div>
                </div>
            </div>
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
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="card">
                    <h4>
                        चालु आर्थिक (2080/081) अनुसार अपाङ्गताको विवरण
                    </h4>
                    <div class="card-body">
                        <canvas id="wardWise" chart-type="bar"></canvas>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h4>
                        आर्थिक वर्ष अनुसार दर्ता र चलानी
                    </h4>
                    <div class="card-body">
                        <canvas id="fyRegistrationAndDispatch" chart-type="bar"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/backend/js/chart.js') }}"></script>
        <script type="module" src="{{ asset('assets/backend/js/chartInit.js') }}"></script>
    @endpush
@endsection
