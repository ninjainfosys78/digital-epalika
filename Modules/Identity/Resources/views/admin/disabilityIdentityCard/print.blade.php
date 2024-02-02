<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$disabilityIdentityCard->name??''}} </title>

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
        body{
            visibility: hidden;
        }
        .col-md-3 {
            float: left;
            width: 25%;
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
            background-color: {{$disabilityIdentityCard->governmentalDisabilityType->color??''}};
            border: 1px solid black;
            border-radius: 8px;
        }
        .header > .office_header{
            display: flex; justify-content:space-between;
        }

        .identity{
            display: flex; justify-content:space-between;
        }

        .identity > h2{
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
        .middle-part{
            display: flex;justify-content: space-between;margin-bottom: 0;
        }

        .footer-part{
            font-size: 10px;
        }

        .footer-part > div >span{
            border-bottom: 1px dotted;
            font-size: 8px !important;
        }

#signature_image{
    z-index: 5;
    margin-left: -60px;
    transform: rotate(-10deg);
}
.signature{
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
            margin: 0;
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
                    <p style="font-size: {{$header->card_font}}rem;font-weight:{{$header->font}};color:{{$disabilityIdentityCard->governmentalDisabilityType->header_color??''}};line-height: 0.2;text-align: center;">{{$header->title}}</p>
                @endforeach
            </div>
            <div>
                <img src="{{$disabilityIdentityCard->photo_url}}" alt="{{$disabilityIdentityCard->name_en}}" height="40">
                <img src="{{$disabilityIdentityCard->employeeSignature->red_signature??''}}" alt="" height="20" id="signature_image" />
            </div>

        </div>
        <div class="identity">
            <h2 class="heading">अपांगता परिचय पत्र</h2>
        </div>
        <div style="display: flex;justify-content: space-between;margin: 0;">
            <p>परिचय पत्रको प्रकार:{{$disabilityIdentityCard->governmentalDisabilityType?->category->label()??''}}</p>
            <p>{{$disabilityPrint->title}}</p>
        </div>

        <p>प. प. नं.: {{$disabilityIdentityCard->card_no}}</p>
        <div>
            <p>नाम थर : <span>{{$disabilityIdentityCard->name ??''}}</span></p>
            <p>ठेगाना :
                <span>{{$disabilityIdentityCard->permanentProvince->province??''}}</span>
                <span>{{$disabilityIdentityCard->permanentDistrict->district??''}}</span>
                <span>{{$disabilityIdentityCard->permanentLocalBody->local_body??''}} </span>
            </p>
            <p>लिङ्ग :<span> {{$disabilityIdentityCard->gender->label() ??''}}</span></p>
            <p>अपांगता प्रकृतिको आधारमा : <span> {{$disabilityIdentityCard->disabilityType->title??''}}</span>
            </p>
            <p>गम्भीरता :
                <span> {{$disabilityIdentityCard->governmentalDisabilityType->title??''}}</span>
            </p>
            <p>बाबु आमा वा संरक्षकको नाम थर : <span> {{$disabilityIdentityCard->father_name??''}}</span></p>
            <p>परिचय पत्र प्रमाणित गर्ने : <span> </span></p>

            <div class="footer-part">
                <div class="col-md-3" >
                    <span>
                        {{$disabilityIdentityCard->employeeSignature->name??''}}
                    </span><br>
                    <p>नाम</p></div>
                <div class="col-md-3" >
                    <span>
                        <img src="{{$disabilityIdentityCard->employeeSignature->red_signature??''}}"
                             alt="{{$disabilityIdentityCard->name??''}}" height="20" class="signature">
                    </span><br>
                    <p>हस्ताक्षर</p></div>
                <div class="col-md-3" >
                    <span>
                        {{$disabilityIdentityCard->employeeSignature->designation??''}}
                    </span><br>
                    <p>पद</p></div>
                <div class="col-md-3" >
                    <span>
                        {{$todayDate}}
                    </span><br>
                    <p>जारि मिति</p></div>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <p class="footer-text">
                    यो परिचय पत्र कसैले पाएमा नजिकको प्रहरी कार्यालयमा वा स्थानीय निकायमा बुझाई दिनुहोला ।
                </p>
            </div>
        </div>
    </div>
    <div class="break-page"></div>
    <div class="header" style="height: 204.48px;width: 324.48px; margin-top: 5px;">
        <div class="office_header">
            <div>
                <img src="{{$officeSetting->logo_url}}" alt="" height="30">
            </div>
            <div>
                @foreach($officeHeaders as $header)
                    <p style="font-size: {{$header->card_font}}rem;font-weight:{{$header->font}};color:{{$disabilityIdentityCard->governmentalDisabilityType->header_color??''}};line-height: 0.2;text-align: center;">{{$header->title_en}}</p>
                @endforeach
            </div>
            <div>
            </div>
        </div>
        <div class="identity">
            <h2 class="heading">Disability Identity Card</h2>
        </div>
        <p>ID Card Type: {{$disabilityIdentityCard->governmentalDisabilityType?->category??''}}</p>
        <p>Card No.: {{$disabilityIdentityCard->card_no}}</p>
        <div>
            <p>Name of card holder: <span>{{$disabilityIdentityCard->name_en ??''}}</span></p>
            <p>Address :
                <span>{{$disabilityIdentityCard->permanentProvince->province_en??''}}</span>
                <span>{{$disabilityIdentityCard->permanentDistrict->district_en??''}}</span>
                <span>{{$disabilityIdentityCard->permanentLocalBody->local_body_en??''}} </span>
            </p>
            <p style="margin-bottom: 0;">Gender : <span> {{$disabilityIdentityCard->gender ??''}}</span></p>


            <div class="middle-part">
                <div>
                    <p style="margin-bottom: 0;">Disability On the basis of nature :
                        <span> {{$disabilityIdentityCard->disabilityType->title_en??''}}</span>
                    </p>
                    <p style="margin-bottom: 0;">On the basis of severity :
                        <span> {{$disabilityIdentityCard->governmentalDisabilityType->title_en??''}}</span>
                    </p>
                </div>
                <div style="display:flex;justify-content: space-between;margin-bottom: 0;">
                    <div>
                        @foreach($disabilityIdentityCard->fingerPrints->where('finger','left') as $fingerPrint)
                            <img src="{{$fingerPrint->finger_image}}" alt="" height="20"><br>
                        <p style="margin-top: 0;">बाँया </p>
                        @endforeach
                    </div>
                    <div>
                        @foreach($disabilityIdentityCard->fingerPrints->where('finger','right') as $fingerPrint)
                            <img src="{{$fingerPrint->finger_image}}" alt="" height="20"><br>
                            <p style="margin-top: 0;">दाँया </p>
                        @endforeach
                    </div>
                </div>
            </div>
            <p style="margin-top: 0;">Father/Mother/Guardian : <span> {{$disabilityIdentityCard->father_name_en??''}}</span></p>
            <p>ID Card Approved By : <span> </span></p>

            <div class="footer-part">
                <div class="col-md-3" >
                    <span>
                        {{$disabilityIdentityCard->employeeSignature->name_en??''}}
                    </span><br>
                    <p>Name</p>
                </div>
                <div class="col-md-3" >
                     <span >
                        <img src="{{$disabilityIdentityCard->employeeSignature->red_signature??''}}"
                             alt="{{$disabilityIdentityCard->name??''}}" height="20" class="signature">

                    </span><br>
                    <p>Signature</p>
                </div>
                <div class="col-md-3" >
                     <span >
                        {{$disabilityIdentityCard->employeeSignature->designation_en??''}}
                    </span><br>
                    <p>Designation</p></div>
                <div class="col-md-3" >
                    <span >
                        {{today()->toDateString()}}
                    </span><br>
                    <p>Issue Date</p></div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
