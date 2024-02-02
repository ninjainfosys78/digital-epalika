@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">दस्तुर तथा दर्ता सम्बन्धी</h4>
                        <div class="d-flex justify-content-between">
                            <button id="printButton" class="btn btn-sm btn-success"
                                    requestRoute="{{route('print.office-letter-print')}}">
                                <i class="fa fa-print"></i> Print
                            </button>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card mb_30">
                                <div class="card-body p-3">
                                    <div class="font-black" id="printData">
                                        <p class="mt-2">घरधनीको नाम, थर: <span class="underline-dotted custom-width"></span> </p>
                                        <p class="mt-2">भू-उपयोग क्षेत्र : <span class="underline-dotted custom-width"></span></p>
                                        <p class="mt-2">भू-उपयोग क्षेत्र : <span class="underline-dotted custom-width"></span></p>
                                        <p class="mt-2">निर्माणको विवरण : <span class="underline-dotted custom-width"></span></p>
                                        <p class="mt-2">निर्माणको प्रयोजन : <span class="underline-dotted custom-width"></span></p>
                                        <p class="mt-2">भवनको वर्गीकरण :

                                            <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">क&emsp;</label>
                                            <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">ख&emsp;</label>
                                            <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                            <label class="form-check-label" for="inlineRadio3">ग&emsp;</label>
                                            <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                                            <label class="form-check-label" for="inlineRadio4">घ</label>
                                       </p>
                                        <p class="mt-2">निर्माणको स्ट्रक्चरल सिस्टम : <span class="underline-dotted custom-width"></span></p>
                                        <table class="table table-bordered my-3">
                                            <thead>
                                            <tr>
                                                <th scope="col" rowspan="2">तल्लाको विवरण</th>
                                                <th scope="col" rowspan="2">प्रस्तावित निर्माणको क्षेत्रफल</th>
                                                <th colspan="2">नक्सा दस्तुर</th>
                                                <th scope="col" rowspan="2">कैफियत</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td>(वर्ग फिट/मिटर)</td>
                                                <td>दर</td>
                                                <td>रकम</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">सेमि/बेसमेन्ट १</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">सेमि/बेसमेन्ट २</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">सेमि/बेसमेन्ट ३</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">भुइँ</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">पहिलो</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">दोस्रो</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">तेस्रो</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">चौथो</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <th colspan="2">जम्मा</th>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">फारम दस्तुर</th>
                                                <td colspan="3"></td>
                                                <td rowspan="4">राजस्व उपशाखामा बुझाउने</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">निवेदक दर्ता दस्तुर</th>
                                                <td colspan="3"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">अन्य</th>
                                                <td colspan="3"> </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">कुल जम्मा</th>
                                                <td colspan="3"> </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="mt-2">अक्षरेपी<span class="underline-dotted custom-width"></span> </p>
                                        <p class="mt-2">फाटवालाको सही: <span class="underline-dotted custom-width"></span> </p>
                                        <p class="mt-2">मिति:<span class="underline-dotted custom-width"></span> रसिद नं: <span class="underline-dotted custom-width"></span> रकम बुझने: <span class="underline-dotted custom-width"></span></p>
                                        <h4 class="mt-3"><b>राजस्व शाखाको प्रयोजनको लागि</b></h4>
                                        <p class="mt-2">निवेदकको नक्सा पास दस्तुर वापत रु: <span class="underline-dotted custom-width"></span> बाट प्राप्त भयो |</p>
                                        <p class="mt-2">मिति: <span class="underline-dotted custom-width"></span> रसिद नं: <span class="underline-dotted custom-width"></span>. रकम बुझने: <span class="underline-dotted custom-width"></span></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('style')
        <style>
            .font-black p {
                color: black;
            }

            .underline-dotted {
                border-bottom: dotted 2px !important;
                padding: 0 20px;
            }

            .custom-width {
                padding: 0 80px !important;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
