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
                            <a href="{{route('admin.circular.registration.index')}}">ई-नक्सा </a>
                        </li>
                        <li class="breadcrumb-item active">नक्सा विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">ई-नक्सा</h4>
            </div>
        </div>
    </div>
    <div>
        @error('file')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-2">
        <div class="col-sm-4">
            <h4> {{\Modules\EMap\Enums\NoticeTypeEnum::CONSULTANTS_REPORT_ON_COMPLETION_OF_SECOND_PHASE->label()}}</h4>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::CONSULTANTS_REPORT_ON_COMPLETION_OF_SECOND_PHASE"
                        url="{{route('emap.admin.map.map-apply.notice.upload.report',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <button class="bg-success text-white" onclick=" printJS({
                printable: 'printData',
                type: 'html',
                documentTitle: 'दोस्रो चरणको कार्य सम्पन्नको परामर्शको प्राविधिकको प्रतिवेदन',
                showModal: true,
                css: '{{asset('assets/backend/css/print.css')}}',
                honorMarginPadding: false,
                modalMessage: 'तपाईंको कागजात छाप्नको लागि तयार हुँदैछ।'})"><i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div><!-- end col-->
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb_30">
                <div class="card-body p-3">
                    <div class="font-black" id="printData">
                        <h3 class="text-center my-3"><b>दोस्रो चरणको कार्य सम्पन्नको परामर्शको प्राविधिकको प्रतिवेदन</b>
                        </h3>
                        @includeIf('emap::admin.map.report.second_phase')
                        हस्ताक्षर:<span class="underline-dotted custom-width"></span><span
                            class="underline-dotted custom-width"></span> प्रतिवेदन पेश गर्ने प्रविधिकको नाम, थर :<span
                            class="underline-dotted custom-width"></span><span
                            class="underline-dotted custom-width"></span></span><br>

                        <span class="mt-2">कन्सल्टेन्सीको नाम:<span class="underline-dotted custom-width"></span><span
                                class="underline-dotted custom-width"></span> कन्सल्टेन्सीको दर्ता नं.<span
                                class="underline-dotted custom-width"></span><span
                                class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">पेश गरेको मिति:<span class="underline-dotted custom-width"></span><span
                                class="underline-dotted custom-width"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
