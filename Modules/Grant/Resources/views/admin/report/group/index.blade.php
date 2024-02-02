@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grant.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> रिपोर्ट</li>
                    </ol>
                </div>
                <h4 class="page-title">समूह रिपोर्ट </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">समूह रिपोर्ट</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel file-name="समूह रिपोर्ट" target-table="report-table" />
                            <x-print-button target-element="report-table" title="समूह रिपोर्ट" />
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="collapse show mb-2" id="collapseFilterForm">
                        <form id="report-filter-form" data-bs-url="{{ route('admin.grant.report.group.report-data') }}">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="ward_no" class="form-label">
                                        वडा नं.</label>
                                    <select name="ward_no[]" multiple data-toggle="select2" id="ward_no"
                                        class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($officeSetting->localBody->ward_no as $ward)
                                            <option value="{{ $ward }}">{{ $ward }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <fieldset>
                                <legend class="font-16 text-info">
                                    <strong>
                                        Columns
                                    </strong>
                                </legend>
                                <div class="row">
                                    @foreach ($columnData as $columns)
                                        <div class="col-md-3 mb-2">
                                            <label for="column.{{ $columns['table_name'] }}">{{ $columns['name'] }}</label>
                                            <select name="columns[{{ $columns['table_name'] }}][]"
                                                id="column.{{ $columns['table_name'] }}" multiple data-toggle="select2"
                                                class="form-control">
                                                <option disabled>--- छान्नुहोस् ---</option>
                                                @foreach ($columns['columns'] as $column)
                                                    <option value="{{ $column['column'] ?? '' }}">
                                                        {{ $column['name'] ?? '' }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    @endforeach

                                </div>
                            </fieldset>
                            <button type="submit" id="submitFormBtn" class="btn btn-primary mt-1">
                                पेश गर्नुहोस्
                            </button>
                        </form>
                    </div>
                    <div id="report-table"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/backend/js/ajaxCall.js') }}"></script>
    @endpush
@endsection
