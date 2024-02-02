@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">जेष्ठ नागरिक</li>
                    </ol>
                </div>
                <h4 class="page-title">जेष्ठ नागरिक विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header px-2 py-1">
                    <div class="card-title border-bottom px-1 d-flex justify-content-between">
                        <h4 class="font-18 ">श्री {{ $seniorCitizenDetail->name }} को व्यतिगत विवरण</h4>
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
                <div class="profile-table px-1" id="printData">
                    <table class="table  table-bordered table-hover table-responsive">
                        <tbody>
                            <tr>
                                <td>
                                    नाम, थर : {{ $seniorCitizenDetail->name }}
                                </td>

                                <td>
                                    जन्म मिति : {{ $seniorCitizenDetail->dob_bs }}
                                </td>
                                <td rowspan="2" class="text-center ">
                                    <img src="{{ $seniorCitizenDetail->photo }}" alt="{{ $seniorCitizenDetail->name }}"
                                        style="object-fit: cover; height: 6rem; width: 6rem; border: 1px solid var(--primary); border-radius: 10px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    कार्ड नं : {{ $seniorCitizenDetail->card_no }}
                                </td>
                                <td>
                                    लिंग : {{ $seniorCitizenDetail->gender?->label() ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    रक्त समुह : {{ $seniorCitizenDetail->blood_group?->label() ?? '' }}
                                </td>

                                <td>
                                    ठेगाना (स्थायी) : {{ $seniorCitizenDetail->localBody->local_body ?? '' }}
                                    -{{ $seniorCitizenDetail->ward_no }}
                                    , {{ $seniorCitizenDetail->tole }}
                                </td>
                                <td rowspan="3">
                                    <h4 class="font-15 text-center pb-2 text-decoration-underline">
                                        हातको छाप :
                                    </h4>

                                    <div class="d-flex justify-content-between">
                                        @foreach ($seniorCitizenDetail->fingerPrints as $file)
                                            <div class="col text center">
                                                <img src="{{ $file->finger_image }}" alt=""
                                                    style="object-fit: cover; height: 6rem; width: 6rem; border: 1px solid var(--primary); border-radius: 10px;">
                                                <p class="text-black"> {{ $file->finger == 'left' ? 'बाँया' : 'दाँया' }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>नागरिकता नं. : {{ $seniorCitizenDetail->citizenship_no }}</td>
                                <td> नागरिकता जारी मिति (वि.स) : {{ $seniorCitizenDetail->issue_date_bs }}</td>
                            </tr>
                            <tr>
                                <td>पति/पत्नीको नाम : {{ $seniorCitizenDetail->spouse }}</td>
                                <td>बावुको नाम: {{ $seniorCitizenDetail->father_name }}</td>
                            </tr>
                            <tr>
                                <td>आमाको नाम : {{ $seniorCitizenDetail->mother_name }}</td>
                            </tr>
                            <tr>
                                <th colspan="3">संरक्षकको विवरण:</th>
                            </tr>
                            <tr>
                                <td>संरक्षकको नाम : {{ $seniorCitizenDetail->patrons_name }}</td>
                                <td>ठेगाना :{{ $seniorCitizenDetail->patrons_name_address }}</td>
                            </tr>
                            <tr>
                                <td>संरक्षकको फोन : {{ $seniorCitizenDetail->patrons_phone }}</td>
                                <td>नाता :{{ $seniorCitizenDetail->patrons_relationship->title ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>कुनै प्रकारको रोग छ वा छैन ? :
                                    {{ $seniorCitizenDetail->is_disease == 1 ? 'छ' : 'छैन' }}
                                </th>
                                @if ($seniorCitizenDetail->is_disease == 1)
                                    <td colspan="2">रोगको नाम : {{ $seniorCitizenDetail->disease_name }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>हेरचाह केन्द्रको विवरण :</th>
                                <td colspan="2">{{ $seniorCitizenDetail->description }}</td>
                            </tr>
                            <tr>
                                <th>कुनै प्रकार को औषधि सेवन गरिएको छ वा छैन ? :
                                    {{ $seniorCitizenDetail->is_medicine == 1 ? 'छ' : 'छैन' }}</th>
                                @if ($seniorCitizenDetail->is_medicine == 1)
                                    <td colspan="2">औषधि नाम : {{ $seniorCitizenDetail->medicine_name }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="identity-card">
                    <div class="border-bottom py-2 px-2 d-flex justify-content-between">
                        <h4 class="font-18">जेष्ठ नागरिक </h4>
                        <a href="javascript:void(0)"
                            route_action="{{ route('identity.admin.seniorCitizenDetail.print', $seniorCitizenDetail) }}"
                            class="btn btn-xs btn-outline-warning printDetail">
                            <i class="fa fa-print">Print</i>

                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pt-5  ">
                            <div class="card px-3 py-2 mx-4 card-rounded">
                                <div class="office-header d-flex justify-content-between">
                                    <div>
                                        <img src="{{ $officeSetting->logo_url }}" alt="" height="40">
                                    </div>
                                    <div>
                                        @foreach ($officeHeaders as $header)
                                            <p
                                                style="font-size: {{ $header->card_font }}rem;color:{{ $header->font_color }};text-align: center;">
                                                {{ $header->title }}</p>
                                        @endforeach
                                    </div>
                                    <div>
                                        <img src="{{ $seniorCitizenDetail->employeeSignature->red_signature ?? '' }}"
                                            alt="{{ $seniorCitizenDetail->name_en }}" height="30" id="signature_image"
                                            style="z-index: 5;margin-right: -20px;margin-top:30px;transform: rotate(-10deg);" />
                                        <img src="{{ $seniorCitizenDetail->photo }}" alt="" height="40">
                                    </div>
                                </div>
                                <div class="identity text-center card-font-color">
                                    <p class="font-12 mb-2">जेष्ठ नागरिक परिचय पत्र</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-font-color">
                                            <p>आईडी कार्ड नं: {{ $seniorCitizenDetail->card_no }}</p>
                                            <p>व्यक्तिको पुरा नाम: {{ $seniorCitizenDetail->name }}</p>
                                            <p>नागरिकता नं : <span>{{ $seniorCitizenDetail->citizenship_no }}</span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-font-color">
                                            <p>लिङ्ग: {{ $seniorCitizenDetail->gender?->label() ?? '' }}</p>
                                            <p>रक्त समूह: {{ $seniorCitizenDetail->blood_group?->label() ?? '' }}</p>
                                            <p>उमेर: {{ $seniorCitizenDetail->age }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-font-color">
                                            <p>रोगको नाम : {{ $seniorCitizenDetail->disease_name }}</span></p>
                                            <p>ठेगाना : <span>
                                                    {{ $seniorCitizenDetail->localBody->local_body ?? '' }},{{ $seniorCitizenDetail->district->district ?? '' }},{{ $seniorCitizenDetail->province->province ?? '' }}</span>
                                            </p>
                                            <p>पति,पत्नीको नाम :
                                                <span>{{ $seniorCitizenDetail->spouse }} </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-2">
                                    {!! QrCode::size(60)->generate(route('seniorCitizenDetail.qrcode', $seniorCitizenDetail)) !!}
                                </div>
                                <div class="row footer-part">
                                    <div class="col-md-4 card-font-color text-center">
                                        <span style="text-decoration: underline dotted;">
                                            {{ $seniorCitizenDetail->employeeSignature->name ?? '' }}
                                        </span><br>
                                        <p>नाम</p>
                                    </div>
                                    <div class="col-md-4 card-font-color text-center">
                                        <span style="border-bottom: 0.122rem dotted #0b0b0b;position: relative;"><img
                                                style="position: absolute;"
                                                src=" {{ $seniorCitizenDetail->employeeSignature->red_signature ?? '' }}"
                                                alt="" height="30" class="signature">
                                        </span><br>
                                        <p>हस्ताक्षर</p>
                                    </div>
                                    <div class="col-md-4 card-font-color text-center">
                                        <span style="text-decoration: underline dotted;">
                                            {{ $seniorCitizenDetail->employeeSignature->designation ?? '' }}
                                        </span><br>
                                        <p>पद</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pt-5  ">
                            <div class="card px-3 py-2 mx-3 card-rounded">
                                <div class="office-header d-flex justify-content-between">
                                    <div>
                                        <img src="{{ $officeSetting->logo_url }}" alt="" height="40">
                                    </div>
                                    <div>
                                        @foreach ($officeHeaders as $header)
                                            <p
                                                style="font-size: {{ $header->card_font }}rem;color:{{ $header->font_color }};text-align: center;">
                                                {{ $header->title_en }}</p>
                                        @endforeach
                                    </div>
                                    <div>
                                        <img src="{{ $seniorCitizenDetail->employeeSignature->red_signature ?? '' }}"
                                            alt="{{ $seniorCitizenDetail->name_en }}" height="30" id="signature_image"
                                            style="z-index: 5;margin-right: -20px;margin-top:30px;transform: rotate(-10deg);" />
                                        <img src="{{ $seniorCitizenDetail->photo }}" alt="" height="40">
                                    </div>
                                </div>
                                <div class="identity text-center card-font-color">
                                    <p class="font-12 mb-2">Senior Citizen ID Card</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card-font-color">
                                            <p>ID Card No
                                                : {{ $seniorCitizenDetail->card_no }}</p>
                                            <p>Full Name : {{ $seniorCitizenDetail->name_en }}</p>
                                            <p>Citizenship No: {{ $seniorCitizenDetail->citizenship_no }}<span></span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-font-color">
                                            <p>Gender
                                                : {{ $seniorCitizenDetail->gender }}</p>
                                            <p>Blood Group : {{ $seniorCitizenDetail->blood_group?->label() ?? '' }}
                                            </p>
                                            <p>Age
                                                : {{ $seniorCitizenDetail->age }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-font-color">
                                    <div class="row">
                                        <div class="col-md-12 card-font-color">
                                            <p>Disease : <span>{{ $seniorCitizenDetail->disease_name }}</span></p>
                                            <p>Address :
                                                <span>
                                                    {{ $seniorCitizenDetail->localBody->local_body_en ?? '' }},{{ $seniorCitizenDetail->district->district_en ?? '' }},{{ $seniorCitizenDetail->province->province_en ?? '' }}</span>
                                            </p>
                                            <p>Husband/Wife Name :
                                                <span> {{ $seniorCitizenDetail->spouse_en }}</span>
                                            </p>
                                        </div>
                                        {{-- <div class="col-md-4 d-flex justify-content-between">
                                            <div class="text-center card-font-color">
                                                @foreach ($seniorCitizenDetail->fingerPrints->where('finger', 'left') as $fingerPrint)
                                                    <img src="{{$fingerPrint->finger_image}}" alt=""
                                                         height="48"><br>
                                                    <p>Left</p>
                                                @endforeach

                                            </div>

                                            <div class="text-center card-font-color">
                                                @foreach ($seniorCitizenDetail->fingerPrints->where('finger', 'right') as $fingerPrint)
                                                    <img src="{{$fingerPrint->finger_image}}" alt=""
                                                         height="48"><br>
                                                    <p>Right</p>
                                                @endforeach
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-center">
                                            {!! QrCode::size(60)->generate(route('seniorCitizenDetail.qrcode', $seniorCitizenDetail)) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row footer-part">
                                    <div class="col-md-4 card-font-color text-center">
                                        <span style="text-decoration: underline dotted;">
                                            {{ $seniorCitizenDetail->employeeSignature->name_en ?? '' }}</span><br>
                                        <p>Name</p>
                                    </div>
                                    <div class="col-md-4 card-font-color text-center">
                                        <span style="border-bottom: 0.122rem dotted #0b0b0b;"><img
                                                style="position: absolute;"
                                                src=" {{ $seniorCitizenDetail->employeeSignature->red_signature ?? '' }}"
                                                alt="" height="30" class="signature">
                                        </span><br>
                                        <p>Signature</p>
                                    </div>
                                    <div class="col-md-4 card-font-color text-center">
                                        <span style="text-decoration: underline dotted;">
                                            {{ $seniorCitizenDetail->employeeSignature->designation_en ?? '' }}
                                        </span><br>
                                        <p>Designation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(".printDetail").on("click", function(e) {
                $.ajax({
                    method: "GET",
                    url: $(this).attr("route_action"),
                    success: function(resp) {
                        var print_area = window.open();
                        print_area.document.write(resp.view);
                        print_area.document.close();
                        print_area.focus();
                        print_area.print();
                        print_area.close();
                    },
                    error: function() {
                        alert("Something Went Wrong");
                    }
                });
            });
        </script>
    @endpush
    @push('style')
        <style>
            .card-font-color>p {
                color: #0b0b0b;
                font-size: 12px;
            }

            .card-font-color>span {
                color: #0b0b0b;
            }

            .identity>p {
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
