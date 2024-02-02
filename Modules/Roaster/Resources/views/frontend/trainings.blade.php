@extends('frontend.layouts.master')
@section('content')
    <section class="container">
        <div class="breadcrumb d-flex p-3">
            <div class="breadcrumb-item">
                <a class="whitespace-nowrap text-primary-500" href="{{route('welcome')}}">ई-पालिका</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500" href="{{route('roaster.index')}}">तालिम</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500" href="{{route('roaster.application')}}">तालिम आवेदन</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500" >तालिमहरु</a>
            </div>
        </div>
                    <div class="text-center">
                        <h4 class="fw-bold">चलिरहेका कृषकका लागि तालिमहरु</h4>
                    </div>
                    <div class="row card shadow p-2">
                        @forelse ($trainings as $training)
                            <div class="col-md-4">
                                <div class="card rounded shadow text-center">
                                    <div class="card-body">
                                        <h5>
                                            {{$training->name}}
                                        </h5>
                                        <div class="d-flex justify-content-center">
                                            <i class="fa fa-clock px-1 text-primary"></i><h6>खुलेको मिति:</h6> <small>{{$training->trainee_open_date}} </small>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <i class="fa fa-clock px-1 text-primary"></i><h6>बन्द हुने मिति: </h6> <small>{{$training->trainee_closed_date}}</small>
                                        </div>
                                        @foreach($training->trainers as $trainer)
                                            <div class="trainerUser d-flex py-2">
                                                <img class="shadow" src="{{$trainer->photo_url}}" alt="user"/>
                                                <div class="user-info my-auto px-3">
                                                    <h5>{{$trainer->name}}</h5>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <a href="{{route('roaster.traineeForm',$training)}}"
                                               class="btn btn-primary btn-effect">आवेदन
                                                दिनुहोस्
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h5>कुनै पनि तालिम भेटिएन</h5>
                            @endforelse
                    </div>



    </section>
@endsection
