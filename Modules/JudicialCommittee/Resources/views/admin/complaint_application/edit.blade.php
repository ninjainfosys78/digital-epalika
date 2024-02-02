@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.judicialCommittee.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">निवेदन फारम</li>
                    </ol>
                </div>
                <h4 class="page-title">निवेदन फारम</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">निवेदन विवरण भर्नुहोस्</h4>
                        <a href="{{route('admin.judicialCommittee.complaintApplication.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list px-1"></i> निवेदन सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('judicialcommittee::complaint-application-livewire',['complaintApplication'=>$complaintApplication])
                </div>
            </div>
        </div>
    </div>
@endsection
