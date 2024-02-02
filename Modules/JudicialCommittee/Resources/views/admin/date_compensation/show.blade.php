@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">तारिख भरपाई</li>
                    </ol>
                </div>
                <h4 class="page-title">तारिख भरपाई</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">तारिख भरपाई</h4>
                        <div class="d-flex justify-content-between">
                            <x-print-button
                                target-element="print-content"
                                title="तारिख भरपाई"
                            />
                            @can('dateCompensation_edit')
                                <a data-bs-type="edit" href="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.edit', [$complaintApplication,$complaintApplication]) }}"
                                   class="btn btn-sm btn-outline-warning mx-1 {{get_setting('Pin')?'confirm_pin':''}}">
                                    <i class="fa fa-edit"> सम्पादन गर्नुहोस्</i>
                                </a>
                            @endcan
                            <a href="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.index',$complaintApplication) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> तारिख भरपाई विवरण
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="print-content">
                        {!! $complaintApplication->getDateCompensationTemplate($dateCompensation) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
