<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $seniorCitizenDetail->name ?? '' }} </title>

    <style>
        .container {
            text-align: center;
        }

        .footer-text {
            display: inline-flex;
            padding: 3px;
            border-radius: 5px;
            font-size: 8px;
            background-color: red;
            color: #fff;
        }

        body {
            visibility: hidden;
        }

        .col-md-3 {
            float: left;
            width: 25%;
        }

        .col-md-9 {
            float: left;
            width: 75%;
        }

        .col-md-6 {
            float: left;
            width: 50%;
        }

        .col-md-4 {
            float: left;
            width: 33.33%;
        }

        h4 {
            color: black;
        }

        p {
            line-height: 0.5;
            font-size: 7px
        }

        p>span {
            border-bottom: 1px dotted;
        }

        .header {
            visibility: visible;
            padding: 15px;
            border: 1px solid black;
            border-radius: 8px;
        }

        .header>.office_header {
            display: flex;
            justify-content: space-between;
        }

        .identity {
            display: flex;
            justify-content: space-between;
        }

        .identity>h2 {
            font-size: 8px;
        }

        .heading {
            background-color: black;
            text-align: center;
            width: 70%;
            color: white;
            border-radius: 5px;
            margin-left: 70px;
            height: 10px;
        }

        .middle-part {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0;
        }

        .footer-part {
            font-size: 10px;
        }

        .footer-part>div>span {
            border-bottom: 1px dotted;
            font-size: 8px !important;
        }

        #signature_image {
            z-index: 5;
            margin-left: -60px;
            transform: rotate(-10deg);
        }

        .signature {
            z-index: 5;
            margin-top: -10px;
            transform: rotate(-10deg);
        }

        @media print {
            .break-page {
                page-break-after: always !important;
            }

        }

        @page {
            size: landscape;

        }
    </style>
</head>

<body>
    <div>
        <div class="header" style="height: 204px;width: 324px;">
            <div class="office_header">
                <div>
                    <img src="{{ $officeSetting->logo_url }}" alt="" height="30">
                </div>
                <div>
                    @foreach ($officeHeaders as $header)
                        <p
                            style="font-size: {{ $header->card_font }}rem;font-weight:{{ $header->font }};color:{{ $header->font_color }};line-height: 0.2;text-align: center;">
                            {{ $header->title }}</p>
                    @endforeach
                </div>
                <div>
                    <img src="{{ $seniorCitizenDetail->employeeSignature->red_signature ?? '' }}"
                        alt="{{ $seniorCitizenDetail->name_en }}" height="20" id="signature_image" />
                    <img src="{{ $seniorCitizenDetail->photo }}" alt="{{ $seniorCitizenDetail->name_en }}"
                        height="40">
                </div>

            </div>
            <div class="identity">
                <h2 class="heading">
                    जेष्ठ नागरिक परिचय पत्र
                </h2>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <p>प.प.नं: <span>{{ $seniorCitizenDetail->card_no }}</span></p>
                    <p>नाम थर: <span>{{ $seniorCitizenDetail->name }}</span></p>
                    <p>ना.प्रा.नं : <span>{{ $seniorCitizenDetail->citizenship_no }}</span></p>
                    <p>रोगको नाम : {{ $seniorCitizenDetail->disease_name }}</span></p>
                    <p>ठेगाना
                        :<span>{{ $seniorCitizenDetail->localBody->local_body ?? '' }},{{ $seniorCitizenDetail->district->district ?? '' }},{{ $seniorCitizenDetail->province->province ?? '' }}</span>
                    </p>
                    <p>पति,पत्नीको नाम :
                        <span>{{ $seniorCitizenDetail->spouse }} </span>
                    </p>
                </div>
                <div class="col-md-3">
                    <p>लिङ्ग: {{ $seniorCitizenDetail->gender->label() ?? '' }}</p>
                    <p>रक्त समूह: {{ $seniorCitizenDetail->blood_group->label() ?? '' }}</p>
                    <p>उमेर: {{ $seniorCitizenDetail->age }}</p>
                </div>
            </div>
            <table style="width: 100%;">
                <tr style="font-size: 5px;">
                    <th>
                        <span style="border-bottom: dashed 1px">
                            {{ $seniorCitizenDetail->employeeSignature->name ?? '' }}
                        </span>
                        <br>
                        नाम
                    </th>
                    <th>
                        <span>
                            <img src="{{ $seniorCitizenDetail->employeeSignature->red_signature ?? '' }}"
                                alt="" height="30" class="signature">
                        </span>
                        <br>
                        हस्ताक्षर
                    </th>
                    <th>
                        <span style="border-bottom: dashed 1px">
                            {{ $seniorCitizenDetail->employeeSignature->designation ?? '' }}</span>
                        <br>
                        पद
                    </th>
                </tr>
            </table>
            <div class="container">
                <div class="row">
                    <p class="footer-text">
                        यो परिचय पत्र कसैले पाएमा नजिकको प्रहरी कार्यालयमा वा स्थानीय निकायमा बुझाई दिनुहोला ।

                    </p>
                </div>
            </div>

            <div class="break-page"></div>
            <div class="header" style="height: 204.48px;width: 324.48px; margin-top: 5px;">
                <div class="office_header">
                    <div>
                        <img src="{{ $officeSetting->logo_url }}" alt="" height="30">
                    </div>
                    <div>
                        @foreach ($officeHeaders as $header)
                            <p
                                style="font-size: {{ $header->card_font }}rem;font-weight:{{ $header->font }};color:{{ $header->font_color }};line-height: 0.2;text-align: center;">
                                {{ $header->title_en }}</p>
                        @endforeach
                    </div>
                    <div>
                        {!! QrCode::size(45)->generate(route('seniorCitizenDetail.qrcode', $seniorCitizenDetail)) !!}
                        <img src="" alt="" height="20" id="signature_image" />
                    </div>
                </div>
                <div class="identity">
                    <h2 class="heading">
                        Senior Citizen ID Card
                    </h2>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <p>ID Card No
                            : {{ $seniorCitizenDetail->card_no }}</p>
                        <p>Full Name : {{ $seniorCitizenDetail->name_en }}</p>
                        <p>Citizenship No: {{ $seniorCitizenDetail->citizenship_no }}<span></span></p>
                        <p>Disease : <span>{{ $seniorCitizenDetail->disease_name }}</span></p>
                        <p>Address :
                            <span>
                                {{ $seniorCitizenDetail->localBody->local_body_en ?? '' }},{{ $seniorCitizenDetail->district->district_en ?? '' }},{{ $seniorCitizenDetail->province->province_en ?? '' }}</span>
                        </p>
                        <p>Husband/Wife Name :
                            <span> {{ $seniorCitizenDetail->spouse_en }}</span>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>Gender
                            : {{ $seniorCitizenDetail->gender }}</p>
                        <p>Blood Group : {{ $seniorCitizenDetail->blood_group->label() ?? '' }}
                        </p>
                        <p>Age
                            : {{ $seniorCitizenDetail->age }}</p>
                    </div>
                </div>
                <div class="row" style="margin-top: 2px;">
                    <div class="col-md-6" style="display: flex;justify-content: center;">
                        <h2></h2>
                    </div>
                    <div class="col-md-6" style="display: flex;justify-content: space-evenly;">
                        <div>
                            @foreach ($seniorCitizenDetail->fingerPrints->where('finger', 'left') as $fingerPrint)
                                <img src="{{ $fingerPrint->finger_image }}" alt="" height="20"><br>
                                <p style="margin-top: 0;">बाँया </p>
                            @endforeach
                        </div>
                        <div>
                            @foreach ($seniorCitizenDetail->fingerPrints->where('finger', 'right') as $fingerPrint)
                                <img src="{{ $fingerPrint->finger_image }}" alt="" height="20"><br>
                                <p style="margin-top: 0;">दाँया </p>
                            @endforeach
                        </div>
                    </div>
                </div>

                <table style="width: 100%;">
                    <tr style="font-size: 5px;">
                        <th>
                            <span style="border-bottom: dashed 1px">
                                {{ $seniorCitizenDetail->employeeSignature->name_en ?? '' }}</span>
                            <br>
                            Name
                        </th>
                        <th>
                            <span style="border-bottom: dashed 1px">
                                <img src="{{ $seniorCitizenDetail->employeeSignature->red_signature ?? '' }}"
                                    alt="" height="30" class="signature">
                            </span>
                            <br>
                            Signature
                        </th>
                        <th>
                            <span
                                style="border-bottom: dashed 1px">{{ $seniorCitizenDetail->employeeSignature->designation_en ?? '' }}</span>
                            <br>
                            Designation
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
