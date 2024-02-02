@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.global.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.global.generalSetting.employee.show',$employee)}}">फाईल</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ फाईल</li>
                    </ol>
                </div>
                <h4 class="page-title">फाईल </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ फाईल</h4>
                        <a href="{{route('admin.global.generalSetting.employee.show',$employee)}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> फाईल सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.generalSetting.employee.experienceFile.store',$employee)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>फाईल विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title')}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="शिर्षक"
                                    />
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="file" class="form-label">फाईल *</label>
                                    <input
                                        type="file"
                                        name="file"
                                        class="form-control @error('file') is-invalid @enderror"
                                        id="file"

                                    />
                                    @error('file')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>


                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

