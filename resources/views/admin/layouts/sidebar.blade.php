<li class="{{request()->is('admin/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.dashboard')}}">
        <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/dashboard.svg')}}" height="25" loading="lazy">
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@if(Route::has('admin.digitalBoard.dashboard'))
    @can('digitalBoardDashboard_access')
        <li class="{{request()->routeIs('admin.digitalBoard.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.digitalBoard.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/digitalboard.svg')}}" height="25" loading="lazy">
                <span>नागरिक वडापत्र</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.circular.dashboard'))
    @can('circularDashboard_access')
        <li class="{{request()->routeIs('admin.circular.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.circular.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/darta chalani.svg')}}" height="25" loading="lazy">
                <span>दर्ता चलानी प्रणाली</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.listRegistrations.dashboard'))
    @can('listRegistrationDashboard_access')
        <li class="{{request()->routeIs('admin.listRegistrations.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.listRegistrations.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/listregistration.svg')}}" height="25" loading="lazy">
                <span>सुची दर्ता प्रणाली</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.helpDesk.dashboard'))
    <li class="{{request()->routeIs('admin.helpDesk.dashboard') ? 'active' : ''}}">
        <a href="{{route('admin.helpDesk.dashboard')}}">
            <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/helpdesk.svg')}}" height="25" loading="lazy">
            <span>हेल्प डेस्क</span>
        </a>
    </li>
@endif
@if(Route::has('admin.grievanceHandling.dashboard'))
    @can('grievanceHandlingDashboard_access')
        <li class="{{request()->routeIs('admin.grievanceHandling.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.grievanceHandling.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/grievancehandling.svg')}}" height="25" loading="lazy">
                <span>गुनासो</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.executiveMeeting.dashboard'))
    @can('executiveMeetingDashboard_access')
        <li class="{{request()->routeIs('admin.executiveMeeting.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.executiveMeeting.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/executivemeeting.svg')}}" height="25" loading="lazy">
                <span>बैठक व्यवस्थापन प्रणाली</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('emap.admin.dashboard'))
    @can('eMapDashboard_access')
        <li class="{{request()->is('emap.admin.dashboard') ? 'active' : ''}}">
            <a href="{{route('emap.admin.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/emap.svg')}}" height="25" loading="lazy">
                <span>घर-नक्सा पास</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.businessRegistration.dashboard'))
    @can('businessRegistrationDashboard_access')
        <li class="{{request()->is('admin.businessRegistration.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.businessRegistration.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/businessregistration.svg')}}" height="25"
                     loading="lazy">
                <span>व्यवसाय दर्ता</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.recommendation.dashboard'))
    @can('recommendationDashboard_access')
        <li class="{{request()->is('admin.recommendation.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.recommendation.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/recommendation.svg')}}" height="25" loading="lazy">
                <span>सिफारिस प्रणाली</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.taskManagement.dashboard'))
    @can('taskManagementDashboard_access')
        <li class="{{request()->is('admin.taskManagement.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.taskManagement.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/taskmanagement.svg')}}" height="25" loading="lazy">
                <span>कार्य व्यवस्थापन</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.roaster.dashboard'))
    @can('roasterDashboard_access')
        <li class="{{request()->is('admin.roaster.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.roaster.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/roaster.svg')}}" height="25" loading="lazy">
                <span>तालिम व्यवस्थापन</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.judicialCommittee.dashboard'))
    @can('judicialCommitteeDashboard_access')
        <li class="{{request()->is('admin.judicialCommittee.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.judicialCommittee.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/judicialcommittee.svg')}}" height="25" loading="lazy">
                <span>न्यायिक समिति</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.plan.dashboard'))
    @can('planDashboard_access')
        <li class="{{request()->is('admin.plan.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.plan.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/plan.svg')}}" height="25" loading="lazy">
                <span>योजना व्यवस्थापन</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.grant.dashboard'))
    @can('grantDashboard_access')
        <li class="{{request()->is('admin.grant.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.grant.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/grant.svg')}}" height="25" loading="lazy">
                <span>अनुदान व्यवस्थापन</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('admin.revenue.dashboard'))
    @can('revenueDashboard_access')
        <li class="{{request()->is('admin.revenue.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.revenue.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/revenue.svg')}}" height="25" loading="lazy">
                <span>राजस्व व्यवस्थापन</span>
            </a>
        </li>
    @endcan
@endif
@if(Route::has('identity.admin.dashboard'))
    @can('identityDashboard_access')
        <li class="{{request()->is('identity.admin.dashboard') ? 'active' : ''}}">
            <a href="{{route('identity.admin.dashboard')}}">
                <img class="sidebar-icon" src="{{asset('assets/backend/images/modules/identity.svg')}}" height="25" loading="lazy">
                <span>परिचयपत्र</span>
            </a>
        </li>
    @endcan
@endif
{{--<li class="{{request()->is('admin/tech') ? 'active' : ''}}">--}}
{{--    <a href="{{route('admin.tech')}}">--}}
{{--        <i class="fa fa-chalkboard-teacher"></i>--}}
{{--        <span> प्राविधिक मद्दत (सहयोग)</span>--}}
{{--    </a>--}}
{{--</li>--}}
{{--<li class="">--}}
{{--    <a href="{{asset('assets/backend/apk/mobile_app.apk')}}" download="{{asset('assets/backend/apk/mobile_app.apk')}}">--}}
{{--        <i class="fa fa-download"></i>--}}
{{--        <span> मोबाइल एप</span>--}}
{{--    </a>--}}
{{--</li>--}}
