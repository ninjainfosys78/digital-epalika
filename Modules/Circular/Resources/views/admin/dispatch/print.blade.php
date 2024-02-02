@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.circular.dispatch.index') }}">चलानी पत्र </a>
                        </li>
                        <li class="breadcrumb-item active">चलानी</li>
                    </ol>
                </div>
                <h4 class="page-title">चलानी पत्र</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title mb-0"> प्रिन्ट</h4>
                        <x-print-button
                            target-element="print"
                            title="{{$dispatch->dispatch_no??''}}"
                        />
                    </div>
                </div>
                <div class="card-body">
                    <div id="print" class="p-1">
                        <style>
                            @page {
                                margin-top: 0.2px;
                            }
                        </style>
                        {!! $data??'' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
