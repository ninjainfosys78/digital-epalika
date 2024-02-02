@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.circular.circularSetting.index') }}">सेटिङ</a>
                    </li>
                    <li class="breadcrumb-item active">सेटिङ</li>
                </ol>
            </div>
            <h4 class="page-title">सेटिङ</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">

            <div class="card-body px-0">
                <form action="{{ route('admin.circular.circularSetting.update', $circularSetting) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-primary">
                            <strong> विवरण </strong>
                        </legend>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="registration_prefix" class="form-label">दर्ता. </label>
                                <input type="text" name="registration_prefix"
                                    value="{{ old('registration_prefix', $circularSetting->registration_prefix) }}"
                                    class="form-control @error('registration_prefix') is-invalid @enderror"
                                    id="registration_prefix" placeholder="दर्ता" required />
                                @error('registration_prefix')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="registration_number" class="form-label">दर्ता जारी नम्बर. </label>
                                <input type="number" name="registration_number"
                                    value="{{ old('registration_number', $circularSetting->registration_number) }}"
                                    class="form-control @error('registration_number') is-invalid @enderror"
                                    id="registration_number" placeholder="दर्ता जारी नम्बर" min="0" required />
                                @error('registration_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="dispatch_prefix" class="form-label">चलानी. </label>
                                <input type="text" name="dispatch_prefix"
                                    value="{{ old('dispatch_prefix', $circularSetting->dispatch_prefix) }}"
                                    class="form-control @error('dispatch_prefix') is-invalid @enderror"
                                    id="dispatch_prefix" placeholder="चलानी" required />
                                @error('dispatch_prefix')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="dispatch_number" class="form-label">चलानी जारी नम्बर </label>
                                <input type="number" min="0" name="dispatch_number"
                                    value="{{ old('dispatch_number', $circularSetting->dispatch_number) }}"
                                    class="form-control @error('dispatch_number') is-invalid @enderror"
                                    id="dispatch_number" placeholder="चलानी जारी नम्बर " required />
                                @error('dispatch_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <h5>
                                    <label for="complaint_severity" class="form-label">
                                        सबैलाई मेल पठाउन मिल्ने कि नमिल्ने ? *
                                    </label>
                                </h5>

                                <div class="d-flex">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="send_email" id="send_email1"
                                            value="1" {{ old('send_email', $circularSetting) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="send_email1">मिल्ने &nbsp;</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="send_email" id="send_email2"
                                            value="0" {{ old('send_email', $circularSetting) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="send_email2">नमिल्ने &nbsp;</label>
                                    </div>
                                </div>
                                @error('send_email')
                                <div class="text-danger">{{ $message }}</div>
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