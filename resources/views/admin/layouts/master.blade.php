<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Digital E-Palika') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta content="A complete solution for a digital palika." name="description"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="check-pin-url" content="{{ route('admin.pin.check-pin') }}"/>
    <meta name="upload-file-url" content="{{ route('admin.file-upload') }}"/>
    <meta content="Digital ePalika" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="{{ asset('images/np.png') }}"/>
    <!-- plugins -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/plugins/select2.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/backend/css/plugins/sweetalert2.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/backend/css/plugins/datepicker.min.css') }}" type="text/css"/>
    <!-- app styles -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
          media='screen,print'/>
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{ asset('assets/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/backend/css/scss/style.css') }}" type="text/css"/>
    @stack('style')
    @livewireStyles
</head>

<body>
<div id="preloader">
    <img class="heartBeat animate" src="{{ asset('assets/backend/images/logo.png') }}" alt="">
</div>
<div id="wrapper">
    @include('admin.layouts.header')
    @include('admin.layouts.side_nav')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid text-center">
                {{ date('Y') }} &copy; Design & Developed by <a href="https://digitalepalika.com">Digital
                    ePalika</a>
            </div>
        </footer>
    </div>
</div>
<div class="rightbar-overlay"></div>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script> --}}

{{-- <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script> --}}
<script src="{{asset('js/browserPermission.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/plugins/sweetalert2.min.js') }}"></script>

@include('sweetalert::alert')

@stack('scripts')
@livewireScripts

{{-- TODO: Add a license error here --}}
{{-- @if (cache()->has('licenseError') || (cache()->has('license') && array_key_exists('is_active', cache()->get('license')) && !cache()->get('license')['is_active']))
<script>
    Swal.fire({
        title: 'License Error',
        text: '{{cache()->get('license')['message']}}',
        icon: 'error',
        confirmationButton: false
    })
</script>

@endif --}}
<script src="{{ asset('assets/backend/js/app.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/custom.js') }}"></script>
<script src="{{ asset('assets/backend/print/print.min.js') }}"></script>
</body>

</html>
