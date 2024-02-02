<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Set Password | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta
        content="B-Palika System"
        name="description"
    />
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/np.png')}}"/>

    <!-- Bootstrap css -->
    <link
        href="{{asset('assets/backend/css/bootstrap.min.css')}}"
        rel="stylesheet"
        type="text/css"
    />
    <!-- App css -->
    <link
        href="{{asset('assets/backend/css/app.min.css')}}"
        rel="stylesheet"
        type="text/css"
        id="app-style"
    />
    <!-- icons -->
    <link href="{{asset('assets/backend/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body class="auth-page" style="background-image: url({{asset('images/mountain_photo.jpeg')}})">
<div class="mt-5 mb-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="row">
                        <div class="col-md-5 system_info">
                            <div class="logo">
                                <img src="{{asset('images/np.png')}}" height="80" alt="Logo">
                            </div>
                            <div class="title">
                                <h4>
                                    <p class="fw-bold py-1 text-white">{{$officeSetting->localBody->local_body??''}}</p>
                                    <span class="fw-semibold fs-5 text-white">
                                        {{$officeSetting->district->district??''}} <br>
                                        {{$officeSetting->province->province??''}}, नेपाल
                                    </span>
                                </h4>
                                <p class="text-white pt-1">
                                    डिजिटल पालिका ब्यबस्थापन प्रणालि
                                    <br>
                                    (Digital Palika Management System)
                                </p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center">
                                        <i class="fa fa-user-lock"></i>
                                    </h2>
                                    <form action="{{route('organization.password.store')}}" method="post">
                                        @csrf

                                        <div class="mb-1">
                                            <label for="password" class="form-label">पासवर्ड
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                type="password"
                                                id="password"
                                                placeholder="Password"
                                            />
                                            @error('password')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">
                                                पासवर्ड पुष्टि
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                type="password"
                                                value="{{old('password_confirmation')}}"
                                                id="password_confirmation"
                                                placeholder="Password Confirmation"
                                            />
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            {!! htmlFormSnippet() !!}
                                            @error('g-recaptcha-response')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                                    <i class="fa fa-lock"></i>
                                                    पेश गर्नुहोस्
                                                </button>
                                                <button type="reset" class="btn btn-danger waves-effect ms-3">
                                                    <i class="fa fa-times-circle"></i>
                                                    रिसेट
                                                </button>
                                            </div>
                                    </form>
                                    <div class="thought">
                                        <h4 class="mb-1 text-dark fw-bold">प्राविधिक सहायता कक्ष</h4>
                                        <p class="text-center">
                                            <i class="fa fa-envelope"></i> : epalikad@gmail.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer footer-alt bg-soft-main">
    2022 -
    <script>
        document.write(new Date().getFullYear());
    </script>
    &copy; Design & Developed by <a href="#" class="text-white text-decoration-underline">Digital ePalika</a>
</footer>

<!-- Vendor js -->
<script src="{{asset('assets/backend/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/backend/js/app.min.js')}}"></script>
</body>
</html>
