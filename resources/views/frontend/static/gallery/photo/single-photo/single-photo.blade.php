@extends('frontend.layouts.master')
@section('content')
<section class="singlephoto-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mt-3">
                <h6 class="font-weight-bold mb-md-3">ग्यालेरी</h6>
                <div class="sidebar">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ url('static/gallery/audio') }}" routerlinkactive="active" href="#static/audio">
                                <div class="card-06">
                                    <h6 class="title">अडियो ग्यालेरी</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ url('static/gallery/video') }}" routerlinkactive="active" href="#static/video">
                                <div class="card-06">
                                    <h6 class="title">भिडियो ग्यालेरी</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ url('static/gallery/photo') }}" routerlinkactive="active" href="#static/photo" class="active">
                                <div class="card-06">
                                    <h6 class="title">फोटो ग्यालेरी</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <h4 class="title-dark mb-3 mt-3">नेपालगंज उप-महानगरपालिकाको संक्षिप्त परिचय तस्बिरहरु</h4>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 mb-4"><img lazy="loaded" class="album-img pointer" alt="" src={{asset('assets/frontend/image/submetro.jpg')}}></div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4"><img lazy="loaded" class="album-img pointer" alt="" src={{asset('assets/frontend/image/submetro.jpg')}}></div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4"><img lazy="loaded" class="album-img pointer" alt="" src={{asset('assets/frontend/image/submetro.jpg')}}></div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4"><img lazy="loaded" class="album-img pointer" alt="" src={{asset('assets/frontend/image/submetro.jpg')}}></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
