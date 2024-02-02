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
                                <div class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                    <img class="sidebar-icon" src="{{asset('assets/backend/images/document.png')}}" height="25" loading="lazy" alt="">
                                </div>
                                <p class="text-body font-15 mb-0 ms-2">प्रयोगकर्ताहरु</p>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">45</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                    <img class="sidebar-icon" src="{{asset('assets/backend/images/document.png')}}" height="25" loading="lazy" alt="">
                                </div>
                                <p class="text-body font-15 mb-0 ms-2">समाचार</p>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">45</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                    <img class="sidebar-icon" src="{{asset('assets/backend/images/document.png')}}" height="25" loading="lazy" alt="">
                                </div>
                                <p class="text-body font-15 mb-0 ms-2">सुचना</p>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">45</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar-sm bg-blue-100 d-flex align-items-center justify-content-center rounded-2">
                                    <img class="sidebar-icon" src="{{asset('assets/backend/images/document.png')}}" height="25" loading="lazy" alt="">
                                </div>
                                <p class="text-body font-15 mb-0 ms-2">कर्मचारी/जनप्रतिनिधि</p>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">45</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <h4>
                महिना अनुसार सूचना समाचार
            </h4>
            <div class="card-body">
                <canvas id="barChart1">

                </canvas>
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <h4>
                चालु आर्थिक वर्षाका वडा अनुसार जम्मा सिफारिस विवरण
            </h4>
            <div class="card-body">
                <canvas id="steppedlineChart">

                </canvas>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h4>
                कुल राजस्व विवरण
            </h4>
            <div class="card-body">
                <canvas id="doughNut1">

                </canvas>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h4>
                भुक्तानी अनुसार कुल राजस्व विवरण
            </h4>
            <div class="card-body">
                <canvas id="pieChart1">

                </canvas>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h4>
                विषय अनुसार तालिम विवरण
            </h4>
            <div class="card-body">
                <canvas id="polarAreaChart1">

                </canvas>
            </div>

        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-lg-6">
        <div class="card">
            <h4>
                आर्थिक वर्ष अनुशारको निवेदन
            </h4>
            <div class="card-body">
                <canvas id="barCharthorizontal" height="170">

                </canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <h4>
                आर्थिक वर्ष अनुसार व्यवसाय विवरण
            </h4>
            <div class="card-body">
                <canvas id="lineChart1" height="170">

                </canvas>

                </canvas>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-lg-6">
        <div class="card">
            <h4>
            चालु आ.वका मासिक निवेदनहरु  
                    </h4>
            <div class="card-body">
                <canvas id="bubbleChart" >

                </canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <h4>
            चालु अर्थिक अनुसार जेष्ठ नागरिक को बिवरन
                    </h4>
            <div class="card-body">
                <canvas id="lineChart1" height="170">

                </canvas>

                </canvas>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="{{asset('assets/backend/js/acquisitions.js')}}"></script>
@endpush
@endsection