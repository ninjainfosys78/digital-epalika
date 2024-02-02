@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.revenue.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">करदाताको प्रकार</li>
                    </ol>
                </div>
                <h4 class="page-title">करदाताको प्रकार</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ करदाताको प्रकार थप्नुहोस्</h4>
                        <a href="{{route('admin.revenue.setting.taxPayerType.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> करदाताको प्रकार सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.revenue.setting.taxPayerType.update', $taxPayerType)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title', $taxPayerType->title)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="शिर्षक"
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="code" class="form-label">कोड *</label>
                                <input
                                    type="text"
                                    name="code"
                                    value="{{old('code', $taxPayerType->code)}}"
                                    class="form-control @error('code') is-invalid @enderror"
                                    id="code"
                                    placeholder="कोड"
                                />
                                @error('code')
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
