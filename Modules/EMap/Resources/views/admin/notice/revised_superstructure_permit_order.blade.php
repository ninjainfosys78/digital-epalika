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
            <h4> {{\Modules\EMap\Enums\NoticeTypeEnum::REVISED_SUPERSTRUCTURE_PERMIT_ORDER->label()}}</h4>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::REVISED_SUPERSTRUCTURE_PERMIT_ORDER"
                        url="{{route('emap.admin.map.map-apply.notice.upload.order',$mapApply)}}"/>
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
                                    </div>
                                    <div class="col-md-6 text-end">मिति: <div class="underline-dotted custom-width"></div></div>
                                </div>

                                <h3 class="text-center mt-3"><b>टिप्पणी र आदेश</b></h3>
                                <p class="text-center my-3"><b>बिषय: संशोधित सुपरस्ट्रक्चर ईजाजत सम्बन्धमा
                                        ।</b></p>
                                <p>श्रीमान,</p>
                                <p class="mb-3">
                                    यस {{config('applicationDetail.office_type')}} वडा नं.<span
                                        class="underline-dotted">{{$mapApply->landDetail->ward_no??''}}</span> टोल<span
                                        class="underline-dotted">{{$mapApply->landDetail->tole??''}}</span> मा अवस्थित साविक<span
                                        class="underline-dotted">{{$mapApply->landDetail->former_ward_no??''}}</span>
                                    कित्ता नं.<span class="underline-dotted">{{$mapApply->landDetail->plot_no??''}}</span> क्षेत्रफल<span
                                        class="underline-dotted">{{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span> मा भवन निर्माण गर्ने घरधनी
                                    श्री<span class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span> ले भवन निर्माण गर्न
                                    मिति<span class="underline-dotted custom-width"></span> मा
                                    प्लिन्थ/सुपरस्ट्रक्चर ईजाजत लिनुभएकोमा सो घरमा थपकोठा/निर्माण परिवर्तन गरेकोमा
                                    संशोधित नक्सा बनाई संशोधित प्लिन्थ/सुपरस्ट्रक्चर 'स्थानीय सरकार संचालन ऐन, २०७४' को
                                    दफा ३५ बमोजिम माग गर्दै निवेदन दिनु भएकोले संशोधित ईजाजत दिने सम्बन्धमा यस
                                    कार्यालयका प्रबिधिकबाट स्थलगत निरिक्षण गरी दिनुभएको प्रतिवेदन र नीजको संलग्न नक्सा
                                    अनुसार थप दस्तुर
                                    <span class="underline-dotted custom-width"></span> अक्षरेपी <span
                                        class="underline-dotted custom-width"></span> मात्र लिई माग अनुसार संशोधित ईजाजत
                                    दिन मनासिब देखि पेश गरेको छु ।

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @push('style')
        <style>
            .font-black p {
                color: black;
            }

            .underline-dotted {
                border-bottom: dotted 2px !important;
                padding: 0 20px;
            }

            .custom-width {
                padding: 0 50px !important;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
