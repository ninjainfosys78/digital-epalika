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
                        <li class="breadcrumb-item active">आयोजना मर्मत संम्भार सम्बन्धी व्यवस्था</li>
                    </ol>
                </div>
                <h4 class="page-title">आयोजना मर्मत संम्भार सम्बन्धी व्यवस्था</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">
                        आयोजना मर्मत संम्भार सम्बन्धी व्यवस्था सम्पादन गर्नुहोस्
                    </h4>
                    <a href="{{ route('admin.plan.project.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> योजनाहरु
                    </a>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.project.projectMaintenanceArrangement.store', $project) }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="office_name" class="form-label">जिम्मा लिने समिती संस्थाको नाम *</label>
                                <input type="text" name="office_name"
                                    class="form-control @error('office_name') is-invalid @enderror"
                                    value="{{ old('office_name', $project->projectMaintenanceArrangement->office_name ?? '') }}"
                                    id="office_name" placeholder="जिम्मा लिने समिती संस्थाको नाम" required />
                                @error('office_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="public_service" class="form-label">जनश्रमदान</label>
                                <input type="number" name="public_service"
                                    value="{{ old('public_service', $project->projectMaintenanceArrangement->public_service ?? '') }}"
                                    class="form-control @error('public_service') is-invalid @enderror" id="public_service"
                                    placeholder="जनश्रमदान" />
                                @error('public_service')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="service_fee" class="form-label">सेवा शुल्क</label>
                                <input type="number" name="service_fee"
                                    value="{{ old('service_fee', $project->projectMaintenanceArrangement->service_fee ?? 0) }}"
                                    class="form-control @error('service_fee') is-invalid @enderror" id="service_fee"
                                    placeholder="सेवा शुल्क" />
                                @error('service_fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="from_fee_donation" class="form-label">दस्तुर, चन्दाबाट</label>
                                <input type="number" name="from_fee_donation"
                                    value="{{ old('from_fee_donation', $project->projectMaintenanceArrangement->from_fee_donation ?? 0) }}"
                                    class="form-control @error('from_fee_donation') is-invalid @enderror"
                                    id="from_fee_donation" placeholder="दस्तुर, चन्दाबाट" />
                                @error('from_fee_donation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="others" class="form-label">अन्य केहि भए</label>
                                <input type="number" name="others"
                                    value="{{ old('others', $project->projectMaintenanceArrangement->others ?? 0) }}"
                                    class="form-control @error('others') is-invalid @enderror" id="others"
                                    placeholder="अन्य केहि भए" />
                                @error('others')
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
