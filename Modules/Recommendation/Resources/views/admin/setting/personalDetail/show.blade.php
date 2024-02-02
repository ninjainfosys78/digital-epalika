@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">व्यक्तिगत विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">व्यक्तिगत विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">व्यक्तिगतको विवरण </h4>
                        <a href="{{ route('admin.recommendation.setting.personalDetail.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> व्यक्तिगत विवरण सुची
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4>व्यक्तिगत विवरण</h4>

                                <div class="text-start mt-3">

                                    <p class="mb-2 font-15"><strong>पुरा नाम :</strong> <span
                                            class="ms-2">{{ $personalDetail->name }}</span>
                                    </p>
                                    <p class="mb-2 font-15"><strong>सम्पर्क नं :</strong><span
                                            class="ms-2">{{ $personalDetail->phone_no }}</span></p>

                                    <p class="mb-2 font-15"><strong>लिङ्ग:</strong> <span
                                            class="ms-2">{{ $personalDetail->gender?->label()??'' }}</span></p>

                                    <p class="mb-2 font-15"><strong>नाबालिक हो/होइन:</strong> <span
                                            class="ms-2">{{ $personalDetail->is_minor==0 ? 'होइन':'हो' }}</span></p>

                                    <p class="mb-2 font-15"><strong>नागरिकता नं:</strong> <span
                                            class="ms-2">{{ $personalDetail->citizenship_no }}</span></p>
                                    <p class="mb-2 font-15"><strong> ठेगाना (स्थायी) : :</strong> <span
                                            class="ms-2">  {{ $personalDetail->localBody->local_body}}
                                                -{{ $personalDetail->ward_no }}
                                                , {{ $personalDetail->tole }}</span>
                                    </p>
                                </div>
                                <table class="table table-bordered mt-2">
                                    <thead>
                                    <tr>
                                        <th>क्र.स</th>
                                        <th>सिफारिस</th>
                                        <th>मिति</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($personalDetail->registrationDetails as $registrationDetail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $registrationDetail->recommendationCategory->title ??'' }}</td>
                                            <td>{{ $registrationDetail->date_ne }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
