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
                        <li class="breadcrumb-item active"> असक्षमता प्रकार</li>
                    </ol>
                </div>
                <h4 class="page-title"> असक्षमता प्रकार</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ असक्षमता प्रकार थप्नुहोस्</h4>
                        <a href="{{ route('identity.admin.setting.disabilityType.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> असक्षमता प्रकार सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('identity.admin.setting.disabilityType.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="disability_type_id" class="form-label">अपाङ्गताको प्रकृति *</label>
                                <select name="disability_type_id" id="disability_type_id"
                                    class="form-control @error('disability_type_id') is-invalid @enderror">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($disabilityTypes as $disabilityType)
                                        <option value="{{ $disabilityType->id }}"
                                            {{ old('disability_type_id') == $disabilityType->id ? 'selected' : '' }}>
                                            {{ $disabilityType->title }}</option>
                                    @endforeach
                                </select>
                                @error('disability_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="शिर्षक" required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="title_en" class="form-label">शिर्षक (English) *</label>
                                <input type="text" name="title_en" value="{{ old('title_en') }}"
                                    class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                    placeholder="शिर्षक (English)" required />
                                @error('title_en')
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
