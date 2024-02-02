@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">तारिख भरपाई सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">तारिख भरपाई</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">तारिख भरपाई सम्पादन गर्नुहोस्</h4>
                        <a href="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.index',$complaintApplication) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> तारिख भरपाई विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.update', [$complaintApplication,$dateCompensation]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="decision_date" labelNe="निर्णय हुने मिति *"
                                    :editDateNe="$dateCompensation->decision_date"
                                    :getTodayDate="false"/>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="decision_subject" class="form-label"> निर्णय हुने विषय <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="decision_subject" class="form-control"
                                       value="{{ old('decision_subject',$dateCompensation->decision_subject) }}"
                                       id="decision_subject" placeholder="निर्णय हुने विषय" required/>
                                @error('decision_subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="decision_time" class="form-label"> निर्णय हुने समय  <span
                                        class="text-danger">*</span></label>
                                <input type="time" name="decision_time" class="form-control"
                                       value="{{ old('decision_time',$dateCompensation->decision_time) }}"
                                       id="decision_time" placeholder="निर्णय हुने समय " required/>
                                @error('decision_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="submitted_date" labelNe="पेश मिति *"
                                    :editDateNe="$dateCompensation->submitted_date"
                                    :get-today-date="false"
                                />
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
