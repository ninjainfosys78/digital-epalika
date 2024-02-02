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
                            <a class="ml-1 text-primary-500">घर नक्सा</a>
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
                            <div class="module-card text-center overflow-hidden p-3">
                                <div class="card-body d-flex gap-3 align-items-start justify-content-between">
                                    <img src="{{ asset('assets/frontend/image/new-icons/job.png') }}" width="50"
                                        height="50">
                                    <div class="d-flex flex-column align-items-start justify-content-start w-75">
                                        <h5 class="fw-semibold mb-1">नक्सा दरखास्त फारम</h5>

                                        <h6 class="text-muted">नयाँ नक्सा दरखास्त फारम भर्नुहोस ।</h6>
                                        <a href="{{ url('form') }}"
                                            class="btn btn-outline-primary btn-sm mt-3"><span>नक्सा दरखास्त</span>

                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-3 p-2">
                            <div class="module-card text-center overflow-hidden p-3">
                                <div class="card-body d-flex gap-3 align-items-start justify-content-between">
                                    <img src="{{ asset('assets/frontend/image/new-icons/password.png') }}" width="50"
                                        height="50">
                                    <div class="d-flex flex-column align-items-start justify-content-start w-75">
                                        <h5 class="fw-semibold mb-1">लग इन</h5>

                                        <h6 class="text-muted">इ-नक्सा लग इन</h6>
                                        <a href="{{ route('organization.login.form') }}"
                                            class="btn btn-outline-primary btn-sm mt-3"><span>लग इन
                                                गर्नुहोस्</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-3 p-2 mt-1">
                            <div class="module-card text-center overflow-hidden p-3">
                                <div class="card-body d-flex gap-3 align-items-start justify-content-between">
                                    <img src="{{ asset('assets/frontend/image/new-icons/map-locator.png') }}" width="50"
                                        height="50">
                                    <div class="d-flex flex-column align-items-start justify-content-start w-75">
                                        <h5 class="fw-semibold mb-1">नक्सा ट्रयाक</h5>

                                        <h6 class="text-muted">घर नक्साको स्थिति बुझन</h6>
                                        <a href="{{ route('mapTrack') }}"
                                            class="btn btn-outline-primary btn-sm mt-3"><span>ट्रयाक
                                                गर्नुहोस्</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-3 p-2 mt-1">
                            <div class="module-card text-center overflow-hidden p-3">

                                <div class="card-body d-flex gap-3 align-items-start justify-content-between">
                                    <img src="{{ asset('assets/frontend/image/new-icons/new-year.png') }}" width="50"
                                        height="50">
                                    <div class="d-flex flex-column align-items-start justify-content-start w-75 text-left">
                                        <h5 class="fw-semibold mb-1">संस्था दर्ता<span class="small text-muted"
                                                style="font-size: 12px">&nbsp;&nbsp;NEC नम्बर लिएकोले
                                            </span></h5>

                                        <h6 class="text-muted text-left">नयाँ इ-नक्साको लागि दर्ता गर्नुहोस्</h6>
                                        <a href="{{ route('organization.register.form') }}"
                                            class="btn btn-outline-primary btn-sm mt-3"><span>दर्ता गर्नुहोस्
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <h4>दरखास्त फारम साथ संलग्न कागजातहरु</h4>
                <h6 class="text-muted">तल दिएका कागजातहरु अनिवार्य राख्नु पर्नेछ । </h6>
                <div class="scroll card mt-4 border-0">
                    <div class="doc">
                        <table class="table table-custom px-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">नयाँ निर्माणको लागि नक्सा पास गर्न अनिवार्य पेश गर्नुपर्ने
                                        आवश्यक कागजातहरु</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4">१. जग्गा धनी प्रमाणपत्र प्रतिलिपि</td>
                                </tr>
                                <tr>
                                    <td class="px-4">२. चालु आर्थिक वर्षको मालपोत तिरेको रसिदको प्रतिलिपि </td>
                                </tr>
                                <tr>
                                    <td class="px-4">३. ज.ध. दर्ता प्रमाण पूर्जामा फोटो नभएको भए नागरिता प्रमाणपत्रको
                                        प्रतिलिपि</td>
                                </tr>
                                <tr>
                                    <td class="px-4">४. कि.न. स्पष्ट भएको नापी प्रमाणित नक्सा (ब्लु प्रिन्ट)</td>
                                </tr>
                                <tr>
                                    <td class="px-4">५. पास गरिने नक्साको फोटोकपी वा ब्लुप्रिन्ट (डिजाईनर र
                                        नक्सावालाको हस्ताक्षर सहित)</td>
                                </tr>
                                <tr>
                                    <td class="px-4">६. डिजाईनरको इजाजतपत्रको नवीकरण सहितको फोटोकपी (सरोकारवालाबाट
                                        प्रमाणित)</td>
                                </tr>
                                <tr>
                                    <td class="px-4">७. मन्जुरी लिई बनाउने भएमा नक्सा वालाको कानून शाखाको रोहवरमा भएको
                                        मन्जुरीनामाको सक्कल </td>
                                </tr>
                                <tr>
                                    <td class="px-4">८. वारेश राखी नक्सा पास गर्ने भए वरिसको प्रमाणितको प्रतिलिपि</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">पुन: निर्माण गर्न आवश्यक कागजातहरु</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4">१. नापी नक्सामा देखिएको तर नक्सा पास नभएको खण्डमा Existing
                                        Building को भुई तल्ला प्लान चार तिरको एलिभेसन र साइट पेश गर्नुपर्नेछ </td>
                                </tr>
                                <tr>
                                    <td class="px-4">२. कागजातको हकमा नयाँ नक्सा पास गर्दा आवश्यक पर्ने सबै कागजातहरु
                                        पेश गर्नुपर्नेछ</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">तल्ला थप गर्न आवश्यक कागजातहरु</th>
                                </tr>
                            <tbody>
                                <tr>
                                    <td class="px-4">१. पहिलो पास गरेको नक्सा र प्रमाणपत्रको फोटोकपी</td>
                                </tr>
                                <tr>
                                    <td class="px-4">२. चालु आर्थिक वर्षसम्मको एकिकृत सम्पति कर तिरेको रसिदको
                                        प्रतिलिपि</td>
                                </tr>
                                <tr>
                                    <td class="px-4">३. अरु कागजातको हकमा नयाँ नक्सा पास गर्दा आवश्यक पर्ने सबै
                                        कागजातहरु पेश गर्नुपर्नेछ</td>
                                </tr>
                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
