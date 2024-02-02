@extends('frontend.static.chat.master')
@section('chat')
    <div class="service-details container">
        <div class="mx-5 mt-3 d-flex">
            <i class="fa fa-arrow-left"></i>
            <h4 class="mx-2 ">सेवाको विवरण</h4>
        </div>
        <div class=" mt-5">
            <h6 class="mx-5">नागरिकलाई प्रदान गरिने अन्य सेवाहरु</h6>
            <ul class="list-group list-group-flush mx-auto">
                <a href="{{url('/chat')}}">
                    <li class="list-group-item d-flex mb-1 pb-0">
                        <p class="mx-5">नागरिकलाई प्रदान गरिने अन्य सेवाहरु 1प्रदान </p> <i
                                class="fa fa-angle-right"></i>
                    </li>
                </a>
                    <li class="list-group-item d-flex mb-1 pb-0">
                        <p class="mx-5">नागरिकलाई प्रदान गरिने अन्य सेवाहरु 1प्रदान </p> <i
                                class="fa fa-angle-right"></i>
                    </li>
                </a>
                    <li class="list-group-item d-flex mb-1 pb-0">
                        <p class="mx-5">नागरिकलाई प्रदान गरिने अन्य सेवाहरु 1प्रदान </p> <i
                                class="fa fa-angle-right"></i>
                    </li>
                </a>
            </ul>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/chat.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/popup.css')}}">
@endpush

