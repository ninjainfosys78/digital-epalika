@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                     alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सिफारिस</li>
                        <li class="breadcrumb-item active">नयाँ टेम्प्लेट</li>
                    </ol>
                </div>
                <h4 class="page-title">नयाँ टेम्प्लेट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ टेम्प्लेट दर्ता गर्नुहोस</h4>
                        <a href="{{ route('admin.recommendation.sipharish.sipharishFormType.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सिफारिस सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <form
                        action="{{ route('admin.recommendation.sipharish.sipharishFormType.updateTemplate', $sipharishFormType) }}"
                        method="post">
                        @csrf
                        @method('put')
                        @foreach( (new \Modules\Recommendation\Entities\SipharishFormType())->getTemplateOptions() as $template)
                            <div class="mt-2">
                                <h4>{{$template['title'] ?? ''}} :</h4>
                                <div class="button-list">
                                    <div class="button-list d-flex flex-wrap mb-2">
                                        @foreach($template['data'] as $key=>$templateValue)
                                            <button type="button" class="btn btn-outline-primary btn-xs me-2"
                                                    onclick="copyText('{{$templateValue}}')">
                                                {{$key}}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-2">
                            <div class="button-list ">
                                <h4>फारम फिल्ड:</h4>
                                <div class="button-list d-flex flex-wrap mb-2">
                                    @foreach($sipharishFormType->sipharisFormFields as $sipharisFormField)
                                        <button type="button" class="btn btn-outline-primary btn-xs me-2"
                                                onclick="copyText('{{"[@form.".$sipharisFormField->slug."]"}}')">
                                            {{$sipharisFormField->field_name}}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12 mb-2">
                                <label for="content" class="form-label">डाटा <span
                                        class="text-danger">*</span></label>
                                <textarea name="content" id="content" required cols="30" rows="10"
                                          class="form-control ckEditor @error('content') is-invalid @enderror">{{ old('content',$sipharishFormType->content) }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @includeIf('recommendation::admin.registration.inc.file')

@endsection
