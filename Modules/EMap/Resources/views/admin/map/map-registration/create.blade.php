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
                        <li class="breadcrumb-item">नक्सा</li>
                        <li class="breadcrumb-item active">दस्तुर तथा दर्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">दस्तुर तथा दर्ता</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">दस्तुर तथा दर्ता</h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('emap.admin.mapApply.mapRegistration.store', $mapApply) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <x-date-input-component nameNe="nepali_date" labelNe="मिति *" nameEn="english_date"
                                    labelEn="Date" :get-today-date="!$mapApply->mapRegistration" :edit-date-ne="$mapApply->mapRegistration->nepali_date ?? ''" :edit-date-en="$mapApply->mapRegistration->english_date ?? ''" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="receipt_no">रसिद नं *</label>
                                <input type="text" class="form-control @error('receipt_no') is-invalid @enderror"
                                    name="receipt_no"
                                    value="{{ old('receipt_no', $mapApply->mapRegistration->receipt_no ?? '') }}"
                                    id="receipt_no" placeholder="रसिद नं">
                                @error('receipt_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="amount">रकम *</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                    name="amount" value="{{ old('amount', $mapApply->mapRegistration->amount ?? 0) }}"
                                    id="amount" placeholder="रकम">
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="recipient">रकम बुझनेको नाम *</label>
                                <input type="text" class="form-control @error('recipient') is-invalid @enderror"
                                    name="recipient"
                                    value="{{ old('recipient', $mapApply->mapRegistration->recipient ?? '') }}"
                                    id="recipient" placeholder="रकम बुझनेको नाम">
                                @error('recipient')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="remarks" class="form-label">कैफियत</label>
                                <textarea class="form-control @error('remarks') is_invalid @enderror" name="remarks" id="remarks" cols="30"
                                    rows="5">{{ old('remarks', $mapApply->mapRegistration->remarks ?? '') }}</textarea>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
