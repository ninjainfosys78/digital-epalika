<li class="{{ request()->is('admin/emap/dashboard') ? 'active' : '' }}">
    <a href="{{ route('emap.admin.dashboard') }}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('organization_access')
    <li class="{{ request()->is('admin/emap/organization') ? 'active' : '' }}">
        <a href="{{ route('emap.admin.organization.index') }}">
            <i class="fa fa-building"></i>
            <span>दर्ता भएका संगठनहरु</span>
        </a>
    </li>
@endcan

<li class="{{ request()->is('admin/emap/map/mapApply*') ? 'active' : '' }}">
    <a href="#sidebarMaptype" {{ request()->is('admin/emap/map/mapApply*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-map"></i>
        <span>नक्सा दर्ता/प्रमाणित</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/emap/map/mapApply*') ? 'show' : '' }}" id="sidebarMaptype">
        <ul class="nav-second-level">
            @can('mapApply_access')
                <li class="{{ request()->is('admin/emap/map/mapApply') ? 'active' : '' }}">
                    <a
                        href="{{ route('emap.admin.map.mapApply.index', \Modules\EMap\Enums\ApplicationFormTypeEnum::MAP_REGISTRATION) }}">
                        <span> नक्सा दर्ता </span>
                    </a>
                </li>
            @endcan
            @can('mapApply_access')
                <li class="">
                    <a
                        href="{{ route('emap.admin.map.mapApply.index', \Modules\EMap\Enums\ApplicationFormTypeEnum::MAP_VERIFIED) }}">
                        <span> नक्सा प्रमाणित</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<li class="{{ request()->is('admin/emap') ? 'active' : '' }}">
    <a href="{{ route('emap.admin.oldMap.index') }}">
        <i class="fa fa-building"></i>
        <span>पुरानो नक्सा </span>
    </a>
</li>
<li class="{{ request()->is('admin/emap/setting/*') ? 'active' : '' }}">
    <a href="#sidebarEMapSetting" {{ request()->is('admin/emap/setting/*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सेटिङ</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/emap/setting/*') ? 'show' : '' }}" id="sidebarEMapSetting">
        <ul class="nav-second-level">
            @can('mapFee_access')
                <li class="{{ request()->is('admin/emap/setting/mapFee') ? 'active' : '' }}">
                    <a href="{{ route('emap.admin.mapFee.index') }}">
                        <span>नक्शा दस्तुर</span>
                    </a>
                </li>
            @endcan
            @can('mapSetting_access')
                <li class="{{ request()->is('admin/emap/setting/mapSetting') ? 'active' : '' }}">
                    <a href="{{ route('emap.admin.mapSetting.index') }}">
                        <span> नक्शा सेटिङ </span>
                    </a>
                </li>
            @endcan
            @can('eMapTemplate_access')
                <li class="{{ request()->is('admin/emap/setting/eMapTemplate*') ? 'active' : '' }}">
                    <a href="{{ route('emap.admin.eMapTemplate.index') }}">
                        <span> टेम्प्लेट </span>
                    </a>
                </li>
            @endcan
            @can('eMapTemplate_access')
                <li class="{{ request()->is('admin/emap/enkasa/mapPassGroup*') ? 'active' : '' }}">
                    <a href="{{ route('emap.admin.mapPassGroup.index') }}">
                        <span> नक्शा पास समूह </span>
                    </a>
                </li>
            @endcan
            <li class="{{ request()->is('admin/emap/setting/dynamicForm*') ? 'active' : '' }}">
                <a href="{{ route('emap.admin.dynamicForm.index') }}">
                    <span> नक्शा पास फारम </span>
                </a>
            </li>

            <li class="{{ request()->is('admin/emap/setting/landUseArea*') ? 'active' : '' }}">
                <a href="{{ route('emap.admin.landUseArea.index') }}">
                    <span> भूउपयोग क्षेत्र </span>
                </a>
            </li>
            <li class="{{ request()->is('admin/emap/setting/streetDetails*') ? 'active' : '' }}">
                <a href="{{ route('emap.admin.streetDetail.index') }}">
                    <span> सडक विवरण </span>
                </a>
            </li>

            <li class="{{ request()->is('admin/emap/setting/criteriaDetailSetting*') ? 'active' : '' }}">
                <a href="{{ route('emap.admin.criteriaDetailSetting.index') }}">
                    <span> मापदण्ड </span>
                </a>
            </li>
            @can('eMapTemplate_access')
                <li class="{{ request()->is('admin/emap/enkasa/naksaPassGroupUser*') ? 'active' : '' }}">
                    <a href="{{ route('emap.admin.form.index') }}">
                        <span> नक्शा पास मर्यादाक्रम</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<!-- <li class="{{ request()->is('admin/emap/organization/reports') ? 'active' : '' }}">
    <a href="{{ route('emap.admin.report.report') }}">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
    </a>
</li> -->
