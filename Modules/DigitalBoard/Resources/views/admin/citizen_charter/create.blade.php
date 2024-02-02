@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home"></i> गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.digitalBoard.citizenCharter.index') }}">डिजिटल बोर्ड</a>
                    </li>
                    <li class="breadcrumb-item active">नयाँ नागरिक वडापत्र थप्नुहोस्</li>
                </ol>
            </div>
            <h4 class="page-title">नागरिक वडापत्र</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">नयाँ नागरिक वडापत्र थप्नुहोस्</h4>
                    <a href="{{ route('admin.digitalBoard.citizenCharter.index') }}"
                        class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> सुची
                    </a>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('admin.digitalBoard.citizenCharter.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-primary">
                            <strong>नागरिक वडापत्र विवरण </strong>
                        </legend>
                        <div class="row">
                            <div class="col-md-6 mb-2">
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
                            <div class="col-md-6 mb-2">
                                <label for="service" class="form-label">सेवा </label>
                                <input type="text" name="service" value="{{ old('service') }}"
                                    class="form-control @error('service') is-invalid @enderror" id="service"
                                    placeholder="सेवा" />
                                @error('service')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="amount" class="form-label">सेवा शुल्क तथा दस्तुर रकम </label>
                                <input type="text" name="amount" value="{{ old('amount') }}"
                                    class="form-control @error('amount') is-invalid @enderror" id="amount"
                                    placeholder="सेवा शुल्क तथा दस्तुर रकम" />
                                @error('amount')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="time" class="form-label">लाग्ने समय </label>
                                <input type="text" name="time" value="{{ old('time') }}"
                                    class="form-control @error('time') is-invalid @enderror" id="time"
                                    placeholder="लाग्ने समय " />
                                @error('time')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="responsible_person" class="form-label">जिम्मेवार व्यक्ति </label>
                                <input type="text" name="responsible_person" value="{{ old('responsible_person') }}"
                                    class="form-control @error('responsible_person') is-invalid @enderror"
                                    id="responsible_person" placeholder="जिम्मेवार व्यक्ति" />
                                @error('responsible_person')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="required_document">आवश्यक कागजातहरु</label>
                                <textarea id="required_document" class="form-control" name="required_document" cols="30"
                                    rows="10">{{old('required_document')}}</textarea>
                                @error('required_document')
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