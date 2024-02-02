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

                        <li class="breadcrumb-item active">तारिख पर्चा</li>
                    </ol>
                </div>
                <h4 class="page-title">तारिख पर्चा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">उजुरी फारम सूची</h4>
                        @can('dateSheet_create')
                            <a href="{{ route('admin.judicialCommittee.complaintApplication.dateSheet.create', $complaintApplication) }}"
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
                                    <th>हाजिर हुने मिति</th>
                                    <th>हाजिर हुने समय</th>
                                    <th>पेश मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaintApplication->dateSheets as $dateSheet)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dateSheet->appearance_date }}</td>
                                        <td>{{ $dateSheet->appearance_time }}</td>
                                        <td>{{ $dateSheet->submitted_date }}</td>
                                        <td class="d-flex">
                                            @can('dateSheet_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.dateSheet.show', [$complaintApplication, $dateSheet]) }}"
                                                    title="विवरण हेर्नुहोस्"
                                                    class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('dateSheet_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.dateSheet.edit', [$complaintApplication, $dateSheet]) }}"
                                                    title="सम्पादन गर्नुहोस्"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
