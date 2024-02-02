@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.grievanceHandling.dashboard')}}">
                            <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.grievanceHandling.grievanceUser.index')}}">गुनासो प्रयोगकर्ताहरु</a>
                    </li>
                    <li class="breadcrumb-item active">नयाँ गुनासो प्रयोगकर्ता थप्नुहोस्</li>
                </ol>
            </div>
            <h4 class="page-title">गुनासो प्रयोगकर्ता</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">गुनासो प्रयोगकर्ता थप्नुहोस्</h4>
                    <a href="{{route('admin.grievanceHandling.grievanceUser.index')}}"
                        class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> गुनासो प्रयोगकर्ता सूची
                    </a>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{route('admin.grievanceHandling.grievanceUser.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">नाम *</label>
                            <input type="text" name="name" value="{{old('name')}}"
                                class="form-control @error('name') is-invalid @enderror" id="name" placeholder="नाम" />
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="phone" class="form-label">फोन *</label>
                            <input type="text" name="phone" value="{{old('phone')}}"
                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                placeholder="फोन " />
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email" class="form-label">इमेल </label>
                            <input type="text" name="email" value="{{old('email')}}"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="इमेल " />
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="address" class="form-label">ठेगाना </label>
                            <input type="text" name="address" value="{{old('address')}}"
                                class="form-control @error('address') is-invalid @enderror" id="address"
                                placeholder="ठेगाना " />
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