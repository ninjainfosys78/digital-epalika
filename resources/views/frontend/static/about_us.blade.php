@extends('frontend.layouts.master')
@section('content')
    <section class="about-us">
        <div class="container">
            <div class="row">
            <div class="d-flex mt-5">
                <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500" href="{{route('welcome')}}">परिचय</a>
                        <i class="fa fa-angle-double-right"></i>
                        <a class="ml-1 text-primary-500">हाम्रो बारेमा</a>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 my-3">
                <h6 class="font-weight-bold mb-md-3">हाम्रो बारेमा</h6>
                <div class="sidebar">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ route('representative') }}" class="text-decoration-none">
                                <div class="card-06">
                                    <h6 class="title">जनप्रतिनिधिहरु</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{ route('employee') }}" class="text-decoration-none">
                                <div class="card-06">
                                    <h6 class="title">कर्मचारीहरु</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-12 mt-2 mt-sm-0 mt-lg-2">
                            <a href="{{route('organization')}}" class="text-decoration-none">
                                <div class="card-06">
                                    <h6 class="title ">संगठन</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>





    </section>
@endsection
