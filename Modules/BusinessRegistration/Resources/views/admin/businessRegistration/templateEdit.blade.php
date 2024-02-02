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
                            <a href="">
                                {{$templateTypeEnum->label()??''}} </a>
                        </li>
                        <li class="breadcrumb-item active"> {{$templateTypeEnum->label()}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$templateTypeEnum->label()}}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">   {{$templateTypeEnum->label()}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.businessRegistration.store.template',[$businessDetail,$templateTypeEnum])}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="data" class="form-label">डाटा *</label>
                                    <textarea name="data" id="data" cols="30" rows="10"
                                              class="form-control ckEditor @error('data') is-invalid @enderror">{{old('data',($printed_data->data ?? $businessDetail->getSpecificTemplateData($templateTypeEnum) ?? ''))}}</textarea>
                                    @error('data')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="files" class="form-label">फाइल *</label>
                                    <input
                                        type="file"
                                        name="files[]"

                                        class="form-control @error('files') is-invalid @enderror"
                                        id="files"
                                        multiple/>
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
    @push('style')
        <link rel="stylesheet" href="{{asset('assets/backend/editor/ckEditor/css/editor.css')}}">
        <link rel="stylesheet" href="{{asset('assets/backend/editor/ckEditor/css/neo.css')}}">
    @endpush
    @push('scripts')
        <script src="{{asset('assets/backend/editor/ckEditor/js/ckeditor.js')}}"></script>
        <script src="{{asset('assets/backend/editor/ckEditor/js/editor.js')}}"></script>
    @endpush
@endsection

