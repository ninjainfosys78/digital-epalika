@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section">
        <div class="breadcrumb d-flex pt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500" href="{{route('grievanceHandling.grievance')}}">गुनासो</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                            <path fill-rule="evenodd"
                                d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                        <a class="ml-1 text-primary-500">गुनासो
                            ट्रयाक</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="container">
            
            <div class="row">
                <div class="col-md-5 m-auto">
                    <h3 class="text-left fw-bold">गुनासो ट्रयाक</h3>
                <p class="text-left fs-6 mb-3">
                   तपाईंको गुनासो/उजुरीको स्थिती थाहा पाउन तल उल्लेखित विवरण भरेर पठाउनुहोस् ।
                </p>
               
                <div class="mt-3 card p-4">
                    <form class="m-2" method="get" action="{{route('grievanceHandling.single-grievance')}}">
                        <div class="mb-3">
                            <label for="phone" class="form-label d-block fw-bold">सम्पर्क नम्बर *</label>
                            <input type="text" name="phone" class="form-control-lg form-control fs-6" id="phone" placeholder="सम्पर्क नम्बर">
                            @error('phone')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="token" class="form-label d-block fw-bold">गुनासो नम्बर *</label>
                            <input type="text" name="token" class="form-control-lg form-control fs-6" id="token" placeholder="आवेदक नम्बर">
                            @error('token')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">खोज्नुहोस्</button>
                    </form>
                </div>
            </div>
</div>
        </div>
    </section>
@endsection
