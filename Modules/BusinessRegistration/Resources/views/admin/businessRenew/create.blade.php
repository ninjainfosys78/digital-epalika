@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> व्यवसाय नवीकरण
                        </li>
                    </ol>
                </div>
                <h4 class="page-title"> व्यवसाय नवीकरण
                </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ नवीकरण थप्नुहोस्</h4>
                        @can('businessRenew_create')
                            <a href="{{ route('admin.businessRegistration.businessRegistration.businessRenew.index', $businessDetail) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> नवीकरण सूची
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <form
                        action="{{ route('admin.businessRegistration.businessRegistration.businessRenew.store', $businessDetail) }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <x-date-input-component name-ne="business_renew_date" label-ne="नवीकरण गरिएको मिति"
                                    name-en="business_renew_date_en" label-en="नवीकरण गरिएको मिति (ई स)" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component name-ne="date_to_be_maintained" label-ne="नवीकरण कायम रहने मिति"
                                    name-en="date_to_be_maintained_en" label-en="नवीकरण कायम रहने मिति (ई स)" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="renew_amount" class="form-label">नवीकरण रकम</label>
                                <input type="number" step="any" name="renew_amount" value="{{ old('renew_amount') }}"
                                    class="form-control @error('renew_amount') is-invalid @enderror" id="renew_amount"
                                    placeholder="नवीकरण रकम" />
                                @error('renew_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="penalty_amount" class="form-label">नवीकरण जरिवाना रकम</label>
                                <input type="number" step="any" name="penalty_amount"
                                    value="{{ old('penalty_amount') }}"
                                    class="form-control @error('penalty_amount') is-invalid @enderror" id="penalty_amount"
                                    placeholder="नवीकरण जरिवाना रकम" />
                                @error('penalty_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="payment_receipt" class="form-label">नवीकरण दस्तुर रसिद नं.</label>
                                <input type="text" name="payment_receipt" value="{{ old('payment_receipt') }}"
                                    class="form-control @error('payment_receipt') is-invalid @enderror" id="payment_receipt"
                                    placeholder="नवीकरण दस्तुर रसिद नं." />
                                @error('payment_receipt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component name-ne="payment_receipt_date" label-ne="नवीकरण दस्तुर रसिद मिति"
                                    name-en="payment_receipt_date_en" label-en="नवीकरण दस्तुर रसिद मिति (ई स)" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
