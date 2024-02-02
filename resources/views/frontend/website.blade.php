@extends('frontend.layouts.master')
@section('content')
    <section class="home-section mt-3">
        <div class="row">
            <div class="col-md-7">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($sliders as $slider)
                            <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                <img
                                    src="{{$slider->image_url}}"
                                    class="d-block w-100" alt="{{$slider->title}}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{$slider->title}}</h5>
                                    <p>{{$slider->description}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-5 intro-col mt-1">
                <div class="card-01 introduction  bg-card shadow rounded">
                    <h6 class="heading mt-2 mb-3 px-3">{{$officeSetting->name}}को संक्षिप्त परिचय</h6>
                    <p class="fw-normal lh-lg">
                        {!! Str::words(strip_tags($officeSetting->introduction),90) !!}
                    </p>
                    <div class="button d-flex justify-content-end">
                        <a href="{{route('introduction')}}" class="btn text-white">थप पढ्नुहोस्</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="avatar-section mt-5">
        <div class="container bg-card card  rounded pt-3">
            <div class="row ">
                @foreach($employees as $employee)
                    <div class="card-02 col-md-4 mb-2 px-3">
                        <div class="card shadow text-center">
                            <img class="mt-3 mb-2 rounded mx-auto d-block img-fluid" src="{{$employee->photo_url}}"
                                 alt="{{$employee->name}}">
                            <div class="card-body p-0 m-0">
                                <div class="card-description ">
                                    <h6 class="card-title mt-2 pt-1">{{$employee->name}}</h6>
                                    <h6 class="card-title ">{{$employee->designation}}</h6>
                                    <p>{{$employee->email}}</p>
                                    <p>{{$employee->phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="news-section  mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="list-item-head rounded p-2">
                        <p class="mb-0 text-white">सुचनाहरु</p>
                    </div>
                    <ul class="list-group">
                        @foreach($notices as $notice)
                            <li class="list-group-item">
                                <i class="fa fa-angle-right"></i>
                                <a href="{{route('single-notice',$notice)}}">{{Str::words($notice->title,12)}}</a>
                                <span><small>{{$notice->date}}</small></span>
                            </li>
                        @endforeach
                        <a class="btn-notice btn-outline-light " href="{{route('notice')}}">थप सुचनाहरु <i
                                class="fa fa-angles-right"></i>
                        </a>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="list-item-head rounded p-2">
                        <p class="mb-0 text-white ">समाचारहरु </p>
                    </div>
                    <ul class="list-group">
                        @foreach($newses as $news)
                            <li class="list-group-item">
                                <i class="fa fa-angle-right"></i>
                                <a href="{{route('single-notice',$notice)}}">{{Str::words($news->title,12)}}</a>
                                <span><small>{{$news->date}}</small></span>
                            </li>
                        @endforeach
                        <a class="btn-notice btn-outline-light ">थप बोर्ड निर्णयहरु
                            <i class="fa fa-angles-right"></i>
                        </a>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="list-item-head rounded p-2">
                        <p class="mb-0 text-white">कार्यपालिका बोर्ड निर्णय</p>
                    </div>
                    <ul class="list-group">
                        @foreach($meetingDecisions as $meetingDecision)
                            <li class="list-group-item">
                                <i class="fa fa-angle-right"></i>
                                <a href="">{{Str::words($meetingDecision->subject,12)}}</a>
                                <span>
                                    <small>{{$meetingDecision->date}}</small>
                                </span>

                            </li>
                        @endforeach
                        <a class="btn-notice btn-outline-light ">थप कार्यपालिका बोर्ड निर्णय <i
                                class="fa fa-angles-right"></i>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="map-section pt-4">
        <div class="mb-3">
            <div class="title-head-main py-auto pt-2 px-4 d-flex">
                <i class="fa fa-globe"></i>
                <p class="px-3">{{$officeSetting->province->province??''}}</p>
            </div>
        </div>
    </section>


    <section class="tab-section mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <iframe src="https://sthaniya.gov.np/gis" style="height:300px;width:100%;"
                            title="Iframe Example"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="row align-content-stretch">
                        @foreach($municipalDetails as $municipalDetail)
                            <div class="col-md-3 p-1 detail " style="background-color: {{$municipalDetail->bg_color}}">
                                <div class="text-center py-1">
                                    {!! $municipalDetail->icon !!}
                                    <h4 class="text-white m-0">
                                        {{$municipalDetail->count}}
                                    </h4>
                                    <p>{{$municipalDetail->title}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="social-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ">
                    <div class="card org-location">
                        <div class="card-body text-center">
                            <p class="card-title ">वडा कार्यालय स्थान</p>
                            <h6 class="card-subtitle mb-2 text-muted"></h6>
                            <div class="map">
                                <iframe
                                    src="{{$officeSetting->google_map}}"
                                    width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">

                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card org-location">
                        <div class="card-body">
                            <p class="card-title text-center">फेसबुक अपडेट</p>
                            <h6 class="card-subtitle mb-2 text-muted"></h6>
                            <div class="facebook-page">
                                <iframe
                                    src="{{$officeSetting->facebook_link}}"
                                    width="300" height="400"
                                    style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                                    allowfullscreen="true"
                                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card org-location">
                        <div class="card-body">
                            <p class="card-title text-center">ट्वीट्स</p>
                            <h6 class="card-subtitle mb-2 text-muted"></h6>
                            <div class="twitter">
                                <a class="twitter-timeline" data-height="400"
                                   href="{{$officeSetting->website}}">Tweets
                                    by NinjaPvt</a>
                                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
