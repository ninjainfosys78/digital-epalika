@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb_30">
                <div class="card-header p-3">
                    <div class="main-title d-flex justify-content-between">
                        <h3> </h3>
                        <div class="d-flex justify-content-end">
                            <button id="printButton" class="btn btn-sm btn-success" printElementId='printData'
                                    requestRoute="{{route('print.application-print')}}">
                                <i class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card mb_30">
                        <div class="card-body p-3">
                            <div class="font-black" id="printData">
                                <h5 class="text-center mt-3"><b> अनुसूची-२</b></h5>
                                <p class="mt-2 text-center"><b>निर्देशिकाको दफा ४ को उपदफा (१) सँग सम्बन्धित व्यवसाय दर्ता</b></p>
                                <p class="text-center">फिदिम नगरपालिका<br>
                                    नगर कार्यपालिकाको कार्यालय<br>
                                    व्यवसाय कर दर्ता किताब</p>
                                <p>करदाता प्रमाणपत्र नं. :
                                <br>जारी भएको मिति :</p>
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th width="35%" scope="col">व्यवसायको विवरण</th>
                                        <th width="35%" scope="col">परिचयपाटी विवरण</th>
                                        <th width="35%" scope="col">व्यवसायीको विवरण</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>१) व्यवसायको प्रकृति :</td>
                                        <td>१) फर्म/कं. को नाम :</td>
                                        <td>१) नाम, थर :</td>
                                    </tr>
                                    <tr>
                                        <td>२) व्यवसायको किसिम :</td>
                                        <td>२) साइज :</td>
                                        <td>२) नागरिकता नं:</td>
                                    </tr>
                                    <tr>
                                        <td>३) रहने स्थान/ठेगाना:<br>
                                            वडा नं.: घर नं.: बाटोको नाम:</td>
                                        <td>३) किसिम: जारी भेय्को जिल्ला :</td>
                                        <td>३) ठेगाना: थायी:<br>
                                        अस्थायी :</td>
                                    </tr>
                                    <tr>
                                        <td>४) अन्य :</td>
                                        <td>४) घर धनीको नाम  :</td>
                                        <td>४) बाबुको नाम :</td>
                                    </tr>
                                    <tr>
                                        <td>५) बजेको नाम :</td>
                                    </tr>
                                    <tr>
                                        <td>६) सम्पर्क फोन नं. :</td>
                                    </tr>
                                    <tr>
                                        <td>७) अन्य :</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">असुली</th>
                                        <th scope="col">आ.व</th>
                                        <th scope="col">मिति</th>
                                        <th scope="col">निवेदन<br>
                                        दस्तुर</th>
                                        <th scope="col">दर्ता<br>
                                        शुल्क</th>
                                        <th scope="col">चालु <br>
                                        आ.व.को<br>
                                        व्यवसाय<br>
                                        कर रु.</th>
                                        <th scope="col">परिचय
                                        <br>पाटी</th>
                                        <th scope="col">वक्यौता</th>
                                        <th scope="col">जरिवाना</th>
                                        <th scope="col">जम्मा<br>रकम</th>
                                        <th scope="col">रसिद<br>नं.</th>
                                        <th scope="col">प्रमणित<br>गर्नेको<br>सही</th>
                                        <th scope="col">कैफियत</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
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
                padding: 0 50px !important;
            }
            hr.style {
                background-color: #fff;
                border-top: 2px dashed #8c8b8b;
            }

        </style>
    @endpush
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
