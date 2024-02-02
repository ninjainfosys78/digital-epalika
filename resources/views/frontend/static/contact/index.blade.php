@extends('frontend.layouts.master')
@section('content')
<section class="contact-section">
    <div class="container">
        <div class="heading mt-3">
            <h1>सम्पर्क</h1>
        </div>
        <div class="row">
            <div class="mt-3 mt-lg-0">
                <div class="address">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 mb-3 ">
                                <div class="card border rounded contact-item">
                                    <i class="fa fa-house-laptop fa-2xl pt-3"></i>
                                    <div class="textbox mb-3 text-center"><small>कार्यालय</small>
                                        <h6 class="heading-01">{{$officeSetting->localBody->local_body??''}}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class=" card border rounded contact-item">
                                    <i class="fa fa-location fa-2xl pt-3"></i>
                                     <div class="textbox text-center"><small>ठेगाना</small>
                                        <h6 class="heading-01">{{$officeSetting->site_address??''}}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 mt-3 mt-md-0">
                                <div class="card border rounded contact-item">
                                    <i class="fa fa-envelope fa-2xl pt-3"></i>
                                    <div class="textbox text-center"><small>ईमेल</small>
                                        <a href="#">
                                            <h6 class="heading-01">{{$officeSetting->email??''}}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 mt-3 mt-md-0">
                                <div class="card border rounded contact-item">
                                    <i class="fa fa-phone fa-2xl pt-3"></i>
                                    <div class="textbox text-center"><small>फोन</small>
                                        <h6 class="heading-01">{{$officeSetting->phone??''}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map">
        <iframe src="{{$officeSetting->google_map??''}}"
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
@endsection
