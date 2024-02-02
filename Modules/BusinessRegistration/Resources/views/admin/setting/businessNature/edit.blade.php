@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.businessRegistration.dashboard')}}">
                                <i class="fa fa-home"></i> व्यवसाय दर्ता
                            </a>
                        </li>
                        <li class="breadcrumb-item">सेटिङ</li>
                        <li class="breadcrumb-item active"> व्यवसायको प्रकृति सम्पादन</li>
                    </ol>
                </div>
                <h4 class="page-title">व्यवसायको प्रकृति सम्पादन</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">व्यवसाय को प्रकृति सम्पादन गर्नुहोस</h4>
                        <a href="{{route('admin.businessRegistration.setting.businessNature.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> व्यवसाय प्रकृति सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.businessRegistration.setting.businessNature.update',$businessNature)}}" method="post"
                          enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>व्यवसाय प्रकृति </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title',$businessNature->title)}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="शिर्षक "
                                        required
                                    />
                                    @error('title')
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

