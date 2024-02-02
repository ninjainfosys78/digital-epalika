@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.global.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                     alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.global.dashboard') }}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">आपतकालिन सम्पर्क थप गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">आपतकालिन सम्पर्क थप</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ आपतकालिन सम्पर्क थप्नुहोस्</h4>
                        <a href="{{ route('admin.global.generalSetting.emergencyNumber.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> आपतकालिन सम्पर्क सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.global.generalSetting.emergencyNumber.store') }}" method="post">
                        @csrf
                        <div class="row">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-md-4 mb-2">
                                <label for="emergency_category_id" class="form-label">प्रकार आबश्यक छ *</label>
                                <select name="emergency_category_id"
                                        class="form-select @error('emergency_category_id') is-invalid @enderror"
                                        id="emergency_category_id" required>
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($emergencyCategories as $emergencyCategory)
                                        <option
                                            {{ $emergencyCategory->id === old('emergency_category_id') ? 'selected' : '' }}
                                            value="{{ $emergencyCategory->id }}">
                                            {{ $emergencyCategory->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('emergency_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input id="title" type="text" name="title" placeholder="शिर्षक आबस्यक छ"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="address" class="form-label">ठेगाना *</label>
                                <input id="address" type="text" name="address" placeholder="ठेगाना"
                                       class="form-control @error('address') is-invalid @enderror"
                                       value="{{ old('address') }}">
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="contact_person_name" class="form-label">सम्पर्क व्यक्ति *</label>
                                <input id="contact_person_name" type="text" name="contact_person_name" placeholder="सम्पर्क व्यक्ति"
                                       class="form-control @error('contact_person_name') is-invalid @enderror"
                                       value="{{ old('contact_person_name') }}">
                                @error('contact_person_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="contact_no" class="form-label">सम्पर्क नं. *</label>
                                <input id="title" type="text" name="contact_no" placeholder="सम्पर्क नं. आबश्यक छ"
                                       class="form-control @error('contact_no') is-invalid @enderror"
                                       value="{{ old('contact_no') }}">
                                @error('contact_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="latitude" class="form-label">अक्षांश</label>
                                <input id="latitude" type="text" name="latitude" placeholder="अक्षांश"
                                       class="form-control @error('latitude') is-invalid @enderror"
                                       value="{{ old('latitude') }}">
                                @error('latitude')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="longitude" class="form-label">देशान्तर</label>
                                <input id="longitude" type="text" name="longitude" placeholder="देशान्तर"
                                       class="form-control @error('longitude') is-invalid @enderror"
                                       value="{{ old('longitude') }}">
                                @error('longitude')
                                <div class="text-danger">{{ $message }}</div>
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
