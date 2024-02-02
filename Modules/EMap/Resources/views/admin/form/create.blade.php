@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">नयाँ सिफारिस</h4>
                <div class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सिफारिस</li>
                        <li class="breadcrumb-item active">नयाँ सिफारिस</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">नयाँ सिफारिस दर्ता गर्नुहोस</h4>
                    <a href="{{ route('emap.admin.form.index', '') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> सिफारिस सुची
                    </a>
                </div>
            </div>
            <div class="px-0 card-body">
                @livewire('emap::form-data-type-livewire')

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
    <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
