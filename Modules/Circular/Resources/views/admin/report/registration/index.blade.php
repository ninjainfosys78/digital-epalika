@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.circular.dashboard') }}">
                            <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item active"> दर्ता रिपोर्ट</li>
                </ol>
            </div>
            <h4 class="page-title"> दर्ता रिपोर्ट </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">दर्ता रिपोर्ट</h4>
                    <div class="d-flex gap-1 justify-content-between">
                        <button class="btn btn-sm btn-light waves-effect waves-light collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFilterForm" aria-expanded="false"
                            aria-controls="collapseExample">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-funnel" viewBox="0 0 16 16">
                                <path
                                    d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                            </svg>फिल्टर
                            <!-- <i class="fa fa-filter"> </i> -->
                        </button>
                        <x-html-to-excel file-name="दर्ता रिपोर्ट" target-table="report-table" />
                        <x-print-button target-element="report-table" title="दर्ता रिपोर्ट" :header-required="true" />
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <div class="collapse show mb-2" id="collapseFilterForm" style="">
                    <form id="report-filter-form"
                        data-bs-url="{{route('admin.circular.report.registration.report-data')}}">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="border p-2 mb-2">
                                    <legend class="font-16 text-primary">
                                        <strong>
                                            दर्ता मिति
                                        </strong>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <x-date-input-component nameNe="from_registration_date" labelNe="मिति देखि"
                                                nameEn="en_from_registration_date" labelEn="From Date"
                                                :get-today-date="false" />
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <x-date-input-component nameNe="to_registration_date" labelNe="मिति सम्म"
                                                nameEn="en_to_registration_date" labelEn="To Date"
                                                :get-today-date="false" />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="border p-2 mb-2">
                                    <legend class="font-16 text-primary">
                                        <strong>
                                            पत्रको मिति
                                        </strong>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <x-date-input-component nameNe="from_letter_date" labelNe="मिति देखि"
                                                nameEn="en_from_letter_date" labelEn="From Date"
                                                :get-today-date="false" />
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <x-date-input-component nameNe="to_letter_date" labelNe="मिति सम्म"
                                                nameEn="en_to_letter_date" labelEn="To Date" :get-today-date="false" />
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="fiscal_year">आर्थिक बर्ष</label>
                                <select name="fiscal_year[]" multiple data-toggle="select2" id="fiscal_year"
                                    class="form-control">
                                    <option disabled>--- छान्नुहोस् ---</option>
                                    @foreach($fiscalYears as $fiscalYear)
                                    <option value="{{$fiscalYear->id}}">{{$fiscalYear->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="registration_no">दर्ता नं.</label>
                                <input type="text" id="registration_no" name="registration_no" class="form-control"
                                    placeholder="दर्ता नं.">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="letter_number">पत्र संख्या </label>
                                <input type="text" id="letter_number" name="letter_number" class="form-control"
                                    placeholder="पत्र संख्या">
                            </div>
                        </div>
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-primary">
                                <strong>
                                    Columns
                                </strong>
                            </legend>
                            <div class="row">
                                @foreach($columnData as $columns)
                                <div class="col-md-6 mb-2">
                                    <label for="column.{{$columns['table_name']}}">{{$columns['name']}}</label>
                                    <select name="columns[{{$columns['table_name']}}][]"
                                        id="column.{{$columns['table_name']}}" multiple data-toggle="select2"
                                        class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($columns['columns'] as $column)
                                        <option value="{{$column['column'] ?? ''}}">{{$column['name'] ?? ''}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @endforeach

                            </div>
                        </fieldset>

                        <button type="submit" id="submitFormBtn" class="btn btn-primary">
                            <i class="fa fa-search"> पेश गर्नुहोस्</i>
                        </button>

                    </form>
                </div>
                <div id="report-table"></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{asset('assets/backend/js/ajaxCall.js')}}"></script>
@endpush
@endsection