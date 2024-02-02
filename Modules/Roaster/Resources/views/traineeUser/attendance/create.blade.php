@extends('roaster::traineeUser.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('traineeOrganization.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('traineeOrganization.admin.attendance.index', [$training, $trainee]) }}">हाजिरी</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ हाजिरी थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">हाजिरी थप्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">हाजिरी थप्नुहोस्</h4>
                        <a href="{{ route('traineeOrganization.admin.attendance.index', [$training, $trainee]) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> हाजिरी सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('traineeOrganization.admin.attendance.store', [$training, $trainee]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="date" class="form-label">मिति *</label>
                                    <input id="title" type="date" name="date" placeholder="मिति"
                                        class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}"
                                        required />
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="status1" class="form-label">स्थिति</label>
                                    <div class="d-flex justify-content-between gap-1">
                                        <select id="status1" name="status" class="form-select">
                                            <option value="">-- छान्नुहोस् --</option>
                                            @foreach (App\Enums\AttendanceEnum::cases() as $key => $attendace)
                                                <option value="{{ $attendace->value }}">{{ $attendace->label() }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
