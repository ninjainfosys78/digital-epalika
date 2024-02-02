@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.businessRegistration.setting.objectTransaction.index') }}">कारोबार
                                गर्ने वस्तु </a>
                        </li>
                        <li class="breadcrumb-item active">कारोबार गर्ने वस्तु</li>
                    </ol>
                </div>
                <h4 class="page-title">कारोबार गर्ने वस्तु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">कारोबार गर्ने वस्तु थप्नुहोस्</h4>
                        <a href="{{ route('admin.businessRegistration.setting.objectTransaction.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>कारोबार गर्ने वस्तु सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.businessRegistration.setting.objectTransaction.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> कारोबार गर्ने वस्तु</strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="object_transaction_id" class="form-label">कारोबार गर्ने वस्तुको
                                        वर्ग</label>
                                    <select name="object_transaction_id" id="object_transaction_id"
                                        class="form-control @error('object_transaction_id') is-invalid @enderror">
                                        <option value="">कारोबार गर्ने वस्तुको वर्ग छान्नुहोस्</option>
                                        @foreach ($parentObjectTransactions as $parentObjectTransaction)
                                            <option value="{{ $parentObjectTransaction->id }}"
                                                {{ old('object_transaction_id') == $parentObjectTransaction->id ? 'selected' : '' }}>
                                                {{ $parentObjectTransaction->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('object_transaction_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="शिर्षक " required />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
