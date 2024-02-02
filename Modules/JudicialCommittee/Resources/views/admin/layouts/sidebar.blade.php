<li class="{{ request()->is('admin/grant/dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.judicialCommittee.dashboard') }}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('judicialMember_access')
    <li>
        <a href="{{ route('admin.judicialCommittee.judicialMember.index') }}">
            <i class="fa fa-users"></i>
            <span> न्यायिक सदस्य विवरण </span>
        </a>
    </li>
@endcan
@can('complaintApplication_access')
    <li>
        <a href="{{ route('admin.judicialCommittee.complaintApplication.index') }}">
            <i class="fa fa-clipboard-check"></i>
            <span>निबेदन फारम</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin.judicialCommittee.registeredApplication') }}">
            <i class="fa fa-clipboard"></i>
            <span>दर्ता भएका उजुरी</span>
        </a>
    </li>
@endcan
<li class="{{request()->is('admin/judicialcommittee/report*') ? 'active' : ''}}">
    <a href="#sidebarJudicialCommitteeReport"
       {{request()->is('admin/judicialcommittee/report*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/judicialcommittee/report*') ? 'show' : ''}}"
         id="sidebarJudicialCommitteeReport">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/plan/report') ? 'active' : ''}}">
                <a href="{{route('admin.judicialCommittee.report.index')}}">
                    <span>प्रतिवेदनहरु</span>
                </a>
            </li>
            <li class="{{request()->is('admin/judicialCommittee/report/complainant-defendant-report') ? 'active' : ''}}">
                <a href="{{route('admin.judicialCommittee.report.complainant-defendant-report-page')}}">
                    <span>पक्ष/विपक्ष अनुसार उजुरी रिपोर्ट</span>
                </a>
            </li>
            <li class="{{request()->is('admin/judicialCommittee/report/complaint-subject-wise-report') ? 'active' : ''}}">
                <a href="{{route('admin.judicialCommittee.report.complaint-subject-wise-report-page')}}">
                    <span>उजुरी विषय अनुसारको रिपोर्ट </span>
                </a>
            </li>
{{--            <li class="{{request()->is('admin/judicialCommittee/report/complainant-defendant-report') ? 'active' : ''}}">--}}
{{--                <a href="{{route('admin.judicialCommittee.report.complainant-defendant-report-page')}}">--}}
{{--                    <span>वडा अनुसारको रिपोर्ट</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
</li>
<li class="{{ request()->is('admin/judicialcommittee/setting/*') ? 'active' : '' }}">
    <a href="#sidebarJudicialCommitteeSetting"
       {{ request()->is('admin/judicialcommittee/setting/*') ? 'aria-expanded=true' : '' }} data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सेटिङ</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/judicialcommittee/setting/*') ? 'show' : '' }}"
         id="sidebarJudicialCommitteeSetting">
        <ul class="nav-second-level">
            @can('lawsuitNature_access')
                <li class="{{ request()->routeIs('admin.judicialCommittee.setting.lawsuitNature.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.judicialCommittee.setting.lawsuitNature.index') }}">
                        <span> मुद्दा प्रकृति </span>
                    </a>
                </li>
            @endcan
            @can('complaintSubject_access')
                <li
                    class="{{ request()->routeIs('admin.judicialCommittee.setting.complaintSubject.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.judicialCommittee.setting.complaintSubject.index') }}">
                        <span> उजुरी विषय </span>
                    </a>
                </li>
            @endcan
            @can('judicialCommitteeTemplate_access')
                <li
                    class="{{ request()->routeIs('admin.judicialCommittee.setting.judicialCommitteeTemplate.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.judicialCommittee.setting.judicialCommitteeTemplate.index') }}">
                        <span> टेम्प्लेट </span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
