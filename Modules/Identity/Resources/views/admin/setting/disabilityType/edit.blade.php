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
                        <li class="breadcrumb-item active">अपांगताको प्रकार</li>
                    </ol>
                </div>
                <h4 class="page-title">  अपांगताको प्रकार</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> अपांगताको प्रकार सम्पादन गर्नुहोस</h4>
                        <a href="{{route('identity.admin.setting.disabilityType.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>  अपांगताको प्रकार सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('identity.admin.setting.disabilityType.update',$disabilityType)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title',$disabilityType->title)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="शिर्षक"
                                    required
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="title_en" class="form-label">शिर्षक (English) *</label>
                                <input
                                    type="text"
                                    name="title_en"
                                    value="{{old('title_en',$disabilityType->title_en)}}"
                                    class="form-control @error('title_en') is-invalid @enderror"
                                    id="title_en"
                                    placeholder="शिर्षक (English)"
                                    required
                                />
                                @error('title_en')
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


