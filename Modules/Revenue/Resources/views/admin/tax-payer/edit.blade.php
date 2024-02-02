@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.revenue.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">करदाता</li>
                    </ol>
                </div>
                <h4 class="page-title">करदाता</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">करदाता सम्पादन गर्नुहोस</h4>
                        <a href="{{route('admin.revenue.taxPayer.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> करदाता सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('revenue::tax-payer-livewire', ['taxPayer' => $taxPayer]);
                </div>
            </div>
        </div>
    </div>
@endsection
