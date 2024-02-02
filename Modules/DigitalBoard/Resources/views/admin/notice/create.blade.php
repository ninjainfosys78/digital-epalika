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
                            <a href="{{route('admin.digitalBoard.notice.index',$type)}}">{{$type==='Notice' ?'सूचना':'समाचार'}} </a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ {{$type==='Notice' ?'सूचना':'समाचार'}}  थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$type==='Notice' ?'सूचना':'समाचार'}}  </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">{{$type==='Notice' ?'सूचना':'समाचार'}}  थप्नुहोस्</h4>
                        <a href="{{route('admin.digitalBoard.notice.index',$type)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> {{$type==='Notice' ?'सूचना':'समाचार'}} सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{route('admin.digitalBoard.notice.store',$type)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-primary">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title')}}"
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
                                     label-ne="मिति *" name-ne="date"
                                    />
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="description" class="form-label">बिवरण </label>
                                    <textarea name="description" id="description" placeholder="बिवरण"  class="form-control summernote" cols="30" rows="5">{{old('description')}}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
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
                                <div class="col-md-6  mb-2">
                                    <label for="ward_no" class="form-label"> वडा नं.</label>
                                    <select name="ward_no[]" class="form-control @error('ward_no') is-invalid @enderror"
                                        multiple id="ward_no" data-toggle="select2" data-width="100%">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        <option value="metro">महानगरपालिका</option>
                                        @foreach ($officeSetting->localBody->ward_no as $ward)
                                            <option value="{{ $ward }}">
                                                {{ $ward }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ward_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
