@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.digitalBoard.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.digitalBoard.service.index') }}">हेल्प डेस्क </a>
                        </li>
                        <li class="breadcrumb-item active">सेवा</li>
                    </ol>
                </div>
                <h4 class="page-title">सेवा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ कर्मचारी थप्नुहोस्</h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.digitalBoard.service.serviceEmployee.store', $service) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="employee_name" class="form-label">नाम *</label>
                                <input type="text" name="employee_name" value="{{ old('employee_name') }}"
                                    class="form-control @error('employee_name') is-invalid @enderror" id="employee_name"
                                    placeholder=" नाम" />
                                @error('employee_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="photo" class="form-label">फोटो</label>
                                <input type="file" name="photo"
                                    class="form-control @error('photo') is-invalid @enderror" id="photo" />
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="email" class="form-label">इमेल</label>
                                <input type="text" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="इमेल" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="phone" class="form-label">फोन</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="फोन" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="designation" class="form-label">पद *</label>
                                <input type="text" name="designation" value="{{ old('designation') }}"
                                    class="form-control @error('designation') is-invalid @enderror" id="designation"
                                    placeholder="पद" />
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="position" class="form-label">स्थान</label>
                                <input type="number" name="position" value="{{ old('position') }}"
                                    class="form-control @error('position') is-invalid @enderror" id="position"
                                    min="0" placeholder="स्थान" />
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">सेवा दिने कर्मचारीहरु </h4>
                        <a href="{{ route('admin.digitalBoard.service.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सेवा सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th> नाम</th>
                                    <th> पद</th>
                                    <th>फोन</th>
                                    <th>इमेल</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($service->serviceEmployees as $key=>$serviceEmployee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="table-user">
                                            <img src="{{ $serviceEmployee->photo_url }}" class="me-2 rounded-circle"
                                                alt="">
                                            {{ $serviceEmployee->employee_name }}
                                        </td>
                                        <td>{{ $serviceEmployee->designation }}</td>
                                        <td>{{ $serviceEmployee->phone }}</td>
                                        <td>{{ $serviceEmployee->email }}</td>
                                        <td class="d-flex gap-1">
                                            <a data-bs-type="edit"
                                                href="{{ route('admin.digitalBoard.service.serviceEmployee.edit', [$service, $serviceEmployee]) }}"
                                                class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.digitalBoard.service.serviceEmployee.destroy', [$service, $serviceEmployee]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
