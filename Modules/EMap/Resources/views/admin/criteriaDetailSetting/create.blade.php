@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">नयाँ मापदण्ड</h4>
                <div class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.dashboard') }}">
                                <img class="icon me-1" src="http://127.0.0.1:8000/assets/backend/images/home.svg"
                                    alt="document-icon"> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">मापदण्ड</li>
                        <li class="breadcrumb-item active">नयाँ मापदण्ड</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ मापदण्ड </h4>
                        <a href="{{ route('emap.admin.criteriaDetailSetting.index', '') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> मापदण्ड सुची
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('emap.admin.criteriaDetailSetting.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="land_use_area_id" class="form-label"> भूउपयोग क्षेत्र </label>
                            <select class="form-select @error('land_use_area_id') is-invalid @enderror"
                                name="land_use_area_id" id="land_use_area_id">
                                <option value="">---छान्नुहोस् ---</option>
                                @foreach ($landUseAreas as $landUseArea)
                                    <option value="{{ $landUseArea->id }}"
                                        {{ old('land_use_area_id') == $landUseArea->id ? 'selected' : '' }}>
                                        {{ $landUseArea->title }}
                                    </option>
                                @endforeach

                            </select>
                            @error('land_use_area_id')
                                <div class="invalid-feedback ">{{ $message }} </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="title" class="form-label">शीर्षक *</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" id="title"
                                placeholder="शीर्षक" />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="area" class="form-label">क्षेत्र *</label>
                            <input type="number" name="area" value="{{ old('area') }}" min="0" step="0.01"
                                class="form-control @error('area') is-invalid @enderror" id="area"
                                placeholder="क्षेत्र" />
                            @error('rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4 mb-3">
                            <label for="sign" class="form-label">संकेत</label>
                            <select class="form-select @error('sign') is-invalid @enderror" name="sign" id="sign">
                                <option value="">---संकेत छान्नुहोस् ---</option>
                                @foreach (\Modules\EMap\Enums\SignEnum::cases() as $sign)
                                    <option value="{{ $sign->value }}"
                                        {{ old('sign') == $sign->value ? 'selected' : '' }}>
                                        {{ $sign->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sign')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="gcr" class="form-label">GCR *</label>
                            <input type="number" name="gcr" value="{{ old('gcr') }}" min="0" step="0.01"
                                class="form-control @error('gcr') is-invalid @enderror" id="gcr" placeholder="GCR" />
                            @error('rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="far" class="form-label">FAR *</label>
                            <input type="number" name="far" value="{{ old('far') }}" min="0" step="0.01"
                                class="form-control @error('far') is-invalid @enderror" id="far" placeholder="FAR" />
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
