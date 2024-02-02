<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>पृष्ठ फेला परेन | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta content="A complete solution for digital palika." name="description"/>
    <meta content="Digital ePalika" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/np.png')}}"/>
    <!-- Bootstrap css -->
    <link href="{{asset('assets/backend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App css -->
    <link href="{{asset('assets/backend/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
</head>

<body class="authentication-bg authentication-bg-pattern bg-main">
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h1 class="text-error">500</h1>
                            <h3 class="mt-3 mb-2">आन्तरिक सर्भर त्रुटि</h3>
                            <p class="text-muted mb-3">आफ्नो पृष्ठलाई रिफ्रेस गर्ने प्रयास किन नगर्ने? वा <a href="https://digitalepalika.com/contact" target="_blank" class="text-dark mx-1"><b>सम्पर्क</b></a> गर्न सक्नुहुन्छ ।</p>
                            <a href="{{url()->previous()}}" class="btn btn-success waves-effect waves-light">गृह पृष्ठ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer footer-alt">
    {{date('Y')}} &copy; Design & Developed by <a href="https://digitalepalika.com">Digital ePalika</a>
</footer>
</body>
</html>
