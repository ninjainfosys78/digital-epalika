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
                            <a href="{{route('admin.digitalBoard.video.index')}}">डिजिटल बोर्ड</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ फोटो थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">फोटो ग्यालरी</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ फोटो थप्नुहोस्</h4>
                        <a href="{{route('admin.digitalBoard.photoGallery.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.digitalBoard.photoGallery.update',$photoGallery)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label"> शिर्षक </label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title', $photoGallery->title)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder=" Title"
                                    required
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
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
                        <div class="row ">

                            <div class="col-md-12 mb-2">
                                <label for="caption" class="form-label">बिवरण </label>
                                <textarea name="caption" id="caption" placeholder="बिवरण"  class="form-control summernote" cols="30" rows="5">{{old('caption',$photoGallery->caption)}}</textarea>
                                @error('caption')
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
