@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.plan.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">कार्गो ह्यान्डलिङ</li>
                    </ol>
                </div>
                <h4 class="page-title">कार्गो ह्यान्डलिङ</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">कार्गो ह्यान्डलिङ </h4>
                        <a href="{{route('admin.plan.cargoHandling.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>कार्गो ह्यान्डलिङ सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('plan::cargo-handling-livewire',['materialData'=>$cargoHandling])
                </div>
            </div>
        </div>
    </div>

@endsection
