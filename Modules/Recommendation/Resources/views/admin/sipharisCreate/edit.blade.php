@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                     alt="document-icon">
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
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ सिफारिस दर्ता गर्नुहोस</h4>
                        <a href="{{ route('admin.recommendation.recommendationCategory.registrationDetail.index','1') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सिफारिस सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.recommendation.sipharish.sipharishCreate.store') }}" method="post">
                        @csrf
                        @livewire('field', ['categorySubCategory'=>[
                               'sipharis_category_id' => old('sipharis_category_id',$sipharishCreate->SipharishFormType?->sipharisSubCategory?->sipharis_category_id),
                               'sipharis_sub_category_id' => old('sipharis_sub_category_id',$sipharishCreate->SipharishFormType?->sipharis_sub_category_id),
                               'personal_detail_id' => old('personal_detail_id',$sipharishCreate->personal_detail_id),
                               'mobile_user_id' => old('mobile_user_id',$sipharishCreate->mobile_user_id),
                               'sipharis_form_type_id' => old('sipharis_form_type_id',$sipharishCreate->sipharis_form_type_id),
                               'status' => old('status',$sipharishCreate->status),
                               'fields' => old('fields', $sipharishCreate->SipharishCreatedValues),
                           ]])

                        <div class="col-md-12 mb-2">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label for="documents" class="form-label fw-bold">आवश्यक कागजातहरु <span
                                        class="text-danger">*</span></label>
                                <button type="button" class="btn btn-xs btn-outline-info"
                                        data-target-element="documents"
                                        data-toggle="add-more">
                                    <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                </button>
                            </div>
                            <fieldset class="bg-soft-secondary">
                                <div id="documents">
                                    <div class="main">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-toggle="remove-parent" data-parent=".main"
                                                    data-target-element="documents">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row border-bottom mb-2">
                                            <div class="col-md-6 mb-2">
                                                <label for="title" class="form-label">शिर्षक</label>
                                                <input type="text" name="files[][title]" class="form-control"
                                                       id="title" placeholder="शिर्षक"/>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="documents" class="form-label">डकुमेन्ट </label>
                                                <input type="file" name="files[][filename]" class="form-control"
                                                       id="documents"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @includeIf('recommendation::admin.registration.inc.file')

@endsection
