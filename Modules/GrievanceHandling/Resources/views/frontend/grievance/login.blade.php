@extends('frontend.layouts.master')
@section('content')
    <section class="help-section">
        <div class="container-fluid">
            <div class="row d-flex mt-5">
                <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500" href="{{route('grievanceHandling.grievance')}}">गुनासो</a>
                        <i class="fa fa-angle-double-right ml-lg-1 text-light"></i><a class="ml-1 text-primary-500">लग इन</a>
                    </div>
                </div>
            </div>
            <div class="row text-center card justify-content-center">
                <h4 class="fw-bold">लग इन</h4>
                <p>तपाईंको गुनासो युजर नाम र पासवर्ड भरेर पठाउनुहोस् ।</p>
                <div class="mt-3">
                    <form class="m-2">
                        <div class="mb-3">
                            <label for="phone" class="form-label">युजर नाम*</label>
                            <input type="text" name="phone" class="" id="phone" placeholder="सम्पर्क नम्बर">
                        </div>
                        <div class="mb-3">
                            <label for="applicant_no" class="form-label">पासवर्ड *</label>
                            <input type="text" name="token" class="" id="applicant_no" placeholder="आवेदक नम्बर">
                        </div>
                        <a type="button" class="btn btn-primary" href="{{route('grievanceHandling.grievance-list')}}">लग
                            इन</a>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </section>
@endsection
