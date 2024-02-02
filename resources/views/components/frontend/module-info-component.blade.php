<style>
    .new-digital-board .card-top {
        position: relative;
        min-height: 80vh;
        background: #0b4086;
        padding: 45px;
        border-radius: 15px;
    }

    a {
        color: white;
    }
    a:hover{
        color: white;

    }

    .new-digital-board .card-top .card {
        border: none;
        box-shadow: none;
    }

    .new-digital-board .card-top .nav-item {
        width: 50%;
    }

    .new-digital-board .card-top .nav-link {
        border-radius: 20px !important;
        color: #bbb;
        margin-right: 5px;
        text-align: center;
        font-size: 16px;
        font-weight: 600
    }

    .new-digital-board .card-top .nav-link:hover {
        background-color: #03A9F4 !important;
        border: 1px solid #03A9F4 !important;
        color: #fff !important;
    }

    .card-header-tabs {
        padding: 10px;
        background: #073168;
        border-radius: 80px;
        justify-content: center;
        align-items: center;
    }

    .new-digital-board .card-top .card .card-header {
        background: transparent;
        border: none;
    }

    .btn-danger,
    .nav-link.active {
        color: #fff !important;
        border-radius: 20px;
        box-shadow: 0px 0px 10px rgb(3 169 244 / 24%);
    }

    .new-digital-board .card-top .card .form-control,
    .new-digital-board .card-top .card .input-group-text {
        line-height: 2.2rem;
        background-color: transparent;
        color: #fff;
    }

    .input-group-text svg {
        color: #fff
    }

    .btn-primary,
    .nav-link.active {
        background-color: #03A9F4 !important;
        border: 1px solid #03A9F4 !important;
        color: #fff !important;
        border-radius: 20px;
        box-shadow: 0px 0px 10px rgb(3 169 244 / 24%);
    }

    ::placeholder {
        color: #ddd !important;
        font-weight: 100 !important
    }

    /* .new-digital-board:before {
        position: absolute;
        background-color: red;
        height: 100vh;
        width: 250px;
        content: '';
    } */
</style>
<div class="new-digital-board">
    <div class="row">
        {{-- Login Panle --}}
        <div class="col-md-4 card-top">

            @auth('mobile-user')
                <x-frontend.mobile-user-authentication-component />
            @else
                <x-frontend.mobile-user-login-component />
            @endauth


        </div>
        @auth('mobile-user')
            <div class="col-md-7 m-auto">
                <div class="row modules">
                    @if (Route::has('grievanceHandling.grievance'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('grievanceHandling.grievance') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/chat.png') }}" width="35"
                                            height="35">

                                        <h6 class="p-2 text-dark">गुनासो</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('ebps'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('ebps') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/map.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">घर-नक्सा</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (Route::has('recommendation.index'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="#">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/chat.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">सिफारिस</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('businessRegistration.business'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('businessRegistration.business') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/flat.png') }}"
                                            style="object-fit: contain; height: 35px; width: 35px" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">व्यवसाय दर्ता</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('grant.index'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('grant.index') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/salary.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">अनुदान</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('payment.index'))
                        <div class="col-md-3">
                            <div class="info-card disable_menu">
                                <a href="#">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/salary.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">राजस्व</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('roaster.index'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('roaster.index') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/presentation.png') }}"
                                            width="35" height="35">
                                        <h6 class="p-2 text-dark">तालिम</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            {{-- End Login Panel --}}
            <div class="col-md-7 m-auto">
                <div class="row modules">
                    @if (Route::has('grievanceHandling.grievance'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('grievanceHandling.grievance') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/chat.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">गुनासो</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('ebps'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('ebps') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/map.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">घर-नक्सा</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('digitalBoard.helpdesk.helpdesk'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('digitalBoard.helpdesk.helpdesk') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/help.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">हेल्प डेस्क</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('recommendation.index'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="#">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/chat.png') }}" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">सिफारिस</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('businessRegistration.business'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('businessRegistration.business') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/flat.png') }}"
                                            style="object-fit: contain; height: 35px; width: 35px" width="35"
                                            height="35">
                                        <h6 class="p-2 text-dark">व्यवसाय दर्ता</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('grant.index'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('grant.index') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/salary.png') }}"
                                            width="35" height="35">
                                        <h6 class="p-2 text-dark">अनुदान</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('payment.index'))
                        <div class="col-md-3">
                            <div class="info-card disable_menu">
                                <a href="#">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/salary.png') }}"
                                            width="35" height="35">
                                        <h6 class="p-2 text-dark">राजस्व</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Route::has('roaster.index'))
                        <div class="col-md-3">
                            <div class="info-card module-card">
                                <a href="{{ route('roaster.index') }}">
                                    <div class="pt-4 text-center">
                                        <img src="{{ asset('assets/frontend/image/new-icons/presentation.png') }}"
                                            width="35" height="35">
                                        <h6 class="p-2 text-dark">तालिम</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://pams.fcgo.gov.np/">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">जिन्सी व्यवस्थापन प्रणाली </h6>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://sutra.fcgo.gov.np/">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">संचितकोष व्यवस्थापन प्रणाली </h6>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://public.donidcr.gov.np/">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">घटना दर्ता र सामाजिक सुरक्षा प्रणाली</h6>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://ss.donidcr.gov.np/">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">सामाजिक सुरक्षा</h6>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://mail.nepal.gov.np/">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">इमेल सेवा</h6>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://attendance.gov.np/">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">कार्यालयको हाजिरी</h6>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://sms.aakashsms.com/login">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">एस.एम.एस</h6>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="info-card module-card">
                            <a href="https://apps.aakashtel.com/login">
                                <div class="pt-4 text-center">
                                    <img src="{{ asset('assets/frontend/image/logo.png') }}" width="35"
                                        height="35">
                                    <h6 class="p-2 text-dark">Voice एस.एम.एस</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>




            </div>
        @endauth
    </div>
</div>
