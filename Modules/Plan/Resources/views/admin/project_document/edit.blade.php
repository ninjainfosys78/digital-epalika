@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.plan.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">योजनाहरु</li>
                    </ol>
                </div>
                <h4 class="page-title">नयाँ कागजात थप्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ कागजात थप्नुहोस्</h4>
                        <a href="{{route('admin.plan.project.show',$project)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.project.projectDocument.update',[$project,$projectDocument])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="document_name" class="form-label">कागजात नाम *</label>
                                <input
                                    type="text"
                                    name="document_name"
                                    value="{{old('document_name',$projectDocument->document_name)}}"
                                    class="form-control @error('document_name') is-invalid @enderror"
                                    id="document_name"
                                    placeholder="कागजात नाम"
                                    required
                                />
                                @error('document_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="data" class="form-label">डाटा *</label>
                                <textarea name="data"
                                          id="data"
                                          required
                                          cols="30" rows="10"
                                          class="form-control ckEditor @error('data') is-invalid @enderror">{{old('data',$projectDocument->data)}}</textarea>
                                @error('data')
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
    @push('scripts')
        <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script>
    @endpush
@endsection
