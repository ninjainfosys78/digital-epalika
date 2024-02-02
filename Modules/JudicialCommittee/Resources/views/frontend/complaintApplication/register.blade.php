@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section mt-lg-5 ">
        <div class="container">
            <div class="row d-flex mt-5 ">
                <div class="mx-auto">
                    <div class="breadcrumb d-flex">
                        <div class="breadcrumb-item">
                            <a class="whitespace-nowrap text-primary-500"
                                href="{{ route('digital-service') }}">गृहपृष्ठ</a>

                            <i class="fa fa-angle-double-right ml-lg-1 text-light"></i>
                            <a class="ml-1 text-primary-500">विवाद हाल्नुहोस् </a>
                        </div>
                    </div>
                    <h4 class="text-center">लिखित विवाद पेस गर्नुहोस</h4>
                    <p class="text-center">
                        तल दिएको फर्म लाई पुरा गर्नुहोस् र आफुले भरेको फर्म ठीक छ छैन विचार
                        गरी पठाउनुहोस् ।
                    </p>
                    @livewire('judicialcommittee::complain-registration-livewire')
                    <br>
                </div>
            </div>
        </div>
    </section>
@endsection
