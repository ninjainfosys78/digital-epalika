@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section ">
        <div class="breadcrumb d-flex pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-item">
                            <a class="whitespace-nowrap text-primary-500" href="{{ url('ebps') }}">ई-नक्सा</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <a class="ml-1 text-primary-500">नक्सा ट्रयाक</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row d-flex mt-5 ">
                <div class="col-md-5 m-auto">
                    <div class="py-3">
                        <h4 class="fw-semibold text-left">नक्सा ट्रयाक </h4>
                        <p class="text-left fs-6">तपाइको घर-नक्सा आवेदनको स्थिति थाहा पाउन उल्लेखित विवरण भरेर पठाउनुहोस
                            ।</p>
                    </div>
                    <form action="{{ route('map-track') }}" method="post">
                        @csrf
                        <div class="row justify-content-center pb-1">
                            <div class="col-md-12 col-xl-12">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        @if (session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <div class="row pt-1">
                                            <div class="col-12">
                                                <label class="form-check-label fw-bold" for="submission_no">सबमिसन
                                                    न:</label>&emsp;
                                                <input type="text" name="submission_no" id="submission_no"
                                                    class="form-control-lg form-control fs-6">
                                                @error('submission_no')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12 mt-4">
                                                <label class="form-check-label px-2 fw-bold" for="phone_no">फोन
                                                    न:</label>&emsp;
                                                <input type="text" name="phone_no" id="phone_no"
                                                    class="form-control-lg form-control fs-6">
                                                @error('phone_no')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-center pt-3 mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <span>ट्रयाक गर्नुहोस्</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
