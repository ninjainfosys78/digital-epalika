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

                        <li class="breadcrumb-item active">प्रतिवादी म्याद जारी</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रतिवादी म्याद जारी</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">प्रतिवादी म्याद जारी सूची</h4>
                        @can('defendantIssuedDeadline_create')
                            <a href="{{ route('admin.judicialCommittee.complaintApplication.defendantIssuedDeadline.create', $complaintApplication) }}"
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
                                    <th>सहभागी हुनुपर्ने दिन</th>
                                    <th>पेश मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaintApplication->defendantIssuedDeadlines as $defendantIssuedDeadline)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $defendantIssuedDeadline->day_to_attend }}</td>
                                        <td>{{ $defendantIssuedDeadline->submitted_date }}</td>
                                        <td class="d-flex">
                                            @can('defendantIssuedDeadline_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.defendantIssuedDeadline.show', [$complaintApplication, $defendantIssuedDeadline]) }}"
                                                    title="विवरण हेर्नुहोस्"
                                                    class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('defendantIssuedDeadline_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.defendantIssuedDeadline.edit', [$complaintApplication, $defendantIssuedDeadline]) }}"
                                                    title="सम्पादन गर्नुहोस्"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
