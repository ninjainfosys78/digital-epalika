@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">टेम्प्लेट सूची</li>
                    </ol>
                </div>
                <h4 class="page-title">टेम्प्लेट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header search-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">टेम्प्लेट सूची</h4>
                        @can('planTemplate_create')
                            <a href="{{ route('admin.plan.planTemplate.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ टेम्प्लेट थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शिर्षक </th>
                                    <th>बर्ग</th>
                                    <th>उपभोक्ता समिति/बोलपत्र</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($planTemplates as $planTemplate)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $planTemplate->title }}</td>
                                        <td>{{ $planTemplate->type?->label() }}</td>
                                        <td>{{ $planTemplate->template_for?->label() ?? 'उपभोक्ता समिति बोलपत्र (दुबै)' }}
                                        </td>
                                        <td>
                                            @can('planTemplate_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.plan.planTemplate.edit', $planTemplate) }}"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }} "
                                                    title="सम्पादन गर्नुहोस्">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
