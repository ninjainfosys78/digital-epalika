@extends('admin.layouts.master')

@section('content')
<div class="row mt-2">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-users avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{ $members_count }}</span></h3>
                            <p class="text-muted font-15 mb-0">समिति सदस्यहरु</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-handshake avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{ $meetings_count }}</span></h3>
                            <p class="text-muted font-15 mb-0 text-truncate">जम्म्मा वैठक</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-handshake avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{ $upcoming_meetings }}</span></h3>
                            <p class="text-muted font-15 mb-0">आगामी बैठकहरू</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-handshake avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{ $completed_meetings }}</span></h3>
                            <p class="text-muted font-15 mb-0">सम्पन्न बैठकहरू</p>
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<div class="row mt-2" id="charts" data-chart-url="{{route('admin.executiveMeeting.dashboard.ajax')}}">
    <div class="col-md-12">
        <div class="card">
            <h4>
                चालु आर्थिक(2080/081) समिति अनुसारका सम्पूर्ण बैठक
            </h4>
            <div class="card-body">
                <canvas id="committeeWiseMeetings" chart-type="bar"></canvas>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="{{asset('assets/backend/js/chart.js')}}"></script>
<script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
@endpush
@endsection