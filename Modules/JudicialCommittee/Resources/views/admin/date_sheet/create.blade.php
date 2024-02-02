@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">तारिख पर्चा थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">तारिख पर्चा</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">तारिख पर्चा थप्नुहोस्</h4>
                        <a href="{{ route('admin.judicialCommittee.registeredApplication') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> दर्ता भएका उजुरी
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form
                        action="{{ route('admin.judicialCommittee.complaintApplication.dateSheet.store', $complaintApplication) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="year" class="form-label"> आवेदन वर्ष <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="year" class="form-control" value="{{ old('year') }}"
                                    id="year" placeholder="आवेदन वर्ष" required />
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="case_name" class="form-label"> केस नाम <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="case_name" class="form-control" value="{{ old('case_name') }}"
                                    id="case_name" placeholder="केस नाम" required />
                                @error('case_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component nameNe="appearance_date" labelNe="हाजिर हुने मिति *"
                                    nameEn="en_appearance_date" labelEn="Appearance Date" :getTodayDate="false" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="appearance_time" class="form-label"> हाजिर हुने समय <span
                                        class="text-danger">*</span></label>
                                <input type="time" name="appearance_time" class="form-control"
                                    value="{{ old('appearance_time') }}" id="appearance_time" placeholder="हाजिर हुने समय"
                                    required />
                                @error('appearance_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component nameNe="submitted_date" labelNe="पेश मिति *"
                                    nameEn="en_submitted_date" labelEn="Submitted Date" />
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    पेश गर्नुहोस्
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
