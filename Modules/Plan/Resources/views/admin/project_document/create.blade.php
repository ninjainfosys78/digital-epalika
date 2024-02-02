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

                        <li class="breadcrumb-item active">योजनाहरु</li>
                    </ol>
                </div>
                <h4 class="page-title">नयाँ कागजात थप्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ कागजात थप्नुहोस्</h4>
                        <a href="{{ route('admin.plan.project.show', $project) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.project.projectDocument.store', $project) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="document_name" class="form-label">कागजात नाम *</label>
                                <input type="text" name="document_name" value="{{ old('document_name') }}"
                                    class="form-control @error('document_name') is-invalid @enderror" id="document_name"
                                    placeholder="कागजात नाम" required />
                                @error('document_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="plan_template_id" class="form-label">कागजात प्रकार</label>
                                <select name="plan_template_id" class="form-select" id="plan_template_id">
                                    <option value=""> कागजात प्रकार छान्नुहोस्</option>
                                    @foreach ($planTemplates as $planTemplate)
                                        <option
                                            value="{{ route('admin.plan.project.templateData', [$project, $planTemplate]) }}">
                                            {{ $planTemplate->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="data" class="form-label">डाटा *</label>
                                <textarea name="data" id="data" required cols="30" rows="10"
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
        <script>
            $(document).ready(function() {
                $('#plan_template_id').on('change', function() {
                    $.ajax({
                        type: 'GET',
                        url: $(this).val(),
                        success: function(resp) {
                            CKEDITOR.instances.data.setData(resp.data);
                            console.log(resp)
                        },
                        error: function() {
                            alert('Something Went Wrong')
                        }
                    })
                })
            })
        </script>
    @endpush
@endsection
