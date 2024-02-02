@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अपाङ्गता विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">अपाङ्गता विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header px-2 py-1">
                    <div class="card-title border-bottom px-1 d-flex justify-content-between">
                        <h4 class="font-18 ">श्री {{$disabilityIdentityCard->name}} को व्यतिगत विवरण</h4>
                        <div>
                            <button class="btn btn-sm btn-info"
                                    onclick="printJS({
                                    printable: 'printData',
                                    targetStyles: ['*'],
                                    ignoreElements:['ignore-header'],
                                    type: 'html'
                                    })">
                                <i class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="profile-table"  id="printData">
                    <table class="table  table-bordered table-hover table-responsive py-1">
                        <tbody>
                        <tr>
                            <td>
                                नागरिकता नं. : {{get_nepali_number($disabilityIdentityCard->citizenship_no)}}
                            </td>
                            <td>
                                परिचयपत्रको प्रकार
                                :
                            </td>
                            <td rowspan="4" class="text-center ">
                                <img src="{{$disabilityIdentityCard->photo_url}}"
                                     alt="{{$disabilityIdentityCard->name}}"
                                     style="object-fit: cover; height: 6rem; width: 6rem; border: 1px solid var(--primary); border-radius: 10px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                आमाको नाम : {{$disabilityIdentityCard->mother_name}}
                            </td>
                            <td>
                                बाबुको नाम : {{$disabilityIdentityCard->father_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>जन्म मिति : {{get_nepali_number($disabilityIdentityCard->dob)}}</td>
                            <td>  लिङ्ग : {{$disabilityIdentityCard->gender?->label() ?? ''}}</td>
                        </tr>

                        <tr>
                            <td>
                                ठेगाना  : {{$disabilityIdentityCard->localBody->local_body?? ""}}
                                -{{$disabilityIdentityCard->ward_no}}
                                , {{$disabilityIdentityCard->tole}}
                            </td>
                            <td>
                                अपाङ्गताको प्रकार : {{$disabilityIdentityCard->disabilityType->title?? ""}}
                            </td>
                        </tr>



                        <tr>
                            <th colspan="3" class="text-center">संरक्षकको विवरण</th>
                        </tr>
                        <tr>
                            <td>नाम: {{$disabilityIdentityCard->guardian_name}}</td>
                            <td> नाता : {{$disabilityIdentityCard->relationship->title??''}}</td>
                            <td>फोन : {{$disabilityIdentityCard->phone}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
{{--                <div class="identity-card">--}}
{{--                    <div class="border-bottom py-2 px-2 d-flex justify-content-between">--}}
{{--                        <h4 class="font-18">अपाङ्गता परिचयपत्र</h4>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 pt-5  ">--}}
{{--                            <div class="card px-3 py-2 mx-4 card-rounded"--}}
{{--                                 style="background-color: {{$disabilityIdentityCard->governmentalDisabilityType->color??''}};">--}}
{{--                                <div class="office-header d-flex justify-content-between">--}}
{{--                                    <div>--}}
{{--                                        <img src="{{$officeSetting->logo_url}}" alt="" height="40">--}}
{{--                                    </div>--}}
{{--                                    <div class="">--}}
{{--                                        @foreach($officeHeaders as $header)--}}
{{--                                            <p style="font-size: {{$header->card_font}}rem;color:{{$disabilityIdentityCard->governmentalDisabilityType->header_color??''}};text-align: center;">{{$header->title}}                                </p>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    <div>--}}

{{--                                        <img src="{{$disabilityIdentityCard->employeeSignature->red_signature??''}}"--}}
{{--                                             alt="" height="30" id="signature_image"--}}
{{--                                             style="z-index: 5;margin-right: -20px;margin-top:30px;transform: rotate(-10deg);"/>--}}
{{--                                        <img src="{{$disabilityIdentityCard->photo_url}}" alt="" height="40">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="identity text-center card-font-color">--}}
{{--                                    <p class="font-12 ">अपांगता परिचय पत्र</p>--}}
{{--                                </div>--}}
{{--                                <div class="card-font-color">--}}
{{--                                    <p>परिचय पत्रको--}}
{{--                                        प्रकार:{{$disabilityIdentityCard->governmentalDisabilityType?->category->label()??''}}</p>--}}
{{--                                    <p>प. प. नं.: {{$disabilityIdentityCard->card_no}}</p>--}}
{{--                                </div>--}}
{{--                                <div class="card-font-color">--}}
{{--                                    <p>नाम थर : <span>{{$disabilityIdentityCard->name ??''}}</span></p>--}}
{{--                                    <p>ठेगाना :--}}
{{--                                        <span>{{$disabilityIdentityCard->permanentProvince->province??''}}</span>--}}
{{--                                        <span>{{$disabilityIdentityCard->permanentDistrict->district??''}}</span>--}}
{{--                                        <span>{{$disabilityIdentityCard->permanentLocalBody->local_body??''}} </span>--}}
{{--                                    </p>--}}
{{--                                    <p>लिङ्ग :<span> {{$disabilityIdentityCard->gender->label() ??''}}</span></p>--}}
{{--                                    <p>अपांगता प्रकृतिको आधारमा :--}}
{{--                                        <span> {{$disabilityIdentityCard->disabilityType->title??''}}</span>--}}
{{--                                    </p>--}}
{{--                                    <p>गम्भीरता :--}}
{{--                                        <span> {{$disabilityIdentityCard->governmentalDisabilityType->title??''}}</span>--}}
{{--                                    </p>--}}
{{--                                    <p>बाबु आमा वा संरक्षकको नाम थर :--}}
{{--                                        <span> {{$disabilityIdentityCard->father_name??''}}</span></p>--}}
{{--                                    <p>परिचय पत्र प्रमाणित गर्ने : <span> </span></p>--}}
{{--                                    <p>जारी मिति : {{$todayDate}}</p>--}}

{{--                                </div>--}}
{{--                                <div class="row footer-part">--}}
{{--                                    <div class="col-md-4 card-font-color text-center">--}}
{{--                                        <span--}}
{{--                                            style="text-decoration: underline dotted;">{{$disabilityIdentityCard->employeeSignature->name??''}}</span><br>--}}
{{--                                        <p>नाम</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4 card-font-color text-center">--}}
{{--                                        <span style="border-bottom: 0.122rem dotted #0b0b0b;position: relative;"><img style="position: absolute;"--}}
{{--                                                src="{{$disabilityIdentityCard->employeeSignature->red_signature??''}}"--}}
{{--                                                alt="{{$disabilityIdentityCard->name??''}}" height="30"--}}
{{--                                                class="signature">--}}
{{--                                        </span><br>--}}
{{--                                        <p>हस्ताक्षर</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4 card-font-color text-center">--}}
{{--                                        <span style="text-decoration: underline dotted;">{{$disabilityIdentityCard->employeeSignature->designation??''}}--}}
{{--                                        </span><br>--}}
{{--                                        <p>पद</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="col-md-6 pt-5  ">--}}
{{--                            <div class="card px-3 py-2 mx-3 card-rounded"--}}
{{--                                 style="background-color: {{$disabilityIdentityCard->governmentalDisabilityType->color??''}};">--}}
{{--                                <div class="office-header d-flex justify-content-between">--}}
{{--                                    <div>--}}
{{--                                        <img src="{{$officeSetting->logo_url}}" alt="" height="40">--}}
{{--                                    </div>--}}
{{--                                    <div class="">--}}
{{--                                        @foreach($officeHeaders as $header)--}}
{{--                                            <p style="font-size: {{$header->card_font}}rem;color:{{$disabilityIdentityCard->governmentalDisabilityType->header_color??''}};text-align: center;">{{$header->title_en}}</p>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        {!! QrCode::size(60)->generate(route('disabilityIdentityCard.qrcode',$disabilityIdentityCard)); !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="identity text-center card-font-color">--}}
{{--                                    <p class="font-12 ">Disability Identity Card</p>--}}
{{--                                </div>--}}
{{--                                <div class="card-font-color">--}}
{{--                                    <p>ID Card Type--}}
{{--                                        : {{$disabilityIdentityCard->governmentalDisabilityType?->category??''}}</p>--}}
{{--                                    <p>Card No. : {{$disabilityIdentityCard->card_no}}</p>--}}
{{--                                </div>--}}
{{--                                <div class="card-font-color">--}}
{{--                                    <p>Name of card holder: <span>{{$disabilityIdentityCard->name_en ??''}}</span></p>--}}
{{--                                    <p>Address :--}}
{{--                                        <span>{{$disabilityIdentityCard->permanentProvince->province_en??''}}</span>--}}
{{--                                        <span>{{$disabilityIdentityCard->permanentDistrict->district_en??''}}</span>--}}
{{--                                        <span>{{$disabilityIdentityCard->permanentLocalBody->local_body_en??''}} </span>--}}
{{--                                    </p>--}}
{{--                                    <p>Gender :--}}
{{--                                        <span> {{$disabilityIdentityCard->gender ??''}}</span></p>--}}

{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-8 card-font-color">--}}
{{--                                            <p style="margin-bottom: 0;">Disability On the basis of nature :--}}
{{--                                                <span> {{$disabilityIdentityCard->disabilityType->title_en??''}}</span>--}}
{{--                                            </p>--}}
{{--                                            <p style="margin-bottom: 0;">On the basis of severity :--}}
{{--                                                <span> {{$disabilityIdentityCard->governmentalDisabilityType->title_en??''}}</span>--}}
{{--                                            </p>--}}
{{--                                            <p>Father/Mother/Guardian :--}}
{{--                                                <span> {{$disabilityIdentityCard->father_name_en??''}}</span></p>--}}
{{--                                            <p>ID Card Approved By : <span> </span></p>--}}
{{--                                            <p>Issue Date :<span>--}}
{{--                                                    {{today()->toDateString()}}--}}
{{--                                                </span>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4 d-flex justify-content-between">--}}
{{--                                            <div class="text-center card-font-color">--}}
{{--                                                @foreach($disabilityIdentityCard->fingerPrints->where('finger','left') as $fingerPrint)--}}
{{--                                                    <img src="{{$fingerPrint->finger_image}}" alt=""--}}
{{--                                                         height="48"><br>--}}
{{--                                                    <p>Left</p>--}}
{{--                                                @endforeach--}}

{{--                                            </div>--}}
{{--                                            <div class="text-center card-font-color">--}}
{{--                                                @foreach($disabilityIdentityCard->fingerPrints->where('finger','right') as $fingerPrint)--}}
{{--                                                    <img src="{{$fingerPrint->finger_image}}" alt=""--}}
{{--                                                         height="48"><br>--}}
{{--                                                    <p>Right</p>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row footer-part">--}}
{{--                                    <div class="col-md-4 card-font-color text-center">--}}
{{--                                        <span--}}
{{--                                            style="text-decoration: underline dotted;">{{$disabilityIdentityCard->employeeSignature->name_en??''}}</span><br>--}}
{{--                                        <p>Name</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4 card-font-color text-center">--}}
{{--                                        <span style="border-bottom: 0.122rem dotted #0b0b0b;"><img style="position: absolute;"--}}
{{--                                                src="{{$disabilityIdentityCard->employeeSignature->red_signature??''}}"--}}
{{--                                                alt="{{$disabilityIdentityCard->name??''}}" height="30"--}}
{{--                                                class="signature">--}}
{{--                                        </span><br>--}}
{{--                                        <p>Signature</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4 card-font-color text-center">--}}
{{--                                        <span style="text-decoration: underline dotted;">{{$disabilityIdentityCard->employeeSignature->designation_en??''}}--}}
{{--                                        </span><br>--}}
{{--                                        <p>Designation</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="identity-card">--}}
{{--                    <div class="border-bottom py-2 px-2">--}}
{{--                        <h4 class="font-18">कागजातहरु </h4>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 pt-2">--}}
{{--                            <div class="card mx-2 shadow">--}}
{{--                                <div class="card-header" id="ignore-header">--}}
{{--                                    <a href="{{route('admin.file-url-download',['file_url'=>$disabilityIdentityCard->citizenship_photo])}}">--}}
{{--                                        <i class="fa fa-download"> डाउनलोड</i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <img src="{{$disabilityIdentityCard->citizenship_photo_url?? ""}}"--}}
{{--                                         class="card-image" alt="Image"--}}
{{--                                         width="60%" style="object-fit: cover;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 pt-2">--}}
{{--                            <div class="card mx-2 shadow">--}}
{{--                                <div class="card-header" id="ignore-header">--}}
{{--                                    <a href="{{route('admin.file-url-download',['file_url'=>$disabilityIdentityCard->citizenship_photo_certificate])}}">--}}
{{--                                        <i class="fa fa-download"> डाउनलोड</i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <img src="{{$disabilityIdentityCard->citizenship_photo_certificate_url?? ""}}"--}}
{{--                                         class="card-image" alt="Image"--}}
{{--                                         width="60%" style="object-fit: cover;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(".printDetail").on("click", function (e) {
                $.ajax({
                    method: "GET",
                    url: $(this).attr("route_action"),
                    success: function (resp) {
                        var print_area = window.open();
                        print_area.document.write(resp.view);
                        print_area.document.close();
                        print_area.focus();
                        print_area.print();
                        print_area.close();
                    }, error: function () {
                        alert("Something Went Wrong");
                    }
                });
            });
        </script>
    @endpush
    @push('style')
        <style>
            .card-font-color > p {
                color: #0b0b0b;
                font-size: 12px;
            }

            .card-font-color > span {
                color: #0b0b0b;
            }
            .identity>p{
                background-color: black;
                text-align: center;
                width: 70%;
                color: white;
                border-radius: 5px;
                margin-left: 70px;
                height: 15px;
            }
        </style>
    @endpush
@endsection


