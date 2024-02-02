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
                            <a href="">पालिका विवरण</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ पालिका विवरण थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">पालिका विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ पालिका विवरण थप्नुहोस्</h4>
                        <a href="{{route('admin.global.website.municipalDetail.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> पालिका विवरण सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.website.municipalDetail.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label"> शीर्षक *</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title')}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="शीर्षक"
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="icon" Aclass="form-label">आइकन *</label>
                                <a target="_blank"
                                    href="https://fontawesome.com/icons/">
                                    आइकनको लागि यँहा क्लिक गर्नुहोस्
                                </a>
                                <input
                                    type="text"
                                    name="icon"
                                    value="{{old('icon')}}"
                                    class="form-control @error('icon') is-invalid @enderror"
                                    id="icon"
                                />
                                @error('icon')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="bg_color" class="form-label">कलर *</label>
                                <input
                                    type="color"
                                    name="bg_color"
                                    value="{{old('bg_color')}}"
                                    class="form-control @error('bg_color') is-invalid @enderror"
                                    id="bg_color"
                                    placeholder="कलर"
                                />
                                @error('bg_color')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="count" class="form-label">गणना *</label>
                                <input
                                    type="text"
                                    name="count"
                                    value="{{old('count')}}"
                                    class="form-control @error('count') is-invalid @enderror"
                                    id="count"
                                    placeholder="गणना"
                                />
                                @error('count')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="position" class="form-label">स्थिति </label>
                                <input
                                    type="number"
                                    name="position"
                                    value="{{old('position')}}"
                                    class="form-control @error('position') is-invalid @enderror"
                                    id="position"
                                    placeholder="स्थिति"
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
