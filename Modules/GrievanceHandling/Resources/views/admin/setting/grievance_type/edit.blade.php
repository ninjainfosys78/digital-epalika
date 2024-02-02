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
                            <a href="{{route('admin.grievanceHandling.setting.grievanceType.index')}}">गुनासो प्रकार </a>
                        </li>
                        <li class="breadcrumb-item active"> गुनासो प्रकार सम्पादन गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">गुनासो प्रकार </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">गुनासो प्रकार सम्पादन गर्नुहोस</h4>
                        <a href="{{route('admin.grievanceHandling.setting.grievanceType.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> गुनासो प्रकार सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.grievanceHandling.setting.grievanceType.update',$grievanceType)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>गुनासो प्रकार  </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title',$grievanceType->title)}}"
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

