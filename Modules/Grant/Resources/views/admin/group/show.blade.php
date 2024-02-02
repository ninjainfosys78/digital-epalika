@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grant.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">समूह</li>
                    </ol>
                </div>
                <h4 class="page-title">समूह प्रोफाइल </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="text-start mt-3">
                        <p class=" text-dark mb-2 font-16"><strong>समूहको नाम :</strong>
                            <span class="ms-2 text-muted">{{ $group->name }}</span>
                        </p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>समूह परिचय पत्र नं :</strong>
                            <span class="ms-2 text-muted">{{ $group->unique_id }}</span>
                        </p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>दर्ता मिति :</strong> <span
                                class="ms-2 text-muted">{{ $group->registration_date }}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>दर्ता भएको कार्यलय :</strong> <span
                                class="ms-2 text-muted">{{ $group->registered_office }}</span></p>

                        <p class=" border-top border-1 text-dark mb-2 font-16"><strong>पाना/भ्याट :</strong> <span
                                class="ms-2 text-muted">{{ $group->vat_pan }}</span></p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>ठेगाना :</strong> <span
                                class="ms-2 text-muted">{{ $group->province->province ?? '' }},
                                {{ $group->district->district ?? '' }},
                                {{ $group->localBody->local_body ?? '' }} -
                                {{ $group->ward_no ?? '' }},
                                {{ $group->village ?? '' }}
                                {{ $group->tole ?? '' }}
                            </span></p>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8 ">
            <div class="row">
                <div class="col-md-4 text-center px-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-dark font-19">सम्पर्क व्यक्तिहरू</h4>
                            <p class="pt-1 font-16">समूहको सम्पर्क व्यक्तिहरू थप्नुहोस् ।</p>
                        </div>
                        <div class="card-btn pb-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">विवरण हेर्नुहोस<i
                                    class="fa fa-arrow-circle-right px-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center px-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-dark font-19">अनुदान विवरण</h4>
                            <p class="pt-1 font-16">समूहको अनुदान विवरण थप्नुहोस् ।</p>
                        </div>
                        <div class="card-btn pb-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">विवरण हेर्नुहोस<i
                                    class="fa fa-arrow-circle-right px-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center px-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-dark font-19">संलग्न कृषक</h4>
                            <p class="pt-1 font-16">समूहको संलग्न कृषक
                                थप्नुहोस् ।</p>
                        </div>
                        <div class="card-btn pb-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">विवरण हेर्नुहोस<i
                                    class="fa fa-arrow-circle-right px-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title my-2">
                            अनुदानग्राही तालिका
                        </h4>
                        <a href="{{ route('admin.grant.group.grantDetails', $group) }}"
                         class="btn btn-outline-primary btn-sm" style="border-radius: 25px; padding:10px">विवरण हेर्नुहोस</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">क्र.स</th>
                                    <th scope="col">कार्यक्रम/क्रियाकलाप</th>
                                    <th scope="col">अनुदानग्राही लगानी</th>
                                    <th scope="col">अनुदान स्थल</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($group->grantDetails as $grantDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</th>
                                        <td>{{ $grantDetail->grant->grantProgram->name ?? '' }}</td>
                                        <td>{{ $grantDetail->personal_investment }}</td>
                                        <td>{{ $grantDetail->localBody->local_body ?? '' }} - {{ $grantDetail->ward_no }}
                                            {{ $grantDetail->village }}, {{ $grantDetail->tole }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
