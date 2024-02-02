@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.revenue.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">करदाताको सम्पति</li>
                    </ol>
                </div>
                <h4 class="page-title">करदाताको सम्पति</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ करदाताको सम्पति थप्नुहोस्</h4>
                        <a href="{{ route('admin.revenue.taxPayer.taxPayerLand.index', $taxPayer) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> करदाताको सम्पति सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    @livewire('revenue::tax-payer-land-livewire', ['taxPayer' => $taxPayer])

                </div>
            </div>
        </div>
    </div>
@endsection
