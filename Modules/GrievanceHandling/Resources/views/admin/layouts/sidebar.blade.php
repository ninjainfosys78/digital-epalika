<li class="{{request()->is('admin/grievanceHandling/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.grievanceHandling.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('grievanceDetail_access')
    <li class="{{request()->is('admin/grievanceHandling/grievanceDetail') ? 'active' : ''}}">
        <a href=" {{route('admin.grievanceHandling.grievanceDetail.index')}}">
            <i class="fa fa-clipboard-list"></i>
            <span>प्राप्त गुनासोहरु</span>
        </a>
    </li>
@endcan
@can('grievanceUser_access')
    <li class="{{request()->is('admin/grievanceHandling/grievanceUser/*') ? 'active' : ''}}">
        <a href=" {{route('admin.grievanceHandling.grievanceUser.index')}}">
            <i class="fa fa-user"></i>
            <span> गुनासो प्रयोगकर्ता </span>
        </a>
    </li>
@endcan
<li class="{{request()->is('admin/grievanceHandling/setting/*') ? 'active' : ''}}">
    <a href="#sidebarGrievanceHandlingSetting"
       {{request()->is('admin/grievanceHandling/setting/*') ? 'aria-expanded=true  ' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सेटिङ </span>
        <span class="menu-arrow">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
    </a>
    <div class="collapse {{request()->is('admin/grievanceHandling/setting/*') ? 'show' : ''}}"
         id="sidebarGrievanceHandlingSetting">
        <ul class="nav-second-level">
            @can('grievanceType_access')
                <li class="{{request()->is('admin/grievanceHandling/setting/grievanceType/*') ? 'active' : ''}}">
                    <a href="{{route('admin.grievanceHandling.setting.grievanceType.index')}}">
                        <span> गुनासो प्रकार </span>
                    </a>
                </li>
            @endcan


                <li class="{{request()->is('admin/grievanceHandling/setting/grievanceSetting/*') ? 'active' : ''}}">
                    <a href="{{route('admin.grievanceHandling.setting.grievanceSetting.index')}}">
                        <span> गुनासो सुन्ने अधिकारी </span>
                    </a>
                </li>

        </ul>
    </div>
</li>
