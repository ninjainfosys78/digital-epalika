@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सिफारिस</li>
                        <li class="breadcrumb-item active">नयाँ सिफारिस</li>
                    </ol>
                </div>
                <h4 class="page-title">नयाँ सिफारिस</h4>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ सिफारिस दर्ता गर्नुहोस</h4>
                        <a href="{{ route('admin.recommendation.recommendationCategory.registrationDetail.index', '1') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सिफारिस सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">

                    <form action="{{ route('admin.recommendation.sipharish.form-fields.store', '1') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>
                                <h4 class="text-info">सिफारिस फाराम</h4>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <label for="files" class="form-label fw-bold">आवश्यक Field <span
                                                class="text-danger">*</span></label>
                                        <button type="button" class="btn btn-xs btn-outline-info"
                                            data-target-element="files" data-toggle="add-more">
                                            <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                        </button>
                                    </div>
                                    <fieldset class="bg-soft-secondary">
                                        <div id="files">
                                            <div class="main">
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-toggle="remove-parent" data-parent=".main"
                                                        data-target-element="files">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="row border-bottom mb-2">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="title" class="form-label">शिर्षक</label>
                                                        <input type="text" name="field[][field_name]"
                                                            class="form-control" id="title" placeholder="शिर्षक" />
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="documents" class="form-label">डकुमेन्ट </label>
                                                        <select id="personal_detail_id" name="field[][status]"
                                                            class="form-select personalDetail">
                                                            <option value="">-- छान्नुहोस् --</option>
                                                            <option value="active"
                                                                {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                                            </option>
                                                            <option value="inactive"
                                                                {{ old('status') == 'active' ? 'selected' : '' }}>Inactive
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-primary mt-2">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
