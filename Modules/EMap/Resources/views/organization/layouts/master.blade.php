<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Digital E-Palika') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="A complete solution for a digital palika." name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="Digital ePalika" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/np.png') }}" />
    <!-- App css -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/plugins/select2.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/plugins/sweetalert2.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/plugins/datepicker.min.css')}}" type="text/css"/>
    <!-- app styles -->
    <link href="{{asset('assets/backend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media='screen,print'/>
    <link href="{{asset('assets/backend/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{asset('assets/backend/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/scss/style.css')}}" type="text/css"/>
    @stack('style')
    @livewireStyles
</head>

<!-- body start -->

<body>
    <!-- Begin page -->
    <div id="wrapper">
        @include('emap::organization.layouts.header')
        @include('emap::organization.layouts.sidebar')
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid text-center">
                    {{ date('Y') }} &copy; Design & Developed by <a href="https://digitalepalika.com">NINJA
                        INFOSYS</a>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
    </div>
    <div class="rightbar-overlay"></div>
    <script src="{{ asset('assets/backend/js/vendor.min.js') }}"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/backend/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/plugins/sweetalert2.min.js') }}"></script>
    @include('sweetalert::alert')

    @stack('scripts')
    @livewireScripts
    <script src="{{ asset('assets/backend/print/print.min.js') }}"></script>
    <script src="{{asset("assets/frontend/js/jquery.min.js")}}"></script>

</body>

</html>
