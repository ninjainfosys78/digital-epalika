@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">निर्णय थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">निर्णय</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">निर्णय थप्नुहोस्</h4>
                        <a href="{{ route('admin.judicialCommittee.registeredApplication') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> दर्ता भएका उजुरी
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form
                        action="{{ route('admin.judicialCommittee.complaintApplication.complaintDecision.store', $complaintApplication) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">विवरण *</label>
                                <textarea name="description" id="description" required cols="30" rows="10"
                                    class="form-control ckEditor @error('description') is-invalid @enderror">{{ old('description', $complaintApplication->complaintDecision->description ?? $complaintApplication->getSpecificTemplateData(\Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum::DECISION)) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="application_status" class="form-label">उजुरी अवस्था </label>
                                <select name="application_status" class="form-select" id="application_status" required>
                                    <option value="">-- छान्नुहोस् --</option>
                                    @foreach (\Modules\JudicialCommittee\Enums\ComplaintApplicationStatusEnum::cases() as $applicationStatus)
                                        <option
                                            {{ $applicationStatus->value == old('application_status', $complaintApplication->application_status?->value) ? 'selected' : '' }}
                                            value="{{ $applicationStatus->value }}">
                                            {{ $applicationStatus->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('application_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <x-date-input-component nameNe="submitted_date" labelNe="पेश मिति *"
                                    nameEn="en_submitted_date" labelEn="Submitted Date" :editDateNe="$complaintApplication->complaintDecision->submitted_date ?? ''"
                                    :getTodayDate="!isset($complaintApplication->complaintDecision->submitted_date)" />
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="files" class="form-label"> निर्णय फाइल (Multiple)</label>
                                <input type="file" id="files" name="files[]" multiple class="form-control">
                                @error('files')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    पेश गर्नुहोस्
                                </button>
                            </div>
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
