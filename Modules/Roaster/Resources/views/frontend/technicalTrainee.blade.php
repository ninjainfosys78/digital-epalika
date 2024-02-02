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
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500" >आवेदन फारम</a>
            </div>
        </div>
        <div class="text-center">
            <h4 class="fw-bold text-decoration-underline">सेवा कालिन तालिम आवेदन फारम</h4>
        </div>

        @livewire('roaster::technical-trainee-livewire',['training'=>$training])

    </section>
@endsection
