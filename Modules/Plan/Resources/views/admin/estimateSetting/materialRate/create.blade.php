@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">सामाग्री दर</li>
                    </ol>
                </div>
                <h4 class="page-title">सामाग्री दर</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">सामाग्री दर </h4>
                        <a href="{{ route('admin.plan.materialRate.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>सामाग्री दर सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.materialRate.store') }}" method="post">
                        @csrf

                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="referance_no" class="form-label">Referance No</label>
                                    <input type="text" name="referance_no" value="{{ old('referance_no') }}"
                                        class="form-control @error('referance_no') is-invalid @enderror" id="referance_no"
                                        placeholder="Referance No" />
                                    @error('referance_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="material_id" class="form-label">सामग्री </label>
                                    <select name="material_id"
                                        class="form-control @error('material_id') is-invalid @enderror" id="material_id"
                                        data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($materials as $material)
                                            <option {{ old('material_id') == $material->id ? 'selected' : '' }}
                                                value="{{ $material->id }}">
                                                {{ $material->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('material_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="fiscal_year_id" class="form-label">आर्थिक वर्ष </label>
                                    <select name="fiscal_year_id"
                                        class="form-control @error('fiscal_year_id') is-invalid @enderror"
                                        id="fiscal_year_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($fiscalYears as $fiscalYear)
                                            <option {{ old('fiscal_year_id') == $fiscalYear->id ? 'selected' : '' }}
                                                value="{{ $fiscalYear->id }}">
                                                {{ $fiscalYear->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fiscal_year_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="royalty" class="form-label">रोयल्टी</label>
                                    <input type="text" name="royalty" value="{{ old('royalty') }}"
                                        class="form-control @error('royalty') is-invalid @enderror" id="royalty"
                                        placeholder="रोयल्टी" />
                                    @error('royalty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p>Is_vat_included *</p>

                                    <input type="radio" id="yes1" name="is_vat_included" value="1"
                                        {{ old('is_vat_included') == 1 ? 'checked' : '' }}>
                                    <label for="yes1">Yes</label>
                                    <input type="radio" id="no1" name="is_vat_included" value="0"
                                        {{ old('is_vat_included') == 0 ? 'checked' : '' }}>
                                    <label for="no1">No</label>
                                    @error('is_vat_included')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p>Is_vat_needed *</p>

                                    <input type="radio" id="yes" name="is_vat_needed" value="1"
                                        {{ old('is_vat_needed') == 1 ? 'checked' : '' }}>
                                    <label for="yes">Yes</label>
                                    <input type="radio" id="no" name="is_vat_needed" value="0"
                                        {{ old('is_vat_needed') == 0 ? 'checked' : '' }}>
                                    <label for="no">No</label>
                                    @error('is_vat_needed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
