@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> सिफारिस टेम्पलेट</li>
                    </ol>
                </div>
                <h4 class="page-title"> सिफारिस टेम्पलेट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">सिफारिस टेम्पलेट</h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('identity.admin.setting.recommendationTemplateSetting.store') }}" method="post">
                        @csrf
                        <div class="row">
                            @if ($recommendationTemplateSetting)
                                <div class="col-md-12 mb-2 d-flex">
                                    <h4 class="form-label">स्थिति</h4>
                                    <a href="{{ route('identity.admin.setting.recommendationTemplateSetting.updateStatus', $recommendationTemplateSetting ?? '') }}"
                                        class="btn btn-xs btn-outline-{{ !empty($recommendationTemplateSetting->status) == 1 ? 'primary' : 'danger' }}">
                                        <i
                                            class="fa {{ !empty($recommendationTemplateSetting->status) == 1 ? 'fa-check' : 'fa-times' }}"></i>
                                    </a>
                                </div>
                            @endif

                            <div class="col-md-12 mb-2">
                                @foreach ((new \Modules\Identity\Entities\DisabilityIdentityCard())->getTemplateOptions() as $template)
                                    <div class="mt-2">
                                        <h4>{{ $template['title'] ?? '' }} </h4>
                                        <div class="button-list d-flex flex-wrap mb-2">
                                            @foreach ($template['data'] as $key => $templateValue)
                                                <div class="d-flex d-warp">
                                                    <button type="button" class="btn btn-outline-primary btn-xs"
                                                        onclick="copyText('{{ $templateValue }}')">
                                                        {{ $key }}
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>

                                <input type="text" name="title"
                                    value="{{ old('title', $recommendationTemplateSetting->title ?? '') }}"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="शिर्षक" required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="is_hospital_detail_required" class="form-label">अस्पताल विवरण आवश्यक छ ?</label>
                                <select name="is_hospital_detail_required" id="is_hospital_detail_required"
                                    class="form-select">
                                    <option
                                        {{ $recommendationTemplateSetting?->is_hospital_detail_required ? 'selected' : '' }}
                                        value="1">छ</option>
                                    <option
                                        {{ !$recommendationTemplateSetting?->is_hospital_detail_required ? 'selected' : '' }}
                                        value="0">छैन</option>
                                </select>
                                @error('is_hospital_detail_required')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">टेम्पलेट *</label>
                                <textarea class="form-control ckEditor" name="description" id="description" placeholder="टेम्पलेट">{{ old('description', $recommendationTemplateSetting->description ?? '') }}</textarea>
                                @error('description')
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
