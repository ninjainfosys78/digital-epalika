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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.project.index') }}">
                                योजनाहरु
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> सम्झौताको शर्तहरु </li>
                    </ol>
                </div>
                <h4 class="page-title">सम्झौताको शर्तहरु </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title"> सम्झौताको शर्तहरु</h4>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.plan.project.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना/कार्यक्रमहरू
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.project.projectAgreementTerm.store', $project) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="data" class="form-label">डाटा *</label>
                                <textarea name="data" id="data" required cols="30" rows="10"
                                    class="form-control ckEditor @error('data') is-invalid @enderror">{{ old('data', $project->projectAgreementTerm->data ?? $agreementTermTemplate) }}</textarea>
                                @error('data')
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
    @push('scripts')
        <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
    @endpush
@endsection
