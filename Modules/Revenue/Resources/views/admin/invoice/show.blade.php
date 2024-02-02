@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.revenue.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        @if (Route::is('admin.revenue.invoice.show'))
                            <li class="breadcrumb-item active">नगदी रसिद</li>
                        @elseif (Route::is('admin.revenue.land.invoice.show'))
                            <li class="breadcrumb-item active">मालपोत रसिद</li>
                        @endif
                    </ol>
                </div>
                @if (Route::is('admin.revenue.invoice.show'))
                    <h4 class="page-title">नगदी रसिद</h4>
                @elseif (Route::is('admin.revenue.land.invoice.show'))
                    <h4 class="page-title">मालपोत रसिद</h4>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        @if (Route::is('admin.revenue.invoice.show'))
                            <h4 class="header-title">नगदी रसिद</h4>
                            <div class="d-flex gap-2">
                                @can('revenueCategory_create')
                                    <a href="{{ route('admin.revenue.invoice.index') }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-list"></i>
                                        नगदी रसिदहरुको सूची
                                    </a>
                                @endcan
                                @can('revenueCategory_create')
                                    <a href="{{ route('admin.revenue.invoice.edit', [$invoice]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-edit"></i>
                                        सम्पादन र समिक्षा गर्नुहोस्
                                    </a>
                                @endcan
                                <x-print-button target-element="report-table" title="{{ $invoice->invoice_no }}" />
                            </div>
                        @elseif (Route::is('admin.revenue.land.invoice.show'))
                            <h4 class="header-title">मालपोत रसिद</h4>
                            <div class="d-flex gap-2">
                                @can('revenueCategory_create')
                                    <a href="{{ route('admin.revenue.land.invoice.index') }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-list"></i>
                                        मालपोत रसिदहरुको सूची
                                    </a>
                                @endcan
                                <x-print-button target-element="report-table" title="{{ $invoice->invoice_no }}" />
                            </div>
                        @endif

                    </div>
                </div>
                <div class="card-body">
                    <div class="bg-white" id="report-table">
                        <div>
                            {!! letterHead() !!}
                            <div class="text-center">
                                @if (Route::is('admin.revenue.invoice.show'))
                                    <h4 class="fw-bold mb-0 text-decoration-underline">नगदी रसिद</h4>
                                @elseif (Route::is('admin.revenue.land.invoice.show'))
                                    <h4 class="fw-bold mb-0 text-decoration-underline">मालपोत रसिद</h4>
                                @endif
                                <p>(सेवाग्राही प्रति)</p>
                            </div>
                            <div class="info">
                                <p class="d-inline"><strong>रसिद नं.:</strong> {{ $invoice->invoice_no }}</p>
                                <p class="d-inline ms-2"><strong>करदाता नं:</strong>
                                    {{ $invoice->taxPayer->registration_no }}</p>
                                <p class="d-inline ms-2"><strong>करदाताको नाम:</strong> {{ $invoice->name }}</p><br>
                                <p class="d-inline"><strong>ठेगाना:</strong> {{ $invoice->address }}</p>
                                <p class="d-inline ms-2"><strong>मिति:</strong> <x-ad-to-bs id="payment_date_customer"
                                        :ad-date="$invoice->payment_date_ad"></x-ad-to-bs></p>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="col-8">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>बिषय</th>
                                                <th>क्षेत्रफल</th>
                                                <th>दर</th>
                                                <th>बक्यौता</th>
                                                <th>जरिवाना</th>
                                                <th>जम्मा</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->invoiceParticulars as $key => $particular)
                                                <tr>
                                                    <td>{{ $particular->revenue }}</td>
                                                    <td>
                                                        <x-convert-to-unicode
                                                            id="total__customer_quantity{{ $key }}"
                                                            number="{{ $particular->quantity }}" />
                                                    </td>
                                                    <td>रु.
                                                        <x-convert-to-unicode id="total__customer_rate{{ $key }}"
                                                            number="{{ $particular->rate }}" />
                                                    </td>
                                                    <td>रु.
                                                        <x-convert-to-unicode id="total__customer_due{{ $key }}"
                                                            number="{{ $particular->due_amount }}" />
                                                    </td>
                                                    <td>रु.
                                                        <x-convert-to-unicode id="total__customer_fine{{ $key }}"
                                                            number="{{ $particular->fine }}" />
                                                    </td>
                                                    <td>रु.
                                                        <x-convert-to-unicode id="total__customer_grand{{ $key }}"
                                                            number="{{ $particular->grand_total_amount }}" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5" class="text-right">जम्मा</th>
                                                <td>रु.
                                                    <x-convert-to-unicode id="total__customer_sum"
                                                        number="{{ $invoice->invoice_particulars_sum_total }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><b>अक्षरुपि</b>:
                                                    <x-number-into-unicode id="customer_word"
                                                        number="{{ $invoice->invoice_particulars_sum_total }}" />
                                                    मात्र
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col">
                                    <p>कर तिरौ, सभ्य नागरिक बनौ ।</p>
                                    <p>समय मै कर तिरौ, जरिवानाबाट बचौ ।</p>
                                    <p>कर सम्बन्धि बिस्तृत जानकारीको लागि राजस्व प्रशासन शाखामा सम्पर्क राख्नु होला ।
                                        <strong>कर तिर्नु भएकोमा धन्यबाद ।</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="dashed">बुझाउनेको सहि</div>
                                <div class="dashed">बुझिलिनेको सहि</div>
                            </div>
                            <div class="text-center">
                                <p> तयार गर्ने: {{ $invoice->user->name }} प्रिन्ट:
                                    <x-ad-to-bs id="print_service" :ad-date="now()"></x-ad-to-bs>
                                    {{ now()->format('h:i:s A') }}
                                </p>
                            </div>
                        </div>
                        <hr class="dashed">
                        <div>
                            {!! letterHead() !!}
                            <div>
                                <div class="text-center">
                                    @if (Route::is('admin.revenue.invoice.show'))
                                        <h4 class="fw-bold mb-0 text-decoration-underline">नगदी रसिद</h4>
                                    @elseif (Route::is('admin.revenue.land.invoice.show'))
                                        <h4 class="fw-bold mb-0 text-decoration-underline">मालपोत रसिद</h4>
                                    @endif
                                    <p>(कार्यालय प्रति)</p>
                                </div>
                                <div class="info">
                                    <p class="d-inline"><strong>रसिद नं.:</strong> {{ $invoice->invoice_no }}</p>
                                    <p class="d-inline ms-2"><strong>करदाता नं:</strong>
                                        {{ $invoice->taxPayer->registration_no }}</p>
                                    <p class="d-inline ms-2"><strong>करदाताको नाम:</strong> {{ $invoice->name }}</p><br>
                                    <p class="d-inline"><strong>ठेगाना:</strong> {{ $invoice->address }}</p>
                                    <p class="d-inline ms-2"><strong>मिति:</strong> <x-ad-to-bs id="payment_date_office"
                                            :ad-date="$invoice->payment_date_ad"></x-ad-to-bs></p>
                                </div>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>बिषय</th>
                                            <th>क्षेत्रफल</th>
                                            <th>दर</th>
                                            <th>बक्यौता</th>
                                            <th>जरिवाना</th>
                                            <th>जम्मा</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice->invoiceParticulars as $key => $particular)
                                            <tr>
                                                <td>{{ $particular->revenue }}</td>
                                                <td>
                                                    <x-convert-to-unicode id="total__office_quantity{{ $key }}"
                                                        number="{{ $particular->quantity }}" />
                                                </td>
                                                <td>रु.
                                                    <x-convert-to-unicode id="total__office_rate{{ $key }}"
                                                        number="{{ $particular->rate }}" />
                                                </td>
                                                <td>रु.
                                                    <x-convert-to-unicode id="total__office_due{{ $key }}"
                                                        number="{{ $particular->due_amount }}" />
                                                </td>
                                                <td>रु.
                                                    <x-convert-to-unicode id="total__office_fine{{ $key }}"
                                                        number="{{ $particular->fine }}" />
                                                </td>
                                                <td>रु.
                                                    <x-convert-to-unicode id="total__office_grand{{ $key }}"
                                                        number="{{ $particular->grand_total_amount }}" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" class="text-right">जम्मा</th>
                                            <td>रु.
                                                <x-convert-to-unicode id="total__office_sum"
                                                    number="{{ $invoice->invoice_particulars_sum_total }}" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><b>अक्षरुपि</b>:
                                                <x-number-into-unicode id="office_word"
                                                    number="{{ $invoice->invoice_particulars_sum_total }}" />
                                                मात्र
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="d-flex justify-content-between">
                                    <div class="dashed">
                                        रकम बुझाउनेको सहि
                                    </div>
                                    <div class="dashed">
                                        रकम बुझिलिनेको सहि
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p> तयार गर्ने: {{ $invoice->user->name }} प्रिन्ट:
                                        <x-ad-to-bs id="print_office" :ad-date="now()"></x-ad-to-bs>
                                        {{ now()->format('h:i:s A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
