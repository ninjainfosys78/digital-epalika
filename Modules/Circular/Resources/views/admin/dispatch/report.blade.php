@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.circular.dispatch.index') }}">चलानी पत्र </a>
                        </li>
                        <li class="breadcrumb-item active">चलानी</li>
                    </ol>
                </div>
                <h4 class="page-title">चलानी पत्र</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm" style="text-align: end">

        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">चलानी पत्र विवरण</h4>
                        <a href="{{ route('admin.circular.dispatch.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> चलानी पत्र सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                चलानी नं. {{$dispatch->dispatch_number}}
                            </div>
                            <div class="col-md-4">
                                <p> बिषय : {{$dispatch->subject}}</p>
                                <p> मिति : {{$dispatch->dispatch_date}}</p>
                            </div>

                        </div>
                        <div class="row">
                            <form enctype="multipart/form-data" action="{{route('admin.circular.dispatch.dispatchDetail.store',$dispatch)}}" method="post">
                                @csrf
                                <div class="col-md-12 mb-2">
                                    <label for="remarks" class="form-label">कैफ़ियत</label>
                                    <textarea name="remarks"
                                              id="remarks" cols="30" rows="5"
                                              class="form-control @error('remarks') is-invalid @enderror"
                                              placeholder="कैफ़ियत">{{old('remarks',$dispatch->dispatchDetail->remarks??'')}}</textarea>
                                    @error('remarks')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="files" class="form-label">फाईल</label>
                                    <input type="file" id="files" name="files[]" class="form-control" multiple>
                                    @error('files')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @error('files.*')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script>
    @endpush
@endsection
