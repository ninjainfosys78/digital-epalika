@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">प्रसाशाक</li>
                    </ol>
                </div>
                <h4 class="page-title"> प्रसाशाक</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ प्रसाशाक थप्नुहोस्</h4>
                        <a href="{{ route('identity.admin.setting.employeeSignature.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> प्रसाशाक सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('identity.admin.setting.employeeSignature.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">नाम *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="नाम" required />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="name_en" class="form-label">नाम(English) *</label>
                                <input type="text" name="name_en" value="{{ old('name_en') }}"
                                    class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                    placeholder="नाम(English)" required />
                                @error('name_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="designation" class="form-label">पद *</label>
                                <input type="text" name="designation" value="{{ old('designation') }}"
                                    class="form-control @error('designation') is-invalid @enderror" id="designation"
                                    placeholder="पद" required />
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="designation_en" class="form-label">पद (English) *</label>
                                <input type="text" name="designation_en" value="{{ old('designation_en') }}"
                                    class="form-control @error('designation_en') is-invalid @enderror" id="designation_en"
                                    placeholder="पद (English)" required />
                                @error('designation_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="pin" class="form-label">पिन *</label>
                                <input type="text" name="pin" value="{{ old('pin') }}"
                                    class="form-control @error('pin') is-invalid @enderror" id="pin" placeholder="पिन"
                                    required />
                                @error('pin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="red_signature" class="form-label">रातो हस्ताक्षर *</label>
                                <input type="file" name="red_signature"
                                    class="form-control @error('red_signature') is-invalid @enderror" id="red_signature"
                                    required />
                                @error('red_signature')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="black_signature" class="form-label">कालो हस्ताक्षर *</label>
                                <input type="file" name="black_signature"
                                    class="form-control @error('black_signature') is-invalid @enderror" id="black_signature"
                                    required />
                                @error('black_signature')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="stamp" class="form-label">छाप *</label>
                                <input type="file" name="stamp"
                                    class="form-control @error('stamp') is-invalid @enderror" id="stamp" />
                                @error('stamp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
