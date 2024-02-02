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
                            <a href="{{ route('admin.executiveMeeting.meeting.meetingAgenda.index', $meeting) }}">
                                बैठक विवरण
                            </a>
                        </li>
                        <li class="breadcrumb-item active">बैठक एजेन्डा थप्नुहोस्</li>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">बैठक एजेन्डा थप्नुहोस्</h4>
                        <a href="{{ route('admin.executiveMeeting.meeting.meetingAgenda.index', $meeting) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> बैठक एजेन्डा सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.executiveMeeting.meeting.meetingAgenda.store', $meeting) }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="proposal" class="form-label">प्रस्ताव *</label>
                                <input type="text" name="proposal" value="{{ old('proposal') }}"
                                    class="form-control @error('proposal') is-invalid @enderror" id="proposal"
                                    placeholder="प्रस्ताव " required />
                                @error('proposal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">विवरण</label>
                                <textarea name="description" id="description" placeholder="विवरण" class="form-control" cols="30" rows="3">{{ old('description') }}</textarea>

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
