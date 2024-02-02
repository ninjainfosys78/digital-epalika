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
                            <a href="{{route('admin.digitalBoard.popUpNotice.index')}}">Pop Up  </a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ Pop Up थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">Pop Up   </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">Pop Up सम्पादन गर्नुहोस</h4>
                        <a href="{{route('admin.digitalBoard.popUpNotice.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> Pop Up सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.digitalBoard.popUpNotice.update',$popUpNotice)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title',$popUpNotice->title)}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="शिर्षक "
                                        required
                                    />
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <x-date-input-component
                                        label-ne="मिति *"
                                        name-ne="date"
                                        :getTodayDate="false"
                                        :editDateNe="$popUpNotice->date"
                                    />
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="description" class="form-label">बिवरण </label>
                                    <textarea name="description" id="description" placeholder="बिवरण"  class="form-control summernote" cols="30" rows="5">{{old('description',$popUpNotice->description)}}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="files" class="form-label">फाईल </label>
                                    <input
                                        type="file"
                                        name="files[]"
                                        class="form-control @error('files') is-invalid @enderror"
                                        id="files"

                                        multiple />
                                    @error('files')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @error('files.*')
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
