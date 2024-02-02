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
                        <li class="breadcrumb-item active"> बैठक निर्णयहरु </li>
                    </ol>
                </div>
                <h4 class="page-title">निर्णयहरु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">बैठक निर्णयहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @can('meetingDecision_create')
                                <a href="{{ route('admin.executiveMeeting.meeting.meetingDecision.create', $meeting) }}"
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

                                    <th>मिति</th>
                                    <th>निर्णय</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($meeting->meetingDecisions as $meetingDecision)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $meetingDecision->date }}</td>
                                        <td>{!! $meetingDecision->description !!}</td>

                                        <td class="text-nowrap d-flex gap-1">
                                            @can('meetingDecision_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.executiveMeeting.meeting.meetingDecision.edit', [$meeting, $meetingDecision]) }}"
                                                    title="सम्पादन गर्नुहोस्"
                                                    class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('meetingDecision_delete')
                                                <form
                                                    action="{{ route('admin.executiveMeeting.meeting.meetingDecision.destroy', [$meeting, $meetingDecision]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete" type="submit"
                                                        class="btn btn-xs btn-outline-danger show_confirm {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        title="मेटाउनु होस्">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="7">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
