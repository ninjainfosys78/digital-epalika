@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mb-0">पुरानो नक्सा </h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">पुरानो नक्सा </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-3 p-0">
                <div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">पुरानो नक्सा थप्नुहोस्</h4>
                        <a href="{{ route('emap.admin.oldMap.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> पुरानो नक्सा सूची
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                @livewire('emap::old-map-livewire')
            </div>
        </div>
    </div>
@endsection
