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
                        <li class="breadcrumb-item active">तालिम दर्ता रिपोर्ट</li>
                    </ol>
                </div>
                <h4 class="page-title">तालिम दर्ता रिपोर्ट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">तालिम दर्ता रिपोर्ट</h4>

                        <button class="btn btn-primary waves-effect waves-light collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFilterForm" aria-expanded="false"
                            aria-controls="collapseExample">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="collapse show mb-2" id="collapseFilterForm">
                        <form id="report-filter-form" method="POST">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>मिति </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <x-date-input-component nameNe="from_date" labelNe="देखि" nameEn="en_from_date"
                                            labelEn="From Date" :get-today-date="false" />

                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <x-date-input-component nameNe="to_date" labelNe="सम्म" nameEn="en_to_date"
                                            labelEn="To Date" :get-today-date="false" />
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>आर्थिक बर्ष </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="fiscal_year">आर्थिक बर्ष</label>
                                                <select name="fiscal_year[]" multiple data-toggle="select2" id="fiscal_year"
                                                    class="form-control">
                                                    <option disabled>--- छान्नुहोस् ---</option>
                                                    @foreach ($fiscalYears as $fiscalYear)
                                                        <option value="{{ $fiscalYear->id }}">{{ $fiscalYear->title }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                निर्माण कार्यको किसिम
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="construction_type"> निर्माण कार्यको किसिम</label>
                                                <select name="construction_type[]" multiple data-toggle="select2"
                                                    id="construction_type" class="form-control">
                                                    <option disabled> --- छान्नुहोस् ---</option>
                                                    @foreach (\Modules\EMap\Enums\TypeOfConstructionWorkEnum::cases() as $construction)
                                                        <option value="{{ $construction->value }}">
                                                            {{ $construction->label() }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                प्रयोजन
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="usage">प्रयोजन </label>
                                                <select name="usage[]" id="usage" multiple data-toggle="select2"
                                                    class="form-control">
                                                    <option disabled>--- छान्नुहोस् ---</option>
                                                    @foreach (\Modules\EMap\Enums\BuildingUsageEnum::cases() as $usage)
                                                        <option value="{{ $usage->value }}">{{ $usage->label() }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                भवन ऐन अनुसार वर्गीकरण
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="building_category">भवन ऐन अनुसार वर्गीकरण </label>
                                                <select name="building_category[]" multiple data-toggle="select2"
                                                    id="building_category" class="form-control">
                                                    <option disabled>--- छान्नुहोस् ---</option>
                                                    @foreach (\Modules\EMap\Enums\CategorizationEnum::cases() as $categorization)
                                                        <option value="{{ $categorization->value }}">
                                                            {{ $categorization->label() }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                हाल निर्माण गर्ने तल्ला संख्या
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="current_storey.from">देखि</label>
                                                <input type="number" name="current_storey[from]"
                                                    value="{{ old('current_storey.from', $current_storey['from']) }}"
                                                    id="investment.from" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="current_storey.to">सम्म</label>
                                                <input type="number" name="current_storey[to]"
                                                    value="{{ old('current_storey.to', $current_storey['from']) }}"
                                                    id="current_storey.to" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                भविष्यमा निर्माण गर्ने तल्ला संख्या
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="future_storey.from">देखि</label>
                                                <input type="number" name="future_storey[from]"
                                                    value="{{ old('future_storey.from', $future_storey['from']) }}"
                                                    id="future_storey.from" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="future_storey.to">सम्म</label>
                                                <input type="number" name="future_storey[to]"
                                                    value="{{ old('future_storey.to', $future_storey['to']) }}"
                                                    id="future_storey.to" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                प्लिन्थको क्षेत्रफल
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="area_of_plinth.from">देखि</label>
                                                <input type="number" name="area_of_plinth[from]"
                                                    value="{{ old('area_of_plinth.from', $area_of_plinth['from']) }}"
                                                    id="area_of_plinth.from" class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="area_of_plinth.to">सम्म</label>
                                                <input type="number" name="area_of_plinth[to]"
                                                    value="{{ old('area_of_plinth.to', $area_of_plinth['to']) }}"
                                                    id="area_of_plinth.to" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                कुल भवनको लम्बाई
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="length.from">देखि</label>
                                                <input type="number" name="length[from]"
                                                    value="{{ old('length.from', $length['from']) }}" id="length.from"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="length.to">सम्म</label>
                                                <input type="number" name="length[to]"
                                                    value="{{ old('length.to', $length['to']) }}" id="length.to"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                कुल भवनको चौडाई
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="breadth.from">देखि</label>
                                                <input type="number" name="breadth[from]"
                                                    value="{{ old('breadth.from', $breadth['from']) }}" id="breadth.from"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="breadth.to">सम्म</label>
                                                <input type="number" name="breadth[to]"
                                                    value="{{ old('breadth.to', $breadth['to']) }}" id="breadth.to"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="border p-2 mb-2">
                                        <legend class="font-16 text-info">
                                            <strong>
                                                नक्सा
                                            </strong>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <label for="application_type">नक्सा </label>
                                                <select name="application_type[]" id="application_type" multiple
                                                    data-toggle="select2" class="form-control">
                                                    <option disabled>--- छान्नुहोस् ---</option>
                                                    @foreach (\Modules\EMap\Enums\ApplicationFormTypeEnum::cases() as $application)
                                                        <option value="{{ $application->value }}">
                                                            {{ $application->label() }}
                                                        </option>
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
                    <div id="report-table"></div>
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
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.roaster.report.report-data') }}",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            $("#submitFormBtn").prop('disabled', true);
                            $("#submitFormBtn").html("<i class='fa fa-spinner fa-spin'></i>");
                        },
                        success: function(resp) {
                            $("#submitFormBtn").prop('disabled', false);
                            $("#collapseFilterForm").collapse('hide')
                            $("#submitFormBtn").html("पेश गर्नुहोस्");
                            $('#report-table').html(resp.view)
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            $('#submitFormBtn').prop('disabled', false)
                            $("#submitFormBtn").html("पेश गर्नुहोस्");
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
