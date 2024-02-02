@extends('frontend.layouts.master')
@section('content')
<section class="audio-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 my-3">
                <h6 class="font-weight-bold mb-md-3">ग्यालेरी</h6>
                <div class="sidebar">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ route('audio') }}" class="text-decoration-none">
                                <div class="card-06">
                                    <h6 class="title">अडियो ग्यालेरी</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ route('video') }}" class="text-decoration-none">
                                <div class="card-06">
                                    <h6 class="title">भिडियो ग्यालेरी</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ route('photo') }}" class="text-decoration-none">
                                <div class="card-06">
                                    <h6 class="title">फोटो ग्यालेरी</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mt-3">
                <h4 class="title-dark mb-3">भिडियो ग्यालेरी</h4>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
