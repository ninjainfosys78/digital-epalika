@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.digitalBoard.dashboard') }}">
                            <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item active">सेवा</li>
                </ol>
            </div>
            <h4 class="page-title">सेवा</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header search-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">नयाँ सेवा थप्नुहोस्</h4>
                    <a href="{{ route('admin.digitalBoard.service.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> सेवा सूची
                    </a>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('admin.digitalBoard.service.store') }}" enctype="multipart/form-data"
                    method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="branch_id" class="form-label">शाखा *</label>
                            <select name="branch_id" class="form-select @error('branch_id') is-invalid @enderror"
                                id="branch_id" required>
                                <option value="">छान्नुहोस्</option>
                                @foreach ($mainBranches as $mainBranch)
                                <option {{ $mainBranch->id === old('branch_id') ? 'selected' : '' }}
                                    value="{{ $mainBranch->id }}">
                                    {{ $mainBranch->branch_name }}
                                </option>
                                @foreach ($mainBranch->branches as $branch)
                                <option {{ $branch->id === old('branch_id') ? 'selected' : '' }}
                                    value="{{ $branch->id }}">
                                    &nbsp;&nbsp;
                                    - - {{ $branch->branch_name }}
                                </option>
                                @endforeach
                                @endforeach
                            </select>
                            @error('branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="service_name" class="form-label">सेवा नाम *</label>
                            <input type="text" name="service_name" value="{{ old('service_name') }}"
                                class="form-control @error('service_name') is-invalid @enderror" id="service_name"
                                placeholder="सेवा नाम" required />
                            @error('service_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="time_taken" class="form-label">लाग्ने समय *</label>
                            <input type="text" name="time_taken" value="{{ old('time_taken') }}"
                                class="form-control @error('time_taken') is-invalid @enderror" id="time_taken"
                                placeholder="लाग्ने समय " required />
                            @error('time_taken')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="responsible_officer" class="form-label">जिम्मेवार अधिकारी *</label>
                            <input type="text" name="responsible_officer" value="{{ old('responsible_officer') }}"
                                class="form-control @error('responsible_officer') is-invalid @enderror"
                                id="responsible_officer" placeholder="जिम्मेवार अधिकारी" required />
                            @error('responsible_officer')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="office" class="form-label">कोठा नम्बर /कार्यालय *</label>
                            <input type="text" name="office" value="{{ old('office') }}"
                                class="form-control @error('office') is-invalid @enderror" id="office"
                                placeholder="नम्बर /कार्यालय" required />
                            @error('office')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <!-- <div class="d-flex align-items-center justify-content-between mb-1">
                                <label for="documents" class="form-label fw-bold">आबश्यक कागजात<span
                                        class="text-danger">*</span></label>
                                <button type="button" class="btn btn-xs btn-outline-primary"
                                    data-target-element="documents" data-toggle="add-more">
                                    <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                </button>
                            </div> -->
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-primary d-flex align-items-center gap-2">
                                    <strong> आबश्यक कागजात </strong>
                                    <button type="button" class="ml-2 btn btn-xs btn-outline-primary"
                                        data-target-element="documents" data-toggle="add-more">
                                        <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                    </button>

                                </legend>
                                <div class="card mb-0">
                                    <div class="row" id="documents">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label for="title" class="form-label p-0">शिर्षक *</label>
                                                <button type="button" class="btn btn-sm btn-outline-default"
                                                    data-toggle="remove-parent" data-parent=".main"
                                                    data-target-element="documents">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <input type="text" name="serviceDocuments[][description]"
                                                class="form-control" id="title" placeholder="शिर्षक" required />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- <fieldset class="bg-soft-secondary">
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
                                            <div class="col-md-12 mb-2">
                                                <label for="title" class="form-label">शिर्षक *</label>
                                                <input type="text" name="serviceDocuments[][description]"
                                                    class="form-control" id="title" placeholder="शिर्षक" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> -->
                        </div>
                        <div class="col-md-6 mb-3">

                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-primary d-flex align-items-center gap-2">
                                    <strong>उपलब्ध गराउने प्रक्रिया * </strong>
                                    <button type="button" class="btn btn-xs btn-outline-primary"
                                        data-target-element="process" data-toggle="add-more">
                                        <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                    </button>

                                </legend>
                                <div class="card mb-0">
                                    <div class="row" id="process">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label for="title" class="form-label p-0">शिर्षक *</label>
                                                <button type="button" class="btn btn-sm btn-outline-default"
                                                    data-toggle="remove-parent" data-parent=".main"
                                                    data-target-element="process">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <input type="text" name="serviceProcesses[][description]"
                                                class="form-control" id="title" placeholder="शिर्षक" required />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>



                            <!-- <div class="d-flex align-items-center justify-content-between mb-1">
                                <label for="process" class="form-label fw-bold">उपलब्ध गराउने प्रक्रिया<span
                                        class="text-danger">*</span></label>
                                <button type="button" class="btn btn-xs btn-outline-primary"
                                    data-target-element="process" data-toggle="add-more">
                                    <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                </button>
                            </div> -->
                            <!-- <fieldset class="bg-soft-secondary">
                                <div id="process">
                                    <div class="main">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-toggle="remove-parent" data-parent=".main"
                                                data-target-element="process">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row border-bottom mb-2">
                                            <div class="col-md-12 mb-2">
                                                <label for="title" class="form-label">शिर्षक *</label>
                                                <input type="text" name="serviceProcesses[][description]"
                                                    class="form-control" id="title" placeholder="शिर्षक" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> -->
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