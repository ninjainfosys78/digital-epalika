@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
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
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">बैठक विवरण</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            <a href="{{ route('admin.executiveMeeting.meeting.index') }}"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                <i class="fa fa-list"></i> बैठक लिस्ट</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>समिति : </b> {{ $meeting->committee->committee_name ?? '' }}</td>
                                    <td><b>बैठकको नाम : </b> {{ $meeting->meeting_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>शुरु हुने मिति : </b> {{ $meeting->start_date }}</td>
                                    <td><b>अन्त्य मिति : </b> {{ $meeting->end_date }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>बैठक विवरण : </b> {{ $meeting->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="header-title mb-0">बैठक एजेण्डा तथा निर्णयहरु</h5>
                    <x-print-button title="बैठक एजेण्डा तथा निर्णयहरु" target-element="meeting-decisions" />
                </div>
                <div class="card-body" id="meeting-decisions">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.सं.</th>
                                    {{-- <th>प्रस्ताव नं.</th> --}}
                                    <th>मिति</th>
                                    <th>निर्णय</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meeting->meetingDecisions as $meetingDecision)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $meetingDecision->meetingAgenda->proposal ?? '' }}</td> --}}
                                        <td>{{ $meetingDecision->date }}</td>
                                        <td>{!! $meetingDecision->description !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="header-title mb-0">उपस्थित सदस्यहरु</h5>
                    <x-print-button title="उपस्थित सदस्यहरु" target-element="meeting-participants" />
                </div>
                <div class="card-body" id="meeting-participants">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.सं.</th>
                                    <th>नाम</th>
                                    <th>पद</th>
                                    <th>फोन</th>
                                    <th>इमेल</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($meeting->meetingParticipants as $meetingParticipant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $meetingParticipant->name }}</td>
                                        <td>{{ $meetingParticipant->designation }}</td>
                                        <td>{{ $meetingParticipant->phone }}</td>
                                        <td>{{ $meetingParticipant->email }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            तालिकामा कुनै डाटा उपलब्ध छैन !!!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="header-title mb-0"> माइन्युट</h5>
                    <x-print-button title="माइन्युट" target-element="meeting-minute" />
                </div>
                <div class="card-body" id="meeting-minute">
                    {!! $meeting->meetingMinute->description ?? '' !!}
                </div>
            </div>
        </div>
    </div>
@endsection
