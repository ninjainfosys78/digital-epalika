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
            <h4> {{\Modules\EMap\Enums\NoticeTypeEnum::FIFTEEN_DAY_GRACE_PERIOD_FOR_MAP_PASS->label()}}</h4>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::FIFTEEN_DAY_GRACE_PERIOD_FOR_MAP_PASS"
                        url="{{route('emap.admin.map.map-apply.notice.upload.bond',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="{{$mapApply->client->name}}नक्सा पासको लागि १५ दिने टास मुचुल्का"/>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb_30">
                <div class="card-body p-3">
                    <div class="font-black" id="printData">
                        <p class="text-center my-3"><b>नक्सा पासको लागि १५ दिने टास मुचुल्का ।</b>
                            <br>
                            <b>(कार्यालय प्रयोजनको लागि)</b></p>
                        <p class="mb-3">
                            &emsp; &emsp; &emsp;यस {{config('applicationDetail.office_type')}} वडा नं.<span
                                class="underline-dotted">{{$mapApply->landDetail->ward_no ?? ''}}</span>
                            टोल<span class="underline-dotted">{{$mapApply->landDetail->tole ?? ''}}</span> मा अवस्थित
                            साविक <span
                                class="underline-dotted">{{$mapApply->landDetail->former_ward_no ?? ''}}</span> कित्ता
                            नं.<span
                                class="underline-dotted">{{$mapApply->landDetail->plot_no ?? ''}}</span> क्षेत्रफल <span
                                class="underline-dotted"> {{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span>
                            मा भवन निर्माण गर्ने घरधनी श्री <span
                                class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span> ले भवन निर्माणको
                            इजाजत प्रयोजनको सिलसिलामा यस
                            {{config('applicationDetail.office_type')}} कार्यालयको च नं.<span
                                class="underline-dotted custom-width"></span> मिति <span
                                class="underline-dotted custom-width"></span> गते प्रकाशित १५ दिने सन्धी सर्पंन बारेको
                            सूचना
                            घरधनीले हामीहरुको रोहवरमा निर्माण स्थलको सबैले देख्ने ठाउँमा टास गरेको ठिक हो |
                        </p>
                        <h4>साक्षीहरु :-</h4>
                        <p>१. श्री<span class="underline-dotted custom-width"></span> दरखास्त <span
                                class="underline-dotted custom-width"></span></p>
                        <p class="mt-2">२. श्री<span class="underline-dotted custom-width"></span> दरखास्त <span
                                class="underline-dotted custom-width"></span></p>
                        <p class="mt-2">३. श्री<span class="underline-dotted custom-width"></span> दरखास्त <span
                                class="underline-dotted custom-width"></span></p>
                        <p class="mt-2">घरधनी:-</p>
                        <p class="mt-2">श्री<span class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span>
                            दरखास्त <span
                                class="underline-dotted custom-width"></span></p>
                        <p class="mt-2"> &emsp; &emsp; &emsp;उपर्युक्त सूचना संधियारहरुलाई बुभाई निर्माण स्थलमा टास गरी वडा समिति
                            मार्फत {{config('applicationDetail.place')}} {{config('applicationDetail.office_type')}} नगर
                            कार्यपालिकाको कार्यालयमा चढायौ |</p>
                        <div class="submit">काम तामेल गर्ने:-</div>
                        <p class="mt-2">दरखास्त :- <span class="underline-dotted custom-width"></span></p>
                        <p class="mt-2">नाम :- <span class="underline-dotted custom-width"></span></p>
                        <p class="mt-2">पद :- <span class="underline-dotted custom-width"></span></p>
                        <p class="mt-2"><span class="underline-dotted custom-width"></span>नं. वडा समितिको कार्यालय</p>
                        <p class="text-center my-3"><b><span class="underline-dotted custom-width"></span>मिति <span
                                    class="underline-dotted custom-width"></span>साल <span
                                    class="underline-dotted custom-width"></span>महिना
                                <span class="underline-dotted custom-width"></span>गते</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
