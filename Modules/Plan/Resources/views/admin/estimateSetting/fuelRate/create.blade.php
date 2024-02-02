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

                        <li class="breadcrumb-item active">इन्धन दर</li>
                    </ol>
                </div>
                <h4 class="page-title">इन्धन दर</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">इन्धन दर </h4>
                        <a href="{{ route('admin.plan.fuelRate.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>इन्धन दर सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.fuelRate.store') }}" method="post">
                        @csrf

                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="rate" class="form-label">दर</label>
                                    <input type="number" name="rate" value="{{ old('rate') }}"
                                        class="form-control @error('rate') is-invalid @enderror" id="rate"
                                        placeholder="दर" />
                                    @error('rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="fuel_id" class="form-label">इन्धन *</label>
                                    <select name="fuel_id" class="form-control @error('fuel_id') is-invalid @enderror"
                                        id="fuel_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($fuels as $fuel)
                                            <option {{ old('fuel_id') == $fuel->id ? 'selected' : '' }}
                                                value="{{ $fuel->id }}">
                                                {{ $fuel->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fuel_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <p>Is Included Vat *</p>

                                    <input type="radio" id="yes" name="has_included_vat" value="1">
                                    <label for="yes">Yes</label>
                                    <input type="radio" id="no" name="has_included_vat" value="0">
                                    <label for="no">No</label>
                                    @error('has_included_vat')
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
