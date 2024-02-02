@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अस्पताल</li>
                    </ol>
                </div>
                <h4 class="page-title">  अस्पताल</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> अस्पताल सम्पादन गर्नुहोस</h4>
                        <a href="{{route('identity.admin.setting.hospital.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>  अस्पताल सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('identity.admin.setting.hospital.update',$hospital)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">नाम *</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{old('name',$hospital->name)}}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    placeholder="नाम"
                                />
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="phone" class="form-label">फोन</label>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{old('phone',$hospital->phone)}}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone"
                                    placeholder="फोन"
                                />
                                @error('phone')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label">ईमेल</label>
                                <input
                                    type="text"
                                    name="email"
                                    value="{{old('email',$hospital->email)}}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="ईमेल"
                                />
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="address" class="form-label">ठेगाना *</label>
                                <input
                                    type="text"
                                    name="address"
                                    value="{{old('address',$hospital->address)}}"
                                    class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    placeholder="ठेगाना"
                                />
                                @error('address')
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


