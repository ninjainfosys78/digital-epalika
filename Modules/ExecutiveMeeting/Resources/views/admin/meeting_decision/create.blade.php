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
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('admin.executiveMeeting.meeting.meetingDecision.index', $meeting) }}">निर्णयहरु</a>
                        </li>
                        <li class="breadcrumb-item active"> नयाँ निर्णयहरु थप्नुहोस्</li>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ निर्णयहरु थप्नुहोस्</h4>
                        <a href="{{ route('admin.executiveMeeting.meeting.meetingDecision.index', $meeting) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> निर्णयहरु बिवरण
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.executiveMeeting.meeting.meetingDecision.store', $meeting) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border border-secondary p-2 mb-2">
                            <legend class="font-16 text-secondary">
                                <strong> उपस्थित सदस्यहरु </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>नाम</th>
                                                    <th>पद</th>
                                                    <th>फोन</th>
                                                    <th>इमेल</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($committeeMembers as $committeeMember)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="meetingParticipants[]"
                                                                    value="{{ $committeeMember->id }}"
                                                                    {{ in_array($committeeMember->id, $meeting->meetingParticipants->pluck('committee_member_id')->toArray()) ? 'checked' : '' }}
                                                                    id="committeeMembers{{ $loop->index }}">
                                                                <label class="form-check-label"
                                                                    for="committeeMembers{{ $loop->index }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>{{ $committeeMember->name }}</td>
                                                        <td>{{ $committeeMember->designation }}</td>
                                                        <td>{{ $committeeMember->phone }}</td>
                                                        <td>{{ $committeeMember->email }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @error('meetingParticipants')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                        @error('meetingParticipants.*')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>



                        <fieldset class="border border-secondary p-2 mb-2">
                            <legend class="font-16 text-secondary">
                                <strong>निर्णय </strong>
                            </legend>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <x-date-input-component nameNe="date" :editDateNe="$meeting->meetingDecision->date ?? ''" idNe="date" labelNe="मिति *"
                                        idEn="en_date" nameEn="en_date" labelEn="Date" :editDateEn="$meeting->meetingDecision->en_date ?? ''"
                                        :getTodayDate="false" />
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="chairman" class="form-label">अध्यक्ष * </label>
                                    <input type="text" name="chairman"
                                        value="{{ old('chairman', $meeting->meetingDecision->chairman ?? '') }}"
                                        class="form-control @error('chairman') is-invalid @enderror" id="chairman"
                                        placeholder="अध्यक्ष" required />
                                    @error('chairman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="description" class="form-label">निर्णय * </label>
                                    <textarea name="description" id="description" cols="30" placeholder="निर्णय" rows="5"
                                        class="form-control ckEditor @error('description') is-invalid @enderror">{{ old('description', $meeting->meetingDecision->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>




                        @livewire('invited-member-livewire', ['meeting' => $meeting])

                        <button type="submit" class="mb-2 btn btn-primary">
                            Save
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
@endpush
