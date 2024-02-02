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
                        <li class="breadcrumb-item active">प्रतिवादी म्याद जारी डाटा भर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रतिवादी म्याद जारी</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">प्रतिवादी म्याद जारी डाटा भर्नुहोस्</h4>
                        <a href="{{ route('admin.judicialCommittee.registeredApplication') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> दर्ता भएका उजुरी
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form
                        action="{{ route('admin.judicialCommittee.complaintApplication.defendantIssuedDeadline.store', $complaintApplication) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="day_to_attend" class="form-label"> सहभागी हुनुपर्ने दिन <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="day_to_attend" class="form-control"
                                    value="{{ old('day_to_attend') }}" id="day_to_attend" placeholder="सहभागी हुनुपर्ने दिन"
                                    required />
                                @error('day_to_attend')
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
