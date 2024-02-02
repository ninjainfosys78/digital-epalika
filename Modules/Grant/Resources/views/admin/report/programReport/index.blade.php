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
                        <li class="breadcrumb-item active">कार्यक्रम अनुसारको रिपोर्टट</li>
                    </ol>
                </div>
                <h4 class="page-title"> कार्यक्रम अनुसारको रिपोर्ट </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">कार्यक्रम अनुसारको रिपोर्ट</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel file-name="कार्यक्रम अनुसारको रिपोर्टट" target-table="report-table" />
                            <x-print-button target-element="report-content" title="कार्यक्रम अनुसारको रिपोर्ट" />
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="collapse show pb-2 border-bottom border-secondary" id="collapseFilterForm">
                        <form id="report-filter-form"
                            data-bs-url="{{ route('admin.grant.report.grant.show-program-report') }}">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="grant_program_name" class="form-label">
                                        अनुदान कार्यक्रमको नाम</label>
                                    <select name="grant_id" data-toggle="select2" id="grant_program_name"
                                        class="form-select">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach ($grants as $grant)
                                            <option value="{{ $grant->id }}">
                                                {{ $grant->grant_program_name }} [{{ $grant->fiscalYear->title }}]
                                            </option>
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

                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <span>कार्यक्रमको नाम:- </span>
                                    <span id="programName"></span>
                                </div>
                                <div class="d-flex">
                                    <span>विनियोजित रकम:- </span>
                                    <span id="amount"></span>
                                </div>
                                <div class="d-flex">
                                    <span>आ.व.:- </span>
                                    <span id="fiscalYear"></span>
                                </div>
                            </div>
                            <table id="report-table" class="table table-sm mt-3 table-centered table-bordered">
                                <thead>
                                    <tr>
                                        <th>क्र.स</th>
                                        <th>नामथर</th>
                                        <th>पति/पत्नीको नाम</th>
                                        <th>बुबाको नाम</th>
                                        <th>बाजेको नाम</th>
                                        <th>नागरिकता नं</th>
                                        <th>सम्पर्क नं.</th>
                                        <th>अनुदान दिने कार्यलय</th>

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
                            $('#programName').html(resp.grant_name)
                            $('#fiscalYear').html(resp.fiscal_year)
                            $('#amount').html(resp.grant_amount)

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
