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
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::NOTICE_ISSUED_IN_THE_NAME_OF_SANGHIAR->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="को संघियारको नाममा जारी भएको सूचना"/>
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
                            <div class="col-md-6 text-end">मिति: <div class="underline-dotted custom-width"></div>
                            </div>
                        </div>
                        <h4 class="text-center fw-bold mt-2">संधियारको नाममा जारी भएको सूचना</h4>
                        <span class="mt-2">
                            यस {{config('applicationDetail.office_type')}}
                            वडा नं. <span class="underline-dotted">{{$mapApply->landDetail->ward_no??''}}</span>
                            टोल <span class="underline-dotted"> {{$mapApply->landDetail->tole??''}}</span>
                            <span class="underline-dotted custom-width"></span>
                            मा अवस्थित साविक <span class="underline-dotted">{{$mapApply->landDetail->former_ward_no??''}}</span>
                            किता नं. <span class="underline-dotted">{{$mapApply->landDetail->plot_no??''}}</span>
                            क्षेत्रफल<span class="underline-dotted">{{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span> मा भवन निर्माण गर्ने घरधनी श्री <span class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span>ले यस नक्सा बमोजिमको भवन निर्माण गर्न निवेदन पेश गरेकोमा संधियारको नाममा यो सुचना
                            प्रकाशित गरिएको छ । निवेदन साथ पेश हुन आएको प्रमाण र नक्साको आधारमा निर्माण स्वीकृति दिंदा
                            तपाइको जग्गा लगायत सार्वजनिक स्थलको हानी निक्सानी हुन्छ, हुदैन, सन्धी सर्पन हानी नोक्सानी
                            हुने भए यो सुचना प्रकाशित भएको १५ दिनभित्र सबुत प्रमाण सहित उप-महानगरपालिकामा उजुर गर्न
                            सुचित गरिन्छ ।
                            म्याद नाघी आएको उजुरी उपर कुनै किसिमको कारवाही नहुने व्यहोरा जानकारी गराईन्छ ।
                        </span>
                        <h5 class="fw-bold mt-2">१. निर्माणका निमित्त प्रस्तावित जग्गा चारकिल्ला विवरण:</h5>
                        <table class="table table-sm table-bordered mt-2">
                            <thead>
                            <tr class="text-center">
                                <th rowspan="2">दिशा</th>
                                <th rowspan="2">आफ्नो जग्गा लम्बाई(फिट/मिटर)</th>
                                <th colspan="3">संधियार</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td>कि.नं.</td>
                                <td>लेन्डस्केपको प्रकार</td>
                                <td>नाम</td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row">उतर</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row">दक्षिण</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row">पुर्व</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row">पश्चिम</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <p class="mt-2">
                            घरको नाप: लम्बाई: <span
                                class="underline-dotted"> {{$mapApply->length??''}}</span> चौडाई: <span
                                class="underline-dotted"> {{$mapApply->breadth??''}} </span> उचाई: <span
                                class="underline-dotted">{{$mapApply->height??''}}
                            </span> तल्ला संख्या: <span class="underline-dotted">{{$mapApply->current_storey??''}}
                            </span></p>
                        <p class="mt-2"> बोधार्थ: १. <span class="underline-dotted custom-width"></span>नं. वडा
                            वडाध्यक्ष/वडा प्रतिनिधि : कुनै प्रतिक्रिया भए जनाईदिनुहुन अनुरोध छ ।</p>
                        <div class="d-flex justify-content-end mt-2"><span class="underline-dotted custom-width"></span>
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


