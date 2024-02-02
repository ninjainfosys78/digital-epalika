@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> व्यक्तिगत विवरण </li>
                        <li class="breadcrumb-item active">नयाँ व्यक्तिगत विवरण </li>
                    </ol>
                </div>
                <h4 class="page-title">व्यक्तिगत विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ व्यक्तिगतको विवरण थप्नुहोस्</h4>
                        <a href="{{ route('admin.recommendation.setting.personalDetail.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> व्यक्तिगत विवरण सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">

                    <form action="{{ route('admin.recommendation.setting.personalDetail.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <legend>
                                <h4 class="text-info">व्यक्तिगत विवरण</h4>
                            </legend>
                            <h6 class="py-2">नोट: कृपया व्यक्तिगत विवरण भर्दा ध्यान दिएर भर्नु होला । </h6>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="name" class="form-label">पुरा नाम *</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="पुरा नाम " required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="phone_no" class="form-label">सम्पर्क नं. *</label>
                                    <input type="text" name="phone_no" value="{{ old('phone_no') }}"
                                        class="form-control @error('phone_no') is-invalid @enderror" id="phone_no"
                                        placeholder="सम्पर्क नं." />
                                    @error('phone_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="gender" class="form-label">लिंग *</label>
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option value="">-- छान्नुहोस् --</option>
                                        @foreach (\App\Enums\Gender::cases() as $gender)
                                            <option {{ $gender->value == old('gender') ? 'selected' : '' }}
                                                value="{{ $gender->value }}">{{ $gender->label() }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2" id="marital-status-div">
                                    <label for="is_minor" class="form-label">नाबालिका हो/होइन ?*</label>
                                    <select id="is_minor" name="is_minor" class="form-select">
                                        <option value="">-- छान्नुहोस् --</option>
                                        <option value="1" {{ old('is_minor') == 1 ? 'selected' : '' }}>हो</option>
                                        <option value="0" {{ old('is_minor') == 0 ? 'selected' : '' }}>होइन</option>
                                    </select>
                                    @error('is_minor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="citizenship_no" class="form-label">नागरिकता नं. *</label>
                                    <input type="text" name="citizenship_no" value="{{ old('citizenship_no') }}"
                                        class="form-control @error('citizenship_no') is-invalid @enderror"
                                        id="citizenship_no" placeholder="नागरिकता नं." required />
                                    @error('citizenship_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="my-2">
                            <legend>
                                <h4 class="text-info">स्थायी ठेगाना *</h4>
                            </legend>
                            <h6 class="py-2">नोट: कृपया क्रमशः प्रदेश, जिल्ला, गा.पा./न.पा., वार्ड नं., गाउँ र टोल छनौट
                                गर्नुहोस् । </h6>
                            @livewire('address', [
                                'province_id' => old('province_id', $officeSetting->province_id),
                                'district_id' => old('district_id', $officeSetting->district_id),
                                'local_body_id' => old('local_body_id', $officeSetting->local_body_id),
                                'ward_no' => old('ward_no', $officeSetting->ward_no),
                            ])
                            <div class="col-md-6 mb-2">
                                <label for="tole" class="form-label">
                                    टोल</label>
                                <input type="text" name="tole" value="{{ old('tole') }}"
                                    class="form-control @error('tole') is-invalid @enderror" id="tole"
                                    placeholder="टोल" required />
                                @error('tole')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary mt-2">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
