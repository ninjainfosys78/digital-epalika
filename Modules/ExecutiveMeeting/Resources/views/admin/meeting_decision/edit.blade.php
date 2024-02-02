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
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('admin.executiveMeeting.meeting.meetingDecision.index', $meeting) }}">निर्णयहरु</a>
                        </li>
                        <li class="breadcrumb-item active">निर्णयहरु सम्पादन गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">निर्णयहरु </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">निर्णयहरु सम्पादन गर्नुहोस</h4>
                        <a href="{{ route('admin.executiveMeeting.meeting.meetingDecision.index', $meeting) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> निर्णयहरु बिवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route('admin.executiveMeeting.meeting.meetingDecision.update', [$meeting, $meetingDecision]) }}"
                        method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <x-date-input-component nameNe="date" :editDateNe="$meetingDecision->date" idNe="date" labelNe="मिति *"
                                    idEn="en_date" nameEn="en_date" :editDateEn="$meetingDecision->en_date" labelEn="Date" :getTodayDate="false" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="chairman" class="form-label">अध्यक्ष * </label>
                                <input type="text" name="chairman" value="{{ old('chairman',$meetingDecision->chairman) }}"
                                class="form-control @error('chairman') is-invalid @enderror" id="chairman"
                                placeholder="अध्यक्ष" required />
                            @error('chairman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">निर्णय * </label>
                                <textarea name="description" id="description" cols="30" placeholder="निर्णय" rows="5"
                                    class="form-control ckEditor @error('description') is-invalid @enderror">{{ old('description', $meetingDecision->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
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
