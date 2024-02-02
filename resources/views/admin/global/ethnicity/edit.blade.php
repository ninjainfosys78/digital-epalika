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
                            <a href="{{route('admin.global.dashboard')}}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">जातियता सम्पादन</li>
                    </ol>
                </div>
                <h4 class="page-title">जातियता सम्पादन</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">जातियता सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.global.generalSetting.ethnicity.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> जातियता सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.generalSetting.ethnicity.update',$ethnicity)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="title" class="form-label">जातियता *</label>
                                <input id="title" type="text" name="title" placeholder="जातियता"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{old('title', $ethnicity->title)}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
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
