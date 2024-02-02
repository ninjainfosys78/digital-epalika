@extends('frontend.layouts.master')
@section('content')
<section class="inner-section">
    <div class="breadcrumb d-flex pt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500"
                            href="{{route('grievanceHandling.grievance')}}">गुनासो</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                            <path fill-rule="evenodd"
                                d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                        <a class="ml-1 text-primary-500">गुनासो दर्ता</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex mt-5 ">
            <div class="mx-auto col-md-6">
                <h3 class="text-left fw-bold">उजुरी दर्ता फर्म</h3>
                <p class="text-left fs-6 mb-3">
                    तल दिएको फर्म लाई २ तह मा पुरा गर्नुहोस् र आफुले भरेको फर्म ठीक छ छैन विचार
                    गरी पठाउनुहोस् ।
                </p>
                @livewire('grievancehandling::grievance-form-wizard')
            </div>
        </div>
    </div>
</section>
@endsection