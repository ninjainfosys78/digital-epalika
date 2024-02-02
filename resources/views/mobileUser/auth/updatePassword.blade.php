<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="B-Palika System" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/np.png') }}" />

    <!-- Bootstrap css -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    @if (config('app.env') === 'production')
        {!! ReCaptcha::htmlScriptTagJsApi() !!}
    @endif
</head>

<body class="auth-page" style="background-image: url({{ asset('images/mountain_photo.jpg') }}); margin-bottom: 10px;">
    @include('sweetalert::alert')

    <div class="pt-4 pb-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 m-auto">
                    <div class="card p-0">
                        <div class="row">
                            <div class="col-md-12 m-auto">
                                <div class="col-md-12 d-flex system_info flex-row py-3 align-items-center">
                                    <div class="logo">
                                        <img src="{{ asset('images/np.png') }}" height="70" alt="Logo">
                                    </div>
                                    <div class="title mx-2">
                                        <h3 class="text-left mb-0">
                                            <p class="fw-bold py-0 text-white">
                                                {{ $officeSetting->localBody->local_body ?? '' }}
                                            </p>
                                            <span class="fw-semibold fs-4 text-white">
                                                {{ $officeSetting->province->province ?? '' }},
                                                {{ $officeSetting->district->district ?? '' }}, नेपाल
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card p-0">
                                    <div class="card-body">
                                        <h3 class="text-primary pt-1 text-center fw-bolder mb-4">
                                            डिजिटल पालिका ब्यबस्थापन प्रणालि
                                            <br>
                                            <p class="fw-bold text-dark my-1" style="font-size: 14px;">
                                                (Digital Palika Management System)
                                            </p>
                                        </h3>
                                        <form action="{{ route('mobileUser.updatePassword', $mobileUser) }}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-2">
                                                <label for="current_password" class="form-label fw-bold">पुरानो पासवोर्ड
                                                    <span class="text-danger">*</span></label>
                                                <input name="current_password" type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    id="current_password" placeholder="पुरानो पासवोर्ड" />
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label for="password" class="form-label fw-bold">पासवोर्ड
                                                    <span class="text-danger">*</span></label>
                                                <input name="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                                    placeholder="पासवोर्ड" />
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label for="password_confirmation" class="form-label fw-bold">पासवोर्ड सुनिश्चित गर्नुहोस
                                                    <span class="text-danger">*</span></label>
                                                <input name="password_confirmation" type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation" placeholder="पासवोर्ड सुनिश्चित गर्नुहोस" />
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if (config('app.env') === 'production')
                                                <div class="mb-2">
                                                    {!! htmlFormSnippet() !!}
                                                    @error('g-recaptcha-response')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            <div class="d-flex justify-content-center mt-3">
                                                <button type="submit"
                                                    class="btn btn-primary btn-block waves-effect waves-light w-50 m-auto fs-5">
                                                    अपडेट पासवोर्ड
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="thought">
            <h4 class="mb-1 text-dark fw-bold">प्राविधिक सहायता कक्ष</h4>
            <p><i class="fa fa-phone-alt"></i> : 081-520361</p>
            <p class="text-center"><i class="fa fa-envelope"></i> : ninjainfosys@gmail.com</p>
        </div>
    </div>

    <footer class="footer footer-alt bg-soft-main">
        2022 - <script>{{ date('Y') }}</script> &copy; Design & Developed by
        <a href="#" class="text-white text-decoration-underline">NINJA INFOSYS</a>
    </footer>

    <!-- Vendor js -->
    <script
