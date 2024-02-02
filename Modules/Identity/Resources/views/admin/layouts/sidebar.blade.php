<li class="{{request()->is('admin/identity/dashboard') ? 'active' : ''}}">
    <a href="{{route('identity.admin.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>

<li class="{{request()->is('admin/identity/disability*') ? 'active' : ''}}">
    <a href="#sidebarDisability"
       {{request()->is('admin/identity/disability*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-wheelchair"></i>
        <span>अपाङ्गता परिचय पत्र</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/identity/disability*') ? 'show' : ''}}"
         id="sidebarDisability">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/identity/disability/disabilityIdentityCard') ? 'active' : ''}}">
                <a href="{{route('identity.admin.disabilityIdentityCard.index')}}">
                    <span> निवेदन</span>
                </a>
            </li>
            <li class="{{request()->routeIs('identity.admin.identityMeeting.*') ? 'active' : ''}}">
                <a href="{{route('identity.admin.identityMeeting.index')}}">
                    <span> बैठक </span>
                </a>
            </li>
            <li class="{{request()->routeIs('identity.admin.disabilityFullDetail.*') ? 'active' : ''}}">
                <a href="{{route('identity.admin.disabilityFullDetail.index')}}">
                    <span> पूर्ण विवरण </span>
                </a>
            </li>
            <li class="{{request()->routeIs('identity.admin.identityPrint') ? 'active' : ''}}">
                <a href="{{route('identity.admin.identityPrint')}}">
                    <span> प्रिन्ट परिचय पत्र </span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="{{request()->is('admin/identity/seniorCitizen*') ? 'active' : ''}}">
    <a href="#sidebarDisabilityIdentityCard"
       {{request()->is('admin/identity/seniorCitizen*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-user"></i>
        <span>जेष्ठ नागरिक</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/identity/seniorCitizen*') ? 'show' : ''}}"
         id="sidebarDisabilityIdentityCard">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/identity/seniorCitizen/seniorCitizenDetail') ? 'active' : ''}}">
                <a href="{{route('identity.admin.seniorCitizenDetail.index')}}">
                    <span>निवेदन </span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="{{request()->is('admin/identity/reports*') ? 'active' : ''}}">
    <a href="#sidebarIdentityReport"
       {{request()->is('admin/identity/reports*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/identity/reports*') ? 'show' : ''}}"
         id="sidebarIdentityReport">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/identity/reports') ? 'active' : ''}}">
                <a href="{{route('identity.admin.disabilityIdentityCardReport')}}">
                    <span> अपाङ्गता परिचयपत्र रिपोर्ट</span>
                </a>
            </li>
            <li class="{{request()->is('admin/identity/reports/ward-wise') ? 'active' : ''}}">
                <a href="{{route('identity.admin.ward-wise')}}">
                    <span>वडा अनुसार रिपोर्ट</span>
                </a>
            </li>
            <li class="{{request()->is('admin/identity/reports/governmental-disability-type') ? 'active' : ''}}">
                <a href="{{route('identity.admin.governmental-disability-type')}}">
                    <span>अपाङ्गताको प्रकार अनुसार रिपोर्ट</span>
                </a>
            </li>
            <li class="{{request()->is('admin/identity/reports/disability-type') ? 'active' : ''}}">
                <a href="{{route('identity.admin.disability-type')}}">
                    <span>प्रकृतिको आधारमा अपाङ्गताको प्रकार अनुसार रिपोर्ट</span>
                </a>
            </li>
            <li class="{{request()->is('admin/identity/reports') ? 'active' : ''}}">
                <a href="{{route('identity.admin.seniorCitizenReport.index')}}">
                    <span>जेष्ठ नागरिक  रिपोर्ट</span>
                </a>
            </li>
            <li class="{{request()->is('admin/identity/reports/senior-citizen-ward-wise') ? 'active' : ''}}">
                <a href="{{route('identity.admin.senior-citizen-ward-wise')}}">
                    <span>वडा अनुसार जेष्ठ नागरिक रिपोर्ट</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="{{request()->is('admin/identity/setting*') ? 'active' : ''}}">
    <a href="#sidebarIdentitySetting"
       {{request()->is('admin/identity/setting*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सेटिङ</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/identity/setting*') ? 'show' : ''}}"
         id="sidebarIdentitySetting">
        <ul class="nav-second-level">
            @can('disabilityReason_access')
                <li class="{{request()->is('admin/identity/setting/disabilityReason') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.disabilityReason.index')}}">
                        <span> अपांगताको कारण</span>
                    </a>
                </li>
            @endcan
            @can('disabilityType_access')
                <li class="{{request()->is('admin/identity/setting/disabilityType') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.disabilityType.index')}}">
                        <span> प्रकृतिको आधारमा अपाङ्गताको प्रकार</span>
                    </a>
                </li>
            @endcan
            @can('governmentalDisabilityType_access')
                <li class="{{request()->is('admin/identity/setting/governmentalDisabilityType') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.governmentalDisabilityType.index')}}">
                        <span>नेपाल सरकारको परिभाषा र बर्गिकरण अपाङ्गताको प्रकार</span>
                    </a>
                </li>
            @endcan
            @can('cardColor_access')
                <li class="{{request()->is('admin/identity/setting/cardColor') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.cardColor.index')}}">
                        <span>रंग कोड सेटअप</span>
                    </a>
                </li>
            @endcan
            @can('employeeSignature_access')
                <li class="{{request()->is('admin/identity/setting/employeeSignature') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.employeeSignature.index')}}">
                        <span> हस्ताक्षर गर्ने व्यक्ति</span>
                    </a>
                </li>
            @endcan
            @can('hospital_access')
                <li class="{{request()->is('admin/identity/setting/hospital') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.hospital.index')}}">
                        <span> अस्पतालहरु</span>
                    </a>
                </li>
            @endcan
            @can('disabilityCommittee_access')
                <li class="{{request()->is('admin/identity/setting/disabilityCommittee') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.disabilityCommittee.index')}}">
                        <span> अपाङ्ग समिति</span>
                    </a>
                </li>
            @endcan
            @can('disabilityCommittee_access')
                <li class="{{request()->is('admin/identity/setting/recommendationSetting') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.recommendationTemplateSetting.index')}}">
                        <span>सिफारिस टेम्पलेट</span>
                    </a>
                </li>
            @endcan
            @can('disabilityCommittee_access')
                <li class="{{request()->is('admin/identity/setting/minuteTemplateSetting') ? 'active' : ''}}">
                    <a href="{{route('identity.admin.setting.minuteTemplateSetting.index')}}">
                        <span>माईनिउट टेम्पलेट</span>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</li>

