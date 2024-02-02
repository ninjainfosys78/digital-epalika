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
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::AGREEMENT_LETTER_BETWEEN_SUPERVISOR_CONSULTANT_AND_LANDLORD->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::AGREEMENT_LETTER_BETWEEN_SUPERVISOR_CONSULTANT_AND_LANDLORD"
                        url="{{route('emap.admin.map.map-apply.notice.upload.agreement',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <button class="bg-success text-white" onclick=" printJS({
                printable: 'printData',
                type: 'html',
                documentTitle: 'सुपरिवेक्षक/कन्सल्टेन्ट तथा घरधनी बीच',
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
                        <h3 class="text-center mt-3"><b>सम्झौत पत्र</b></h3>
                        <h6 class="text-center"><b>(सुपरिवेक्षक/कन्सल्टेन्ट तथा घरधनी बीच)</b></h6>
                        <span>
                            लिखितम् {{$mapApply->houseOwner->local_body??''}} वडा नं.<span
                                class="underline-dotted">{{$mapApply->houseOwner->ward_no??''}}</span>बस्ने
                            श्री<span
                                class="underline-dotted">{{$mapApply->houseOwner->grand_father_name??''}}</span>को
                            नाती/नातिनी श्री <span
                                class="underline-dotted">{{$mapApply->houseOwner->father_name??''}}</span>
                            को छोरा/छोरी/श्रीमती/बुहारी घरधनी
                            वर्ष <span class="underline-dotted"></span>को श्री <span
                                class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span> यसपछि
                            पहिलो पक्ष भनिएको र <span
                                class="underline-dotted">{{$mapApply->designerDetails->first()->local_body??''}}</span>
                            वडा नं.<span
                                class="underline-dotted">{{$mapApply->designerDetails->first()->ward_no??''}}</span>बस्ने
                            सुपरिवेक्षण (इन्जिनियर, सव
                            इन्जिनियर)
                            श्री<span
                                class="underline-dotted">{{$mapApply->designerDetails->first()->grand_father_name??''}}</span>को
                            नाति/नातिनी श्री <span
                                class="underline-dotted">{{$mapApply->designerDetails->first()->father_name??''}}</span>को
                            छोरा/छोरी वर्ष <span
                                class="underline-dotted custom-width"></span>को श्री <span
                                class="underline-dotted">{{$mapApply->designerDetails->first()->name??''}}</span>यस
                            पछि दोस्रो पक्ष भनिएको बीच आज
                            मिति <span class="underline-dotted custom-width"></span>साल <span
                                class="underline-dotted custom-width"></span>महिना<span
                                class="underline-dotted custom-width"></span>गतेका दिन तपसिल बमोजिमका सर्तका
                            अधिनमा रही कार्य गराउन मन्जुर भएको हुँदा यो समझदारी-पत्रमा सही छाप गरी किनाराका
                            साक्षीको रोहवरमा एक-एक प्रति बुझि लियौँ दियौँ ।
                        </span><br>
                        <span class="fw-bold">शर्तहरु:</span><br>
                        <span>१. घरधनीलाई आवश्यक पर्ने प्रविधिक सरसल्लाह एवं सुझाव उपलव्ध गराईनेछ ।</span><br>
                        <span>२. {{config('applicationDetail.office_type')}}बाट 'राष्ट्रिय भवन संहिता-२०६०' 'जग्गा विकास
                            तथा भवन
                            मापदण्ड-२०६४तथा 'वस्ती विकास शहरी योजना तथा भवन मापदण्ड-२०७२' बमोजिम प्रथम चरणको
                            नक्शा स्वीकृत भए पश्चात सो स्वीकृत नक्शामा तोकिए बमोजिमको Drawing, Design र
                            Specification बमोजिम निर्माण कार्य गर्न गराउनको लागि आवश्यक पर्ने प्राविधिक सेवा
                            उपलब्ध गराइनेछ ।</span><br>
                        <span>३. निर्माणकर्मीहरुलाई आवश्यक पर्ने कुनैपनि अस्पष्ट कुराहरुलाई तोकिए बमोजिम स्पष्ट
                            गराईनेछ ।</span><br>
                        <span>४. कार्य प्रगतिको बारेमा घरधनी र {{config('applicationDetail.office_type')}}लाई समय-समयमा
                            जानकारी उपलब्ध गराईनेछ
                            ।</span><br>
                        <span>५. {{config('applicationDetail.office_type')}}ले तोके बमोजिम डि.पि.सि. सम्मको
                            प्रतिवेदन {{config('applicationDetail.office_type')}}ले उपलब्ध
                            गराएको फरम्याटमा तयार गरी {{config('applicationDetail.office_type')}}मा पेश गरिनेछ । भवन
                            निर्माण सम्पन्न
                            भैसकेपछि निर्माण सम्पन्नको प्रतिवेदन {{config('applicationDetail.office_type')}}ले उपलब्ध
                            गराएको फरम्याटमा तयार
                            गरी {{config('applicationDetail.office_type')}}मा पेश गरिनेछ ।</span><br>
                        <table class="table table-sm table-bordered mt-2">
                            <thead>
                            <tr>
                                <th scope="col">प्रथम पक्षको तर्फबाट</th>
                                <th scope="col">दोस्रो पक्षको तर्फबाट</th>
                                <th scope="col">रोहवर</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td>घरधनीको नाम:<span
                                        class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span>
                                </td>
                                <td>घरधनीको नाम:<span
                                        class="underline-dotted">{{$mapApply->designerDetails->first()->name??''}}</span>
                                </td>
                                <td>{{config('applicationDetail.office_type')}}<span
                                        class="underline-dotted custom-width"></span></td>
                            </tr>
                            <tr>
                                <td>हस्ताक्षर:<span class="underline-dotted custom-width"></span></td>
                                <td>ने.ई.का.नं. :<span
                                        class="underline-dotted">{{$mapApply->designerDetails->first()->nec_council_no??''}}</span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>

                                <td>ठेगाना:<span
                                        class="underline-dotted">{{$mapApply->houseOwner->address??''}}</span>
                                </td>
                                <td>कन्सल्टेन्सी:<span
                                        class="underline-dotted">{{$mapApply->designerDetails->first()->consulting_firm_name??''}}</span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>हस्ताक्षर:<span class="underline-dotted custom-width"></span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>ठेगाना:<span
                                        class="underline-dotted">{{$mapApply->designerDetails->first()->address??''}}</span>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <p class="sign">मिति: २०७<span class="underline-dotted custom-width"></span>महिना<span
                                class="underline-dotted custom-width"></span>गते<span
                                class="underline-dotted custom-width"></span> । </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
