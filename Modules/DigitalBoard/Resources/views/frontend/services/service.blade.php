@extends('helpdesk::HelpDesk.Resources.views.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-info p-2">
                    <div class="text-center text-decoration-underline">
                        <h6 class="fw-bold">प्रशासन शाखाक सेवाहरु</h6>
                    </div>
                    <div class="card-body">
                        <ol>
                            <li><a>नाता प्रमाणित </a></li>
                            <li><a>घर बाटो प्रमिणित</a></li>
                            <li><a>बिबाहिक प्रमिणित</a></li>
                            <li><a>नागरिता शिफारिस</a></li>
                        </ol>
                        <a class="btn btn-primary">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets/frontend/helpdesk/css/index.css')}}">

        <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    @endpush
@endsection
