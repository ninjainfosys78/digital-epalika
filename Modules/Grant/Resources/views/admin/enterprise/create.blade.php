@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grant.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">निजि उधम/फर्म थप</li>
                    </ol>
                </div>
                <h4 class="page-title"> निजि उधम/फर्महरु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">निजि उधम/फर्मको विवरण फारम</h4>
                        <a href="{{ route('admin.grant.enterprise.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> निजि उधम/फर्म सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.grant.enterprise.store') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>
                                <h4 class="text-info">निजि उधम/फर्मको विवरण</h4>
                            </legend>
                            <h5 class="mt-1 text-black">नोट: कृपया निजि उधम/फर्मको विवरण भर्दा ध्यान दिएर भर्नु होला
                                । </h5>
                            <div class="row mt-2">
                                <div class="col-md-4 mb-2">
                                    <label for="name" class="form-label">निजि उधम/फर्मको नाम <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="निजि उधम/फर्मको नाम" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="enterprise_type_id" class="fs-5">निजि उधम/फर्म प्रकार<span
                                            class="text-danger">*</span></label>
                                    <select name="enterprise_type_id" id="enterprise_type_id" class="form-select" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($enterpriseTypes as $enterpriseType)
                                            <option value="{{ $enterpriseType->id }}"
                                                {{ $enterpriseType->id == old('enterprise_type_id') ? 'selected' : '' }}>
                                                {{ $enterpriseType->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('enterprise_type_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="vat_pan" class="form-label">प्यान/भ्याट</label>
                                    <input type="text" name="vat_pan" value="{{ old('vat_pan') }}"
                                        class="form-control @error('vat_pan') is-invalid @enderror" id="vat_pan"
                                        placeholder="प्यान/भ्याट" />
                                    @error('vat_pan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mt-3">
                            <legend>
                                <h4 class="text-info">स्थानीय ठेगाना</h4>
                            </legend>
                            <h5 class="my-1 text-black">नोट: कृपया क्रमशः प्रदेश, जिल्ला, गा.पा./न.पा., वार्ड नं., गाउँ
                                र
                                टोल छनौट गर्नुहोस् ।</h5>
                            @livewire('address', [
                                'province_id' => $officeSetting->province_id,
                                'district_id' => $officeSetting->district_id,
                                'local_body_id' => $officeSetting->local_body_id,
                            ])
                            <div class="row ">
                                <div class="col-md-6 mb-2">
                                    <label for="village" class="form-label">गाउँ</label>
                                    <input type="text" name="village" value="{{ old('village') }}"
                                        class="form-control @error('village') is-invalid @enderror" id="village"
                                        placeholder="गाउँ" />
                                    @error('village')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="tole" class="form-label">टोल</label>
                                    <input type="text" name="tole" value="{{ old('tole') }}"
                                        class="form-control @error('tole') is-invalid @enderror" id="tole"
                                        placeholder="टोल" />
                                    @error('tole')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="my-2">
                            <legend>
                                <h4 class="text-info">संलग्न कृषकहरू</h4>
                            </legend>
                            <h5 class="mt-1 text-black">निजि उधम/फर्ममा संलग्न कृषकहरू छान्नुहोस् </h5>
                            <div class="row mt-2">
                                <div class="col-md-6 mb-2">
                                    <label for="farmers" class="fs-5">कृषकहरू </label>
                                    <div class="input-group">
                                        <select name="farmers[]" multiple data-toggle="select2" id="farmers"
                                            class="form-control" aria-describedby="button-farmer">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($farmers as $farmer)
                                                <option value="{{ $farmer->id }}">{{ $farmer->name }}
                                                    ({{ $farmer->unique_id }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-outline-primary" type="button" id="button-farmer"
                                            title="कृषक थप" data-bs-toggle="modal" data-bs-target="#farmer-modal">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                    @error('farmers')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-primary">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @include('grant::admin.inc.farmer_form')
    </div>
@endsection
