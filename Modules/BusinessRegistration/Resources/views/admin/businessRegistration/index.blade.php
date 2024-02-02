@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.businessRegistration.businessRegistration.index') }}">व्यवसाय
                                दर्ता </a>
                        </li>
                        <li class="breadcrumb-item active">व्यवसाय दर्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">व्यवसाय दर्ता </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="collapse mb-2" id="collapseFilterForm">
                <div class="card p-0">
                    <div class="card-body px-0s">
                        <form>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="object_transaction_id">व्यवसायको कारोबार गर्ने मुख्य सेवा वा
                                        बस्तु</label>
                                    <select name="object_transaction_id" id="object_transaction_id" class="form-select">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($objectTransactions as $objectTransaction)
                                            <option
                                                {{ request('object_transaction_id') == $objectTransaction->id ? 'selected' : '' }}
                                                value="{{ $objectTransaction->id }}" class="fw-bold"
                                                @if ($objectTransaction->objectTransactions->count() > 0) disabled @endif>
                                                {{ $objectTransaction->title }}</option>
                                            @foreach ($objectTransaction->objectTransactions as $data)
                                                <option
                                                    {{ request('object_transaction_id') == $data->id ? 'selected' : '' }}
                                                    value="{{ $data->id }}">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;{{ $data->title }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="business_nature_id">व्यवसायको प्रकृति</label>
                                    <select name="business_nature_id" id="business_nature_id" class="form-select">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($businessNatures as $businessNature)
                                            <option
                                                {{ request('business_nature_id') == $businessNature->id ? 'selected' : '' }}
                                                value="{{ $businessNature->id }}">{{ $businessNature->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <x-date-input-component nameNe="to_date" labelNe="देखि" :get-today-date="false"
                                        :edit-date-ne="request('to_date')" />
                                </div>
                                <div class="col-md-3">
                                    <x-date-input-component nameNe="from_date" labelNe="सम्म" :get-today-date="false"
                                        :edit-date-ne="request('from_date')" />
                                </div>
                                <div class="col-md-3">
                                    <label for="registration_no">दर्ता नं</label>
                                    <input type="text" name="registration_no" value="{{ request('registration_no') }}"
                                        id="registration_no" placeholder="दर्ता नं" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="mt-2 btn btn-sm btn-primary">
                                <i class="fa fa-search"> पेश गर्नुहोस्</i>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header search-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">दर्ता भएका व्यवसायहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            <button class="btn btn-sm mx-1 btn-outline-info waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-custom">
                            <thead class="align-middle text-nowrap text-center">
                                <tr>
                                    <th rowspan="2">क्र.स</th>
                                    <th rowspan="2">दर्ता नं</th>
                                    <th rowspan="2">दर्ता मिति</th>
                                    <th colspan="2">व्यवसायी</th>
                                    <th colspan="2">व्यवसाय</th>
                                    <th rowspan="2">#</th>
                                </tr>
                                <tr>
                                    <th>नाम</th>
                                    <th>ठेगाना</th>
                                    <th>नाम</th>
                                    <th>ठेगाना</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap text-center">
                                @forelse($businessDetails as $businessDetail)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $businessDetail->registration_no ?? '' }}</td>
                                        <td>{{ $businessDetail->registration_date_ne ?? '' }}</td>
                                        <td>{{ $businessDetail->partners->first()?->name ?? '' }}</td>
                                        <td>
                                            <span>{{ $businessDetail->partners->first()?->localBody->local_body ?? '' }}
                                                - {{ $businessDetail->partners->first()?->ward_no ?? '' }} </span>
                                        </td>
                                        <td>{{ $businessDetail->name ?? '' }}</td>
                                        <td>
                                            <span>{{ $businessDetail->localBody->local_body ?? '' }}
                                                - {{ $businessDetail->ward_no ?? '' }} </span>
                                        </td>
                                        <td class="d-flex gap-1">
                                            @can('businessRegistration_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.businessRegistration.businessRegistration.edit', $businessDetail) }}"
                                                    class="btn btn-xs btn-outline-info {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="पुरा विवरण हेर्नुहोस">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </a>
                                            @endcan
                                            @can('businessRegistration_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.businessRegistration.businessRegistration.show', $businessDetail) }}"
                                                    class="btn btn-xs btn-outline-info {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="पुरा विवरण हेर्नुहोस">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('businessRenew_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.businessRegistration.businessRegistration.businessRenew.index', $businessDetail) }}"
                                                    class="btn btn-xs btn-outline-info {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="व्यवसाय नवीकरण">
                                                    <i class="fas fa-undo"></i>
                                                </a>
                                            @endcan
                                            @if (!is_null($businessDetail->registration_no))
                                                @can('businessRegistration_access')
                                                    <a data-bs-type="edit"
                                                        href="{{ route('admin.businessRegistration.businessRegistration.print', $businessDetail) }}"
                                                        title="प्रिन्ट गर्नुहोस" class="btn btn-xs btn-outline-warning">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="13">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $businessDetails->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
