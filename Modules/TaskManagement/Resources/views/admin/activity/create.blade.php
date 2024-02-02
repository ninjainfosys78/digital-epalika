@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.taskManagement.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">कार्यहरू</li>
                    </ol>
                </div>
                <h4 class="page-title">कार्यहरू </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">कार्यहरू थप्नुहोस</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            <a href="{{ route('admin.taskManagement.activity.index') }}"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                <i class="fa fa-list mx-1"></i>कार्यहरूको सुची</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    @livewire('taskmanagement::activity-livewire')
                </div>
            </div>
        </div>
    </div>
@endsection
