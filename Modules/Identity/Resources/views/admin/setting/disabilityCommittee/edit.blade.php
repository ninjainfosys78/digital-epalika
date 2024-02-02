@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अपाङ्ग समिति</li>
                    </ol>
                </div>
                <h4 class="page-title">अपाङ्ग समिति</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> अपाङ्ग समिति सम्पादन गर्नुहोस</h4>
                        <a href="{{ route('identity.admin.setting.disabilityCommittee.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> अपाङ्ग समिति सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('identity.admin.setting.disabilityCommittee.update', $disabilityCommittee) }}"
                        method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">नाम *</label>
                                <input type="text" name="name" value="{{ old('name', $disabilityCommittee->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="नाम" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="phone" class="form-label">फोन</label>
                                <input type="text" name="phone" value="{{ old('phone', $disabilityCommittee->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="फोन" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="designation" class="form-label">पद</label>
                                <input type="text" name="designation"
                                    value="{{ old('designation', $disabilityCommittee->designation) }}"
                                    class="form-control @error('designation') is-invalid @enderror" id="designation"
                                    placeholder="पद" />
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="position" class="form-label">मर्यादाक्रम</label>
                                <input type="number" name="position"
                                    value="{{ old('position', $disabilityCommittee->position) }}"
                                    class="form-control @error('position') is-invalid @enderror" id="position"
                                    placeholder="मर्यादाक्रम" />
                                @error('position')
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
