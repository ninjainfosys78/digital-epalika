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
                <h4 class="page-title"> अनुदान रिपोर्ट </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">अनुदान रिपोर्ट</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel file-name="अनुदान रिपोर्ट" target-table="report-table" />
                            <x-print-button target-element="report-table" title="अनुदान रिपोर्ट" />
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="collapse show mb-2" id="collapseFilterForm">
                        <form id="report-filter-form" method="POST"
                            data-bs-url="{{ route('admin.grant.report.grant.report-data') }}">
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
                                <div class="col-md-3 mb-2">
                                    <label for="fiscal_year_id" class="form-label">
                                        आर्थिक वर्ष</label>
                                    <select name="fiscal_year_id[]" multiple data-toggle="select2" id="fiscal_year_id"
                                        class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($fiscalYears as $fiscalYear)
                                            <option value="{{ $fiscalYear->id }}">
                                                {{ $fiscalYear->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="grant_type_id" class="form-label">
                                        अनुदानको प्रकार</label>
                                    <select name="grant_type_id[]" multiple data-toggle="select2" id="grant_type_id"
                                        class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($grantTypes as $grantType)
                                            <option value="{{ $grantType->id }}">{{ $grantType->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="grant_for" class="form-label">
                                        अनुदानग्राहीको प्रकार</label>
                                    <select name="grant_for[]" multiple data-toggle="select2" id="grant_for"
                                        class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach (\Modules\Grant\Enums\GranteeEnum::cases() as $grant_for)
                                            <option value="{{ $grant_for->value }}">
                                                {{ $grant_for->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="is_new" class="form-label">
                                        नयाँ / निरन्तर</label>
                                    <select name="is_old[]" data-toggle="select2" id="is_old" class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        <option value="0"> नयाँ</option>
                                        <option value="1"> निरन्तर</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="grant_program_id" class="form-label">
                                        अनुदान कार्यक्रमको नाम</label>
                                    <select name="grant_program_id[]" multiple data-toggle="select2" id="grant_program_id"
                                        class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($grantPrograms as $grantProgram)
                                            <option value="{{ $grantProgram->id }}">
                                                {{ $grantProgram->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="grant_office_id" class="form-label">
                                        अनुदान दिने संस्था</label>
                                    <select name="grant_office_id[]" multiple data-toggle="select2" id="grant_office_id"
                                        class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($grantOffices as $grantOffice)
                                            <option value="{{ $grantOffice->id }}">
                                                {{ $grantOffice->office_name }}
                                            </option>
                                        @endforeach

                                    </select>
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
                                                <label
                                                    for="column.{{ $columns['table_name'] }}">{{ $columns['name'] }}</label>
                                                <select name="columns[{{ $columns['table_name'] }}][]"
                                                    id="column.{{ $columns['table_name'] }}" multiple
                                                    data-toggle="select2" class="form-control">
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
                            </div>
                            <button type="submit" id="submitFormBtn" class="btn btn-primary mt-1">
                                पेश गर्नुहोस्
                            </button>
                        </form>
                    </div>
                    <div id="report-table"></div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script src="{{ asset('assets/backend/js/ajaxCall.js') }}"></script>
        @endpush
    @endsection
