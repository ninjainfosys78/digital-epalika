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
                        <li class="breadcrumb-item active">गतिविधिहरू</li>
                    </ol>
                </div>
                <h4 class="page-title">गतिविधिहरू</h4>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">गतिविधिहरू</h4>
                    </div>
                </div>

                <div class="card-body px-0">
                    <ul class="list-unstyled timeline-sm">
                        @forelse($complaintApplication->complaintLogs as $complaintLog)
                            <li class="timeline-sm-item">
                                <span class="timeline-sm-date">
                                    <x-ad-to-bs id="-activity{{ $loop->iteration }}" :ad-date="$complaintLog->created_at->toDateString()" />
                                </span>
                                <p class="fw-bold">{{ $complaintLog->title }}</p>
                                <p class="text-muted mt-2">
                                    {{ $complaintLog->description }}
                            </li>
                        @empty
                            <li>कुनै डाटा उपलब्ध छैन !!!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
