@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> जेष्ठ नागरिक रिपोर्ट</li>
                    </ol>
                </div>
                <h4 class="page-title"> जेष्ठ नागरिक रिपोर्ट </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">जेष्ठ नागरिक रिपोर्ट</h4>

                        <button class="btn btn-primary waves-effect waves-light collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseFilterForm" aria-expanded="false"
                                aria-controls="collapseExample">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="collapse show mb-2" id="collapseFilterForm">
                        <form id="report-filter-form"
                              data-bs-url="{{route('identity.admin.seniorCitizenReport.report')}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong> मिति </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <x-date-input-component
                                                    nameNe="from_date" labelNe="देखि"
                                                    nameEn="en_from_date" labelEn="From Date"
                                                    :get-today-date="false"
                                                />

                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <x-date-input-component
                                                    nameNe="to_date" labelNe="सम्म"
                                                    nameEn="en_to_date" labelEn="To Date"
                                                    :get-today-date="false"
                                                />
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong> आर्थिक बर्ष </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="fiscal_year">आर्थिक बर्ष</label>
                                                <select name="fiscal_year[]" multiple data-toggle="select2"
                                                        id="fiscal_year" class="form-control">
                                                    <option disabled>--- छान्नुहोस् ---</option>
                                                    @foreach($fiscalYears as $fiscalYear)
                                                        <option
                                                            value="{{$fiscalYear->id}}">{{$fiscalYear->title}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        Columns
                                    </strong>
                                </legend>
                                <div class="row">
                                    @foreach($columnData as $columns)
                                        <div class="col-md-12 mb-2">
                                            <label for="column.{{$columns['table_name']}}">{{$columns['name']}}</label>
                                            <select name="columns[{{$columns['table_name']}}][]"
                                                    id="column.{{$columns['table_name']}}" multiple
                                                    data-toggle="select2"
                                                    class="form-control">
                                                <option disabled>--- छान्नुहोस् ---</option>
                                                @foreach($columns['columns'] as $column)
                                                    <option
                                                        value="{{$column['column'] ?? ''}}">{{$column['name'] ?? ''}}</option>
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
                    <div id="report-table" class="table-responsive"></div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/ajaxCall.js')}}"></script>
    @endpush
@endsection


