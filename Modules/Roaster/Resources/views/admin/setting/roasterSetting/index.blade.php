@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roaster.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roaster.setting.roasterSetting.index') }}">सेटिङ </a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">सेटिङ </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">सेटिङ </h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.roaster.setting.roasterSetting.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <p>Is Verified *</p>

                                    <input type="radio" id="yes" name="is_verified" value="1"
                                        {{ !empty($roasterSetting->is_verified) == 1 ? 'checked' : '' }}>
                                    <label for="yes">Yes</label>
                                    <input type="radio" id="no" name="is_verified" value="0"
                                        {{ !empty($roasterSetting->is_verified) == 0 ? 'checked' : '' }}>
                                    <label for="no">No</label>
                                    @error('is_verified')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
