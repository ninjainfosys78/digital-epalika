<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/emap/admin/css/bootstrap1.min.css') }}" />
    <title>व्यवसाय दर्ता</title>
</head>

<body>
    <button id="printButton" class="btn btn-sm btn-success mx-2" printElementId='printData'
        requestRoute="{{ route('print.business-registration-print') }}" title="Print Application">
        <i class="fa fa-print"></i> print
    </button>
    <section id="printData">

        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a href="https://palikaerp.palikaerp.com" class="main-logo">
                    <img alt="nepal-government-logo" class="m-2" height="120" width="140"
                        src="{{ asset('images/np.png') }}">
                </a>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="row mt-3">
                    <div class="text-center">
                        <x-header-component />
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-2">
                {!! QrCode::generate($proprietorDetail->businessDetail->submission_no ?? '') !!}
            </div>

            <div class="col-lg-12">
                <div class=" row font-black">
                    <div class="col-md-12 d-flex justify-content-between">
                        <div>
                            <p>
                                {{ config('applicationDetail.to_office.to') }}
                                <br>
                                {{ config('applicationDetail.to_office.office_name') }}
                                <br>
                                {{ config('applicationDetail.to_office.office') }}
                                <br>
                                {{ config('applicationDetail.to_office.office_address') }}
                            </p>
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>सम्बिसन नम्बर</th>
                                    <th>
                                        {{ $proprietorDetail->businessDetail->submission_no ?? '' }}
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <p class="text-center my-3" style="text-align: center;"><b> विषय:- व्यवसाय दर्ता/सम्बन्धमा ।</b>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p class="mb-3">
                            मैले/हामीले निम्न स्थानमा सञ्चालन गर्न लागेको व्यवसाय दर्ता गर्न/सञ्चालन
                            गरेको व्यबसाय नवीकरण गर्न आवश्यक कागजात सहित दरखास्त गर्न आएका छु/छौं ।
                            नियमानुसार लाग्ने कर बुझाउनुको
                            साथै {{ config('applicationDetail.office_type') }}बाट समय–समयमा दिइने
                            आदेश/निर्देशन समेत पालन गर्न मञ्जुर छु/छौं । साथै मैले/हामीले पेश गरेको
                            कागजात तथा विवरणहरु ठीक साँचो रहेको र फरक परे कानून बमोजिम कार्वाही भएमा
                            मञ्जुर छु/छौं ।
                        </p>
                    </div>


                    <div class="col-md-12">
                        <p>व्यवसायीको नाम, थर : <span class="underline-dotted">{{ $proprietorDetail->name }}</span></p>

                    </div>
                    <div class="col-md-3">
                        <p>व्यबसायीको स्थायी
                            ठेगाना : <span class="underline-dotted">{{ $proprietorDetail->province->province ?? '' }},
                                {{ $proprietorDetail->district->district ?? '' }} जिल्ला </span>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p> नगरपालिका : <span
                                class="underline-dotted">{{ $proprietorDetail->localBody->local_body ?? '' }}</span></p>
                    </div>
                    <div class="col-md-3">
                        <p> वडा नं. : <span class="underline-dotted">{{ $proprietorDetail->ward_no }}</span></p>
                    </div>
                    <div class="col-md-3">
                        <p>मार्ग : <span class="underline-dotted"> {{ $proprietorDetail->way }} </span></p>
                    </div>
                    <div class="col-md-12">
                        <p>टोल : <span class="underline-dotted"> {{ $proprietorDetail->tole }} </span></p>
                    </div>

                    @if ($proprietorDetail->threeGenerationDetails->count() > 0)
                        <div class="col-md-12">
                            <p class="text-center my-3" style="text-align: center;"><b>तिन पुस्ते बिवरण</b></p>
                            <div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>नाता</th>
                                        <th> नाम, थर</th>
                                        <th>नाम, थर( अंग्रेजीमा)</th>
                                        <th>नागरिकता न</th>
                                        <th>सम्पर्क न</th>
                                    </tr>
                                    @foreach ($proprietorDetail->threeGenerationDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->relation }}</td>
                                            <td>{{ $detail->name }}</td>
                                            <td>{{ $detail->name_en }}</td>
                                            <td>{{ $detail->citizenship_no }}</td>
                                            <td>{{ $detail->mobile_no }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    @endif

                    <div class="col-md-12 break-page">
                        <p> व्यवसाय रहने स्थानको
                            ठेगाना : <span
                                class="underline-dotted">{{ $proprietorDetail->businessDetail->province->province ?? '' }}
                                , {{ $proprietorDetail->businessDetail->district->district ?? '' }} जिल्ला</span>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p> नगरपालिका : <span class="underline-dotted">
                                {{ $proprietorDetail->businessDetail->localBody->local_body ?? '' }}</span>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p> वडा नं. : <span
                                class="underline-dotted">{{ $proprietorDetail->businessDetail->ward_no ?? '' }}</span>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>मार्ग : <span class="underline-dotted"> {{ $proprietorDetail->businessDetail->ward_no ?? '' }}
                            </span></p>
                    </div>

                    <div class="col-md-3">
                        <p>घर नं. : <span class="underline-dotted">{{ $proprietorDetail->house_no }}</span></p>
                    </div>
                    <div class="col-md-3">
                        <p>मोबाइल : <span class="underline-dotted">{{ $proprietorDetail->phone }}</span></p>
                    </div>
                    <div class="col-md-3">
                        <p>इमेल : <span class="underline-dotted">{{ $proprietorDetail->email }}</span></p>
                    </div>
                    @if ($proprietorDetail->businessDetail->is_rent == 1)
                        <div class="col-md-12">

                            <p class="text-center my-3" style="text-align: center;"><b>भाडामा भएको व्यवसाय
                                </b></p>
                        </div>
                        <div class="col-md-3">
                            <p> घर जग्गा धनीको नाम, थर:
                                <span
                                    class="underline-dotted">{{ $proprietorDetail->businessDetail->house_owner_name ?? '' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p>घर जग्गा धनीको
                                ठेगाना: <span
                                    class="underline-dotted">{{ $proprietorDetail->businessDetail->house_owner_address ?? '' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p>घर जग्गा धनीको
                                मोबाइल.: <span
                                    class="underline-dotted">{{ $proprietorDetail->businessDetail->house_owner_phone ?? '' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p> घर जग्गा धनीको मासिक भाडा
                                रु.: <span
                                    class="underline-dotted">{{ $proprietorDetail->businessDetail->house_owner_monthly_rent ?? '' }}
                                </span>
                            </p>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <p>व्यवसायको विवरण/प्रकृति : <span
                                class="underline-dotted">{{ $proprietorDetail->businessDetail->business_nature->label() ?? '' }}</span>
                        </p>
                    </div>
                    @if ($proprietorDetail->businessDetail->business_nature->value === 'partnership')
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>साझेदार सँगको नाता</th>
                                    <th> साझेदार को नाम थर</th>
                                    <th>नागरिकता न</th>
                                    <th>सम्पर्क न</th>
                                </tr>
                                @foreach ($proprietorDetail->businessDetail->partnerDetails as $partner)
                                    <tr>
                                        <td>{{ $partner->relation }}</td>
                                        <td>{{ $partner->name }}</td>
                                        <td>{{ $partner->citizenship_no }}</td>
                                        <td>{{ $partner->mobile_no }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif

                    <div class="col-md-3">
                        <p>पूँजी लगानी रु. : <span
                                class="underline-dotted">{{ $proprietorDetail->businessDetail->amount_cost ?? '' }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>फर्म-कम्पनीको नाम : <span
                                class="underline-dotted">{{ $proprietorDetail->businessDetail->business_detail_name ?? '' }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>परिचय पाटीको साइज: (लम्बाई <span
                                class="underline-dotted">{{ $proprietorDetail->introboard->length ?? '' }}</span>
                            चौडाई <span
                                class="underline-dotted">{{ $proprietorDetail->introboard->width ?? '' }}</span>वर्गफिट
                            <span class="underline-dotted">{{ $proprietorDetail->introboard->square ?? '' }}</span>)
                        </p>
                    </div>


                    @if ($proprietorDetail->businessDetail->is_registered == 1)
                        <div class="col-md-12">
                            <p class="text-center my-3" style="text-align: center;"><b>अन्यत्र दर्ता भएको दर्ता नं </b>
                            </p>
                            <div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>दर्ता नम्बर</th>
                                        <th>व्यवसायको नाम</th>
                                        <th> दर्ता मिति</th>
                                        <th>सक्रिय</th>
                                    </tr>
                                    @foreach ($proprietorDetail->businessDetail->registeredBusinesses as $register)
                                        <tr>
                                            <td>{{ $register->registration_no }}</td>
                                            <td>{{ $register->business_name }}</td>
                                            <td>{{ $register->registration_date }}</td>
                                            <td>{{ $register->active == '1' ? 'छ' : 'छैन' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    @endif

                    <div class="col-md-12">
                        <p class="text-center my-3" style="text-align: center; margin-top: 10px;"><b>संलग्न
                                कागजातहरु</b>
                        </p>
                    </div>

                    <div class="col-md-12">
                        क)व्यवसायीको पासपोर्ट साइजको फोटो*
                        <i class="{{ !empty($proprietorDetail->businessRegisteredFile->photo) ? 'fa fa-check' : '' }}"
                            aria-hidden="true"></i>
                        <br>
                        ख) नागरिकता प्रमाणपत्रको प्रतिलिपि-१ <i
                            class="{{ !empty($proprietorDetail->businessRegisteredFile->citizen_ship) ? 'fa fa-check' : '' }}"
                            aria-hidden="true"></i>
                        <br>

                        ग) फर्म कम्पनी भएमा दर्ता, इजाजत प्रमाणपत्र <i
                            class="{{ !empty($proprietorDetail->businessRegisteredFile->company_registration_url) ? 'fa fa-check' : '' }}"
                            aria-hidden="true"></i>
                        <br>
                        घ) आन्तरिक राजस्व कार्यालयमा आघिल्लो आ.व सम्मको करतिरेको करदाता प्रमाणपत्रको
                        प्रतिलिपि
                        <i class="{{ !empty($proprietorDetail->businessRegisteredFile->tax_pay_file) ? 'fa fa-check' : 'fa fa-check' }}"
                            aria-hidden="true"></i>
                        <br>

                        ङ) हस्ताक्षर<i
                            class="{{ !empty($proprietorDetail->businessRegisteredFile->signature) ? 'fa fa-check' : '' }}"
                            aria-hidden="true"></i>
                        <br>
                        ङ)
                        औठाको छाप<i
                            class="{{ !empty($proprietorDetail->businessRegisteredFile->thumb) ? 'fa fa-check' : '' }}"
                            aria-hidden="true"></i>
                        <br>
                    </div>

                    <div class="col-md-12">
                        <p>माथि उल्लेखित सम्पूर्ण व्यहोरा ठिक साँचो हो भनी सहि छाप गर्ने ।</p>
                    </div>
                    <div class="col-md-6">
                        <p>निवेदकको दस्तखत : ............................................</p>
                    </div>
                    <div class="col-md-6 ">
                        <p>मिति : {{ $proprietorDetail->created_at->toDateString() }}</p>
                    </div>

                    <div class="col-md-6">
                        <p>
                            रुजु गर्ने ...............
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p>
                            प्रमाणित गर्ने ................
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset('assets/backend/emap/admin/js/jquery1-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/printAjaxScript.js') }}"></script>
</body>

</html>
