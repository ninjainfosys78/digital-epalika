<li class="{{ request()->is('admin/taskmanagement/dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.taskManagement.dashboard') }}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('taskActivity_access')
    <li class="{{ request()->RouteIs('admin.taskManagement.activity.*') ? 'active' : '' }}">
        <a href="{{ route('admin.taskManagement.activity.index') }}">
            <i class="fa fa-tasks"></i>
            <span>क्रियाकलाप</span>
        </a>
    </li>
@endcan
@can('allTaskActivity_access')
    <li class="{{ request()->RouteIs('admin.taskManagement.allActivity.*') ? 'active' : '' }}">
        <a href="{{ route('admin.taskManagement.allActivity.index') }}">
            <i class="fa fa-tasks"></i>
            <span>सबै क्रियाकलाप</span>
        </a>
    </li>
@endcan

<li class="{{ request()->is('admin/taskManagement/fileTracking*') ? 'active' : '' }}">
    <a href="#sidebarFileTracking" {{ request()->is('admin/taskManagement/fileTracking*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-file"></i>
        <span> फाइल ट्रयाकिङ</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/taskManagement/fileTracking*') ? 'show' : '' }}"
        id="sidebarFileTracking">
        <ul class="nav-second-level">
            @can('fileTracking_access')
                <li class="{{ request()->is('admin/taskManagement/fileTracking') ? 'active' : '' }}">
                    <a href="{{ route('admin.taskManagement.fileTracking.index') }}">
                        <span>फाइल ट्रयाकिङ लिस्ट</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<li class="{{ request()->is('admin/taskManagement/report*') ? 'active' : '' }}">
    <a href="#sidebarTaskManagementReport"
        {{ request()->is('admin/taskManagement/report*') ? 'aria-expanded=true' : '' }} data-bs-toggle="collapse">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/taskManagement/report*') ? 'show' : '' }}"
        id="sidebarTaskManagementReport">
        <ul class="nav-second-level">

            <li class="{{ request()->is('admin/taskManagement/report') ? 'active' : '' }}">
                <a href="{{ route('admin.taskManagement.report.index') }}">
                    <span>प्रतिवेदनहरु</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/taskManagement/report/daily-report') ? 'active' : '' }}">
                <a href="{{ route('admin.taskManagement.report.dailyReport') }}">
                    <span>दैनिक रिपोर्ट</span>
                </a>
            </li>
            {{-- <li class="{{ request()->is('admin/taskManagement/report') ? 'active' : '' }}">
                <a href="{{ route('admin.taskManagement.report.index') }}">
                    <span>साप्ताहिक रिपोर्ट</span>
                </a>
            </li> --}}
            <li class="{{ request()->is('admin/taskManagement/report/monthly-report') ? 'active' : '' }}">
                <a href="{{ route('admin.taskManagement.report.monthlyReport') }}">
                    <span>मासिक रिपोर्ट</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/taskManagement/report/trimonthly-report') ? 'active' : '' }}">
                <a href="{{ route('admin.taskManagement.report.trimonthlyReport') }}">
                    <span>त्रैमासिक रिपोर्ट</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/taskManagement/report/quarterly-report') ? 'active' : '' }}">
                <a href="{{ route('admin.taskManagement.report.quarterlyReport') }}">
                    <span>चौमासिक रिपोर्ट</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/taskManagement/report/yearly-report') ? 'active' : '' }}">
                <a href="{{ route('admin.taskManagement.report.yearlyReport') }}">
                    <span>वार्षिक रिपोर्ट</span>
                </a>
            </li>
        </ul>
    </div>
</li>
