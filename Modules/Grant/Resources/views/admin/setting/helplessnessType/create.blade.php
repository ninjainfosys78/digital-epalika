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
                            <a href="{{ route('admin.grant.setting.grantOffice.index') }}">असहायताको प्रकार</a>
                        </li>
                        <li class="breadcrumb-item active">असहायताको प्रकार थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">असहायताको प्रकार थप्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">असहायताको प्रकार थप्नुहोस्</h4>

                        <a href="{{ route('admin.grant.setting.helplessnessType.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> असहायताको प्रकार सूची
                        </a>

                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.grant.setting.helplessnessType.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="helplessness_type" class="form-label">असहायताको प्रकार</label>
                                <input type="text" name="helplessness_type" value="{{ old('helplessness_type') }}"
                                    class="form-control @error('helplessness_type') is-invalid @enderror"
                                    id="helplessness_type" placeholder="असहायताको प्रकार" required />
                                @error('helplessness_type')
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
