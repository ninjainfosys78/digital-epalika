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
                                {{Str::words($noticeTypeEnum->label(),3)}} </a>
                        </li>
                        <li class="breadcrumb-item active"> {{Str::words($noticeTypeEnum->label(),3)}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{Str::words($noticeTypeEnum->label(),5)}}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">{{$noticeTypeEnum->label()}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('emap.admin.map.map-apply.notice.upload.store-template-data',[$mapApply, $applicationFormTypeEnum,$noticeTypeEnum])}}"
                        method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="data" class="form-label">डाटा *</label>
                                <textarea name="data" id="data" cols="30" rows="10"
                                          class="form-control ckEditor @error('data') is-invalid @enderror">{{old('data',($mapApply->applyMapNotices->first()?->data ?? $mapApply->getSpecificTemplateData($noticeTypeEnum) ?? ''))}}</textarea>
                                @error('data')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="files" class="form-label">फाइल </label>
                                <input
                                    type="file"
                                    name="files[]"
                                    class="form-control @error('files') is-invalid @enderror"
                                    id="files"
                                    multiple/>
                                @foreach($mapApply->applyMapNotices as $applyMapNotice)
                                    @foreach($applyMapNotice->files as $file)
                                        <a href="{{$file->file_url}}" download="{{$file->file_url}}">
                                            <i class="fa fa-download"></i>
                                            Download &nbsp;</a>
                                    @endforeach
                                @endforeach
                                @error('files')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                @error('files.*')
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

