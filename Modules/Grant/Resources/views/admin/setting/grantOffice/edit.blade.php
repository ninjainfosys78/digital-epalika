@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.grant.setting.grantOffice.index')}}">अनुदान कार्यालय</a>
                        </li>
                        <li class="breadcrumb-item active">अनुदान कार्यालय  सम्पादन गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">अनुदान कार्यालय  सम्पादन गर्नुहोस</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">अनुदान कार्यालय सम्पादन गर्नुहोस</h4>
                        @can('grantOffice_access')
                            <a href="{{route('admin.grant.setting.grantOffice.index')}}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> अनुदान कार्यालय सूची
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.grant.setting.grantOffice.update', $grantOffice)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="office_name" class="form-label">अनुदान कार्यालय</label>
                                <input
                                    type="text"
                                    name="office_name"
                                    value="{{old('office_name',$grantOffice->office_name)}}"
                                    class="form-control @error('office_name') is-invalid @enderror"
                                    id="office_name"
                                    placeholder="अनुदान कार्यालय"
                                    required
                                />
                                @error('office_name')
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
