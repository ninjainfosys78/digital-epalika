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
                            <a href="{{route('admin.recommendation.sipharish.sipharisSignatureDetail.index')}}">हस्ताक्षर</a>
                        </li>
                        <li class="breadcrumb-item active">हस्ताक्षर सम्पादन</li>
                    </ol>
                </div>
                <h4 class="page-title">हस्ताक्षर </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">हस्ताक्षर थप्नुहोस्</h4>
                        <a href="{{route('admin.recommendation.sipharish.sipharisSignatureDetail.create')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> हस्ताक्षर सम्पादन गर्नुहोस्

                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('admin.recommendation.sipharish.sipharisSignatureDetail.update',$sipharisSignatureDetail)}}"
                        method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="full_name" class="form-label">पुरा नाम *</label>
                                    <input
                                        type="text"
                                        name="full_name"
                                        value="{{old('full_name',$sipharisSignatureDetail->full_name)}}"
                                        class="form-control @error('full_name') is-invalid @enderror"
                                        id="full_name"
                                        placeholder="शिर्षक "
                                        required
                                    />
                                    @error('full_name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="position" class="form-label">पद *</label>
                                    <input
                                        type="text"
                                        name="position"
                                        value="{{old('position',$sipharisSignatureDetail->position)}}"
                                        class="form-control @error('position') is-invalid @enderror"
                                        id="position"
                                        placeholder="शिर्षक "
                                        required
                                    />
                                    @error('position')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="files" class="form-label">फाईल </label>
                                    <input
                                        type="file"
                                        name="signature"
                                        class="form-control @error('signature') is-invalid @enderror"
                                        id="signature"

                                    />
                                    @error('signature')
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
