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

                        <li class="breadcrumb-item active">तारिख पर्चा</li>
                    </ol>
                </div>
                <h4 class="page-title">तारिख पर्चा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">तारिख पर्चा</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <x-print-button
                                title="तारिख पर्चा"
                                target-element="print-date-sheet"
                            />
                            <a href="{{ route('admin.judicialCommittee.registeredApplication') }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"> दर्ता भएका उजुरी</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="print-date-sheet">
                        {!! $complaintApplication->getDateSheetTemplate($dateSheet) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
