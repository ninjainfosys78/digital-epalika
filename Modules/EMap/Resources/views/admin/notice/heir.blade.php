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
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::HEIR->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::HEIR"
                        url="{{route('emap.admin.map.map-apply.notice.upload.heir',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <button class="bg-success text-white" onclick=" printJS({
                printable: 'printData',
                type: 'html',
                documentTitle: 'वारेसनामा',
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
                        <h3 class="text-center"><b>वारेसनामा</b></h3>
                        <div class="vertical">
                            दस्तखत : <span class="underline-dotted custom-width"></span>
                        </div>
                        <div class="text">
                                <span>
                                    लिखितम<span class="underline-dotted custom-width"></span>जिल्ला<span
                                        class="underline-dotted custom-width"></span>
                                    {{config('applicationDetail.office_short_name')}}/गा.वि.स. वडा नं.<span
                                        class="underline-dotted custom-width"></span>
                                    बस्ने वर्ष<span class="underline-dotted custom-width"></span>
                                    को आगे<span class="underline-dotted custom-width"></span> मेरो/हाम्रो नाउँमा
                                    दर्ता भएको साविक<span class="underline-dotted custom-width"></span>
                                    हाल<span class="underline-dotted custom-width"></span> उ.न.पा. वडा नं.<span
                                        class="underline-dotted custom-width"></span>
                                    स्थित कि.नं.<span class="underline-dotted custom-width"></span>
                                    क्षेत्रफल<span class="underline-dotted custom-width"></span>
                                    भएको जग्गामा घर बनाउनको लागि<span
                                        class="underline-dotted custom-width"></span> उ.न.पा. कार्यालयमा नक्सा
                                    दरखास्त पेश गरी नक्सा पास तथा निर्माण
                                    इजाजत लिन मेरो/हाम्रो घरयसी कामले फुर्सद नभएकोले सो कार्यको लागि<span
                                        class="underline-dotted custom-width"></span>
                                    उ.न.पा. वडा नं.<span class="underline-dotted custom-width"></span> बस्ने
                                    वर्ष<span class="underline-dotted custom-width"></span>
                                    को श्री<span class="underline-dotted custom-width"></span> लाई वारेसको
                                    अख्तियार दिई पठाएको/का छु/छौ | निज वारेसले त्यस उ.न.पा. कार्यालयमा
                                    उपस्थित भै तत्सम्बन्धी दरखास्त पेश गरी मक्स पास तथा निर्माण इजाजत लिएमा र
                                    नक्सा पास कार्य हुँदा जाँदा केहि गरी विपक्षहरुसँग मुदा हारे जितेमा
                                    मेरो/हाम्रो मन्जुर छ |
                                    मुदा फैसला हुँदाका बखत जो परेको म/हामी आफै उपस्थित भै बुझाउने छु/छौ | अड्डा
                                    अदालतबाट लागेको दण्ड जरिवाना सरकारी विगो, दशौद र आदेशले लागेको कोर्ट फि
                                    समेत तिर्न बुझाउन मैले/हामीले बाँकि राख्ने छैन/छैनौँ | नतिरी बाँकि राखेको
                                    ठहरे वारेसनामा बदर गरी नक्सा पास कार्य कानून बमोजिम होस् भनि मेरो/हाम्रो
                                    राजीखुशीले
                                    किनारामा लेखिएका साक्षीहरुको रोहवरमा<span
                                        class="underline-dotted custom-width"></span> उ.न.पा. कार्यालयमा बसेर
                                    वारेसनामा लेखी
                                    नीज<span class="underline-dotted custom-width"></span> लाई दिएँ |
                                </span><br>
                            <span class="letter mt-2">
                                    इति सम्वत्<span class="underline-dotted custom-width"></span>
                                    साल<span class="underline-dotted custom-width"></span>
                                    महिना<span class="underline-dotted custom-width"></span>
                                    गते रोज<span class="underline-dotted custom-width"></span>
                                    शुभम</span>
                        </div>


                        <div class="row mt-4">
                            <div class="d-flex justify-content-between">
                                <p class="signature my-5">दस्तखत:<span class="underline-dotted"></span></p>
                                <div class="d-flex justify-content-end">
                                    <div class="row p-4">
                                        <div class="col-md-6">
                                            <div class="finger" style="width: 7rem; height: 10rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center mt-2">दायाँ</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-4">
                                        <div class="col-md-6">
                                            <div class="finger" style="width: 7rem; height: 10rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center mt-2">वायाँ</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="person">
                            <h5 class="text-decoration-underline">सक्षीहरु</h5>
                            <p>१. श्री<span class="underline-dotted custom-width"></span> दरखास्त<span
                                    class="underline-dotted custom-width"></span></p>
                            <p class="mt-2">२. श्री<span class="underline-dotted custom-width"></span> दरखास्त<span
                                    class="underline-dotted custom-width"></span></p>
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
