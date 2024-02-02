<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | {{ config('app.name') }}</title>
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
    <!-- icons -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/sweetalert2.min.css') }}">
    @livewireStyles
</head>

<body class="auth-page" style="background-image: url({{ asset('images/mountain_photo.jpg') }});">
    <div class="container-fluid">
        <div class="card rounded mt-2">
            <div class="col-md-12 system_info p-1">
                <div class="logo">
                    <img src="{{ asset('images/np.png') }}" height="60" alt="Logo">
                </div>
                <div class="title">
                    <div class="m-2">
                        <h4 class="text-white">डिजिटल ई-पालिका</h4>
                        <h5 class="text-white pt-1">ई-नक्सा पास</h5>
                        <h5
                            class="text-center text-decoration-underline
                                                mt-1 text-white">
                            ई-नक्सा पास सेवा प्रदान गर्नको लागि तलको फारम भरि
                            सुचिकृतको लागि पठाउनुहोस् ।</h5>
                    </div>
                </div>
            </div>
            <livewire:emap::organization-register-person-livewire />
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
</body>

</html>
