@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">पुरानो नक्सा सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">पुरानो नक्सा  </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">पुरानो नक्सा  सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('emap.admin.oldMap.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> पुरानो नक्सा सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('emap::old-map-livewire',['oldMapUpdate'=>$oldMap])
                </div>
            </div>
        </div>
    </div>
@endsection
