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
                        <li class="breadcrumb-item ">नक्सा</li>
                        <li class="breadcrumb-item active">नक्सा दर्ता तथा दस्तुर</li>
                    </ol>
                </div>
                <h4 class="page-title">नक्सा दर्ता तथा दस्तुर </h4>
            </div>
        </div>
    </div>
    <div class="card p-0">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title mb-0"> नक्सा दर्ता तथा दस्तुर </h4>
            </div>
        </div>
        <div class="card-body px-0">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">मिति</th>
                        <th scope="col">रसिद नं</th>
                        <th scope="col">रकम</th>
                        <th scope="col">रकम बुझनेको नाम</th>
                        <th scope="col">कैफियत</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $mapApply->mapRegistration->nepali_date ?? '' }}</td>
                        <td>{{ $mapApply->mapRegistration->receipt_no ?? '' }}</td>
                        <td>रु. {{ $mapApply->mapRegistration->amount ?? 0 }}</td>
                        <td>{{ $mapApply->mapRegistration->recipient ?? '' }}</td>
                        <td>{{ $mapApply->mapRegistration->remarks ?? '' }}</td>
                        <td><a href="{{ route('emap.admin.mapApply.mapRegistration.create', $mapApply) }}" type="button"
                                class="btn btn-outline-info btn-sm {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
