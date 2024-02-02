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
                            <a href="{{ route('admin.businessRegistration.setting.objectTransactionSubCategory.index') }}">कारोबार
                                गर्ने वस्तु उप श्रेणी </a>
                        </li>
                        <li class="breadcrumb-item active">कारोबार गर्ने वस्तु उप श्रेणी</li>
                    </ol>
                </div>
                <h4 class="page-title">कारोबार गर्ने वस्तु उप श्रेणी</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">कारोबार गर्ने वस्तु उप श्रेणी थप्नुहोस्</h4>
                        <a href="{{ route('admin.businessRegistration.setting.objectTransactionSubCategory.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> कारोबार गर्ने वस्तु उप श्रेणी सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.businessRegistration.setting.objectTransactionSubCategory.store') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> कारोबार गर्ने वस्तु उप श्रेणी</strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="शिर्षक " required />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="object_transaction_id" class="form-label">बर्ग *</label>
                                    <select name="object_transaction_id" id="object_transaction_id" class="form-control">
                                        <option value="">छान्नुहोस्</option>
                                        @foreach ($all_objectTransactions as $all_objectTransaction)
                                            <option
                                                value="{{ $all_objectTransaction->id }}"{{ old('object_transaction_id') == $all_objectTransaction->id ? 'selected' : '' }}>
                                                {{ $all_objectTransaction->title }}
                                            </option>
                                        @endforeach
                                        @error('object_transaction_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="category_a" class="form-label">क बर्ग *</label>
                                    <input type="text" name="category_a" value="{{ old('category_a') }}"
                                        class="form-control @error('category_a') is-invalid @enderror" id="category_a"
                                        placeholder="करोड भन्दा बढी पुजी लगानी भएका" required />
                                    @error('category_a')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="category_b" class="form-label">ख बर्ग *</label>
                                    <input type="text" name="category_b" value="{{ old('category_b') }}"
                                        class="form-control @error('category_b') is-invalid @enderror" id="category_b"
                                        placeholder="लाख देखि करोड सम्म पुजि लगानी भएका" required />
                                    @error('category_b')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="category_c" class="form-label">ग बर्ग *</label>
                                    <input type="text" name="category_c" value="{{ old('category_c') }}"
                                        class="form-control @error('category_c') is-invalid @enderror" id="category_c"
                                        placeholder="लाख भन्दा कम पुजि लगानी भएका" required />
                                    @error('category_c')
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
