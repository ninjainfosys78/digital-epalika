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
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::TECHNICAL_REPORT->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    </div>
                <div class="btn-group mb-3">
                    <x-print-button title="प्रविधिक प्रतिवेदन"/>
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
                        <h3 class="text-center"><b>प्रविधिक प्रतिवेदन</b></h3>
                        <p class="text-center"><b>(स्थानीय सरकार संचालन ऐन २०७४ को दफा ३१ र ३२ बमोजिम सर्जमिन
                                खटी गएको )</b></p>
                        <span class="mb-3">
                            &emsp;&emsp;यस {{config('applicationDetail.office_type')}} वडा नं.<span
                                class="underline-dotted custom-width">{{$mapApply->landDetail->ward_no??''}}</span>टोल
                            <span class="underline-dotted custom-width">{{$mapApply->landDetail->tole??''}}</span>मा
                            अवस्थित साविक <span
                                class="underline-dotted custom-width">{{$mapApply->landDetail->former_ward_no??''}}</span>कित्ता
                            नं.<span
                                class="underline-dotted custom-width">{{$mapApply->landDetail->plot_no??''}}</span>क्षेत्रफल
                            <span
                                class="underline-dotted custom-width">{{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span>मा
                            भवन निर्माण गर्ने घरधनी श्री
                            <span class="underline-dotted custom-width">{{$mapApply->houseOwner->name??''}}</span>ले भवन
                            निर्माणको निमित्त पेश
                            गरेको नक्सा सम्बन्धमा मिति <span class="underline-dotted custom-width"></span>मा
                            स्थलगत निरिक्षण गरी देहाय बमोजिमको प्रतिवेदन पेश गरेको छु ।
                        </span><br>
                        <span>१.&emsp;&emsp;भू-उपयोग क्षेत्र<span
                                class="underline-dotted custom-width">{{$mapApply->landDetail?->landUseArea?->title??''}}</span>
                        </span><br>
                        <span class="mt-2">२.&emsp;&emsp;निर्माण हुने स्थलसम्म पग्ने बाटोको व्यवस्था : </span><br>
                        <span>२.१&emsp;&ensp;बाटोको किसिम :
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            पिच&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            ग्राभेल&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio3" value="option3">
                            मोटर जाने&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio4" value="option4">
                           कच्ची&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio5" value="option5">
                           अन्य भए खुलाउने
                                <span class="underline-dotted custom-width"></span>

                        </span><br>
                        <span class="mt-2">२.२&emsp;&ensp;बाटोको चौडाई<span class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">२.३&emsp;&ensp;मापदण्ड बमोजिमको सडक अधिकार क्षेत्रसँग साइट प्लान मेल खान्छ, खादैन
                            सो को विवरण <span
                                class="underline-dotted custom-width">
{{--                                {{$mapApply->criteriaDetails->where('detail',\Modules\EMap\Enums\DetailsRegardingCriteriaEnum::ROAD_JURISDICTION)->first()->according_to_criteria??''}}</span>--}}
                        </span><br>
                        <span class="mt-2">३.&emsp;&emsp;निर्माण हुने भवनले सार्बजनिक स्थल वा निर्माणलाई बाधा पुर्याएको
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            छ&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            छैन&emsp;सो को विवरण<br>&emsp;&emsp;&emsp;<span
                                class="underline-dotted custom-width"></span><span class="underline-dotted custom-width"></span>
                        </span><br>
                        <span class="mt-2">४.&emsp;&emsp;खोला/खहरे/नदी/ताल/कुलो आदि नजिक भए सो देखि </span><br>
                        <span class="mt-2">४.१&emsp;&ensp;निर्माणको निमित्त प्रस्तावित जग्गासम्मको दुरी:<span
                                class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">४.२&emsp;&ensp;प्रस्तावित भवन निर्माणको बाहिरी भागसम्मको दुरी:<span
                                class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">५.&emsp;&emsp;निर्माण हुने जग्गा वा सो को नजिकबाट हाइटेन्सन लाइन गएको
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            छ&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            छैन ?
                        </span><br>
                        <span class="mt-2">५.१&emsp;&ensp;छ भने</span><br>
                        <span class="mt-2">५.१.१&emsp;निर्माणको निमित्त प्रस्तावित जग्गासम्मको दुरी:<span
                                class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">५.१.२&emsp;प्रस्तावित भवन निर्माणको बाहिरी भागसम्मको दुरी:<span
                                class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">६.&emsp;&emsp;नापी नक्सा र फिल्डको आकार प्रकार
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            मिल्छ&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            मिल्दैन
                        </span><br>
                        <span class="mt-2">७.&emsp;&emsp;लालपुर्जा भन्दा फिल्डमा जग्गा
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            ठिक&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            बढी&emsp;
                            <input class="form-check-input form-check-inline" type="checkbox"
                                   name="inlineRadioOptions" id="inlineRadio3" value="option3">
                            घटी देखिन्छ
                        </span><br>
                        <span class="mt-2">८.&emsp;&emsp;प्रविधिकको अन्य कुनै कुरा भए व्यहोरा खुलाउने</span><br>
                        <span class="mt-2">(क)&emsp;&ensp;भिरालो जग्गा भए <span class="underline-dotted custom-width"></span>
                        </span><br>
                        <span class="mt-2">(ख)&emsp;&ensp;भौगर्भिक धाँजा भए<span class="underline-dotted custom-width"></span>
                        </span><br>
                        <span class="mt-2">प्रतिवेदन पेश गर्नेको नाम:<span
                                class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">पद:<span class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">सही:<span class="underline-dotted custom-width"></span></span><br>
                        <span class="mt-2">मिति:<span class="underline-dotted custom-width"></span></span><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
