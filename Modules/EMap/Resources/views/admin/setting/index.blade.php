@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mb-0">नक्सा सेटिङ</h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon"> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.mapSetting.index') }}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">नक्सा सेटिङ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नक्सा सेटिङ</h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('emap.admin.mapSetting.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="land_measurement_id" class="form-label mb-2">भूमि मापन एकाइ</label>
                                <select name="land_measurement_id" id="land_measurement_id"
                                    class="mt-1 form-select @error('land_measurement_id') is-invalid @enderror">
                                    <option value="">--- भूमि मापन एकाइ छान्नुहोस् ---</option>
                                    @foreach ($unitTypes as $unitType)
                                        <option value="{{ $unitType->id }}"
                                            {{ $unitType->id == old('land_measurement_id', $mapSetting->land_measurement_id ?? '') ? 'selected' : '' }}>
                                            {{ $unitType->title }}</option>
                                    @endforeach

                                </select>
                                @error('land_measurement_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="land_measurement_standard_id" class="form-label mb-2">भूमि मापन मानक
                                    एकाइ</label>
                                <select name="land_measurement_standard_id" id="land_measurement_standard_id"
                                    class="mt-1 form-select @error('land_measurement_standard_id') is-invalid @enderror">
                                    <option value="">--- भूमि मापन मानक एकाइ छान्नुहोस् ---</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}"
                                            {{ $unit->id == old('land_measurement_standard_id', $mapSetting->land_measurement_standard_id ?? '') ? 'selected' : '' }}>
                                            {{ $unit->title }}</option>
                                    @endforeach
                                </select>
                                @error('land_measurement_standard_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="thumbnail" class="form-label mb-2">थम्बनेल</label>
                                <input name="thumbnail" id="thumbnail" class="mt-1 form-control" type="file">
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!empty($mapSetting->thumbnail))
                                    <a href="{{ $mapSetting->thumbnail }}"
                                        class="mt-2 align-items-center d-flex justify-content-end"
                                        download="{{ $mapSetting->thumbnail }}">
                                        <i class="fa fa-download me-1 "></i> डाउनलोड
                                    </a><br>
                                @endif
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="document" class="form-label mb-2">DWG Catalog format </label>
                                <input name="document" id="document" class="mt-1 form-control" type="file">
                                @error('document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!empty($mapSetting->document))
                                    <a href="{{ $mapSetting->document }}"
                                        class="mt-2 d-flex align-items-center justify-content-end"
                                        download="{{ $mapSetting->document }}">
                                        <i class="fa fa-download me-1"></i> डाउनलोड
                                    </a><br>
                                @endif
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="muchulka_after_complietion" class="form-label">Muchulka After Complietion
                                </label>
                                <textarea name="muchulka_after_complietion" id="muchulka_after_complietion" cols="30"
                                    placeholder="Muchulka After Complietion"
                                    class="form-control ckEditor @error('muchulka_after_complietion') is-invalid @enderror" rows="5">{{ old('muchulka_after_complietion', $mapSetting->muchulka_after_complietion ?? '') }}</textarea>
                                @error('muchulka_after_complietion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="muchulka_before_complietion" class="form-label">Muchulka Before Complietion
                                </label>
                                <textarea name="muchulka_before_complietion" id="muchulka_before_complietion" cols="30"
                                    placeholder="Muchulka Before Complietion"
                                    class="form-control ckEditor @error('muchulka_before_complietion') is-invalid @enderror" rows="5">{{ old('muchulka_before_complietion', $mapSetting->muchulka_before_complietion ?? '') }}</textarea>
                                @error('muchulka_before_complietion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
    @endpush
@endsection
