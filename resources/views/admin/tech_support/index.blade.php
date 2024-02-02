@extends('admin.layouts.master')
@push('style')
    <link href="{{asset('assets/backend/libs/hopscotch/css/hopscotch.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">डिजिटल ई-पालिका</a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">प्राविधिक मद्दत</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center bg-main p-2">
                        <img src="{{asset(config('app.logo'))}}" alt=""
                             height="40" id="logo-tour">
                    </div>
                    <div class="system mt-2">
                        <div class="introduction">
                            <h4 id="system-intro">१. प्रणाली परिचय</h4>
                            <h4 id="system-aim">२. लक्ष्य</h4>
                            <h4 id="system-purpose">३. उद्देश्य</h4>
                            <h4 id="why-we">४. हामी किन?</h4>
                        </div>
                        <div class="modules mt-3">
                            <h4 id="our-system">५. हामीसंग भएका प्रणालीहरु</h4>
                            <div class="row mt-2">
                                <div class="col-md-4 border" id="citizen">
                                    <a href="{{route('admin.digitalBoard.dashboard')}}">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/digitalboard.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">नागरिक वडापत्र</h4>
                                        </div>
                                    </a>
                                </div>
                                @if(Route::has('admin.circular.dashboard'))
                                    <div class="col-md-4 border" id="darta">
                                        <a href="{{route('admin.circular.dashboard')}}">
                                            <div class="p-2 center">
                                                <img src="{{asset('assets/backend/images/modules/circular.png')}}"
                                                     height="50" width="50">
                                                <h4 class="p-1">दर्ता चलानी प्रणाली</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                <div class="col-md-4 border" id="listregistration">
                                    <a href="{{route('admin.listRegistrations.dashboard')}}">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/listregistration.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">सुची दर्ता प्रणाली</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="helpdesk">
                                    <a href="{{route('admin.helpDesk.dashboard')}}">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/helpdesk.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">हेल्प डेस्क</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="grievancehandling">
                                    <a href="{{route('admin.grievanceHandling.dashboard')}}">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/grievancehandling.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">ई-गुनासो</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="executivemeeting">
                                    <a href="{{route('admin.executiveMeeting.dashboard')}}">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/executivemeeting.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">ई-कार्यपालिका</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="businessregistration">
                                    <a href="{{route('admin.businessRegistration.dashboard')}}">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/businessregistration.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">व्यवसाय दर्ता</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="emap">
                                    <a href="{{route('emap.admin.dashboard')}}">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/emap.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">घर-नक्सा पास</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="recommendation">
                                    <a href="#">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/sifarish-parnali.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">शिफारिस प्रणाली</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="yojana">
                                    <a href="#">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/plan.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">योजना व्यवस्थापन</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="talim">
                                    <a href="#">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/roaster.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">तालिम व्यवस्थापन</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="anudan">
                                    <a href="#">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/anudan.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">अनुदान व्यवस्थापन</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="nyayik">
                                    <a href="#">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/nyayik.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">न्यायिक समिति</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 border" id="kramachari">
                                    <a href="#">
                                        <div class="p-2 center">
                                            <img src="{{asset('assets/backend/images/modules/kramachari.png')}}"
                                                 height="50" width="50">
                                            <h4 class="p-1">कर्मचारी व्यवस्थापन</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="cautions mt-3">
                            <h4 id="cautions">६. प्रणाली सञ्चालन गर्नु अघि विचार गर्नुपर्ने कुराहरू</h4>
                            <ul class="list-group mt-2">
                                <li class="list-group-item">
                                    Step 1: Google Drive
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/libs/hopscotch/js/hopscotch.min.js')}}"></script>
        <script src="{{asset('assets/backend/js/pages/tour.init.js')}}"></script>
    @endpush
@endsection
