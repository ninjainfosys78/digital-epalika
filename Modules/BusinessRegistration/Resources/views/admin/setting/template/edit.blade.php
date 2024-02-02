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
                            <a href="{{route('admin.businessRegistration.setting.businessRegistrationTemplate.index',$templateTypeEnum)}}">टेम्प्लेट </a>
                        </li>
                        <li class="breadcrumb-item active">टेम्प्लेट सम्पादन गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">टेम्प्लेट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">टेम्प्लेट सम्पादन गर्नुहोस</h4>
                        <a href="{{route('admin.businessRegistration.setting.businessRegistrationTemplate.index',$templateTypeEnum)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> टेम्प्लेट सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.businessRegistration.setting.businessRegistrationTemplate.update',[$templateTypeEnum,$businessRegistrationTemplate])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> टेम्प्लेट</strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title',$businessRegistrationTemplate->title)}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="शिर्षक "
                                        required
                                    />
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>


                                <div class="row">

                                    @foreach( (new Modules\BusinessRegistration\Entities\BusinessDetail())->getTemplateOptions() as $template)
                                        <div class="col-md-12">
                                            <h6>{{$template['title'] ?? ''}}</h6>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="row">
                                                @forelse($template['data'] as $key=>$templateValue)
                                                    <button class="col-md-2 btn btn-primary btn-sm m-1" type="button"
                                                            onclick="copyText('{{$templateValue}}')">{{$key}}</button>
                                                @empty
                                                    <button class="col-md-2 btn btn-primary btn-sm m-1" type="button">दाटा छैन</button>
                                                @endforelse

                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="data" class="form-label">डाटा *</label>
                                    <textarea name="data" id="data" cols="30" rows="10" class="form-control ckEditor">{{old('data',$businessRegistrationTemplate->data)}}</textarea>
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
    @push('scripts')
        <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script>
    @endpush
@endsection

