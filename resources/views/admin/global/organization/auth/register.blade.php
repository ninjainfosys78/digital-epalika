<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Register | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta content="B-Palika System" name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/np.png') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap css -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App css -->
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    {{-- <link rel="stylesheet" href="{{asset('assets/frontend/css/sweetalert2.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/sweetalert2.min.css') }}">
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
    @livewireStyles
</head>


<body class="auth-page">
<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <div class="card rounded mt-2">
                <div class="col-md-12 p-1 text-center mb-2">
                    <div class="logo">
                        <img src="{{ asset('images/np.png') }}" height="70" alt="Logo">
                    </div>
                    <div class="title">
                        <div class="m-2">
                            <h2 class="text-primary fw-bolder mb-0">डिजिटल ई-पालिका</h2>
                            <h3 class="text-dark fw-bold pt-1 mb-0">ई-नक्सा पास</h3>
                            <p class="text-dark fw-bold pt-1"> ई-नक्सा पास सेवा प्रदान गर्नको लागि तलको फारम भरि
                                सुचिकृतको लागि पठाउनुहोस् ।</p>
                        </div>
                    </div>
                </div>
                <livewire:emap::organization-register-livewire/>
            </div>
        </div>
    </div>
</div>
<!-- Vendor js -->
<script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/backend/js/app.min.js') }}"></script>
<script src="{{ asset('assets/backend/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

<!-- Init js-->
<script src="{{ asset('assets/backend/js/pages/form-wizard.init.js') }}"></script>
<script src="{{ asset('assets/frontend/js/sweetalert2.min.js') }}"></script>

@livewireScripts

{{-- listener for toastr --}}
<script>
    window.addEventListener('alert_message', event => {
        swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
        });
    });
</script>
@include('sweetalert::alert')
</body>

</html>
