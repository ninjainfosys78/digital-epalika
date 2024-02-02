@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> व्यक्तिगत अनुसार</li>
                    </ol>
                </div>
                <h4 class="page-title"> व्यक्तिगत  अनुसार </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> व्यक्तिगत अनुसार</h4>
                        <div class="d-flex gap-1 justify-content-between">
                            <button class="btn btn-sm btn-outline-secondary waves-effect waves-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFilterForm" aria-expanded="false"
                                    aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            <x-html-to-excel
                                file-name=" व्यक्तिगत अनुसार रिपोर्ट"
                                target-table="report-table"
                            />
                            <x-print-button
                                target-element="report-content"
                                title=" व्यक्तिगत अनुसार रिपोर्ट"

                            />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="collapse show mb-2" id="collapseFilterForm">
                        <form id="report-filter-form" data-bs-url="{{route('admin.recommendation.report.personal-detail-report')}}">
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
                                    <label for="recommendation_category">सिफारिस श्रेणी</label>
                                    <select name="recommendation_category[]" multiple data-toggle="select2"
                                            id="recommendation_category" class="form-control">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($recommendationCategories as $recommendationCategory)
                                            @if(count($recommendationCategory->recommendationCategories)>0)
                                                <optgroup label="{{$recommendationCategory->title}}">
                                                    @foreach($recommendationCategory->recommendationCategories as $subRecommendationCategory)
                                                        <option
                                                            value="{{$subRecommendationCategory->id}}">
                                                            {{$subRecommendationCategory->title}}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option
                                                    value="{{$recommendationCategory->id}}">
                                                    {{$recommendationCategory->title}}
                                                </option>
                                            @endif
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
                                <thead>
                                <tr>
                                    <th>क्र.सं.</th>
                                    <th>नाम</th>
                                    <th>सिफारिस</th>
                                    <th>मिति</th>
                                </tr>
                                </thead>
                            </table>
                            <p id="total"></p>
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
                            $('#total').html("आर्थिक वर्ष " + resp.fiscal_years.toString() + " मा "+resp.total+" सिफारिस दर्ता भएका छन !" )

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            submitFormBtn.prop('disabled', false)
                            submitFormBtn.html("पेश गर्नुहोस्");
                            toastMessage('error', XMLHttpRequest.responseJSON.message)
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
