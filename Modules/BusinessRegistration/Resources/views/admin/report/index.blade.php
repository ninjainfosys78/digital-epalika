@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.businessRegistration.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> प्रतिवेदनहरु</li>
                    </ol>
                </div>
                <h4 class="page-title"> प्रतिवेदनहरु </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">व्यवसाय दर्ता प्रतिवेदन</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel file-name="प्रतिवेदन रिपोर्ट" target-table="report-table" />
                            <x-print-button target-element="report-table" title="प्रतिवेदन रिपोर्ट" :headerRequired="true" />
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="collapse show mb-2" id="collapseFilterForm">
                        <form id="report-filter-form"
                            data-bs-url="{{ route('admin.businessRegistration.report.report-data') }}">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="from_date" labelNe="मिति देखि" nameEn="en_from_date"
                                        labelEn="From Date" :get-today-date="false" />
                                </div>
                                <div class="col-md-3">
                                    <x-date-input-component nameNe="to_date" labelNe="मिति सम्म" nameEn="en_to_date"
                                        labelEn="To Date" :get-today-date="false" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="fiscal_year">आर्थिक बर्ष</label>
                                    <select name="fiscal_year[]" multiple data-toggle="select2" id="fiscal_year"
                                        class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($fiscalYears as $fiscalYear)
                                            <option value="{{ $fiscalYear->id }}">{{ $fiscalYear->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="object_transaction">कारोबार गर्ने वस्तु</label>
                                    <select name="object_transaction[]" multiple data-toggle="select2"
                                        id="object_transaction" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($objectTransactions as $objectTransaction)
                                            @if (count($objectTransaction->objectTransactions) > 0)
                                                <optgroup label="{{ $objectTransaction->title }}">
                                                    @foreach ($objectTransaction->objectTransactions as $subObjectTransaction)
                                                        <option value="{{ $subObjectTransaction->id }}">
                                                            {{ $subObjectTransaction->title }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option value="{{ $objectTransaction->id }}">
                                                    {{ $objectTransaction->title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="business_nature">व्यवसायको प्रकृति </label>
                                    <select name="business_nature[]" multiple data-toggle="select2" id="business_nature"
                                        class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($businessNatures as $businessNature)
                                            <option value="{{ $businessNature->id }}">{{ $businessNature->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        Columns
                                    </strong>
                                </legend>
                                <div class="row">
                                    @foreach ($columnData as $columns)
                                        <div class="col-md-6 mb-2">
                                            <label
                                                for="column.{{ $columns['table_name'] }}">{{ $columns['name'] }}</label>
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
                            <button type="submit" id="submitFormBtn" class="btn btn-primary">
                                पेश गर्नुहोस्
                            </button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <div id="report-table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/backend/js/ajaxCall.js') }}"></script>
    @endpush
@endsection
