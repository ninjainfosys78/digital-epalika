<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}"/>
    <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/icons.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/frontend/css/plugins/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/plugins/datepicker.min.css')}}">
    @stack('styles')
    @livewireStyles
</head>
<body>
@include('frontend.partials.header')
@if(config('app.website_type') === 'website')
    @include('frontend.partials.navbar')
@endif

    @yield('content')


@if(config('app.website_type') === 'website')
    @include('frontend.partials.website_footer')
@else
    @include('frontend.partials.digital_board_footer')
@endif
<script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/print.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/plugins/datepicker.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/custom.min.js')}}"></script>

@livewireScripts

@stack('scripts')

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
@if(app()->environment('production'))
    <script src="{{asset('js/newRelic.min.js')}}"></script>
@endif
</body>
</html>
