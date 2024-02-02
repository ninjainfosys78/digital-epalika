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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.project.index') }}">
                                योजनाहरु
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> आयोजनाको लागत सम्वन्धि विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title"> आयोजनाको लागत सम्वन्धि विवरण</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">आयोजनाको लागत सम्वन्धि विवरण</h4>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.plan.project.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना/कार्यक्रमहरू
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    @livewire('plan::project-cost-detail-livewire', ['project_id' => $project->id])
                </div>
            </div>
        </div>
    </div>
@endsection
