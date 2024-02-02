@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section">
        <div class="breadcrumb d-flex pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-item">
                            <a class="whitespace-nowrap text-primary-500" href="{{ url('digital-service') }}">ई-पालिका</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <a class="ml-1 text-primary-500">गुनासो</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body">
                                    <div class="  d-flex justify-content-between align-items-center gap-3">
                                        <img class="icon" style="width: 40px"
                                            src="{{ asset('assets/frontend/image/new-icons/chat.png') }}" alt="">
                                        <div class="info text-left w-75">
                                            <h5 class="mt-0 mb-1 card-title text-left">गुनासो दर्ता</h5>
                                            <h6 class="card-text mt-2 text-left">नयाँ गुनासोको दर्ता गर्नुहोस् ।</h6>
                                            <a href="{{ route('grievanceHandling.grievance-register') }}"
                                                class="btn btn-outline-primary btn-sm"><span>गुनासो
                                                    दर्ता</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-center gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/verified.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">उजुरी/गुनासो नीति</h5>
                                        <h6 class="card-text mt-2 text-left">उजुरी/गुनासो समाधान नीति ।</h6>
                                        <a href="{{ route('grievanceHandling.policy') }}"
                                            class="btn btn-outline-primary btn-sm"><span>नीतिहरु</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-center gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/self-control.png') }}"
                                        alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">गुनासो ट्र्याक</h5>
                                        <h6 class="card-text mt-2 text-left">गुनासो/उजुरीको स्थिती थाहा पाउन ।</h6>
                                        <a href="{{ route('grievanceHandling.track') }}"
                                            class="btn btn-outline-primary btn-sm"><span>गुनासो
                                                ट्र्याक</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-center gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/password.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">गुनासो लग इन</h5>
                                        <h6 class="card-text mt-2 text-left">गुनासो/उजुरी लग इन ।</h6>
                                        <a href="" class="btn btn-outline-primary btn-sm"><span>लग
                                                इन</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 p-2">
                                        <div class="card shadow text-center">
                                            <div class="card-body">
                                                <h5 class="mt-0 mb-1 card-title text-left"></h5>
                                                <img class="icon" style="width: 40px" src="{{ asset('assets/frontend/image/login.png') }}" alt="">
                                                <h6 class="card-text mt-2 text-left">
                                                </h6>
                                                <a href="" class="btn btn-outline-primary btn-sm"><span>लग इन</span>
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-md-2 p-2">
                            <div class="card bg-l-success text-success border-0 text-center">
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                        <path
                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                        <path
                                            d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                                    </svg>
                                    <h4 class="fw-bold mt-2">{{ $grievanceCount }}</h4>
                                    <h6 class="fw-semibold">कुल प्राप्त गुनासो</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 p-2">
                            <div class="card bg-l-info text-info border-0 text-center">
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path
                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                        <path
                                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0" />
                                    </svg>
                                    <h4 class="fw-bold mt-2">{{ $registeredGrievanceCount }}</h4>
                                    <h6 class="fw-semibold">कुल दर्ता गुनासो</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 p-2">
                            <div class="card bg-l-primary text-primary border-0 text-center">
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
                                        <path
                                            d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
                                    </svg>
                                    <h4 class="fw-bold mt-2">{{ $closedGrievanceCount }}</h4>
                                    <h6 class="fw-semibold">फर्छ्यौट भएको</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 p-2">
                            <div class="card bg-l-warning text-warning border-0 text-center">
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-eyeglasses" viewBox="0 0 16 16">
                                        <path
                                            d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4m2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A1.993 1.993 0 0 0 8 6c-.532 0-1.016.208-1.375.547M14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0" />
                                    </svg>
                                    <h4 class="fw-bold mt-2">{{ $investigatedGrievanceCount }}</h4>
                                    <h6 class="fw-semibold">अनुसन्धान गरिदै</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 p-2">
                            <div class="card bg-l-dark text-dark border-0 text-center">
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                    <h4 class="fw-bold mt-2">{{ $seenGrievanceCount }}</h4>
                                    <h6 class="fw-semibold">हेरिएको</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 p-2">
                            <div class="card bg-l-danger text-danger border-0 text-center">
                                <div class="card-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path
                                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z" />
                                        <path
                                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                        <path
                                            d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708" />
                                    </svg>
                                    <h4 class="fw-bold mt-2">{{ $unseenGrievanceCount }}</h4>
                                    <h6 class="fw-semibold">नहेरिएको</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-5">
                    <h5 class="fw-semibold mb-4">गुनासो प्राप्त भएका गुनासो प्रकृतिहरु</h5>
                    <div class="">

                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th scope="col">गुनासो प्रकृतिहरु</th>
                                    <th scope="col"> संख्या</th>
                                </tr>
                                <tr class="empty">
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grievanceTypes as $type)
                                    <tr>
                                        <td>{{ $type->title }}</td>
                                        <td>{{ $type->grievance_details_count }}</td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-7 grievance-answer">
                    <h5 class="fw-semibold mb-4">सार्वजनिक गरिएका गुनासोहरु</h5>
                    <p>
                        @foreach ($grievanceDetails as $grievanceDetail)
                            <button class="btn w-100" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false">
                                {{ $grievanceDetail->subject }}
                            </button>
                        @endforeach
                    </p>
                    @foreach ($grievanceDetails as $grievanceDetail)
                        <div class="collapse" id="collapse{{ $loop->iteration }}">
                            <div class="card card-body">
                                <p><i class="fa fa-angle-double-right m-lg-1"></i>{{ $grievanceDetail->description }}</p>
                            </div>
                        </div>
                    @endforeach
                    <a class="btn mb-1 mt-1 btn-primary mx-auto"
                        href="{{ route('grievanceHandling.public-grievance') }}">थप
                        गुनासोहरु
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
