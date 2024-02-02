@extends('frontend.static.chat.master')
@section('chat')
    <div class="welcome px-5 d-flex">
        <div class="welcome-msg mt-5">
            <h5>खजुरा गाउँपालिकाको संक्षिप्त परिचय</h5>
            <p>तत्कालीन सङ्घीय मामिला तथा स्थानीय विकास मन्त्रालयले तयार गरेको नमुना बमोजिम गठित गाउँपालिका,
                नगरपालिका तथा विशेष, संरक्षित वा स्वायत्त क्षेत्रको संख्या तथा सिमाना निर्धारण आयोगले मिति २०७३ पुस
                २२ मा पेश गरेको प्रतिवेदन अनुसार तत्कालिन संघीय मामिला तथा स्थानीय विकास मन्त्रीको संयोजकत्वमा गठित
                समितिले मिति २०७३/११/२० मा पेश गरेको प्रतिवेदनको आधारमा</p>
        </div>
        <div class="welcome-img my-auto">
            <img src="{{asset('assets/frontend/image/icon/support.png')}}" alt="">
        </div>
    </div>
    <div class="menu-item mb-5 ">
        <div class="tabs mx-5 px-5 pt-4">
            <ul class="nav nav-pills mb-3 d-flex justify-content-around" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">नागरिक
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">घर/जग्गा
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">व्यवसाय
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled"
                            aria-selected="false">अन्य
                    </button>
                </li>
            </ul>
            <hr>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                     aria-labelledby="pills-home-tab" tabindex="0">
                    <div class="row  mt-5">
                        <div class="col-md-3">
                            <div class="icon text-center mx-auto">
                                <a href="{{url('/service-details')}}"><img
                                        src="{{asset('assets/frontend/image/icon/student.png')}}" class="card-img-top"
                                        alt="...">
                                    <div class="card-body">
                                        <p class="card-text">विधार्थी</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/minor.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">नाबालक</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Disabled.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">अपाङ्ग</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/recommendation.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">सिफारिस</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Patron.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">संरक्षक</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Certified.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">प्रमाणित</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">ब्यक्ति</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/chairman.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">अध्यक्ष</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/karar.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">करार/ राहत</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center">
                                <img src="{{asset('assets/frontend/image/icon/registration.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">दर्ता</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center">
                                <img src="{{asset('assets/frontend/image/icon/service.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">सेवा</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center">
                                <img src="{{asset('assets/frontend/image/icon/others.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">अन्य</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                     tabindex="0">
                    <div class="row  mt-5">
                        <div class="col-md-3">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/student.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">नामसारी</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/minor.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">विधुत/धारा</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Disabled.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">जग्गा</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/recommendation.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">घर/बाटो</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Patron.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">घर/पुर्जा</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Certified.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">भवन निर्माण</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">नक्सा</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/chairman.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">अन्य</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                     tabindex="0">
                    <div class="row  mt-5">
                        <div class="col-md-3">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/student.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">बन्द/नाम परिवर्तन</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/minor.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">संचालन</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Disabled.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">दर्ता</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/recommendation.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">ठाउँसरी</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Patron.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">कन्टेनर सेवा</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Certified.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">कर</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">अन्य</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab"
                     tabindex="0">
                    <div class="row  mt-5">
                        <div class="col-md-3">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/student.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">सिफारिस</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/minor.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">वितरण</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Disabled.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">परिवर्तन</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/recommendation.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">दर्ता/नवीकरण</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Patron.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">शुल्क</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/Certified.png')}}"
                                     class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">विज्ञापन</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">छायांकन</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">सेवा</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">कर</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">निकाय</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">विधालय</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <div class="icon text-center mx-auto">
                                <img src="{{asset('assets/frontend/image/icon/person.png')}}" class="card-img-top"
                                     alt="...">
                                <div class="card-body">
                                    <p class="card-text">अन्य</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/popup.css')}}">
@endpush
