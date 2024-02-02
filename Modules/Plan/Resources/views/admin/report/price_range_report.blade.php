@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> योजना छनौट रिपोर्ट</li>
                    </ol>
                </div>
                <h4 class="page-title">योजना छनौट रिपोर्ट </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">योजना छनौट रिपोर्ट</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFilterForm" aria-expanded="false"
                                    aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel
                                file-name="योजना छनौट रिपोर्ट"
                                target-table="report-table"
                            />
                            <x-print-button
                                target-element="report-content"
                                title="योजना छनौट रिपोर्ट"
                            />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="collapse show pb-2 border-bottom border-secondary" id="collapseFilterForm">
                        <form id="report-filter-form"
                              data-bs-url="{{route('admin.plan.report.get-price-range-report-data')}}">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component
                                        nameNe="from_date" labelNe="मिति देखि"
                                        nameEn="en_from_date" labelEn="From Date"
                                        :get-today-date="false"
                                    />
                                </div>
                                <div class="col-md-3">
                                    <x-date-input-component
                                        nameNe="to_date" labelNe="मिति सम्म"
                                        nameEn="en_to_date" labelEn="To Date"
                                        :get-today-date="false"
                                    />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="fiscal_year">आर्थिक बर्ष</label>
                                    <select name="fiscal_year[]" multiple data-toggle="select2"
                                            id="fiscal_year" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($fiscalYears as $fiscalYear)
                                            <option value="{{$fiscalYear->id}}">{{$fiscalYear->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="ward_no">वडा नं.</label>
                                    <select name="ward_no[]" multiple data-toggle="select2"
                                            id="ward_no" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($officeSetting->localBody->ward_no as $ward)
                                            <option value="{{$ward}}">{{$ward}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="plan_area_id">योजनाको क्षेत्</label>
                                    <select name="plan_area_id[]" multiple data-toggle="select2"
                                            id="plan_area_id" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($planAreas as $planArea)
                                            <option value="{{$planArea->id}}">{{$planArea->area_name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="plan_sub_area_id">योजना उपक्षेत्र</label>
                                    <select name="plan_sub_area_id[]" multiple data-toggle="select2"
                                            id="plan_sub_area_id" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="plan_level_id">योजनाको स्तर</label>
                                    <select name="plan_level_id[]" multiple data-toggle="select2"
                                            id="plan_level_id" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($planLevels as $planLevel)
                                            <option value="{{$planLevel->id}}">{{$planLevel->level_name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="plan_sub_level_id"> योजना उपस्तर</label>
                                    <select name="plan_sub_level_id[]" multiple data-toggle="select2"
                                            id="plan_sub_level_id" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="budget_head_id">बजेट शिर्षक</label>
                                    <select name="budget_head_id[]" multiple data-toggle="select2"
                                            id="budget_head_id" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($budgetHeads as $budgetHead)
                                            <option value="{{$budgetHead->id}}">{{$budgetHead->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="budget_sub_head_id">बजेट उप-शिर्षक</label>
                                    <select name="budget_sub_head_id[]" multiple data-toggle="select2"
                                            id="budget_sub_head_id" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="project_status">योजनाको अवस्था</label>
                                    <select name="project_status[]" multiple data-toggle="select2"
                                            id="project_status" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach(\Modules\Plan\Enums\ProjectStatusEnum::cases() as $projectStatus)
                                            <option
                                                value="{{$projectStatus->value}}">{{$projectStatus->label()}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <button type="submit" id="submitFormBtn" class="btn btn-primary">
                                पेश गर्नुहोस्
                            </button>

                        </form>
                    </div>
                    <div class="table-responsive">
                        <div id="report-content" class="d-none">
                            {!! letterHead() !!}
                            <table id="report-table" class="table table-sm mt-3 table-bordered">
                                <thead class="align-middle">
                                <tr>
                                    <th>रू. १ लाख सम्म</th>
                                    <th>१ लाख देखि २ लाख सम्म</th>
                                    <th>२ लाख देखि ५ लाख सम्म</th>
                                    <th>रू. ५ लाख देखि १० लाख सम्म</th>
                                    <th>रू. १० लाख देखि ५० लाख सम्म</th>
                                    <th>रू. ५० लाख भन्दा बढि</th>
                                    <th>जम्मा</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                function createTable(data) {

                    const table = document.querySelector('#report-table');
                    // create tbody
                    // delete tbody tag if exists
                    if (table.querySelector('tbody')) {
                        table.querySelector('tbody').remove();
                    }

                    const tbody = document.createElement('tbody');

                    const tr = document.createElement('tr');

                    Object.values(data).forEach(el => {
                        const td = document.createElement('td');
                        // set cell content
                        td.innerHTML = el;
                        // append cell to row
                        tr.appendChild(td);
                    });
                    tbody.appendChild(tr);
                    table.appendChild(tbody);
                }

                // x-csrf protection
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document.body).delegate('#report-filter-form', 'submit', function (e) {
                    e.preventDefault()
                    // get attribute data-bs-url from form and assign it to const variable url
                    const url = $(this).attr('data-bs-url');
                    const submitFormBtn = $("#submitFormBtn");
                    const collapseFilterForm = $("#collapseFilterForm");
                    $.ajax({
                        type: "post",
                        url: url,
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            submitFormBtn.prop('disabled', true);
                            submitFormBtn.html("<i class='fa fa-spinner fa-spin'></i>");
                        },
                        success: function (resp) {
                            submitFormBtn.prop('disabled', false);
                            collapseFilterForm.collapse('hide')
                            submitFormBtn.html("पेश गर्नुहोस्");
                            $('#report-content').removeClass('d-none')
                            createTable(resp)

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            submitFormBtn.prop('disabled', false)
                            submitFormBtn.html("पेश गर्नुहोस्");
                            toastMessage('error', XMLHttpRequest.responseJSON.message)
                        }
                    });
                })

                function toastMessage(type, title) {
                    swal.fire({
                        title: title,
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        width: 450,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: type,
                    });
                }
            })
            ;
        </script>
    @endpush
@endsection
