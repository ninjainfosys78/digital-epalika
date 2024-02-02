@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">फारम</li>
                    </ol>
                </div>
                <h4 class="page-title">सम्पादन</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">सम्पादन</h4>
        </div>
        <div class="card-body">
            <form action="{{route('organization.admin.storeTemplateData',[$mapApply,$noticeTypeEnum])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="data">डाटा *</label>
                    <textarea name="data" id="data" cols="30" rows="10"
                              class="form-control ckEditor @error('data') is-invalid @enderror">{{old('data',($mapApply->applyMapNotices->first()?->data ?? $mapApply->getSpecificTemplateData($noticeTypeEnum) ?? ''))}}</textarea>
                    @error('data')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="files">फ़ाइल</label>
                    <input type="file" class="form-control" id="files"
                           name="files[]" multiple>
                    @error('files')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    @error('files*')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mt-4 d-flex justify-content-end">

                    <button type="submit" class="btn btn-primary    ">
                        Save
                    </button>
                </div>
            </form>
        </div>

    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script>
    @endpush

@endsection
