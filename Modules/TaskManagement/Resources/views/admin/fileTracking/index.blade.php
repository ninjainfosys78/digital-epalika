@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.taskManagement.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">फाइल ट्रयाकिङ</li>
                    </ol>
                </div>
                <h4 class="page-title">फाइल ट्रयाकिङ </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header search-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">फाइल ट्रयाकिङ </h4>
                        <div class="d-flex flex-wrap gap-1 align-items-center">
                            @includeIf('inc.filter_form')
                            @can('fileTracking_create')
                                <a href="{{ route('admin.taskManagement.fileTracking.create') }}"
                                    class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>दर्ता नं.</th>
                                    <th>हार्डकपि/सफ्टकपि</th>
                                    <th>कैफियत</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fileTrackings as $fileTracking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fileTracking->registration_no }}</td>
                                        <td>{{ $fileTracking->is_hardcopy ? 'हार्डकपि' : 'सफ्टकपि' }}</td>
                                        <td>{{ $fileTracking->remarks }}</td>
                                        <td class="d-flex gap-1">

                                            <a href="{{ route('admin.taskManagement.fileTracking.show', $fileTracking) }}"
                                                title="हेर्नुहोस" class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.taskManagement.fileTracking.destroy', $fileTracking) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                    title="मेटाउनु होस्">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $fileTrackings->onEachSide(config('app.pagination_count'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
