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
                                    d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z">
                                </path>
                            </svg>
                            <a class="ml-1 text-primary-500">अनुदान</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="row">
                        <div class="col-md-4 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-start gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/notification.png') }}"
                                        alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">सूचना</h5>
                                        <h6 class="card-text mt-2 text-left">नयाँ सूचनाहरु हेर्नुहोस ।</h6>
                                        <a href="" class="btn btn-outline-primary btn-sm"><span>सूचनाहरु</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-start gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/add-file.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">नयाँ दर्ता</h5>
                                        <h6 class="card-text mt-2 text-left">नयाँ अनुदानको लागि दर्ता गर्नुहोस् ।</h6>
                                        <a href="{{ route('grant.applicationRegistration') }}"
                                            class="btn btn-outline-primary btn-sm"><span>नयाँ
                                                दर्ता गर्नुहोस्</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <h4 class="fs-4 mb-0 fw-bolder">हालसालै प्रकसित भयका सूचनाहरु</h4>
                            <p class="fs-6">तल दिएको सूचना पढनुहोस् र आफुले चाहेको सूचना डाउनलोड गर्नुहोस्। </p>
                            <div class="mt-4">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th>क्र.स.</th>
                                            <th>सूचना शीर्षक</th>
                                            <th>प्रकाशित मिति</th>
                                            <th>फाईल</th>
                                        </tr>
                                        <tr class="empty">
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>१</th>
                                            <td>विपन्‍न बस्तीमा मुख्यमन्त्री कार्यक्रम सञ्‍चालन मापदण्ड, २०७८</td>
                                            <td>२०७९/०२/११</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <a href="" class="text-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path
                                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                        </svg>
                                                    </a>
                                                    <a href="" class="text-dark"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                            <path
                                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                            <path
                                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                        </svg></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="empty">
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <td>विपन्‍न बस्तीमा मुख्यमन्त्री कार्यक्रम सञ्‍चालन मापदण्ड, २०७८</td>
                                            <td>२०७९/०२/११</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <a href="" class="text-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path
                                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                        </svg>
                                                    </a>
                                                    <a href="" class="text-dark"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                            <path
                                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                            <path
                                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                        </svg></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="empty">
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
