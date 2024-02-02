@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">नक्सा</li>
                    </ol>
                </div>
                <h4 class="page-title">नक्सा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">नक्साहरु</h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">सब्मिसन आइडी</th>
                                    <th scope="col">घर धनीको नाम</th>
                                    <th scope="col">घर धनीको फोन नं.</th>
                                    <th scope="col">निर्माण कार्यको किसिम</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapApplies as $mapApply)
                                    <tr>
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $mapApply->unique_id ?? '' }}</td>
                                        <td>{{ $mapApply->houseOwner?->name ?? '' }}</td>
                                        <td>{{ $mapApply->houseOwner?->phone ?? '' }}</td>
                                        <td>{{ $mapApply->construction_type->label() }}</td>
                                        <td class="d-flex">

                                            @if ($mapApply->sent_to_organization !== 'Accept')
                                                <a data-bs-type="edit" class="btn me-1 btn-xs btn-outline-primary"
                                                    href="{{ route('organization.admin.mapApply.show', $mapApply) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="सम्पादन गर्नुहोस्">
                                                    <i class="fa fa-pen"></i>
                                                </a>

                                                <a data-bs-type="sent-to-admin"
                                                    class="btn me-1 btn-xs {{ $mapApply->sent_to_admin_at == null ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                    href="{{ route('organization.admin.updateStatus', $mapApply) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="एडमिनलाई पठाउनुस">
                                                    <i
                                                        class="fa {{ $mapApply->sent_to_admin_at == null ? 'fa-times' : 'fa-check' }}"></i>
                                                    {{--                                                    {{ $mapApply->sent_to_admin_at == null ? 'सक्रिय गर्नुहोस्' : 'निष्क्रिय गर्नुहोस्' }} --}}
                                                </a>
                                                <a data-bs-type="show" class="btn me-1 btn-xs btn-outline-warning"
                                                    href="{{ route('organization.admin.formList', $mapApply) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="हेर्नुहोस">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @else
                                                तपाईको फारम पालिकाले स्वीकार गरेको छ
                                            @endif
                                            <a data-bs-type="file" class="btn btn-xs btn-outline-info mx-1"
                                                href="{{ route('organization.admin.organizationDocument', $mapApply) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="कागजातहरु">
                                                <i class="fa fa-file"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
