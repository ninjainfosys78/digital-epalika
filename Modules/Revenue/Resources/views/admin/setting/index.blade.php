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
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.mapSetting.index') }}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">नक्सा सेटिङ</li>
                    </ol>
                </div>
                <h4 class="page-title">राजस्व सेटिङ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नक्सा सेटिङ</h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.revenue.setting.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="land_measurement_id" class="form-label">भूमि मापन एकाइ</label>
                                <select name="land_measurement_id" id="land_measurement_id"
                                    class="form-select @error('land_measurement_id') is-invalid @enderror">
                                    <option value="">--- भूमि मापन एकाइ छान्नुहोस् ---</option>
                                    @foreach ($unitTypes as $unitType)
                                        <option value="{{ $unitType->id }}"
                                            {{ $unitType->id == old('land_measurement_id', $revenueSetting->land_measurement_id ?? '') ? 'selected' : '' }}>
                                            {{ $unitType->title }}</option>
                                    @endforeach

                                </select>
                                @error('land_measurement_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="land_measurement_standard_id" class="form-label">भूमि मापन मानक
                                    एकाइ</label>
                                <select name="land_measurement_standard_id" id="land_measurement_standard_id"
                                    class="form-select @error('land_measurement_standard_id') is-invalid @enderror">
                                    <option value="">--- भूमि मापन मानक एकाइ छान्नुहोस् ---</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}"
                                            {{ $unit->id == old('land_measurement_standard_id', $revenueSetting->land_measurement_standard_id ?? '') ? 'selected' : '' }}>
                                            {{ $unit->title }}</option>
                                    @endforeach
                                </select>
                                @error('land_measurement_standard_id')
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
