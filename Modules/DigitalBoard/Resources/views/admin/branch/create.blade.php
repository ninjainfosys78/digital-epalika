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
                            <a href="{{ route('admin.helpDesk.branch.index') }}">हेल्प डेस्क </a>
                        </li>
                        <li class="breadcrumb-item active">शाखा</li>
                    </ol>
                </div>
                <h4 class="page-title">शाखा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ शाखा थप्नुहोस्</h4>
                        <a href="{{ route('admin.helpDesk.branch.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> शाखा सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.helpDesk.branch.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="branch_id" class="form-label">मुख्य शाखा</label>
                                <select name="branch_id" class="form-select @error('branch_id') is-invalid @enderror"
                                    id="branch_id">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($mainBranches as $mainBranch)
                                        <option {{ $mainBranch->id === old('branch_id') ? 'selected' : '' }}
                                            value="{{ $mainBranch->id }}">
                                            {{ $mainBranch->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="branch_name" class="form-label">शाखा नाम *</label>
                                <input type="text" name="branch_name" value="{{ old('branch_name') }}"
                                    class="form-control @error('branch_name') is-invalid @enderror" id="branch_name"
                                    placeholder="शाखा नाम" required />
                                @error('branch_name')
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
