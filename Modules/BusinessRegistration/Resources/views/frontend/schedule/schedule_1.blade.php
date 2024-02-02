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
                                <h5 class="text-center mt-3"><b> अनुसूची-१</b></h5>
                                <p class="mt-2"><b>निर्देशिकाको दफा ४ को उपदफा (१) सँग सम्बन्धित व्यवसाय दर्ता/नवीकरण निवेदन फारम</b></p>
                                <p>श्रीमान प्रमुख प्रशासकीय अधिकृत,<br>
                                फिदिम नगरपालिकाको कार्यालय,<br>
                                फिदिम,पाँचथर</p>
                                <p class="text-center my-1"><b>बिषय : व्यवसाय दर्ता/नवीकरण गर्न र परिचय पाटी राख्न अनुमति पाउँ । </b></p>
                                <p class="my-2">मैले/हामीले निम्न स्थानमा<span class="underline-dotted custom-width"></span>व्यवसाय दर्ता/नवीकरण
                                गर्न लागेकोले आवश्यक कागजात सहित दरखास्त दिन आएको छु/छौ । नियमानुसार लाग्ने कर, दस्तुर बुझाउनुको साथ नगरपालिका बाट समय समयमा
                                दिइने आदेश/निर्देशन समेत पालन गर्न मन्जुरी छु/छौ । साथै मैले/हामीले पेश गरेको कागजात तथा विवरणहरु ठिक साँचो रहेको र फरक परे
                                कानून बमोजिम कार्वाही भएमा मन्जुरी छु/छौ ।</p>
                                <p>१. व्यवसायीको नाम, थर :<span class="underline-dotted custom-width"></span><span class="underline-dotted custom-width"></span><br>
                                (फर्म कम्पनीको हकमा मुख्य व्यत्तिको नाम)<br>
                                २. स्थायी ठेगाना : <span class="underline-dotted custom-width"></span> जिल्ला<span class="underline-dotted custom-width"></span> न.पा.<span class="underline-dotted custom-width"></span>
                                वडा नं.<span class="underline-dotted custom-width"></span> मार्ग<span class="underline-dotted custom-width"></span> घर नं.<span class="underline-dotted custom-width"></span><br>
                                ३. बाबुको नाम, थर :<span class="underline-dotted custom-width"></span><br>
                                ४. व्यवसाय रहने स्थानको ठेगान : वडा नं.<span class="underline-dotted custom-width"></span> मार्ग<span class="underline-dotted custom-width"></span>
                                घर नं.<span class="underline-dotted custom-width"></span><br>
                                ५. सम्पर्क फोन नं.<span class="underline-dotted custom-width"></span> फ्याक्स<span class="underline-dotted custom-width"></span>
                                इमेल<span class="underline-dotted custom-width"></span><br>
                                ६. भाडामा रहेको भए व्यवसाय रहने घर र जग्गा धनीको नाम, थर :<span class="underline-dotted custom-width"></span><br>
                                ७. ठेगाना :<span class="underline-dotted custom-width"></span> वडा नं.<span class="underline-dotted custom-width"></span>
                                घर नं.<span class="underline-dotted custom-width"></span><br>
                                ८. व्यवसायको विवरण/प्रकृति :<span class="underline-dotted custom-width"></span><br>
                                ९. पूँजीगत लगानी रु. मा <span class="underline-dotted custom-width"></span><br>
                                १०. फर्म/कम्पनीको नाम :<span class="underline-dotted custom-width"></span><br>
                                ११. परिचय पाटीको साइज : (लम्बाई <span class="underline-dotted custom-width"></span> चौडाई<span class="underline-dotted custom-width"></span>
                                वर्गफिट <span class="underline-dotted custom-width"></span>)<br>
                                १२. अन्य दर्ता भएको भए, दर्ता नं.<span class="underline-dotted custom-width"></span>/कार्यालय :<span class="underline-dotted custom-width"></span><br>
                                १३.संलग्न गर्नुपर्ने कागजातहरु : आफनै घर जग्गा भए जग्गा धनी प्रमाण पत्रको प्रतिलिपि-१, भाडामा बस्ने भए भाडा रकम र भुत्तानी तरिका समेत खुलेको वहाल सम्झौतापत्र-१,
                                नागरिकको हकमा नेपालस्थित राजदुतावासबाट व्यवसायीको नाममा जारी कागजात-१, करदाताको हालसालैको पासपोर्ट साईजको फोटो २ प्रति, फर्म कम्पनी भएमा दर्ता,
                                इजाजत प्रमाणपत्र र आन्तरिक राजस्व कार्यालयमा अघिल्लो आ.व.सम्मको कर तिरेको करदाता प्रमाणपत्रको प्रतिलिपि ।</p>
                                <div class="d-flex justify-content-end mt-2">
                                    <p class="text-center"><span class="underline-dotted custom-width"></span><br>
                                        निवेदकको दरखास्त </p>
                                </div>
                                <hr class="style">
                                <h5 class="mt-2">कार्यालय प्रयोजनका लागि मात्र :-</h5>
                                <p>निवेदन दस्तुर :<span class="underline-dotted custom-width"></span> दर्ता दस्तुर <span class="underline-dotted custom-width"></span>
                                व्यवसाय कर <span class="underline-dotted custom-width"></span> परिचय पाटी दस्तुर<span class="underline-dotted custom-width"></span>
                                जरिवाना<span class="underline-dotted custom-width"></span> जम्मा <span class="underline-dotted custom-width"></span> व्यवसाय प्रमाण पत्र नं. :<span class="underline-dotted custom-width"></span>
                                मिति : <span class="underline-dotted custom-width"></span> पेश गर्ने/ठिक छ भनी पप्रमाणितगर्ने/स्वीकृत गर्ने</p>
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
