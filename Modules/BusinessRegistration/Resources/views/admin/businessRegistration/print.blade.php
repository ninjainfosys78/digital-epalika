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
                            <a href="{{route('admin.businessRegistration.businessRegistration.index')}}">व्यवसाय
                                दर्ता </a>
                        </li>
                        <li class="breadcrumb-item active">प्रमाणपत्र प्रिन्ट</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रमाणपत्र प्रिन्ट </h4>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">प्रमाणपत्र प्रिन्ट</h4>
                        <x-print-button
                            target-element="print"
                            title="{{$businessDetail-> registration_no}}"
                        />
                    </div>
                </div>
                <div class="card-body">
                    <div id="print" class="certificate" style="border-image: url({{asset('assets/backend/border.png')}}) 30 stretch">
                        <div class="lh-lg font-15 position-relative">
                            {!! letterHead() !!}
                            <div class="position-absolute top-0 end-0">
                                <img src="{{$businessDetail->partners->first()?->photo ?? ''}}" height="80" width="90" alt=""/>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div>
                                    <p><strong>करदाता नं :</strong> {{get_nepali_number($businessDetail->taxpayer_number)}}</p>
                                    <p><strong>प्रमाणपत्र नं :</strong> {{get_nepali_number($businessDetail-> registration_no)}}</p>
                                </div>
                                <div class="certificate-title">
                                    <h3>व्यवसाय दर्ता प्रमाण-पत्र</h3>
                                </div>
                                <div>
                                    <p><strong>दर्ता मिति :</strong> {{get_nepali_number($businessDetail->registration_date_ne)}}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p>जिल्ला <span
                                        class="dashed-bottom mx-1">{{$businessDetail->partners->first()?->district->district ??''}}</span>
                                    गा.बि.स./नगरपालिका <span
                                        class="dashed-bottom mx-1">{{$businessDetail->partners->first()?->localBody->local_body ??''}}</span>
                                    वडा नं. <span
                                        class="dashed-bottom mx-1">{{get_nepali_number($businessDetail->partners->first()?->ward_no ??'')}}</span>
                                    बस्ने श्री <span
                                        class="dashed-bottom mx-1">{{$businessDetail->partners->first()?->name ??''}}</span>
                                    लाई निम्न विवरण अनुसारको व्यवसाय दर्ता गरी यो प्रमाण-पत्र जारी गरिएको छ ।
                                </p>
                            </div>
                            <div class="mt-2">
                                <p><strong>व्यवसायको नाम :</strong> <span class="mx-1">{{$businessDetail->name}}</span></p>
                                <p><strong>व्यवसाय रहने स्थान :</strong>
                                    <span class="mx-1">{{$businessDetail->localBody->local_body??''}}</span>
                                    वडा नं. <span class="mx-1">{{get_nepali_number($businessDetail->ward_no)}}</span>
                                    बाटोको नाम <span class="mx-1">{{$businessDetail->way}}</span></p>
                                <p><strong>घर नं. .............. टोल</strong> <span class="mx-1">{{$businessDetail->tole}}</span></p>
                                <p><strong>व्यवसाय रहने घर/जगाधानी नाम :</strong>
                                    <span class="mx-1">{{$businessDetail->house_owner_name}}</span></p>
                                <p><strong>व्यवसायको प्रकृति :</strong>
                                    <span class="mx-1">{{$businessDetail->businessNature->title??''}}</span></p>
                                <p><strong>विवरण :</strong> <span class="mx-1">{{$businessDetail->objectTransaction->title??''}}</span>
                                </p>
                                <p><strong>उद्देश्य : </strong><span class="mx-1">{{$businessDetail->purpose}}</span></p>
                                <p><strong>परिचयपाटीको साइज : </strong><span class="mx-1">({{get_nepali_number($businessDetail->length)}} * {{get_nepali_number($businessDetail->width)}}) Sq.ft</span>
                                </p>
                                <p><strong>पुजीगत लगानी (रु मा) :</strong><span class="mx-1">{{get_nepali_number($businessDetail->investment)}}</span></p>

                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <p class="dashed">करवालाको हस्ताक्षर</p>
                                <p class="dashed">स्वीकृत गर्नेको हस्ताक्षर</p>
                            </div>
                            <div class="mt-4">
                                <p class="fw-bold">नोट:</p>
                                <p>१. प्रत्येक आर्थिक वर्षको असार मसान्त भित्र नविकरण गराई सक्नु पर्नेछ । अन्यथा
                                    यस {{$officeSetting->localBody->local_body??''}}को प्रचलित आर्थिक एन बमोजिम कारवाही
                                    हुनेछ ।</p>
                                <p>२. {{$officeSetting->localBody->local_body??''}}को कर ,शुल्क ,दस्तुर समयमा नबुझाएमा
                                    करदातालाई {{$officeSetting->localBody->local_body??''}}का तथा वडा समितिबाट दिएको
                                    सेवा, सुबिधा र सिफारिसमा समेत रोक्का गरिनेछ ।</p>
                                <p>३. यो प्रमाण-पत्र गर्ने स्थानमा सबैले देख्ने गरी राख्नुपर्नेछ ।</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
