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
                            <a
                                href="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.index', $templateTypeEnum) }}">टेम्प्लेट
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
                        <a href="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.index', $templateTypeEnum) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> टेम्प्लेट सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form
                        action="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.store', $templateTypeEnum) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>टेम्प्लेट</strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="शिर्षक " required />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">

                                    @foreach ((new Modules\BusinessRegistration\Entities\BusinessDetail())->getTemplateOptions() as $template)
                                        <div class="col-md-12">
                                            <h6>{{ $template['title'] ?? '' }}</h6>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="row">
                                                @forelse($template['data'] as $key=>$templateValue)
                                                    <button class="col-md-2 btn btn-primary btn-sm m-1" type="button"
                                                        onclick="copyText('{{ $templateValue }}')">{{ $key }}</button>
                                                @empty
                                                    <button class="col-md-2 btn btn-primary btn-sm m-1" type="button">
                                                        दाटा छैन
                                                    </button>
                                                @endforelse

                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 mt-1">
                                        <h6>Static Template</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <span style="cursor: pointer"
                                            class="badge badge-outline-primary text-primary getTemplate"
                                            data-bs-type="level1">
                                            व्यवसाय दर्ता प्रमाण-पत्र
                                        </span>
                                    </div>
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
                        </fieldset>
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
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.getTemplate').on('click', function(event) {
                    event.preventDefault();

                    const button = event.target
                    // Extract info from data-bs-* attributes
                    const type = button.getAttribute('data-bs-type')

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.businessRegistration.setting.get-static-template') }}",
                        data: {
                            type: type
                        },
                        success: function(resp) {
                            CKEDITOR.instances.data.setData(resp);
                        },
                        error: function() {
                            alert("Something Went Wrong");
                        },
                        timeout: 10000
                    });
                });
            });
        </script>
    @endpush
@endsection
