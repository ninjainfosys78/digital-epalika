@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">सिफारिस</li>
                    </ol>
                </div>
                <h4 class="page-title">सिफारिस</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ सिफारिस श्रेणी थप्नुहोस</h4>
                        @can('branch_create')
                            <a href="{{ route('admin.recommendation.sipharish.sipharishCategory.index') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> सिफारिस श्रेणी सूची
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.recommendation.sipharish.sipharishCategory.store') }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="शिर्षक" required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
