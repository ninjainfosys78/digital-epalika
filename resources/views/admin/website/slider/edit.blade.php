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
                            <a href="">स्लाइडर</a>
                        </li>
                        <li class="breadcrumb-item active">स्लाइडर सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">स्लाइडर</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">स्लाइडर सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.global.website.slider.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> स्लाइडर सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.website.slider.update',$slider)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label"> शीर्षक</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title',$slider->title)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="शीर्षक"
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="image" class="form-label">फोटो </label>
                                <input
                                    type="file"
                                    name="image"
                                    value="{{old('image',$slider->image_url)}}"
                                    class="form-control @error('image') is-invalid @enderror"
                                    id="image"
                                />
                                @error('image')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">विवरण </label>
                                <input
                                    type="text"
                                    name="description"
                                    value="{{old('description',$slider->description)}}"
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    placeholder="विवरण"
                                />
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
