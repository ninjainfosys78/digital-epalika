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
                        <li class="breadcrumb-item active"> पक्ष/विपक्ष अनुसार उजुरी रिपोर्ट</li>
                    </ol>
                </div>
                <h4 class="page-title">पक्ष/विपक्ष अनुसार उजुरी रिपोर्ट </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">पक्ष/विपक्ष अनुसार उजुरी रिपोर्ट</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed"
                                    type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFilterForm" aria-expanded="false"
                                    aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel
                                file-name="पक्ष/विपक्ष अनुसार उजुरी रिपोर्ट"
                                target-table="report-table"
                            />
                            <x-print-button
                                target-element="report-content"
                                title="पक्ष/विपक्ष अनुसार उजुरी रिपोर्ट"
                            />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="collapse show pb-2 border-bottom border-secondary" id="collapseFilterForm">
                        <form id="report-filter-form"
                              data-bs-url="{{route('admin.judicialCommittee.report.get-complaint-defendant-report')}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>निवेदन मिति </strong>
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
                                <div class="col-md-3">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>आर्थिक बर्ष </strong>
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
                                <div class="col-md-3">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>मुद्दा प्रकृति</strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="lawsuit_nature_id">मुद्दा प्रकृति</label>
                                                <select name="lawsuit_nature_id[]" multiple data-toggle="select2"
                                                        id="lawsuit_nature_id" class="form-control">
                                                    <option disabled>--- छान्नुहोस् ---</option>
                                                    @foreach($lawsuitNatures as $lawsuitNature)
                                                        <option
                                                            value="{{$lawsuitNature->id}}">{{$lawsuitNature->title}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </fieldset>
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
                                <thead>
                                <tr>
                                    <th>क्र.सं.</th>
                                    <th>उजुरीको विवरण</th>
                                    <th>पक्ष</th>
                                    <th>विपक्ष</th>
                                    <th>दर्ता नं.</th>
                                    <th>अवस्था</th>
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

                    data.forEach(function (item) {
                        // create row
                        const tr = document.createElement('tr');
                        // create cell
                        Object.values(item).forEach(data => {
                            const td = document.createElement('td');
                            // set cell content
                            td.innerHTML = data;
                            // append cell to row
                            tr.appendChild(td);
                        });

                        // append row to tbody
                        tbody.appendChild(tr);
                    });

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
                            $('#report-content').removeClass('d-none');
                            createTable(resp.data)
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
