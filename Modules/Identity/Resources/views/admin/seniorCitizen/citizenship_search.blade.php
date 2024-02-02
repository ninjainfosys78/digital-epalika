@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> जेष्ठ नागरिक</li>
                    </ol>
                </div>
                <h4 class="page-title"> जेष्ठ नागरिक</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ जेष्ठ नागरिक थप्नुहोस्</h4>
                        <div>
                            <a href="{{route('identity.admin.seniorCitizenDetail.index')}}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> जेष्ठ नागरिक सुची
                            </a>
                            <a href="https://localhost:8003/mfs100" target="_blank" class="btn btn-sm btn-outline-primary">
                                Run MFS 100
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('identity::search-citizenship-livewire')
                </div>
            </div>
        </div>
    </div>
@endsection


