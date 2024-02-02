@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.setting.minuteSetting.index') }}">
                                माइन्यूट
                            </a>
                        </li>
                        <li class="breadcrumb-item active">माइन्यूट थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">माइन्यूट </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">माइन्यूट</h4>

                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.executiveMeeting.setting.minuteSetting.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">

                            </div>
                            <div class="col-md-12 mb-2">
                                @foreach ((new \Modules\ExecutiveMeeting\Entities\MinuteSetting())->getTemplateOptions() as $template)
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
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">बिवरण * </label>
                                <textarea name="description" id="description" cols="30" placeholder="बिवरण" rows="5"
                                    class="form-control ckEditor @error('description') is-invalid @enderror">{{ old('description', $minuteSetting->description ?? '') }}</textarea>
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
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
@endpush
