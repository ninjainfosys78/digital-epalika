<li class="{{request()->is('admin/businessRegistration/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.businessRegistration.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('businessRegistration_access')
    <li class="{{request()->is('admin/businessRegistration/businessRegistration') ? 'active' : ''}}">
        <a href="{{route('admin.businessRegistration.businessRegistration.index')}}">
            <i class="fa fa-clipboard"></i>
            <span> व्यवसाय दर्ता / नविकरण</span>
        </a>
    </li>
@endcan

<li class="{{request()->is('admin/businessRegistration/report*') ? 'active' : ''}}">
    <a href="#sidebarBusinessRegistrationReport"
       {{request()->is('admin/businessRegistration/report*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/businessRegistration/report*') ? 'show' : ''}}"
         id="sidebarBusinessRegistrationReport">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/businessRegistration/report') ? 'active' : ''}}">
                <a href="{{route('admin.businessRegistration.report.index')}}">
                    <span>प्रतिवेदनहरु</span>
                </a>
            </li>
            <li class="{{request()->is('admin/businessRegistration/report/business-registration-book') ? 'active' : ''}}">
                <a href="{{route('admin.businessRegistration.report.business-registration-book')}}">
                    <span>दर्ता प्रतिवेदन</span>
                </a>
            </li>
            <li class="{{request()->is('admin/businessRegistration/report/business-nature-wise') ? 'active' : ''}}">
                <a href="{{route('admin.businessRegistration.report.business-nature-wise')}}">
                    <span>प्रकृति अनुसार </span>
                </a>
            </li>
            <li class="{{request()->is('admin/businessRegistration/report/object-transaction') ? 'active' : ''}}">
                <a href="{{route('admin.businessRegistration.report.object-transaction')}}">
                    <span>
                         मुख्य सेवा/बस्तु
                    </span>
                </a>
            </li>
            <li class="{{request()->is('admin/businessRegistration/report/business-objectTransaction-nature-wise') ? 'active' : ''}}">
                <a href="{{route('admin.businessRegistration.report.business-objectTransaction-nature-wise')}}">
                    <span>प्रकृति तथा मुख्य सेवा/बस्तु </span>
                </a>
            </li>
            <li class="{{request()->is('admin/businessRegistration/report/ward-wise') ? 'active' : ''}}">
                <a href="{{route('admin.businessRegistration.report.ward-wise')}}">
                    <span>
                        वडा अनुसार
                    </span>
                </a>
            </li>
        </ul>
    </div>
</li>



<li class="{{request()->is('admin/businessRegistration/setting/*') ? 'active' : ''}}">
    <a href="#sidebarBusinessRegistrationSetting"
       {{request()->is('admin/businessRegistration/setting/*') ? 'aria-expanded=true  ' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>आधारभूत सेटिङ</span>
        <span class="menu-arrow">
                        <i class="fa fa-angle-right"></i>
                    </span>
    </a>
    <div class="collapse {{request()->is('admin/businessRegistration/setting/*') ? 'show' : ''}}"
         id="sidebarBusinessRegistrationSetting">
        <ul class="nav-second-level">
            @can('businessNature_access')
                <li class="{{request()->is('admin/businessRegistration/setting/businessNature/*') ? 'active' : ''}}">
                    <a href="{{route('admin.businessRegistration.setting.businessNature.index')}}">
                        <span>  व्यवसायको प्रकृति </span>
                    </a>
                </li>
            @endcan

            @can('objectTransaction_access')
                <li class="{{request()->is('admin/businessRegistration/setting/objectTransaction/*') ? 'active' : ''}}">
                    <a href="{{route('admin.businessRegistration.setting.objectTransaction.index')}}">
                        <span>कारोबार गर्ने वस्तु श्रेणी</span>
                    </a>
                </li>
            @endcan

            @can('businessRegistrationTemplate_access')
                <li class="{{request()->is('admin/businessRegistration/setting/businessRegistrationTemplate/*') ? 'active' : ''}}">
                    <a href="{{route('admin.businessRegistration.setting.businessRegistrationTemplate.enumList')}}">
                        <span>सेटिङ</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>

<li class="{{request()->is('admin/businessRegistration/files/file/*') ? 'active' : ''}}">
    <a href="{{route('admin.businessRegistration.files.file')}}">
        <i class="fa fa-file-archive"></i>
        <span>फाईल व्यवस्थापन</span>
    </a>
</li>

