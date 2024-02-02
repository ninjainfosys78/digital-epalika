<li class="{{request()->is('admin/executivemeeting/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.executiveMeeting.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('committeeMember_access')
    <li class="{{request()->is('admin/executiveMeeting/committee/*') ? 'active' : ''}}">
        <a href="#sidebarCommitteeMembers"
           {{request()->is('admin/executiveMeeting/committee/*') ? 'aria-expanded=true' : ''}}
           data-bs-toggle="collapse">
            <i class="fa fa-users"></i>
            <span> समिति सदस्य</span>
            <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
        </a>
        <div class="collapse {{request()->is('admin/executiveMeeting/committee/*') ? 'active' : ''}}"
             id="sidebarCommitteeMembers">
            <ul class="nav-second-level">
                @foreach($sharedCommittees as $sharedCommittee)
                    <li class="{{request()->is('admin/executiveMeeting/committee') ? 'active' : ''}}">
                        <a href="{{route('admin.executiveMeeting.committee.committeeMember.index',$sharedCommittee)}}">
                            <span>{{$sharedCommittee->committee_name}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </li>
@endcan
@can('meeting_access')
    <li class="{{request()->is('admin/executivemeeting/meeting*') ? 'active' : ''}}">
        <a href="{{route('admin.executiveMeeting.meeting.index')}}">
            <i class="fa fa-layer-group"></i>
            <span> बैठक </span>
        </a>
    </li>
    <li class="{{request()->is('admin/executivemeeting/calendar*') ? 'active' : ''}}">
        <a href="{{route('admin.executiveMeeting.calendar.index')}}">
            <i class="fa fa-calendar-alt"></i>
            <span> बैठक क्यालेन्डर  </span>
        </a>
    </li>
@endcan
<li class="{{request()->is('admin/executiveMeeting/reports/*') ? 'active' : ''}}">
    <a href="#sidebarExecutiveMeeting"
       {{request()->is('admin/executiveMeeting/reports/*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-file"></i>
        <span> रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/executiveMeeting/reports/*') ? 'active' : ''}}"
         id="sidebarExecutiveMeeting">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/executiveMeeting/reports') ? 'active' : ''}}">
                <a href="{{route('admin.executiveMeeting.report.index')}}">
                    <span>प्रतिवेदन</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="{{request()->is('admin/executiveMeeting/setting/*') ? 'active' : ''}}">
    <a href="#sidebarExecutiveMeetingSetting"
       {{request()->is('admin/executiveMeeting/setting/*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span> सेटिङ</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/executiveMeeting/setting/*') ? 'active' : ''}}"
         id="sidebarExecutiveMeetingSetting">
        <ul class="nav-second-level">
            @can('committeeType_access')
                <li class="{{request()->is('admin/executiveMeeting/setting/committeeType*') ? 'active' : ''}}">
                    <a href="{{route('admin.executiveMeeting.setting.committeeType.index')}}">
                        <span> समिति प्रकार</span>
                    </a>
                </li>
            @endcan
            @can('committee_access')
                <li class="{{request()->is('admin/executiveMeeting/setting/committee*') ? 'active' : ''}}">
                    <a href="{{route('admin.executiveMeeting.setting.committee.index')}}">
                        <span> समिति</span>
                    </a>
                </li>
            @endcan
            @can('committee_access')
            <li class="{{request()->is('admin/executiveMeeting/setting/minuteSetting*') ? 'active' : ''}}">
                <a href="{{route('admin.executiveMeeting.setting.minuteSetting.index')}}">
                    <span> माइन्यूट</span>
                </a>
            </li>
        @endcan
        </ul>
    </div>
</li>
