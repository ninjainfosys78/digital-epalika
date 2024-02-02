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
                                <i class="fas fa-building avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$todayTaskCount}}</span></h3>
                            <p class="text-muted font-15 mb-0">आजको जम्मा कार्यहरु</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-map avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$taskSubmittedUserCount}}</span>/<span data-plugin="counterup">{{$taskNotSubmittedUserCount}}</span></h3>
                            <p class="text-muted font-15 mb-0 text-truncate">आजको कार्य भरेको/नभरेको कर्मचारीहरु</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 border-end">
                        <div class="d-flex flex-column align-items-center">
                            <div @class(["avatar-sm rounded-circle","bg-blue"=>!empty($todayActivity),"bg-danger"=>empty($todayActivity)])>
                                @if(!empty($todayActivity))
                                <i class="fas fa-check-circle avatar-title font-18 text-white"></i>
                                @else
                                <a href="{{route('admin.taskManagement.activity.create')}}"><i class="fas fa-times-circle avatar-title font-18 text-white"></i></a>
                                @endif
                            </div>
                            <p class="text-muted font-15 mt-3 mb-0">के तपाईंले आजको कार्य भर्नुभयो?</p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex flex-column align-items-center">
                            <div class="avatar-sm bg-blue rounded-circle">
                                <i class="fas fa-map avatar-title font-18 text-white"></i>
                            </div>
                            <h3 class="mb-0 mt-1"><span data-plugin="counterup">{{$currentUserTodayTaskCount}}</span></h3>
                            <p class="text-muted font-15 mb-0">आफुले आज गरेको कार्यहरु</p>
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- <div class="row" id="charts" data-chart-url="{{route('admin.taskManagement.dashboard')}}">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="dailyTask" chart-type="column" chart-title="पछिल्लो ७ दिनको कार्य विवरण"></div>
                    <div class="loading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row mt-2" id="charts" data-chart-url="{{route('admin.taskManagement.dashboard.ajax')}}">

    <div class="col-md-12">
        <div class="card">
            <h4>
                पछिल्लो ७ दिनको कार्य विवरण
            </h4>
            <div class="card-body">
                <canvas id="dailyTask" chart-type="bar"></canvas>
            </div>

        </div>
    </div>
    </div>

    @push('scripts')
    <script src="{{asset('assets/backend/js/chart.js')}}"></script>
    <script type="module" src="{{asset('assets/backend/js/chartInit.js')}}"></script>
@endpush
@endsection
