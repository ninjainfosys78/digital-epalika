@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">मुद्दा प्रकृति</li>
                    </ol>
                </div>
                <h4 class="page-title">मुद्दा प्रकृति</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">मुद्दा प्रकृति थप्नुहोस </h4>
                        <a href="{{ route('admin.judicialCommittee.setting.lawsuitNature.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> मुद्दा प्रकृति सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.judicialCommittee.setting.lawsuitNature.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="title" class="form-label">शीर्षक *</label>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                            class="form-control  @error('title') is-invalid @enderror" id="title"
                                            placeholder="शीर्षक" />
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="title_en" class="form-label">शीर्षक_en</label>
                                        <input type="text" name="title_en" value="{{ old('title_en') }}"
                                            class="form-control  @error('title_en') is-invalid @enderror" id="title_en"
                                            placeholder="शीर्षक_en" />
                                        @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="code" class="form-label">कोड *</label>
                                        <input type="text" name="code" value="{{ old('code') }}"
                                            class="form-control  @error('code') is-invalid @enderror" id="code"
                                            placeholder="मुख्य न्यायिक सदस्य नाम" />
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
