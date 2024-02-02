@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.global.dashboard') }}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">आपतकालिन सेवा सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">आपतकालिन सेवाहरु</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ आपतकालिन सेवा थप्नुहोस्</h4>
                        <a href="{{ route('admin.global.generalSetting.emergencyCategory.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> आपतकालिन सेवाको सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.global.generalSetting.emergencyCategory.update', $emergencyCategory) }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        @method('PUT')

                        <div class="row">


                            <div class="col-md-4 mb-2">
                                <label for="title" class="form-label">शिर्षक आबस्यक छ *</label>
                                <input id="title" type="text" name="title" placeholder="शिर्षक आबस्यक छ"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $emergencyCategory->title) }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="image">फोटो </label>
                                <input type="file" name="image" id="image" class="form-control" >
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
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
