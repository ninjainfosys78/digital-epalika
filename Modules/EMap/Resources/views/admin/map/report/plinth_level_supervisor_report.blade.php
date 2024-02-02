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
            <h4> {{\Modules\EMap\Enums\NoticeTypeEnum::CONSTRUCTION_SUPERVISION_REPORT_UP_TO_PLINTH_LEVEL->label()}}</h4>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::CONSTRUCTION_SUPERVISION_REPORT_UP_TO_PLINTH_LEVEL"
                        url="{{route('emap.admin.map.map-apply.notice.upload.report',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <button class="bg-success text-white" onclick=" printJS({
                printable: 'printData',
                type: 'html',
                documentTitle: 'प्लिन्थ लेभलसम्मको निर्माणको सुपरिवेक्षण प्रतिवेदन',
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
                            <h5 class="text-center">प्लिन्थ लेभलसम्मको निर्माणको सुपरिवेक्षण प्रतिवेदन</h5>
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">घरधनीको नाम/ठेगाना</th>
                                    <td>{{$mapApply->houseOwner->name??''}}</td>
                                <tr>
                                    <th scope="col">नक्सा दर्ता नं.</th>
                                    <td>{{$mapApply->registration_no??''}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">कन्सल्टेन्सीको नाम</th>
                                    <td>{{$mapApply->consultant_name}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">निर्माणकर्मी/ठेकेदार</th>
                                    <td>{{$mapApply->designerDetails->first()->name??''}}</td>
                                </tr>
                                </tr>
                                </thead>
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
                                <tr class="mx-4">
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>घरको नक्सा तथा घर निर्माण गर्दा ध्यान दिनुपर्ने कुरा</li>
                                            <li>नक्सा पास प्रक्रियाको बारेमा</li>
                                            <li>निर्माण सामग्रीको गुणस्तरको बारेमा</li>
                                            <li>घरधनी, निर्माणकर्मी, सुपरिवेक्षकको दायित्व</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="col">घरधनीलाई परामर्श तथा घरनिर्माण सम्बन्धी अभिमुखीकरण</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>लेभल तथा कुना मिलाउने</li>
                                            <li>घर बनाउने क्षेत्रको सिमाक्ङन</li>
                                            <li>पिलरको centering</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="col">लेआउट गर्ने समयमा</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>जग्गाको लम्बाई, चौडाई,र गहिराई</li>
                                            <li>सोलिङ</li>
                                            <li>पि सि सि को अनुपात</li>
                                            <li>डण्डीको संख्या तथा राखेको तरिका</li>
                                            <li>जग बिममा डण्डीको संख्या तथा राखेको तरिका</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">जग खन्दा तथा जग र जग बन्धनको डण्डी बाँध्दा</th>
                                    <th scope="col"></th>
                                </tr>
                                </tbody>
                            </table>
                            <div class="break-page"></div>
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
                                    <td>
                                        <ul>
                                            <li>पिलरको डण्डीको संख्या र मोटाई</li>
                                            <li>पिलरको डण्डी खप्टिदा</li>
                                            <li>रिङको साइज, हुक, दूरी</li>
                                            <li>जगमा पिलरको डण्डीको<br>
                                                anchorage
                                            </li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="col">पिलरको डण्डी बाँध्दा तथा पिलर खडा गर्दा</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>कंक्रिटको अनुपात</li>
                                            <li>ढलानको साइज र आकार</li>
                                            <li>ढलान खँदिको तरिका र भाइब्रेटरको प्रयोग</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="col">जग तथा जगबन्धन र प्लिन्थ लेभलसम्म पिलर ढलान गर्दा</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>डण्डी संख्या र साइज</li>
                                            <li>डण्डीको anchorage</li>
                                            <li>डण्डी खाप्टिदाको स्थान र दूरी</li>
                                            <li>रिङको साइज, हुक, दूरी</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="col">टाइबिमको डण्डी बाँध्दा</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>कंक्रिटको अनुपात</li>
                                            <li>ढलानको साइज र आकार</li>
                                            <li>ढलान खँदिको तरिका र भाइब्रेटरको प्रयोग</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">टाइबिमको ढलान गर्दा</th>
                                    <th scope="col"></th>
                                </tr>
                                </tbody>
                            </table>
                            <div class="break-page"></div>
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
                                    <td>
                                        <ul>
                                            <li>घरको नक्सा तथा घर निर्माण गर्दा ध्यान दिनुपर्ने कुरा</li>
                                            <li>नक्सा पास प्रक्रियाको बारेमा</li>
                                            <li>निर्माण सामग्रीको गुणस्तरको बारेमा</li>
                                            <li>घरधनी, निर्माणकर्मी, सुपरिवेक्षकको दायित्व</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">घरधनीलाई परामर्श तथा घरनिर्माण सम्बन्धी अभिमुखीकारण</th>
                                    <th scope="col"></th>
                                </tr>
                                </tbody>
                            </table>


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
                                    <td>
                                        <ul>
                                            <li>लेभल तथा कुना मिलाउने</li>
                                            <li>घर बनाउने क्षेत्रको सिमाक्ङन</li>
                                            <li>पिलरको centering</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="col">लेआउट गर्ने समयमा</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>लगको लम्बाई, चौडाई,र गहिराई</li>
                                            <li>सोलिङ</li>
                                            <li>पि सि सि को अनुपात</li>
                                            <li>जगबन्धनमा डण्डीको संख्या तथा राखेको तरिका</li>
                                            <li>ठाडो डण्डीको साइज राखेको तरिका</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">जग, जगबन्धन र ठाडो डण्डी बाँध्दा</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>गारो लगाउने तरिका-दाँती वा स्टेप</li>
                                            <li>मसलाको अनुपात</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="col">प्लिन्थ लेभलसम्म गारो लगाउँदा</th>
                                    <th scope="col"></th>
                                </tr>
                                </tbody>
                            </table>
                            <div class="page-break"></div>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <td></td>
                                    <td>
                                        <ul>
                                            <li>कंक्रिटको अनुपात</li>
                                            <li>डण्डीको साइज, संख्या</li>
                                            <li>बन्धनको मोटाई</li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                            <li><span class="underline-dotted custom-width"></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">डि.पि.सि. बन्धन</th>
                                </tr>
                                </tbody>
                            </table>
                            <h5><b>नाम र सही</b></h5>
                            <table class="table table-sm table-bordered mt-2 text-center">
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
                            <p><b>नोट : </b>हात्तीपाइले, टाइ बिम डिटेल, चुरी, पिलरको डन्डी, लिन्टेल, सिल, स्टिच वेण्ड र
                                छतको रड आउनेगरी फोटो अनिवार्य छ
                                ।</p>
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
