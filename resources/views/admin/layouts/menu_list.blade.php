<div class="bg-main menu-list" data-simplebar>
    <div class="row g-0">
        @if(Route::has('admin.dashboard'))
            <div class="col">
                <a class="dropdown-icon-item" href="{{route('admin.dashboard')}}">
                    <img src="{{asset(config('app.logo_sm'))}}" alt="">
                    <span>मुख्य ड्यासबोर्ड</span>
                </a>
            </div>
        @endif
    </div>
    <div class="row g-0">
        @if(Route::has('admin.digitalBoard.dashboard'))
            @can('digitalBoardDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.digitalBoard.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/digitalboard.png')}}" alt="">
                        <span>नागरिक वडापत्र</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.circular.dashboard'))
            @can('circularDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.circular.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/circular.png')}}" alt="">
                        <span>दर्ता चलानी प्रणाली</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.listRegistrations.dashboard'))
            @can('listRegistrationDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.listRegistrations.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/listregistration.png')}}" alt="">
                        <span>सुची दर्ता प्रणाली</span>
                    </a>
                </div>
            @endcan
        @endif
    </div>
    <div class="row g-0">
        @if(Route::has('admin.grievanceHandling.dashboard'))
            @can('grievanceHandlingDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.grievanceHandling.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/grievancehandling.png')}}" alt="">
                        <span>ई-गुनासो</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.executiveMeeting.dashboard'))
            @can('executiveMeetingDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.executiveMeeting.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/executivemeeting.png')}}" alt="">
                        <span>ई-कार्यपालिका</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('emap.admin.dashboard'))
            @can('eMapDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('emap.admin.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/emap.png')}}" alt="">
                        <span>घर-नक्सा पास</span>
                    </a>
                </div>
            @endcan
        @endif
    </div>
    <div class="row g-0">
        @if(Route::has('admin.businessRegistration.dashboard'))
            @can('businessRegistrationDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item"
                       href="{{route('admin.businessRegistration.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/businessregistration.png')}}" alt="">
                        <span>व्यवसाय दर्ता</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.recommendation.dashboard'))
            @can('recommendationDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.recommendation.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/recommendation.png')}}" alt="">
                        <span>शिफारिस प्रणाली</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.taskManagement.dashboard'))
            @can('taskManagementDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.taskManagement.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/taskmanagement.png')}}" alt="">
                        <span>कार्य व्यवस्थापन</span>
                    </a>
                </div>
            @endcan
        @endif
    </div>
    <div class="row g-0">
        @if(Route::has('admin.roaster.dashboard'))
            @can('roasterDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.roaster.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/roaster.png')}}" alt="">
                        <span>तालिम व्यवस्थापन</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.judicialCommittee.dashboard'))
            @can('judicialCommitteeDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.judicialCommittee.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/judicialcommittee.png')}}" alt="">
                        <span>न्यायिक समिति</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.plan.dashboard'))
            @can('planDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.plan.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/plan.png')}}" alt="">
                        <span>योजना व्यवस्थापन</span>
                    </a>
                </div>
            @endcan
        @endif
    </div>
    <div class="row g-0">
        @if(Route::has('admin.grant.dashboard'))
            @can('grantDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.grant.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/grant.png')}}" alt="">
                        <span>अनुदान व्यवस्थापन</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('admin.revenue.dashboard'))
            @can('revenueDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('admin.revenue.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/revenue.png')}}" alt="">
                        <span>राजस्व व्यवस्थापन</span>
                    </a>
                </div>
            @endcan
        @endif
        @if(Route::has('identity.admin.dashboard'))
            @can('identityDashboard_access')
                <div class="col">
                    <a class="dropdown-icon-item" href="{{route('identity.admin.dashboard')}}">
                        <img src="{{asset('assets/backend/images/modules/identity.png')}}" alt="">
                        <span>परिचयपत्र</span>
                    </a>
                </div>
            @endcan
        @endif
    </div>
</div>
