@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="breadcrumb d-flex">
            <div class="breadcrumb-item">
                <a class="whitespace-nowrap text-primary-500" href="{{route('welcome')}}">ई-पालिका</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500" href="{{route('roaster.index')}}">तालिम</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500">प्रशिक्षक दर्ता फारम</a>
            </div>
        </div>
        <div class="shadow p-2">
            <h4 class="text-center">प्रशिक्षक दर्ता फारम</h4>
            <livewire:roaster::trainer-livewire/>
        </div>
    </div>
@endsection
