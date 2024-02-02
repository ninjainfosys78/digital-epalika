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
                        <li class="breadcrumb-item active">बैठक विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">बैठक विवरण </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="collapse mb-2" id="collapseFilterForm">
                <div class="card p-0">
                    <div class="card-body px-0">
                        <form>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="committee" class="form-label">समिति</label>
                                    <select name="committee" data-toggle="select2" id="committee" class="form-control">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($committees as $committee)
                                            <option {{ request('committee') == $committee->id ? 'selected' : '' }}
                                                value="{{ $committee->id }}">
                                                {{ $committee->committee_name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                        <h4 class="header-title mb-0">बैठक विवरण</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            <button class="btn btn-sm mx-1 btn-outline-info waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            @can('meeting_create')
                                <a href="{{ route('admin.executiveMeeting.meeting.create') }}"
                                    class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="">
                        <table class="table table-sm table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>समिति</th>
                                    <th>बैठकको नाम</th>
                                    <th>विवरण</th>
                                    <th>पुनरावृत्ति</th>
                                    <th>शुरु हुने मिति</th>
                                    <th>अन्त्य मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($meetings as $meeting)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $meeting->committee->committee_name ?? '' }}</td>
                                        <td>{{ $meeting->meeting_name }}</td>
                                        <td>{{ $meeting->description }}</td>
                                        <td>{{ $meeting->recurrence->label() }}</td>
                                        <td>
                                            {{ $meeting->start_date }}
                                        </td>
                                        <td>
                                            {{ $meeting->end_date }}
                                        </td>

                                        <td class="d-flex">
                                            <div class="btn-group dropstart">

                                                <a style="width:75px;"
                                                    href="{{ route('admin.executiveMeeting.meeting.show', $meeting) }}"
                                                    title="विवरण हेर्नुहोस" class="btn btn-sm me-1 btn-primary">
                                                    <i class="fa fa-eye"> विवरण </i>
                                                </a>
                                                <button type="button"
                                                    class="btn btn-sm btn-info waves-effect waves-light dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-angle-down"></i>
                                                </button>

                                                <div class="dropdown-menu" style="">
                                                    @if ($meeting->is_print == 0)
                                                        @can('meeting_edit')
                                                            <a href="{{ route('admin.executiveMeeting.meeting.edit', $meeting) }}"
                                                                title="सम्पादन गर्नुहोस्" class="dropdown-item text-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-pencil"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                </svg>
                                                            </a>
                                                        @endcan
                                                        @can('meeting_delete')
                                                            <form
                                                                action="{{ route('admin.executiveMeeting.meeting.destroy', $meeting) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button data-bs-type="delete" type="submit"
                                                                    class="dropdown-item text-danger show_confirm {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                                    title="मेटाउनु होस्">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor" class="bi bi-trash"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                                        <path
                                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcan

                                                        @can('meetingDecision_access')
                                                            <a href="{{ route('admin.executiveMeeting.meeting.meetingDecision.index', $meeting) }}"
                                                                title="बैठक निर्णय" class="dropdown-item text-secondary">
                                                                <i class="fa fa-tasks"> बैठक निर्णय</i>
                                                            </a>
                                                        @endcan
                                                        @can('meetingDecision_access')
                                                            <a href="{{ route('admin.executiveMeeting.meeting.meetingMinute.index', $meeting) }}"
                                                                title="माइन्यूट" class="dropdown-item text-secondary">
                                                                <i class="fa fa-file"> माइन्यूट </i>
                                                            </a>
                                                        @endcan
                                                    @endif
                                                    <a href="javascript:void(0)"
                                                        data-meeting-print-url="{{ route('admin.executiveMeeting.meeting.printMinute', $meeting) }}"
                                                        title="माइन्यूट"
                                                        class="dropdown-item text-secondary showMeetingDetailModal">
                                                        <i class="fa fa-print"> माइन्यूट प्रिन्ट </i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $meetings->onEachSide(config('app.pagination_count'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="meeting-modal" class="modal fade" tabindex="-1" aria-labelledby="meeting-mdal" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white fw-bold mb-0" id="meeting-modal">
                        बैठक माइन्यूट
                    </h4>
                    <x-print-button target-element="meeting-data" title="बैठक माइन्यूट"
                        btn-class="btn-sm btn-outline-light mx-3" />
                    <button type="button" class="btn-close border" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="meeting-data">

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.showMeetingDetailModal').on('click', function(e) {
                    e.preventDefault()
                    $.ajax({
                        method: "GET",
                        url: $(this).data("meeting-print-url"),
                        success: function(resp) {
                            $('#meeting-modal').modal('toggle')
                            $('#meeting-data').html(resp.view)
                        },
                        error: function() {
                            alert("Something Went Wrong");
                        }
                    });
                })
            })
        </script>
        <script src="{{ asset('assets/backend/js/plugins/footable.min.js') }}"></script>
    @endpush
@endsection
