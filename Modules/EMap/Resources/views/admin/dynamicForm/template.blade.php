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
                        <li class="breadcrumb-item active">नक्शा पास फारम</li>
                        <li class="breadcrumb-item active">नक्शा पास फारम टेम्प्लेट</li>
                    </ol>
                </div>
                <h4 class="page-title">नक्शा पास फारम टेम्प्लेट</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नक्शा पास फारम टेम्प्लेट</h4>
                        <a href="{{ route('emap.admin.dynamicForm.index', '') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> नक्शा पास फारम सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('emap.admin.dynamicForm.template.store', $dynamicForm) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label for="template" class="form-label">टेम्प्लेट</label>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                @foreach ((new \Modules\EMap\Entities\MapApply())->getTemplateOptions() as $template)
                                    <div class="mt-2">
                                        <h4>{{ $template['title'] ?? '' }} :</h4>
                                        <div class="button-list d-flex flex-wrap mb-2">
                                            @foreach ($template['data'] as $key => $templateValue)
                                                <button type="button" class="btn btn-outline-primary btn-xs"
                                                    onclick="copyText('{{ $templateValue }}')">
                                                    {{ $key }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-12 mb-2">
                                    @foreach ($data as $key => $formField)
                                        <div class="mt-2">
                                            <h4>{{ $key ?? '' }} :</h4>
                                            <div class="button-list">
                                                @foreach ($formField as $index => $formData)
                                                    <button type="button" class="btn btn-outline-primary btn-xs"
                                                        onclick="copyText('{{ '[@form.' . $index . ']' }}')">
                                                        {{ $formData }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="col-md-12 mb-2">
                                    <textarea id="template" class="form-control ckEditor" name="template" cols="30" rows="10">{{ old('template', $dynamicForm->template) }}</textarea>
                                    @error('template')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">
                                पेश गर्नुहोस्
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
