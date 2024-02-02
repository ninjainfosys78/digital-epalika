@extends('frontend.layouts.master')
@section('content')
<section class="inner-section mt-lg-5 ">
    <div class="container-fluid">
        <div class="row d-flex mt-5 ">
            <div class="mx-auto">
                <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500"
                           href="">कार्यलय</a>
                        <i class="fa fa-angle-double-right ml-lg-1"></i>
                        <a class="ml-1 text-primary-500">परिचय</a>
                    </div>
                </div>
            </div>
            {!! $officeSetting->introduction !!}
        </div>
    </div>
</section>
@endsection
