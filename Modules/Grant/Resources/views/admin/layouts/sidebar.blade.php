<li class="{{ request()->is('admin/grant/dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.grant.dashboard') }}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>

<li class="{{ request()->is('admin/grant/grantee/*') ? 'active' : '' }}">
    <a href="#sidebarGrantee" {{ request()->is('admin/grant/grantee/*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-user"></i>
        <span> अनुदानग्राहीहरु </span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/grant/grantee/*') ? 'show' : '' }}" id="sidebarGrantee">
        <ul class="nav-second-level">
            @can('farmer_access')
                <li class="{{ request()->is('admin/grant/grantee/farmer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.farmer.index') }}">
                        <span> कृषक/व्यक्ति </span>
                    </a>
                </li>
            @endcan
            @can('cooperative_access')
                <li class="{{ request()->is('admin/grant/grantee/cooperative*') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.cooperative.index') }}">
                        <span> सहकारी </span>
                    </a>
                </li>
            @endcan
            @can('group_access')
                <li class="{{ request()->is('admin/grant/grantee/group*') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.group.index') }}">
                        <span> समूह </span>
                    </a>
                </li>
            @endcan
            @can('enterprise_access')
                <li class="{{ request()->is('admin/grant/grantee/enterprise*') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.enterprise.index') }}">
                        <span> निजि उधम/फर्म </span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>

@can('grant_access')
    <li>
        <a href="{{ route('admin.grant.grant.index') }}">
            <i class="fa fa-check-square"></i>
            <span>कार्यक्रम/क्रियाकलापहरु</span>
        </a>
    </li>
@endcan

@can('grantDetail_access')
    <li>
        <a href="{{ route('admin.grant.grantDetail.index') }}">
            <i class="fa fa-list-alt"></i>
            <span>अनुदान जारी</span>
        </a>
    </li>
@endcan

<li>
    <a href="{{ route('admin.grant.cashGrant.index') }}">
        <i class="fa fa-list-alt"></i>
        <span>नगद अनुदानको लागि </span>
    </a>
</li>


<li class="{{ request()->is('admin/grant/report/*') ? 'active' : '' }}">
    <a href="#sidebarGrantReport" {{ request()->is('admin/grant/report/*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-file-contract"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/grant/report/*') ? 'show' : '' }}" id="sidebarGrantReport">
        <ul class="nav-second-level">
            @can('farmerReport_access')
                <li class="{{ request()->is('admin/grant/report/farmer') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.report.farmer.index') }}">
                        <span> सेवाग्राही रिपोर्ट </span>
                    </a>
                </li>
            @endcan
            @can('groupReport_access')
                <li class="{{ request()->is('admin/grant/report/group') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.report.group.index') }}">
                        <span>समूह रिपोर्ट </span>
                    </a>
                </li>
            @endcan
            @can('enterpriseReport_access')
                <li class="{{ request()->is('admin/grant/report/enterprise') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.report.enterprise.index') }}">
                        <span>निजि/उधम रिपोर्ट </span>
                    </a>
                </li>
            @endcan
            @can('cooperativeReport_access')
                <li class="{{ request()->is('admin/grant/report/cooperative') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.report.cooperative.index') }}">
                        <span>सहकारी रिपोर्ट </span>
                    </a>
                </li>
            @endcan
            @can('grantReport_access')
                <li class="{{ request()->is('admin/grant/report/program') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.report.grant.program-report') }}">
                        <span>कार्यक्रम अनुसार रिपोर्ट </span>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</li>
<li class="{{ request()->is('admin/grant/setting/*') ? 'active' : '' }}">
    <a href="#sidebarGrantSetting" {{ request()->is('admin/grant/setting/*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सेटिङ</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/grant/setting/*') ? 'show' : '' }}" id="sidebarGrantSetting">
        <ul class="nav-second-level">
            @can('grantType_access')
                <li class="{{ request()->is('admin/grant/setting/infrastructure') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.setting.grantType.index') }}">
                        <span> अनुदानको प्रकार </span>
                    </a>
                </li>
            @endcan
            @can('cooperativeType_access')
                <li class="{{ request()->is('admin/grant/setting/infrastructure') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.setting.cooperativeType.index') }}">
                        <span> सहकारीको प्रकार </span>
                    </a>
                </li>
            @endcan
            @can('affiliation_access')
                <li class="{{ request()->is('admin/grant/setting/infrastructure') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.setting.affiliation.index') }}">
                        <span> सहकारीको आवध्ता </span>
                    </a>
                </li>
            @endcan
            @can('enterpriseType_access')
                <li class="{{ request()->is('admin/grant/setting/infrastructure') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.setting.enterpriseType.index') }}">
                        <span> उद्यमको प्रकार </span>
                    </a>
                </li>
            @endcan

            @can('grantOffice_access')
                <li class="{{ request()->is('admin/grant/setting/infrastructure') ? 'active' : '' }}">
                    <a href="{{ route('admin.grant.setting.grantOffice.index') }}">
                        <span> अनुदान दिने सस्था</span>
                    </a>
                </li>
            @endcan
           
            <li class="{{ request()->is('admin/grant/setting/infrastructure') ? 'active' : '' }}">
                <a href="{{ route('admin.grant.setting.helplessnessType.index') }}">
                    <span>असहायताको  प्रकार </span>
                </a>
            </li>
       



        </ul>
    </div>
</li>
