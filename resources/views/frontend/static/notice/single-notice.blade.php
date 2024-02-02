@extends('frontend.layouts.master')
@section('content')
    <section class="view-notice">
        <div class="container">
            <div class="breadcrumb d-flex">
                <div class="breadcrumb-item">
                    <a class="whitespace-nowrap text-primary-500" href="{{route('notice')}}">सूचना</a>
                    <i class="fa fa-angle-double-right"></i>
                    <a class=" text-primary-500 text-center">सूचना</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card-01 justify-content px-5 pt-5 pb-5">
                        <h3>{{$notice->title}}</h3>
                        <small>- {{$notice->date}}</small>
                        <p>{!! $notice->description !!}</p>
                        <div class="col-lg-10">
                            <div class="row">
                                @foreach($notice->files as $file)
                                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                                        <a href="#">
                                            <img lazy="loaded" class="album-img pointer" alt="" src={{$file->file_url}}>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
