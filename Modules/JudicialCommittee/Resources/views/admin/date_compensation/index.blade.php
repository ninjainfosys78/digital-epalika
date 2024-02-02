@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">तारिख भरपाई</li>
                    </ol>
                </div>
                <h4 class="page-title">तारिख भरपाई</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">तारिख भरपाई सूची</h4>
                        @can('dateCompensation_create')
                            <a href="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.create', $complaintApplication) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>निर्णय हुने मिति </th>
                                    <th>निर्णय हुने समय</th>
                                    <th>निर्णय हुने विषय</th>
                                    <th>पेश मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaintApplication->dateCompensations as $dateCompensation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dateCompensation->decision_date }}</td>
                                        <td>{{ $dateCompensation->decision_time }}</td>
                                        <td>{{ $dateCompensation->decision_subject }}</td>
                                        <td>{{ $dateCompensation->submitted_date }}</td>
                                        <td>
                                            @can('dateCompensation_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.show', [$complaintApplication, $dateCompensation]) }}"
                                                    title="विवरण हेर्नुहोस्"
                                                    class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('dateCompensation_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.edit', [$complaintApplication, $dateCompensation]) }}"
                                                    title="सम्पादन गर्नुहोस्"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
