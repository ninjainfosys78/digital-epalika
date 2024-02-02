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
                            <a href="{{route('admin.grant.setting.enterpriseType.index')}}">उद्यम प्रकार</a>
                        </li>
                        <li class="breadcrumb-item active">उद्यम प्रकार सम्पादन गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">उद्यम प्रकार सम्पादन गर्नुहोस</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">उद्यम प्रकार सम्पादन गर्नुहोस</h4>
                        <a href="{{route('admin.grant.setting.enterpriseType.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> उद्यम प्रकार सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.grant.setting.enterpriseType.update',$enterpriseType)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">शीर्षक</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title',$enterpriseType)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="शीर्षक"
                                    required
                                />
                                @error('title')
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
