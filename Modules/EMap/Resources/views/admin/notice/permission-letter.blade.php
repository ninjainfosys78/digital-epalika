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
            <h4> {{\Modules\EMap\Enums\NoticeTypeEnum::GRANTING_PERMISSION_FOR_CONSTRUCTION_UP_TO_THE_PLINTH_LEVEL_OF_THE_HOUSE->label()}}</h4>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::GRANTING_PERMISSION_FOR_CONSTRUCTION_UP_TO_THE_PLINTH_LEVEL_OF_THE_HOUSE"
                        url="{{route('emap.admin.map.map-apply.notice.upload.order',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="{{$mapApply->client->name}}घरको प्लिन्थ लेभल सम्मको निर्माणका "/>
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
                        <h3 class="text-center my-3"><b>टिप्पणी र आदेश</b></h3>
                        <p class="text-center my-3"><b>बिषय: घरको प्लिन्थ लेभल सम्मको निर्माणका निमित्त इजाजत
                                प्रदान गर्ने ।</b></p>
                        <p>श्रीमान,</p>
                        <p class="mb-3">
                            जग्गा धनी <span class="underline-dotted ">{{$mapApply->landOwner->name??''}}</span> को नाममा
                            दर्ता रहेको यस
                            {{config('applicationDetail.office_type')}} वडा नं. <span
                                class="underline-dotted ">{{$mapApply->landDetail->ward_no??''}}</span>
                            टोल<span class="underline-dotted ">{{$mapApply->landDetail->tole??''}}</span> मा अवस्थित
                            साविक वडा नं.
                            <span class="underline-dotted ">{{$mapApply->landDetail->former_ward_no??''}}</span>कित्ता
                            नं. <span
                                class="underline-dotted ">{{$mapApply->landDetail->plot_no??''}}</span> क्षेत्रफल <span
                                class="underline-dotted ">{{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span>
                            मा भवन निर्माण गर्ने घरधनी श्री
                            <span class="underline-dotted ">{{$mapApply->houseOwner->name??''}}</span> ले भवन निर्माण
                            गर्ने स्वीकृति
                            पाउँ
                            भनी स्थानीय सरकार संचालन ऐन २०७४ को दफा २७, २८, २९, ३० बमोजिम मिति<span
                                class="underline-dotted custom-width"></span> मा नक्सा सहित आवश्यक प्रमाण राखी
                            निवेदन दिनुभएकोमा सोहि ऐनको दफा ३०, ३१ बमोजिम १५ दिन सन्धीसर्पंनको उजुरीबारे सूचना
                            प्रकाशीत गरिएकोमा ऐनको म्यादभित्र कसैको उजुरी नपरेकोले श्री <span
                                class="underline-dotted custom-width"></span> लाई निर्माण कार्य स्वीकृति दिंदा
                            कसैको हानी नोक्सानी
                            हुँदैन भनी उल्लेख भई आएको, साथै प्रविधिकको स्थलगत प्रतिवेदनमा समेत नक्सापास गरी भवन
                            निर्माण स्वीकृति दिने मिल्ने भन्ने मिति<span
                                class="underline-dotted custom-width"></span> मा भएको सर्जमिन मुचुल्कामा उल्लेख
                            भै आएकोले दफा ३२, ३३, ३४, ३५ बमोजिम<span
                                class="underline-dotted custom-width"></span> इजाजत दिन मनासिब देखि पेश गरेको छु
                            ।
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
