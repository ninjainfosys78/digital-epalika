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
                        <li class="breadcrumb-item active">बजेट
                            {{ $type == 'budgetSubHead' ? 'उप-शिर्षकहरु' : 'शिर्षकहरु' }}
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">बजेट {{ $type == 'budgetSubHead' ? 'उप-शिर्षकहरु' : 'शिर्षकहरु' }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ बजेट {{ $type == 'budgetSubHead' ? 'उप-शिर्षक' : 'शिर्षक' }} थप्नुहोस्
                        </h4>
                        <a href="{{ route('admin.plan.budgetHead.index', $type) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> बजेट {{ $type == 'budgetSubHead' ? 'उप-शिर्षकहरु' : 'शिर्षकहरु' }}
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.budgetHead.store', $type) }}" method="post">
                        @csrf
                        <div class="row">
                            @if ($type == 'budgetSubHead')
                                <div class="col-md-12 mb-2">
                                    <label for="budget_head_id" class="form-label">मुख्य बजेट शिर्षक</label>
                                    <select name="budget_head_id"
                                        class="form-control @error('budget_head_id') is-invalid @enderror"
                                        id="budget_head_id" data-toggle="select2" data-width="100%">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($mainBudgetHeads as $mainBudgetHead)
                                            <option {{ $mainBudgetHead->id == old('budget_head_id') ? 'selected' : '' }}
                                                value="{{ $mainBudgetHead->id }}">
                                                {{ $mainBudgetHead->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('budget_head_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="बजेट शिर्षक" required />
                                @error('title')
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
