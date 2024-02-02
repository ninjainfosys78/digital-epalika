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
            <h4> {{\Modules\EMap\Enums\NoticeTypeEnum::CONSTRUCTION_SUPERVISION_REPORT_UPTO_SUPERSTRUCTURE->label()}}</h4>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::CONSTRUCTION_SUPERVISION_REPORT_UPTO_SUPERSTRUCTURE"
                        url="{{route('emap.admin.map.map-apply.notice.upload.report',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <button class="bg-success text-white" onclick=" printJS({
                printable: 'printData',
                type: 'html',
                documentTitle: 'सुपरस्ट्रक्चर सम्म निर्माणको सुपरिवेक्षण प्रतिवेदन',
                showModal: true,
                css: '{{asset('assets/backend/css/print.css')}}',
                honorMarginPadding: false,
                modalMessage: 'तपाईंको कागजात छाप्नको लागि तयार हुँदैछ।'})"><i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div><!-- end col-->
    </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card mb_30">
                                <div class="card-body p-3">
                                    <div class="font-black" id="printData">
                                        <h5 class="text-center mb-2">सुपरस्ट्रक्चर सम्म निर्माणको सुपरिवेक्षण प्रतिवेदन</h5>
                                        <table class="table table-sm table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th scope="col">घरधनीको नाम/ठेगाना </th>
                                                <td>{{$mapApply->houseOwner->name??''}} {{$mapApply->houseOwner->address??''}}</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col">नक्सा दर्ता नं.</th>
                                                <td>{{$mapApply->registration_no}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">कन्सल्टेन्सीको नाम</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">निर्माणकर्मी/ठेकेदार</th>
                                                <td>{{$mapApply->designerDetails->first()->name??''}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <h4><b>पिलरवाला घर</b></h4>
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">फोटो र फोटोको विवरण</th>
                                                <th scope="col">कैफियत</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>पिलरको डण्डीको संख्या र मोटाई</li>
                                                        <li>पिलरको डण्डी खप्टिदा</li>
                                                        <li>रिङको साइज, हुक, दूरी </li>
                                                        <li>जगमा पिलरको डण्डीको<br>
                                                        anchorage</li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">टाइबिम वा बिममाथिको पिलरको डण्डी बाँध्दा</th>
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>कंक्रिटको अनुपात</li>
                                                        <li>ढलानको साइज र आकार</li>
                                                        <li>ढलान खँदिको तरिका र भाइब्रेटरको प्रयोग</li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">पिलर ढलान गर्दा</th>
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>गारो लगाउने तरिका - दाँती वा स्टेप</li>
                                                        <li>मसलाको अनुपात</li>
                                                        <li>बन्धनको मोटाई, डण्डीको साइज, पिलरमा कनेक्सन</li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">गारो तथा बन्धन राख्दा</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="break-page"></div>
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">फोटो र फोटोको विवरण</th>
                                                <th scope="col">कैफियत</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>फर्माको साइज, मोटाई, लेभल, सपोर्ट </li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">स्ल्याब र बिमको फर्मा राख्दा</th>
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>डण्डी संख्या र साइज </li>
                                                        <li>डण्डीको anchorage</li>
                                                        <li>डण्डी खाप्टिदाको स्थान र दूरी</li>
                                                        <li>रिङको साइज, हुक, दूरी</li>
                                                        <li>बिमा पिलर जोर्नीमा रिङ</li>
                                                        <li>बिम पिलर जोर्नीमा बिमको डण्डी राखेको तरिका</li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">स्ल्याब र बिमको डण्डी राख्दा</th>
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>कंक्रिटको अनुपात </li>
                                                        <li>ढलानको साइज र आकार </li>
                                                        <li>ढलान खँदिको तरिका र भाइब्रेटरको प्रयोग</li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">स्ल्याब र बिमको ढलान</th>
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>गारोलाई ७ दिन सम्म सुक्न नदिने </li>
                                                        <li>ढलानलाई २१ दिन सम्म सुक्न नदिने </li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">क्युरिङ गर्दा</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="break-page"></div>
                                        <h4><b>गारोवाला घर</b></h4>
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">फोटो र फोटोको विवरण</th>
                                                <th scope="col">कैफियत</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>गारो लगाउने तरिका - दाँती वा स्टेप</li>
                                                        <li>मसलाको अनुपात</li>
                                                        <li>गारोको bond</li>
                                                        <li>झ्याल ढोकाको स्थान र साइज </li>
                                                        <li>झ्याल ढोकाको साइडमा ठाडो डण्डी </li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">प्लिन्थ लेभलमाथि गारो लगाउँदा </th>
                                                <th scope="col"></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-sm table-bordered mt-2">
                                            <thead>
                                            <tr class="text-center">
                                                <th scope="col">फोटो र फोटोको विवरण</th>
                                                <th scope="col">कैफियत</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>डण्डीको साइज, संख्या </li>
                                                        <li>बन्धनको मोटाई  </li>
                                                        <li>कंक्रिट अनुपात</li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">कर्नर स्टिज, सिल र लिन्टेल बन्धन</th>
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>फर्माको साइज, मोटाई, लेभल, सपोर्ट </li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">स्ल्याब र स्ल्याब बन्धनको फर्मा</th>
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>कंक्रिटको अनुपात</li>
                                                        <li>ढलानको साइज र आकार </li>
                                                        <li>डण्डीको संख्या, राख्ने तरिका</li>
                                                        <li>रिङको साइज, हुक, दूरी</li>
                                                        <li>ढलान खँदिको तरिका र भाइब्रेटरको प्रयोग </li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="break-page"></div>
                                        <table class="table table-sm table-bordered mt-2">
                                            <thead>
                                            <tr>
                                                <th scope="col">स्ल्याब र स्ल्याब बन्धनको ढलान</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td><ul>
                                                        <li>कंक्रिटको अनुपात</li>
                                                        <li>डण्डीको साइज, संख्या </li>
                                                        <li>बन्धनको मोटाई</li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                        <li><span class="underline-dotted custom-width"></span></li>
                                                    </ul></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">डि.पि.सि. बन्धन</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <h5><b>नाम र सही</b></h5>
                                        <table class="table table-bordered mt-2 text-center">
                                            <thead>
                                            <tr>
                                                <th scope="col"><span class="underline-dotted custom-width"></span></th>
                                                <th scope="col"><span class="underline-dotted custom-width"></span></th>
                                                <th scope="col"><span class="underline-dotted custom-width"></span></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>घरधनी</td>
                                                <td>ठेकेदार</td>
                                                <td>सुपरिवेक्षक</td>
                                            </tr>
                                            </tbody>
                                        </table>
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
