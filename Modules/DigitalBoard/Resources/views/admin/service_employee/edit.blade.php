@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.digitalBoard.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.digitalBoard.service.index')}}">हेल्प डेस्क </a>
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
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">कर्मचारी विवरण अद्यावधिक गर्नुहोस्</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('admin.digitalBoard.service.serviceEmployee.update',[$service,$serviceEmployee])}}"
                        method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="employee_name" class="form-label">नाम *</label>
                                <input
                                    type="text"
                                    name="employee_name"
                                    value="{{old('employee_name',$serviceEmployee->employee_name)}}"
                                    class="form-control @error('employee_name') is-invalid @enderror"
                                    id="employee_name"
                                    placeholder=" नाम"
                                    required
                                />
                                @error('employee_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="photo" class="form-label">फोटो</label>
                                <input
                                    type="file"
                                    name="photo"
                                    class="form-control @error('photo') is-invalid @enderror"
                                    id="photo"
                                />
                                @error('photo')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="email" class="form-label">इमेल</label>
                                <input
                                    type="text"
                                    name="email"
                                    value="{{old('email',$serviceEmployee->email)}}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="इमेल"
                                />
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="phone" class="form-label">फोन</label>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{old('phone',$serviceEmployee->phone)}}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone"
                                    placeholder="फोन"
                                />
                                @error('phone')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="designation" class="form-label">पद *</label>
                                <input
                                    type="text"
                                    name="designation"
                                    value="{{old('designation',$serviceEmployee->designation)}}"
                                    class="form-control @error('designation') is-invalid @enderror"
                                    id="designation"
                                    placeholder="पद"
                                    required
                                />
                                @error('designation')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="position" class="form-label">स्थान</label>
                                <input
                                    type="number"
                                    name="position"
                                    value="{{old('position',$serviceEmployee->position)}}"
                                    class="form-control @error('position') is-invalid @enderror"
                                    id="position"
                                    placeholder="स्थान"
                                />
                                @error('position')
                                <div class="invalid-feedback">{{$message}}</div>
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
