<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$seniorCitizenDetail->name??''}} </title>

    <style>

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

        p > span {
            border-bottom: 1px dotted;
        }

        .header {
            visibility: visible;
            padding: 15px;
            border: 1px solid black;
            border-radius: 8px;
        }

        .header > .office_header {
            display: flex;
            justify-content: space-between;
        }

        .identity {
            display: flex;
            justify-content: space-between;
        }

        .identity > h2 {
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

        .footer-part > div > span {
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
    <div class="header" style="height: 204.48px;width: 324.48px;">
        <div class="office_header">
            <div>
                <img src="{{$officeSetting->logo_url}}" alt="" height="30">
            </div>
            <div>
                @foreach($officeHeaders as $header)
                    <p style="font-size: {{$header->card_font}}rem;font-weight:{{$header->font}};color:{{$header->font_color}};line-height: 0.2;text-align: center;">{{$header->title}}</p>
                @endforeach
            </div>
            <div>
                <img src="{{$seniorCitizenDetail->photo}}" alt="" height="40">
                <img src="" alt="" height="20" id="signature_image"/>
            </div>

        </div>
        <div class="identity">
            <h2 class="heading">
                जेष्ठ नागरिक परिचय पत्र
            </h2>
        </div>
        <div class="row">
            <div class="col-md-9">
                <p>आईडी कार्ड नं: {{$seniorCitizenDetail->card_no}}<span></span></p>
                <p>व्यक्तिको पुरा नाम: <span>{{$seniorCitizenDetail->name}}</span></p>
                <p>नागरिकता नं : <span>{{$seniorCitizenDetail->citizenship_no}}</span></p>
                <p>रोग : <span>{{$seniorCitizenDetail->is_disease==1 ? 'छ':'छैन'}}</span></p>
                <p>ठेगाना :<span>{{$seniorCitizenDetail->localBody->local_body??''}},{{$seniorCitizenDetail->district->district??''}},{{$seniorCitizenDetail->province->province??''}}</span>
                </p>
                <p>पति,पत्नीको नाम :
                    <span>{{$seniorCitizenDetail->spouse}} </span>
                </p>
            </div>
            <div class="col-md-3">
                <p>लिङ्ग: {{$seniorCitizenDetail->gender->label()??''}}</p>
                <p>रक्त समूह: {{$seniorCitizenDetail->blood_group->label()??''}}</p>
                <p>उमेर: {{$seniorCitizenDetail->age}}</p>
            </div>
        </div>
        <table style="width: 100%;">
            <tr style="font-size: 10px;">
                <th>
                    <span style="border-bottom: dashed 1px"></span>
                    <br>
                    नाम
                </th>
                <th>
                    <span style="border-bottom: dashed 1px"></span>
                    <br>
                    हस्ताक्षर
                </th>
                <th>
                    <span style="border-bottom: dashed 1px"></span>
                    <br>
                    पद
                </th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
