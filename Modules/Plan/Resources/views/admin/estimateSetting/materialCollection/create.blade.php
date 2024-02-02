@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">सामग्री संग्रह</li>
                    </ol>
                </div>
                <h4 class="page-title">सामग्री संग्रह</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">सामग्री संग्रह </h4>
                        <a href="{{ route('admin.plan.materialCollection.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>सामग्री संग्रह सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <livewire:plan::material-collection-livewire />
                </div>
            </div>
        </div>
    </div>
@endsection
