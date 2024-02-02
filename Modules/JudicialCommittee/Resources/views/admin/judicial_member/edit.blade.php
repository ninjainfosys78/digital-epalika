@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.judicialCommittee.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.judicialCommittee.judicialMember.index')}}">
                                न्यायिक समिति विवरण
                            </a>
                        </li>
                        <li class="breadcrumb-item active">न्यायिक समिति विवरण सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">न्यायिक समिति विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">न्यायिक समिति सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.judicialCommittee.judicialMember.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> न्यायिक समिति विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.judicialCommittee.judicialMember.update',$judicialMember)}}"
                          enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">नाम *</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{old('name',$judicialMember->name)}}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    placeholder="नाम"
                                    required
                                />
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="designation" class="form-label">पद *</label>
                                <input
                                    type="text"
                                    name="designation"
                                    value="{{old('designation',$judicialMember->designation)}}"
                                    class="form-control @error('designation') is-invalid @enderror"
                                    id="designation"
                                    placeholder="पद"
                                    required
                                />
                                @error('designation')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="phone" class="form-label">सम्पर्क नं. *</label>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{old('phone',$judicialMember->phone)}}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone"
                                    placeholder="सम्पर्क नं."
                                />
                                @error('phone')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label">इमेल</label>
                                <input
                                    type="text"
                                    name="email"
                                    value="{{old('email',$judicialMember->email)}}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="इमेल"
                                />
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="address" class="form-label">ठेगाना</label>
                                <input
                                    type="text"
                                    name="address"
                                    value="{{old('address',$judicialMember->address)}}"
                                    class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    placeholder="ठेगाना"
                                />
                                @error('address')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="position" class="form-label">मर्यादा क्रम </label>
                                <input
                                    type="number"
                                    name="position"
                                    value="{{old('position',$judicialMember->position)}}"
                                    class="form-control @error('position') is-invalid @enderror"
                                    id="position"
                                    placeholder="मर्यादा क्रम "
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
