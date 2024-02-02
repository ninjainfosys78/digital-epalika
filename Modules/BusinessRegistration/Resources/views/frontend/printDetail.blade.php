<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/icons.min.css')}}">
    <title>{{$businessDetail->name}}को व्यवसाय दर्ता आवेदन</title>

</head>
<body class="container bg-white">
<section class="row justify-content-center my-4 ">
    <div class="card col-md-8 border">
        <div class="card-body">
            <p class="text-danger">नोट: आवेदन अनिवार्य प्रिन्ट गरि कार्यालयमा हाजिर हुनुहोला</p>
            <x-print-button
                target-element="printData"
                title="{{$businessDetail->name}}"

            />
            <div id="printData">
                <p>
                    श्रीमान प्रमुख प्रशासकीय अधिकृत ज्यु, <br>
                    {{$officeSetting->localBody->local_body??''}} <br>
                    नगर कार्यपालिकाको कार्यालय <br>
                    {{$officeSetting->district->district??''}}
                </p>
                <p class="text-center">बिषय : व्यवसाय दर्ता / नवीकरण सम्बन्धमा </p>
                <p>
                    मैले/हामीले निमन् स्थानमा व्यवसाय दर्ता/नविकरण गर्न लागेकोले आवश्यक कागजात सहित दरखास्त गर्न
                    आएका छु/र्छौं नियमानुसार लागने कर बुझाउनुको साथै नगरपालिकाबाट समय-समयमा दिइने आदेश/निर्देशन समेत
                    पालन गर्न
                    मन्जुर छु/र्छौं । साथै मैले/हामीले पेश गरेको कागजात तथा बिवरणहरु ठिक साँचो रहेको र फरक परे कानून
                    बमोजिम
                    कार्वाही भएमा मञ्जुर छु/र्छौं ।
                </p>

                <p> १. व्यवसायीको नाम,थर : <span
                        class="dashed-bottom">{{$businessDetail->partners->first()?->name??''}}</span></p>
                <p> २. स्थायी ठेगाना : <span
                        class="dashed-bottom">{{$businessDetail->partners->first()?->district->district??''}}</span>
                    जिल्ला
                    <span
                        class="dashed-bottom">{{$businessDetail->partners->first()?->localBody->local_body??''}}</span>
                    गा . पा. / न.
                    पा.
                    वडा नं <span class="dashed-bottom">{{$businessDetail->partners->first()?->ward_no??''}}</span>
                    <span class="dashed-bottom">{{$businessDetail->partners->first()?->way??''}}</span> मार्ग घर नं.
                    <span class="dashed-bottom">{{$businessDetail->partners->first()?->house_no??''}}</span>
                </p>
                <p> ३. बाबुको नाम, थर : <span
                        class="dashed-bottom">{{$businessDetail->partners->first()?->father_name??''}}</span></p>
                <p>४ . व्यवसायको नाम : <span class="dashed-bottom">{{$businessDetail->name??''}}</span></p>
                <p> ५. व्यवसाय रहने स्थानको ठेगाना : <span
                        class="dashed-bottom">{{$businessDetail->district->district??''}}</span> जिल्ला
                    <span class="dashed-bottom">{{$businessDetail->localBody->local_body??''}}</span> गा . पा. / न. पा.
                    वडा नं <span class="dashed-bottom">{{$businessDetail->ward_no??''}}</span> <span
                        class="dashed-bottom">{{$businessDetail->way??''}}</span>
                    मार्ग</p>

                <p> ६. सम्पर्क फोन नं : <span
                        class="dashed-bottom">{{$businessDetail->partners->first()?->phone??''}}</span> ईमेल :
                    <span class="dashed-bottom">{{$businessDetail->partners->first()?->email??''}}</span></p>

                <p> ७. भाडामा भएको भए व्यवसाय रहने घर र जग्गा धनीको नाम, थर :
                    <span class="dashed-bottom">{{$businessDetail->house_owner_name}}</span></p>
                <p>८. ठेगाना : <span class="dashed-bottom">{{$businessDetail->house_owner_address}}</span></p>
                <p> ९. व्यवसायको विवरण/प्रकृति : <span
                        class="dashed-bottom">{{$businessDetail->businessNature->title??''}}</span></p>
                <p>१०. पुजीगत लगानी रु : <span class="dashed-bottom">{{$businessDetail->investment}}</span></p>
                <p> ११. परिचय पाटीको साइज : <span class="dashed-bottom">{{$businessDetail->length}}</span> *
                    <span class="dashed-bottom">{{$businessDetail->width}}</span> Sq.ft</p>
                <p> १२. अन्यत्र दर्ता भएको भए, दर्ता नं. :
                    <span
                        class="dashed-bottom">{{$businessDetail->registeredBusinesses->first()?->registration_no??''}}</span>
                </p>

                <h4 class="font-weight-bold"> संलगन गर्नुपर्ने कागजातहरु</h4>
                <ul>
                    <li>आफनै घर जग्गा भए जग्गा धनि प्रमाणपत्रको प्रतिलिपि</li>
                    <li>भाडामा बास्ने भए भाडा रकम र भुक्तानी तरिका समेत खुलेको वहान सम्झौतापत्र</li>
                    <li> नागरिकताको प्रतिलिपि</li>
                    <li> वडा सिफारिस</li>
                    <li>बिदेशी नागरिकको हकमा नेपालस्थित राजदुतावासबाट व्यवासायीको नाममा जारी कागजात</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('assets/backend/print/print.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>
</html>
