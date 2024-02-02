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
                            <a class="ml-1 text-primary-500">तालिम</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-start gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/add-file.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">तालिम आवेदन</h5>
                                        <h6 class="card-text mt-2 text-left">नयाँ आवेदन को लागि आवेदन दिनुहोस ।</h6>
                                        <a href="{{ route('roaster.individual-training-view', 'trainee') }}"
                                            class="btn btn-outline-primary btn-sm"><span>तालिम आवेदन</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-start gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/add-file.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">लग इन</h5>
                                        <h6 class="card-text mt-2 text-left">तालिम लग इन</h6>
                                        <a href="{{ route('roaster.traineeUser.login.form') }}" class="btn btn-outline-primary btn-sm"><span>लग इन
                                                गर्नुहोस्</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-start gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/add-file.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">प्रशिक्षक दर्ता फर्म</h5>
                                        <h6 class="card-text mt-2 text-left">नयाँ प्रशिक्षकको लागि दर्ता गर्नुहोस् ।
                                        </h6>
                                        <a href="{{ route('roaster.trainer-form') }}"
                                            class="btn btn-outline-primary btn-sm"><span>प्रशिक्षक
                                                दर्ता फर्म</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-start gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/add-file.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">हाम्रा प्रशिक्षकहरु</h5>
                                        <h6 class="card-text mt-2 text-left">हाम्रा प्रशिक्षकहरु ।</h6>
                                        <a href="" class="btn btn-outline-primary btn-sm"><span>हाम्रा
                                                प्रशिक्षकहरु</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="card custom-card text-left">
                                <div class="card-body  d-flex justify-content-between align-items-start gap-3">
                                    <img class="icon" style="width: 40px"
                                        src="{{ asset('assets/frontend/image/new-icons/add-file.png') }}" alt="">
                                    <div class="info text-left w-75">
                                        <h5 class="mt-0 mb-1 card-title text-left">संस्था दर्ता</h5>
                                        <h6 class="card-text mt-2 text-left">नयाँ तालिमको लागि दर्ता गर्नुहोस् (NEC
                                            नम्बर
                                            लिएकोले)।</h6>
                                        <a href="{{ route('roaster.trainee-register') }}"
                                            class="btn btn-outline-primary btn-sm"><span>संस्था</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <h4 class="fs-4 mb-0 fw-bolder">हालसालै चलिरहेका तालिमहरु</h4>
                    <div class="mt-4">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.स.</th>
                                    <th>तालिमको नाम</th>
                                    <th>खुलेको मिति</th>
                                    <th>बन्द हुने मिति</th>
                                    <th></th>
                                </tr>
                                <tr class="empty">
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trainings as $training)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $training->name }}</td>
                                        <td>{{ $training->open_date }}</td>
                                        <td>{{ $training->closed_date }}</td>
                                        <td>
                                            @if ($training->form_type === \Modules\Roaster\Enums\TrainingTypeEnum::TECHNICAL_TRAINEE)
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('roaster.technicalTraineeForm', $training) }}"
                                                        class="text-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path
                                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('roaster.traineeForm', $training) }}"
                                                        class="text-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                            <path
                                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endif

                                        </td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
