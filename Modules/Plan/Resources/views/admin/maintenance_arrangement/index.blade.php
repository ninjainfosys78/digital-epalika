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
                        <li class="breadcrumb-item active">आयोजना मर्मत संम्भार सम्बन्धी व्यवस्था</li>
                    </ol>
                </div>
                <h4 class="page-title">आयोजना मर्मत संम्भार सम्बन्धी व्यवस्था</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">
                        आयोजना मर्मत संम्भार सम्बन्धी व्यवस्था
                    </h4>
                    <a href="{{ route('admin.plan.project.projectMaintenanceArrangement.create', $project) }}"
                        class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-edit"> सम्पादन गर्नुहोस्</i>
                    </a>
                </div>
                <div class="card-body px-0">
                    <h5>क) आयोजना मर्मत संम्भारको जिम्मा लिने समिति संस्थाको नाम:
                        {{ $project->projectMaintenanceArrangement->office_name ?? '' }}</h5>
                    <h5>ख) मर्मत संम्भारको सम्भावित स्रोत (छ छैन खुलाउने):
                        <ul>
                            <li>जनश्रमदान: {{ $project->projectMaintenanceArrangement->public_service ?? '' }}</li>
                            <li>सेवा शुल्क: {{ $project->projectMaintenanceArrangement->service_fee ?? '' }}</li>
                            <li>दस्तुर,
                                चन्दाबाट: {{ $project->projectMaintenanceArrangement->from_fee_donation ?? '' }}</li>
                            <li> अन्य केही भए: {{ $project->projectMaintenanceArrangement->others ?? '' }}</li>
                        </ul>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection
