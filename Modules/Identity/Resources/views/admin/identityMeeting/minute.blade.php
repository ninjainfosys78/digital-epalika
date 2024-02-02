@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> माईनिउट</li>
                    </ol>
                </div>
                <h4 class="page-title">माईनिउट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">माईनिउट</h4>
                        <a href="{{ route('identity.admin.identityMeeting.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> बैठक विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('identity.admin.identityMeeting.minute.store',$identityMeeting) }}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="minute" class="form-label">माईनिउट *</label>
                                <textarea class="form-control ckEditor" name="minute" id="minute"
                                          placeholder="माईनिउट">{{ old('minute', $identityMeeting->minute ?? $identityMeeting->getIdentityTemplateData(minuteTemplateSettingData())  ?? '') }}</textarea>
                                @error('minute')
                                <div class="invalid-feedback">{{ $message }}</div>
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
        <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
    @endpush
@endsection
