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
                            <a href="{{ route('admin.executiveMeeting.municipalCommittee.index') }}">इ-कार्यपालिका</a>
                        </li>
                        <li class="breadcrumb-item active"> नयाँ वडा समिति थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">वडा समिति</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ वडा समिति थप्नुहोस्</h4>
                        <a href="{{ route('admin.executiveMeeting.wardCommittee.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> वडा समिति बिवरण
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.executiveMeeting.wardCommittee.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>व्यक्तिगत विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="name" class="form-label">नाम *</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="नाम" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if (auth()->user()->role->type === 'Super')
                                    <div class="col-md-4 mb-2">
                                        <label for="committee_ward" class="form-label"> कार्यस्थल वडा नं.</label>
                                        <select name="committee_ward" id="committee_ward"
                                            class="form-select @error('designation') is-invalid @enderror">
                                            <option>--छान्नुहोस्--</option>
                                            @foreach ($officeSetting->localBody->ward_no as $ward)
                                                <option value="{{ $ward }}"
                                                    {{ old('committee_ward') == $ward ? 'selected' : '' }}>
                                                    {{ $ward }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('committee_ward')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="{{ auth()->user()->role->type === 'Super' ? 'col-md-4' : 'col-md-8' }} mb-2">
                                    <label for="photo" class="form-label">फोटो </label>
                                    <input type="file" name="photo"
                                        class="form-control @error('photo') is-invalid @enderror" id="photo" />
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="designation" class="form-label">पद *</label>
                                    <input type="text" name="designation" value="{{ old('designation') }}"
                                        class="form-control @error('designation') is-invalid @enderror" id="designation"
                                        placeholder="पद" required />
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">इमेल </label>
                                    <input type="text" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="इमेल" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="phone" class="form-label">फोन नम्बर * </label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        placeholder="फोन नम्बर" required />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="position" class="form-label">मर्यादाक्रम </label>
                                    <input type="number" name="position" value="{{ old('position') }}"
                                        class="form-control @error('position') is-invalid @enderror" id="position"
                                        placeholder="मर्यादाक्रम" />
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>ठेगाना</strong>
                            </legend>
                            @livewire('address', ['address' => $officeSetting->address])
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="village" class="form-label"> गाउ </label>
                                    <input type="text" name="village" value="{{ old('village') }}"
                                        class="form-control @error('village') is-invalid @enderror" id="village"
                                        placeholder="गाउ" />
                                    @error('village')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="tole" class="form-label">टोल </label>
                                    <input type="text" name="tole" value="{{ old('tole') }}"
                                        class="form-control @error('tole') is-invalid @enderror" id="tole"
                                        placeholder="टोल" />
                                    @error('tole')
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
