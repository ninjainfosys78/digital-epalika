@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.setting.committeeType.index') }}">
                                समिति प्रकार
                            </a>
                        </li>
                        <li class="breadcrumb-item active">समिति प्रकार थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">समिति प्रकार</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">समिति प्रकार थप्नुहोस्</h4>
                        <a href="{{ route('admin.executiveMeeting.setting.committeeType.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> समिति प्रकार सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.executiveMeeting.setting.committeeType.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">शिर्षक *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="शिर्षक " required />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="committee_no" class="form-label">समिति संख्या</label>
                                <input type="number" name="committee_no" value="{{ old('committee_no') }}"
                                    class="form-control @error('committee_no') is-invalid @enderror" id="committee_no"
                                    placeholder="समिति संख्या" required />
                                @error('committee_no')
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
@endsection
