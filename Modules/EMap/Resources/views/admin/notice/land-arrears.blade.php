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
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::SARZAMIN_MUCHULKA->label()}}</h3></div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::SARZAMIN_MUCHULKA"
                        url="{{route('emap.admin.map.map-apply.notice.upload.bond',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="{{$mapApply->client->name}}सरजमिन मुचुल्का"/>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb_30">
                <div class="card-body p-3">
                    <div class="font-black" id="printData">
                        <h3 class="text-center"><b>सरजमिन मुचुल्का</b></h3>
                        <p class="text-center"><b>(स्थानीय सरकार संचालन ऐन २०७४ को दफा ३१ र ३२ बमोजिम सर्जमिन
                                खटी गएको )</b></p>
                        <span>
                            लिखितम हामी तपसिलका मानिसहरु आगे जग्गा धनी श्री <span
                                class="underline-dotted">{{$mapApply->landOwner->name??''}}</span> को नाममा
                            दर्ता रहेको यस {{config('applicationDetail.office_type')}} वडा नं.<span
                                class="underline-dotted">{{$mapApply->landDetail->ward_no??''}}</span>टोल <span
                                class="underline-dotted">{{$mapApply->landDetail->tole??''}}</span> मा
                            अवस्थित साविक वडा नं.<span
                                class="underline-dotted">{{$mapApply->landDetail->former_ward_no??''}}</span> कित्ता नं.<span
                                class="underline-dotted">{{$mapApply->landDetail->plot_no??''}}</span> क्षेत्रफल<span
                                class="underline-dotted">{{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span>
                            मा भवन निर्माण गर्ने घरधनी श्री <span
                                class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span> ले नक्सा
                            बमोजिमको भवन बनाउन पाउ भनी दरखास्त परेको १५ दिनको सूचना टास भई "स्थानीय सरकार संचालन
                            ऐन २०७४ "
                            को दफा ३० र ३१ बमोजिम सर्जमिन गर्नु पर्दा यस सर्जमिनमा आई तपाई तपसिलका मानिसहरुसँग
                            सोधनी गरिन्छ कि माथि लेखिए बमोजिमको भवन बनाउदा तपाईहरुलाई सन्धि सर्पन पीर मर्का
                            पर्छ, पर्दैन भए आफ्नो व्यहोरा तपसिलमा खोली लेखी दिनुस् भनी यस उप-महानगरपालिका
                            कार्यालय नक्सा शाखाबाट खटी आउनुभएका कर्मचारीले सोधनी गर्दा हामीहरुको चित बुभयो, उक्त
                            जग्गामा कोहि कसैको सन्धि सर्पन, पिर मर्का नपर्ने देखिएको हुदाँ सो <span
                                class="underline-dotted custom-width"></span> को नक्सा पास गरिदिएमा ठिक छ, भनेर लेखी
                            दिएको छौ
                            फरक पर्ने छैन फरक परे ऐन कानुन बमोजिम सहुला
                            बुझाउँला भनी यस मुचुल्कामा सही छाप गरि नेपालगञ्ज उप-महानगरपालिकामा चढायौ | पुनश्च :
                        </span><br>
                        <div class="text-center fw-bold">तपसिल</div>
                            <div class="row border">
                                <div class="col-md-6 text-lg-center">
                                    सही छाप
                                </div>
                                <div class="col-md-6 text-lg-center">जग्गा साँध संधियारको नाम,थर</div>
                            </div>
                        <div class="text-center my-2">पूर्व वर्ष<span
                                class="underline-dotted custom-width"></span>&ensp;&ensp;&ensp; &emsp;को श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></div>
                        <div class="text-center my-2">पश्चिम वर्ष<span
                                class="underline-dotted custom-width"></span>&ensp;&ensp;&ensp; &emsp; को श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></div>
                        <div class="text-center my-2">उतर वर्ष<span class="underline-dotted custom-width"></span>&ensp;&ensp;&ensp; &emsp;
                            को श्रीमान/श्रीमती/सुश्री<span class="underline-dotted custom-width"></span></div>
                        <div class="text-center my-2">दक्षिण वर्ष<span
                                class="underline-dotted custom-width"></span>&ensp;&ensp;&ensp; &emsp; को श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></div>
                        <h4 class="head text-decoration-underline mt-1">छिमेकि सक्षीवाला</h4>
                        <span class="d-flex justify-content-center">{{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            <span
                                class="underline-dotted custom-width"></span>बस्ने<span
                                class="underline-dotted custom-width"></span> वर्षको श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></span>
                        <span class="d-flex justify-content-center ">{{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            <span
                                class="underline-dotted custom-width"></span>बस्ने<span
                                class="underline-dotted custom-width"></span> वर्षको श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></span>
                        <span class="d-flex justify-content-center ">{{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            <span
                                class="underline-dotted custom-width"></span>बस्ने<span
                                class="underline-dotted custom-width"></span> वर्षको श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></span>
                        <span class="d-flex justify-content-center">{{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            <span
                                class="underline-dotted custom-width"></span>बस्ने<span
                                class="underline-dotted custom-width"></span> वर्षको श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></span>
                        <span class="d-flex justify-content-center">{{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            <span
                                class="underline-dotted custom-width"></span>बस्ने<span
                                class="underline-dotted custom-width"></span> वर्षको श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></span>
                        <span class="d-flex justify-content-center">{{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            <span
                                class="underline-dotted custom-width"></span>बस्ने<span
                                class="underline-dotted custom-width"></span> वर्षको श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></span>
                        <span class="d-flex justify-content-center">{{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            <span
                                class="underline-dotted custom-width"></span>बस्ने<span
                                class="underline-dotted custom-width"></span> वर्षको श्रीमान/श्रीमती/सुश्री<span
                                class="underline-dotted custom-width"></span></span>
                        <span class="head text-decoration-underline">रोहवरमा</span><br>
                        <span>सहिछाप</span><br>
                        <span>१. {{config('applicationDetail.place')}} {{config('applicationDetail.office_short_name')}}
                            वडा नं.<span class="underline-dotted custom-width"></span>
                            बस्ने वर्ष <span class="underline-dotted custom-width"></span> को जग्गा धनी
                            श्रीमान/श्रीमती/सुश्री <span
                                class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span></span><br>
                        <span class="mt-2">२. वडा नं.<span class="underline-dotted custom-width"></span>को वडा
                            अध्यक्ष श्री <span class="underline-dotted custom-width"></span></span><br>
                        <span class="head text-decoration-underline mt-2">काम तामेल गर्ने </span><br>
                        <span>प्रविधिक श्री <span class="underline-dotted custom-width"></span>पद <span
                                class="underline-dotted custom-width"></span><br>
                            प्रशासनिक कर्मचारी श्री <span
                                class="underline-dotted custom-width"></span>पद <span
                                class="underline-dotted custom-width"></span><br>
                            ईति सम्वत् <span class="underline-dotted custom-width"></span>
                            साल <span class="underline-dotted custom-width"></span>
                            महिना <span class="underline-dotted custom-width"></span>
                            गते <span class="underline-dotted custom-width"></span>रोज शुभम् | </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
