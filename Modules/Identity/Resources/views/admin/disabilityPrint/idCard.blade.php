<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            border-radius: 5px;
        }

        .dynamic-content {
            display: inline-block;
            background-color: white;
            width: 100%;
            color: black !important;
            padding: 2px;
            font-size: 12px;
        }

        .d-flex {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .items-between {
            justify-content: space-between;
        }

        .fs16 {
            font-size: 12px;
            white-space: nowrap;
            font-weight: 600;
        }

        .card-background {
            border-radius: 5px;
            background-color: {{$disabilityIdentityCard->governmentalDisabilityType?->category->backgroundColor()??'white'}};
            color: {{$disabilityIdentityCard->governmentalDisabilityType?->category->color()??'black'}};
            padding: 10px;
            border: 0.5px solid;
        }

        @media print {
            @page {
                size: A4 landscape;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
<div style="margin: 10% 20%;">
    <div class="card-background">
        <table class="id-card-header" style="width: 100%; border: none;">
            <tr>
                <td rowspan="4" style="width: 5%">
                    <img src="{{officeSetting()->logo_url}}"
                         alt="" width="50"/>

                </td>

                <td style="
                      text-align: center;
                      padding: 0 !important;
                      width: 90%;
                    ">
                    <span
                        style="font-weight: {{get_office_header()->first()->font??'normal'}}; font-size: {{get_office_header()->first()->card_font??1}}rem">{{get_office_header()->first()->title??''}}</span>
                </td>
                <td style="width: 5%;visibility: hidden">.</td>
            </tr>
            @foreach(get_office_header()->skip(1) as $header)
                <tr>
                    <td style="
                      text-align: center;
                      padding: 0 !important;
                      line-height: 0.8;
                    ">
                        <span style="font-size: {{$header->card_font}}rem; font-weight: {{$header->font}}">
                           {{$header->title}}
                        </span>
                    </td>
                </tr>
            @endforeach

        </table>
        <div class="d-flex items-between">
            <table class="id-card-header-01" style="width: 50%; border: none;">
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="fs16">
                                परिचयपत्र नं.:
                            </div>
                            <div class="dynamic-content">{{get_nepali_number($disabilityIdentityCard->card_no)}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="fs16">
                                परिचयपत्रको प्रकार :
                            </div>
                            <div
                                class="dynamic-content">
                                ({{$disabilityIdentityCard->governmentalDisabilityType?->category->label()??''}})
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <span style=" display: flex;flex-direction: column;">
                 <span style=" display: inline-block;
                 border: 1px solid;
  width: 55px;
  height: 42px;
  padding: 5px;
  background-color: white;
    text-align: center;">
                     <img src="{{$disabilityIdentityCard->photo_url}}"
                          alt="तस्विर" width="40" height="37" style=" max-width: 100%;
  max-height: 100%;
  display: inline-block;
  color: black;
  vertical-align: middle;

  "/>
                </span>
            <span class="fs16"
                  style="display: inline-block">{{get_nepali_count($disabilityIdentityCard->print_count)}}</span>
            </span>

        </div>
        <table style="width: 100%; border: none; text-align: center;">
            <tr>
                <td style="padding: 0 !important">

                    <span style="font-weight: 600; font-size: 16px">अपांगता परिचय पत्र</span>
                </td>
            </tr>

        </table>
        <table class="id-card-header" style="width: 100%; border: none;">
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            नाम, थर :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->name}}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            ठेगाना :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->province->province??''}},
                            {{$disabilityIdentityCard->district->district??''}},
                            {{$disabilityIdentityCard->localBody->local_body??''}},
                            {{get_nepali_number($disabilityIdentityCard->ward_no)??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            जन्म मिति :
                        </div>
                        <div class="dynamic-content">{{get_nepali_number($disabilityIdentityCard->dob)??''}}
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            नागरिकता नं.:
                        </div>
                        <div class="dynamic-content">{{get_nepali_number($disabilityIdentityCard->citizenship_no)??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            लिङ्ग :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->gender?->label()??''}}
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            रक्त समुह :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->blood_group?->label()??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            अपांगताको किसिम : प्रकृतिको आधारमा :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->disabilityType->title??''}}
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            गम्भीरता :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->governmentalDisabilityType->title??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            बाबु/आमा वा संरक्षकको नाम थर :
                        </div>
                        <div class="dynamic-content">
                            {{$disabilityIdentityCard->father_name??''}}/
                            {{$disabilityIdentityCard->mother_name??''}}/
                            {{$disabilityIdentityCard->guardian_name??''}}
                        </div>
                    </div>
                </td>

            </tr>
        </table>
        <table class="id-card-header" style="width: 100%; border: none;">
            <tr>
                <td style=" padding: 0 !important">

                    <div class="d-flex">
                        <div class="fs16">
                            परिचयपत्र वाहकको दस्तखत :
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            परिचयपत्र प्रमाणित गर्ने:
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="4" style="background: white;"></td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            हस्ताक्षर
                        </div>
                        <div class="dynamic-content">
                            <img src="{{$disabilityIdentityCard->employeeSignature->red_signature}}"
                          alt="तस्विर" width="40" height="37" style=" max-width: 100%;">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            नाम, थर :
                        </div>

                        <div class="dynamic-content">
                             {{$disabilityIdentityCard->employeeSignature->name??''}}
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            पद :
                        </div>
                        <div class="dynamic-content">
                            {{$disabilityIdentityCard->employeeSignature->designation ??''}}
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            मिति:
                        </div>

                        <div class="dynamic-content">
                            {{ get_nepali_number($date) }}
                        </div>
                    </div>
                </td>
            </tr>

        </table>
        <div style="
                  text-align: center;
                  line-height: 0.8;
                  padding: 1px;
                ">
                <span style="font-size: 10px; font-weight: bold">
                    यो परिचय पत्र कसैले पाएमा नजिकको प्रहरी कार्यालयमा वा स्थानीय निकायमा बुझाई दिनुहोला ।

                </span>
        </div>
    </div>
    <div class="page-break"></div>

    <div class="card-background">
        <table class="id-card-header" style="width: 100%; border: none;">
            <tr>
                <td rowspan="4" style="width: 5%">
                    <img src="{{officeSetting()->logo_url}}"
                         alt="" width="50"/>

                </td>

                <td style="
                      text-align: center;
                      padding: 0 !important;
                      width: 90%;
                    ">
                    <span
                        style="font-weight: {{get_office_header()->first()->font??'normal'}}; font-size: {{get_office_header()->first()->card_font??1}}rem">{{get_office_header()->first()->title_en??''}}</span>
                </td>
                <td style="width: 5%;visibility: hidden">.</td>
            </tr>
            @foreach(get_office_header()->skip(1) as $header)
                <tr>
                    <td style="
                      text-align: center;
                      padding: 0 !important;
                      line-height: 0.8;
                    ">
                        <span style="font-size: {{$header->card_font}}rem; font-weight: {{$header->font}}">
                           {{$header->title_en}}
                        </span>
                    </td>
                </tr>
            @endforeach

        </table>
        <div class="d-flex items-between">
            <table class="id-card-header-01" style="width: 50%; border: none;">
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="fs16">
                                ID Card No.:
                            </div>
                            <div class="dynamic-content">{{get_english_number($disabilityIdentityCard->card_no)}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="fs16">
                                ID Card Type :
                            </div>
                            <div
                                class="dynamic-content">
                                ({{$disabilityIdentityCard->governmentalDisabilityType?->category->labelEn()??''}})
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <span style=" display: flex;flex-direction: column;">
                <span style=" display: inline-block;
  width: 55px;
  height: 42px;
  padding: 5px;
  background-color: white;
    text-align: center;
     border: 1px solid;
    ">
                     <img src="{{$disabilityIdentityCard->photo_url}}"
                          alt="Photo" width="40" height="37" style=" max-width: 100%;
  max-height: 100%;
  display: inline-block;
  color: black;
  vertical-align: middle;"/>
                </span>
            <span class="fs16"
                  style="display: inline-block">{{get_nepali_count($disabilityIdentityCard->print_count,'en')}}</span>
            </span>

        </div>
        <table style="width: 100%; border: none; text-align: center;">
            <tr>

                <td style="padding: 0 !important">
                    <span style="font-weight: 600; font-size: 16px">Disability Identity Card</span>
                </td>
            </tr>
        </table>
        <table class="id-card-header" style="width: 100%; border: none;">
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Full Name Of Person :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->name_en}}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Address :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->province->province_en??''}},
                            {{$disabilityIdentityCard->district->district_en??''}},
                            {{$disabilityIdentityCard->localBody->local_body_en??''}},
                            {{get_english_number($disabilityIdentityCard->ward_no)??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Date of Birth :
                        </div>
                        <div class="dynamic-content">{{get_english_number($disabilityIdentityCard->dob)??''}}
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Citizenship No.:
                        </div>
                        <div class="dynamic-content">{{get_english_number($disabilityIdentityCard->citizenship_no)??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Sex :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->gender?->labelEn()??''}}
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Blood Group :
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->blood_group?->labelEn()??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Disability Type: By Nature:
                        </div>
                        <div class="dynamic-content">{{$disabilityIdentityCard->disabilityType->title_en??''}}
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            By Severity:
                        </div>
                        <div
                            class="dynamic-content">{{$disabilityIdentityCard->governmentalDisabilityType->title_en??''}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Father/Mother Name or Guardian :
                        </div>
                        <div class="dynamic-content">
                            {{$disabilityIdentityCard->father_name_en??''}}/
                            {{$disabilityIdentityCard->mother_name_en??''}}/
                            {{$disabilityIdentityCard->guardian_name_en??''}}
                        </div>
                    </div>
                </td>

            </tr>
        </table>
        <table class="id-card-header" style="width: 100%; border: none;">
            <tr>
                <td style=" padding: 0 !important">

                    <div class="d-flex">
                        <div class="fs16">
                            Signature of ID Card Holders:
                        </div>
                    </div>
                </td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Approved By:
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="4" style="background: white;"></td>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Signature:
                        </div>
                        <div class="dynamic-content">
                            <img src="{{$disabilityIdentityCard->employeeSignature->red_signature}}"
                            alt="तस्विर" width="40" height="37" style=" max-width: 100%;">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Name:
                        </div>
                        <div class="dynamic-content" >
                            {{$disabilityIdentityCard->employeeSignature->name_en ??''}}
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Designation:
                        </div>
                        <div class="dynamic-content">
                            {{$disabilityIdentityCard->employeeSignature->designation_en ??''}}
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td style=" padding: 0 !important">
                    <div class="d-flex">
                        <div class="fs16">
                            Date :
                        </div>
                        <div class="dynamic-content">{{$date}}
                        </div>
                    </div>
                </td>
            </tr>

        </table>
        <div style="
                  text-align: center;
                  line-height: 0.8;
                  padding: 1px;
                ">
                <span style="font-size: 10px; font-weight: bold">
                   "If somebody finds this ID card, please deposit this in the nearby Police Station or Municipality Office."
                </span>
        </div>
    </div>
</div>
</body>
</html>
