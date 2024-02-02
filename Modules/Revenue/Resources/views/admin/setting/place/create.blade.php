@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.revenue.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">जग्गाको मुल्यांकन</li>
                    </ol>
                </div>
                <h4 class="page-title">जग्गाको मुल्यांकन</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ जग्गाको मुल्यांकन थप्नुहोस्</h4>
                        <a href="{{ route('admin.revenue.setting.place.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>जग्गाको मुल्यांकन सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.revenue.setting.place.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="sector_id" class="form-label">क्षेत्र</label>
                                <select name="sector_id" class="form-select @error('sector_id') is-invalid @enderror"
                                    id="sector_id" data-toggle="select2" data-width="100%" required>
                                    <option value="">--- छान्नुहोस् ---</option>
                                    @foreach ($sectors as $sector)
                                        <option {{ $sector->id == old('sector_id') ? 'selected' : '' }}
                                            value="{{ $sector->id }}">
                                            {{ $sector->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sector_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">स्थान *</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="स्थान" required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="ward_no" class="form-label">वार्ड *</label>
                                <select name="ward_no[]" class="form-select @error('ward_no') is-invalid @enderror"
                                    id="ward_no" data-toggle="select2" data-width="100%" multiple required>
                                    <option value="" disabled>--- छान्नुहोस् ---</option>
                                    @foreach (get_local_bodies(localBodyId: officeSetting()->local_body_id)->ward_no as $ward)
                                        <option {{ in_array($ward, old('ward_no', [])) ? 'selected' : '' }}
                                            value="{{ $ward }}">
                                            {{ $ward }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ward_no.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('ward_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="rate" class="form-label">दर (वर्ग मीटरमा) *</label>
                                <input type="number" step="0.01" name="rate" value="{{ old('rate') }}"
                                    class="form-control @error('rate') is-invalid @enderror" id="rate"
                                    placeholder="दर" />
                                @error('rate')
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
