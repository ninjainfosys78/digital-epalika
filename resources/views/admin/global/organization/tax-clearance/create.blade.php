@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">कर चुक्ता थप्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">कर चुक्ता थप्नुहोस</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card p-0">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">कर चुक्ता थप्नुहोस</h3>
                    <a href="{{ route('organization.taxClearance.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-list"></i> कर चुक्ता सुची
                    </a>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('organization.taxClearance.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="year">बर्ष *</label>
                            <input type="text" class="form-control @error('year') is-invalid @enderror" id="year"
                                name="year" value="{{ old('year') }}" placeholder="बर्ष" required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="document">फाईल</label>
                            <input type="file" class="form-control @error('document') is-invalid @enderror"
                                id="file" name="document" required>
                            @error('document')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
