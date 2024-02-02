@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">टेम्प्लेट</h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.eMapTemplate.index') }}">
                                टेम्प्लेट
                            </a>
                        </li>
                        <li class="breadcrumb-item active">टेम्प्लेट थप्नुहोस्</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title mb-0">टेम्प्लेट थप्नुहोस्</h4>
                <a href="{{ route('emap.admin.eMapTemplate.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fa fa-list"></i> टेम्प्लेट सूची
                </a>
            </div>
        </div>
        <div class="px-0 card-body">
            <form action="{{ route('emap.admin.eMapTemplate.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="title" class="form-label">शिर्षक *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror" id="title" placeholder="शिर्षक" />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        @foreach ((new \Modules\EMap\Entities\MapApply())->getTemplateOptions() as $template)
                            <div class="mt-2 mb-2">
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
                        <h4>Static Template :</h4>
                        <div class="button-list d-flex flex-wrap">
                            <button class="btn btn-outline-primary btn-xs getTemplate" data-bs-type="level">
                                प्लिन्थ लेभलसम्म निर्माण कार्यको ईजाजत पत्र
                            </button>
                            <button class="btn btn-outline-primary btn-xs getTemplate" data-bs-type="superstructure">
                                भवन निर्माण स्थायी ईजाजत पत्र (Superstructure को लागि)
                            </button>
                            <button class="btn btn-outline-primary btn-xs getTemplate"
                                data-bs-type="construction-completion-certificate">
                                भवन निर्माण कार्य सम्पन्न प्रमाण-पत्र
                            </button>
                            <button class="btn btn-outline-primary btn-xs getTemplate" data-bs-type="naksa_certificate">
                                नक्सा प्रमाणित प्रमाण-पत्र
                            </button>
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
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
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
                    const type = button.getAttribute('data-bs-type')
                    $.ajax({
                        type: "POST",
                        url: "{{ route('emap.admin.template-emap.get-static-template') }}",
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
