@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">बैठक एजेन्डा</li>
                    </ol>
                </div>
                <h4 class="page-title">बैठक एजेन्डा </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">बैठक एजेन्डा</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @can('meetingAgenda_create')
                                <a href="{{ route('admin.executiveMeeting.meeting.meetingAgenda.create', $meeting) }}"
                                    class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>प्रस्ताब</th>
                                    <th>विवरण</th>
                                    <th>सम्पन्न भए/नभएको</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($meeting->meetingAgendas as $meetingAgenda)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $meetingAgenda->proposal }}</td>
                                        <td>{{ $meetingAgenda->description }}</td>
                                        <td>
                                            @can('meetingAgenda_edit')
                                                <a href="{{ route('admin.executiveMeeting.meeting.meetingAgenda.updateStatus', [$meeting, $meetingAgenda]) }}"
                                                    class="btn btn-xs btn-outline-{{ $meetingAgenda->is_final ? 'primary' : 'danger' }}"
                                                    title="सम्पन्न {{ $meetingAgenda->is_final ? 'भएको' : 'नभएको' }}">
                                                    <i
                                                        class="fa  {{ $meetingAgenda->is_final ? ' fa-check' : 'fa-window-close' }}"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        <td class="d-flex gap-1">
                                            @can('meetingAgenda_edit')
                                                <a href="{{ route('admin.executiveMeeting.meeting.meetingAgenda.edit', [$meeting, $meetingAgenda]) }}"
                                                    class="btn btn-xs btn-outline-warning" title="सम्पादन गर्नुहोस्">

                                                    <i class="fa fa-edit"></i>

                                                </a>
                                            @endcan
                                            @can('meetingAgenda_delete')
                                                <form
                                                    action="{{ route('admin.executiveMeeting.meeting.meetingAgenda.destroy', [$meeting, $meetingAgenda]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger show_confirm" title="मेटाउनु होस्">

                                                        <i class="fa fa-trash"></i>

                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="5">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
