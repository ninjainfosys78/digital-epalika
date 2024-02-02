@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mb-0">नक्शा दस्तुर </h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">नक्शा दस्तुर</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-3 p-0">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नक्शा दस्तुर थप्नुहोस्</h4>
                        <a href="{{ route('emap.admin.mapFee.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> नक्शा दस्तुर सूची
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('emap.admin.mapFee.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="storey" class="form-label">तल्ला *</label>
                            <input type="text" name="storey" value="{{ old('storey') }}"
                                class="form-control @error('storey') is-invalid @enderror" id="storey"
                                placeholder="तल्ला" />
                            @error('storey')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="rate" class="form-label">दर *</label>
                            <input type="number" name="rate" value="{{ old('rate') }}" min="0"
                                class="form-control @error('rate') is-invalid @enderror" id="rate" placeholder="दर" />
                            @error('rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
