@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.taskManagement.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">समस्थिगत क्रियाकलाप रिपोर्ट</li>
                    </ol>
                </div>
                <h4 class="page-title"> समस्थिगत क्रियाकलाप रिपोर्ट </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">समस्थिगत क्रियाकलाप रिपोर्ट</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel file-name="समस्थिगत क्रियाकलाप रिपोर्ट" target-table="report-table" />
                            <x-print-button target-element="report-content" title="समस्थिगत क्रियाकलाप रिपोर्ट" />
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="collapse show pb-2 border-bottom border-secondary" id="collapseFilterForm">
                        <form id="report-filter-form" data-bs-url="{{ route('admin.taskManagement.report.report-data') }}">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="from_date" labelNe="मिति देखि" nameEn="en_from_date"
                                        labelEn="Date" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="to_date" labelNe="मिति सम्म" nameEn="en_to_date"
                                        labelEn="Date" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="fiscal_year">आर्थिक बर्ष</label>
                                    <select name="fiscal_year[]" multiple data-toggle="select2" id="fiscal_year"
                                        class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($fiscalYears as $fiscalYear)
                                            <option value="{{ $fiscalYear->id }}"
                                                {{ $fiscalYear->id == officeSetting()->fiscal_year_id ? 'selected' : '' }}>
                                                {{ $fiscalYear->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @if (checkSuperAdmin())
                                    <div class="col-md-7 mb-2">
                                        <label for="branch_id">शाखा</label>
                                        <select name="branch_id[]" multiple data-toggle="select2" id="branch_id"
                                            class="form-control">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                @foreach ($branch->branches as $subBranch)
                                                    <option value="{{ $subBranch->id }}">
                                                        --- {{ $subBranch->branch_name }}
                                                    </option>
                                                @endforeach
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label for="user_id">कर्मचारी</label>
                                        <select name="user_id[]" multiple data-toggle="select2" id="user_id"
                                            class="form-control">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                            </div>

                            <button type="submit" id="submitFormBtn" class="btn btn-primary">
                                पेश गर्नुहोस्
                            </button>

                        </form>
                    </div>
                    <div class="table-responsive">
                        <div id="report-content" class="d-none">
                            {!! letterHead() !!}
                            <table id="report-table" class="table table-sm mt-3 table-centered table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2">क्र.सं.</th>
                                        <th rowspan="2">मिति</th>
                                        <th rowspan="2">कर्मचारीको नाम</th>
                                        <th rowspan="2">शाखा</th>
                                        <th colspan="3" class="text-center">कार्य विवरण</th>
                                        <th rowspan="2">कैफियत</th>
                                    </tr>
                                    <tr>
                                        <th>शिर्षक</th>
                                        <th>विवरण</th>
                                        <th>कैफियत</th>
                                    </tr>
                                </thead>
                                <tbody id="report-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {

                // x-csrf protection
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document.body).delegate('#report-filter-form', 'submit', function(e) {
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
                        beforeSend: function() {
                            submitFormBtn.prop('disabled', true);
                            submitFormBtn.html("<i class='fa fa-spinner fa-spin'></i>");
                        },
                        success: function(resp) {
                            submitFormBtn.prop('disabled', false);
                            collapseFilterForm.collapse('hide')
                            submitFormBtn.html("पेश गर्नुहोस्");
                            $('#report-content').removeClass('d-none')
                            $('#report-body').html(resp.data)

                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
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
            });
        </script>
    @endpush
@endsection
