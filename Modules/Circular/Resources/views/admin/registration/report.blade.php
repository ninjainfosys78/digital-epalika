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
                            <a href="{{route('admin.circular.registration.index')}}">दर्ता प्रणाली </a>
                        </li>
                        <li class="breadcrumb-item active">दर्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">दर्ता प्रणाली</h4>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4">
            <a href="{{route('admin.circular.registration.index')}}" class="btn btn-danger rounded-pill waves-effect waves-light mb-3">
                <i class="fa fa-plus"></i> पत्र दर्ता</a>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <button class="btn btn-info float-right">
                        <i class="fa fa-file-excel"></i> Export Excel
                    </button>
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="{{$officeSetting->localBody->local_body ?? ''}}को पत्र दर्ता रिपोर्ट"/>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <livewire:circular::registration-report />
@endsection
