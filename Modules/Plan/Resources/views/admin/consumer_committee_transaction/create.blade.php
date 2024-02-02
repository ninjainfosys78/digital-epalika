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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.project.index') }}">
                                योजनाहरु
                            </a>
                        </li>
                        <li class="breadcrumb-item active">किस्ता/पेश्की विवरण थप्नुहोस्</li>

                        <li class="breadcrumb-item active">योजनाहरु</li>
                    </ol>
                </div>
                <h4 class="page-title">किस्ता/पेश्की विवरण थप्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">किस्ता/पेश्की विवरण थप्नुहोस्</h4>
                        <a href="{{ route('admin.plan.project.consumerCommitteeTransaction.index', $project) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> किस्ता/पेश्की विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.project.consumerCommitteeTransaction.store', $project) }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="type" class="form-label">प्रकार *</label>
                                <select name="type" class="form-select @error('type') is-invalid @enderror"
                                    id="type" required>
                                    <option value=""> -- छान्नुहोस् --</option>
                                    @foreach (\Modules\Plan\Enums\TransactionTypeEnum::cases() as $transactionType)
                                        <option value="{{ $transactionType->value }}">
                                            {{ $transactionType->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <x-date-input-component nameNe="date" labelNe="मिति" nameEn="en_date" labelEn="Start Date"
                                    :getTodayDate="false" />
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="amount" class="form-label">रकम *</label>
                                <input type="number" name="amount" value="{{ old('amount') }}"
                                    class="form-control @error('amount') is-invalid @enderror" id="amount"
                                    placeholder="रकम" required />
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="remarks" class="form-label">कैफियत</label>
                                <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror" placeholder="कैफियत"
                                    cols="30" rows="3">{{ old('remarks') }}</textarea>
                                @error('remarks')
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
