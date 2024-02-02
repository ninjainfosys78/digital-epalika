@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="breadcrumb d-flex p-3">
            <div class="breadcrumb-item">
                <a class="whitespace-nowrap text-primary-500" href="{{route('welcome')}}">ई-पालिका</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500" href="{{route('roaster.index')}}">तालिम</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500">तालिम आवेदन</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center pb-5">
            <h4 class="text-center">तालिम आवेदन</h4>
            <div class="col-sm-6 ">
                <div class="row  d-flex justify-content-center">
                    <div class="col-md-6 p-2">
                        <div class="card bg-primary text-light text-center">
                            <div class="card-body">
                                <h5 class="fw-semibold mt-2">
                                    सेवा कालिन तालिम आवेदन फारम
                                </h5>
                                <i class="fa fa-file-invoice fs-1 py-2"></i>
                                <p></p>
                                <a href="{{route('roaster.individual-training-view','technical_trainee')}}" class="btn btn-light"><span>तालिम आवेदन</span>
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-2">
                        <div class="card bg-primary text-light text-center">
                            <div class="card-body">
                                <h5 class="fw-semibold mt-2">
                                    कृषक तालिम आवेदन फारम
                                </h5>
                                <i class="fa fa-file-invoice fs-1 py-2"></i>
                                <p></p>
                                <a href="{{route('roaster.individual-training-view','trainee')}}" class="btn btn-light"><span>तालिम आवेदन</span>
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
