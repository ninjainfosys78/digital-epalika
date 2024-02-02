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
                        <li class="breadcrumb-item active">योजना
                            {{ $type == 'planAreaSubCategory' ? 'उपक्षेत्रहरु' : 'क्षेत्रहरु' }}</li>
                    </ol>
                </div>
                <h4 class="page-title">योजना {{ $type == 'planAreaSubCategory' ? 'उपक्षेत्रहरु' : 'क्षेत्रहरु' }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ {{ $type == 'planAreaSubCategory' ? 'उपक्षेत्र' : 'क्षेत्र' }}
                            थप्नुहोस्
                        </h4>
                        <a href="{{ route('admin.plan.planArea.index', $type) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना
                            {{ $type == 'planAreaSubCategory' ? 'उपक्षेत्रहरु' : 'क्षेत्रहरु' }}
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.planArea.store', $type) }}" method="post">
                        @csrf
                        <div class="row">
                            @if ($type == 'planAreaSubCategory')
                                <div class="col-md-12 mb-2">
                                    <label for="plan_area_id" class="form-label">मुख्य योजना क्षेत्र</label>
                                    <select name="plan_area_id"
                                        class="form-control @error('plan_area_id') is-invalid @enderror" id="plan_area_id"
                                        data-toggle="select2" data-width="100%">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($mainPlanAreas as $mainPlanArea)
                                            <option {{ $mainPlanArea->id == old('plan_area_id') ? 'selected' : '' }}
                                                value="{{ $mainPlanArea->id }}">
                                                {{ $mainPlanArea->area_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('plan_area_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-12 mb-2">
                                <label for="area_name" class="form-label">क्षेत्र को नाम *</label>
                                <input type="text" name="area_name" value="{{ old('area_name') }}"
                                    class="form-control @error('area_name') is-invalid @enderror" id="area_name"
                                    placeholder="योजना क्षेत्र" required />
                                @error('area_name')
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
