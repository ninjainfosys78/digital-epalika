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
            <h4> {{\Modules\EMap\Enums\NoticeTypeEnum::REVISED_SUPERSTRUCTURE_PERMIT->label()}}</h4>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::REVISED_SUPERSTRUCTURE_PERMIT"
                        url="{{route('emap.admin.map.map-apply.notice.upload.notice',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="{{$mapApply->client->name}}संशोधित सुपरस्ट्रक्चर ईजाजत सम्बन्धमा"/>
                </div>
            </div>
        </div><!-- end col-->
    </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card mb_30">
                        <div class="card-body p-3">
                            <div class="font-black" id="printData">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        पत्र सं: <div class="underline-dotted custom-width"></div><br>
                                        चलानी नं: <div class="underline-dotted custom-width"></div>
                                    </div>
                                    <div class="col-md-6 text-end">मिति: <div class="underline-dotted custom-width"></div></div>
                                </div>
                                <p class="text-center my-3">
                                    <b>बिषय: {{\Modules\EMap\Enums\NoticeTypeEnum::REVISED_SUPERSTRUCTURE_PERMIT->label()}}
                                        ।</b></p>
                                <div class="res">श्री<span class="underline-dotted custom-width"></span><span
                                        class="underline-dotted custom-width"></span><br>
                                    <span class="underline-dotted custom-width"></span><span
                                        class="underline-dotted custom-width"></span></div>
                                <p class="my-3">
                                    &emsp;&emsp;&emsp;उपर्युक्त सम्बन्धमा तपाईले यस कार्यालयबाट मिति<span
                                        class="underline-dotted custom-width"></span> मा वडा नं.<span
                                        class="underline-dotted">{{$mapApply->landDetail->ward_no??''}}</span>साविक
                                    <span
                                        class="underline-dotted">{{$mapApply->landDetail->former_ward_no}}</span>
                                    कि.नं.<span
                                        class="underline-dotted">{{$mapApply->landDetail->plot_no??''}}</span>
                                    क्षेत्रफल<span
                                        class="underline-dotted">{{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span>जग्गामा
                                    घर निर्माणको लागि प्लिन्थ/सुपरस्ट्रक्चरल स्वीकृति लिनु भएकोमा सो घर निर्माण गर्दा
                                    संशोधन गरी घरमा थपकोठा/तल थप/प्लिन्थ
                                    घटी/बढी/डिजाईन परिवर्तन/निर्माण परिवर्तन गरेकोमा संशोधित नक्सा पेश गरेकोमा उक्त
                                    नक्सा तत्कालिन नक्सा पासको मापदण्ड/आधारभूत निर्माण मापदण्ड, २०७२ अनुसार को निर्माण
                                    अनुसार
                                    हालको नक्सा प्रमाणित गरी नक्सा संशोधन प्रमाणपत्र दिईएको छ ।
                                </p>
                                <p class="letter">पुनश्रच : मापदण्डको हकमा मिति <span class="underline-dotted custom-width"></span> मा
                                    दिईएको इजाजत पत्रमा उल्लेख भए अनुसार लागू हुनेछ । </p>

                                <div class="d-flex justify-content-around mt-4">
                                    <p class="text-center"><span class="underline-dotted custom-width"></span><br>
                                        निरीक्षण गरी पेश गर्ने</p>
                                    <p class="text-center"><span class="underline-dotted custom-width"></span><br>सिफारिस
                                        गर्ने </p>
                                    <p class="text-center"><span class="underline-dotted custom-width"></span><br>
                                        स्वीकृत गर्ने</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
