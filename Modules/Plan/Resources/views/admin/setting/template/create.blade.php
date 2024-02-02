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
                            <a href="{{ route('admin.plan.planTemplate.index') }}">
                                टेम्प्लेट
                            </a>
                        </li>
                        <li class="breadcrumb-item active">टेम्प्लेट थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">टेम्प्लेट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">टेम्प्लेट थप्नुहोस्</h4>
                        <a href="{{ route('admin.plan.planTemplate.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> टेम्प्लेट सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.planTemplate.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="शिर्षक " />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="template_for" class="form-label">उपभोक्ता समिति/बोलपत्र(टेन्डर) को लागि</label>
                                <select name="template_for" id="type" class="form-control">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach (\Modules\Plan\Enums\ProjectOperatedThroughEnum::cases() as $operatedThroughEnum)
                                        <option {{ old('template_for') == $operatedThroughEnum->value ? 'selected' : '' }}
                                            value="{{ $operatedThroughEnum->value }}">
                                            {{ $operatedThroughEnum->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('template_for')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="type" class="form-label">टेम्प्लेट</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach (\Modules\Plan\Enums\PlanTemplateTypeEnum::cases() as $templateType)
                                        <option {{ old('type') == $templateType->value ? 'selected' : '' }}
                                            value="{{ $templateType->value }}">
                                            {{ $templateType->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">

                                @foreach ((new \Modules\Plan\Entities\Project())->getTemplateOptions() as $template)
                                    <div class="col-md-12 mt-1">
                                        <h6>{{ $template['title'] ?? '' }}</h6>
                                    </div>
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
                                @endforeach
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="data" class="form-label">डाटा *</label>
                                <textarea name="data" id="data" cols="30" rows="10"
                                    class="form-control ckEditor @error('data') is-invalid @enderror">{{ old('data') }}</textarea>
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
