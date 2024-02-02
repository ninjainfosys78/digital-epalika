@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">निस्सा सनाखत </li>
                    </ol>
                </div>
                <h4 class="page-title">निस्सा सनाखत </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">निस्सा सनाखत </h4>
                        <div class="d-flex justify-content-between">
                            <x-print-button title="निस्सा सनाखत" target-element="printJudicialReceiptBill" />
                            @can('judicialReceiptBill_edit')
                                <a data-bs-type="edit"
                                    href="{{ route('admin.judicialCommittee.complaintApplication.judicialReceiptBill.create', $complaintApplication) }}"
                                    class="btn btn-sm btn-outline-warning mx-1 {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                    <i class="fa fa-edit"> सम्पादन गर्नुहोस्</i>
                                </a>
                            @endcan
                            <a href="{{ route('admin.judicialCommittee.registeredApplication') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"> दर्ता भएका उजुरी</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div id="printJudicialReceiptBill">
                        {!! $complaintApplication->getSpecificTemplateData(
                            \Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum::JUDICIAL_RECEIPT_BILL,
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
