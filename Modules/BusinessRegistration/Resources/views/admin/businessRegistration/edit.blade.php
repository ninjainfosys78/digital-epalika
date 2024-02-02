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
                        <li class="breadcrumb-item active"> व्यवसाय
                        </li>
                    </ol>
                </div>
                <h4 class="page-title"> व्यवसाय
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> व्यवसाय सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.businessRegistration.businessRegistration.index',$businessDetail)}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> व्यवसाय सूची
                        </a>
                    </div>
                </div>
                @livewire('businessregistration::registration-form',['businessDetail'=>$businessDetail])
            </div>
        </div>
    </div>

@endsection
