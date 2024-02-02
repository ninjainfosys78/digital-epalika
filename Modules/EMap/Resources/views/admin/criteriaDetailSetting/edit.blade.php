@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.dashboard') }}">
                                <i class="fa fa-home"></i> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">मापदण्ड</li>
                        <li class="breadcrumb-item active">नयाँ मापदण्ड</li>
                    </ol>
                </div>
                <h4 class="page-title">नयाँ मापदण्ड</h4>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ मापदण्ड </h4>
                        <a href="{{ route('emap.admin.criteriaDetailSetting.index','') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> मापदण्ड सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('emap.admin.criteriaDetailSetting.update', $criteriaDetailSetting)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                            <div class="col-md-12 mb-3">
                                    <label for="land_use_area_id" class="form-label"> भूउपयोग क्षेत्र </label>
                                    <select
                                        class="form-select @error('land_use_area_id') is-invalid @enderror"
                                        name="land_use_area_id" id="land_use_area_id">
                                        <option value="">---छान्नुहोस् ---</option>
                                        @foreach ($landUseAreas as $landUseArea)
                                            <option value="{{ $landUseArea->id }}"
                                                {{ old('land_use_area_id') == $landUseArea->id ? 'selected' : '' }}>
                                                {{ $landUseArea->title }}</option>
                                        @endforeach

                                    </select>
                                    @error('land_use_area_id')
                                        <div class="invalid-feedback ">{{ $message }} </div>
                                    @enderror
                                </div>

                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">शीर्षक *</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title', $criteriaDetailSetting->title)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="शीर्षक"
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="area" class="form-label">क्षेत्र *</label>
                                <input
                                    type="number"
                                    name="area"
                                    value="{{old('area', $criteriaDetailSetting->area)}}"
                                    min="0"
                                    step="0.01"
                                    class="form-control @error('area') is-invalid @enderror"
                                    id="area"
                                    placeholder="क्षेत्र"
                                />
                                @error('rate')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>


                            <div class="col-md-4 mb-3">
                                <label for="sign" class="form-label">संकेत</label>
                                <select class="form-select @error('sign') is-invalid @enderror" name="sign"
                                    id="sign">
                                    <option value="">---संकेत छान्नुहोस् ---</option>
                                    @foreach (\Modules\EMap\Enums\SignEnum::cases() as $sign)
                                        <option value="{{ $sign->value }}"
                                            {{ old('sign') == $sign->value ? 'selected' : '' }}>
                                            {{ $sign->label() }}</option>
                                    @endforeach
                                </select>
                                @error('sign')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="gcr" class="form-label">GCR *</label>
                                <input
                                    type="number"
                                    name="gcr"
                                    value="{{old('gcr', $criteriaDetailSetting->gcr)}}"
                                    min="0"
                                    step="0.01"
                                    class="form-control @error('gcr') is-invalid @enderror"
                                    id="gcr"
                                    placeholder="GCR"
                                />
                                @error('rate')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="far" class="form-label">FAR *</label>
                                <input
                                    type="number"
                                    name="far"
                                    value="{{old('far', $criteriaDetailSetting->far)}}"
                                    min="0"
                                    step="0.01"
                                    class="form-control @error('far') is-invalid @enderror"
                                    id="far"
                                    placeholder="FAR"
                                />
                                @error('rate')
                                <div class="invalid-feedback">{{$message}}</div>
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
@push('style')
    <style>
        .hidden {
            display: none;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formType = document.getElementById('form_type');
            const form = document.getElementById('form');
            const file = document.getElementById('file');
            // Add more field variables as needed

            // Function to toggle the visibility of fields based on form_type value
            function toggleFields() {
                const selectedValue = formType.value;

                // Hide all fields initially
                form.classList.add('hidden');
                file.classList.add('hidden');
                // Add more fields to hide as needed

                // Show fields based on the selected value
                if (selectedValue === 'form') {
                    form.classList.remove('hidden');

                    const fileElements = file.querySelectorAll('input, select, textarea, select');
                    fileElements.forEach((element) => {
                        element.value = null;
                    });
                } else if (selectedValue === 'file') {
                    file.classList.remove('hidden');
                    const formElements = form.querySelectorAll('input, select, textarea, select');
                    formElements.forEach((element) => {
                        element.value = null;
                    });
                }
                // Add more conditions to show other fields as needed
            }

            // Initial call to set the initial state based on the form_type value
            toggleFields();

            // Listen for changes in the form_type field
            formType.addEventListener('change', toggleFields);
        });

    </script>
@endpush

