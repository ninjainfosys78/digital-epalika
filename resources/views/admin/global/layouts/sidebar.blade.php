<li class="{{ request()->is('admin/global/dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.global.dashboard') }}">
        <i class="fa fa-home"></i>
        <span> गृहपृष्ठ </span>
    </a>
</li>
<li
    class="{{ request()->is('admin/global/generalSetting*') || request()->is('admin/global/generalSetting*') ? 'active' : '' }}">
    <a href="#generalSetting"
        {{ request()->is('admin/global/generalSetting*') || request()->is('admin/global/generalSetting*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-cog"></i>
        <span>सामान्य सेटिङ </span>
        <span class="menu-arrow"><i class="fas fa-angle-right"></i></span>
    </a>
    <div class="collapse {{ request()->is('admin/global/generalSetting*') || request()->is('admin/global/generalSetting*') ? 'show' : '' }}"
        id="generalSetting">
        <ul class="nav-second-level">
            @can('fiscalYear_access')
                <li class="{{ request()->is('admin/global/generalSetting/fiscalYear*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.fiscalYear.index') }}">
                        <span> आर्थिक बर्ष थप्नुहोस्</span>
                    </a>
                </li>
            @endcan

            @can('ethnicity_access')
                <li class="{{ request()->is('admin/global/generalSetting/ethnicity/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.ethnicity.index') }}">
                        <span> जातियता थप्नुहोस्</span>
                    </a>
                </li>
            @endcan

            @can('occupation_access')
                <li class="{{ request()->is('admin/global/generalSetting/occupation/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.occupation.index') }}">
                        <span> पेसा थप्नुहोस्</span>
                    </a>
                </li>
            @endcan

            @can('relationship_access')
                <li class="{{ request()->is('admin/global/relationship') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.relationship.index') }}">
                        <span>नाता</span>
                    </a>
                </li>
            @endcan

            @can('emergencyNumber_access')
                <li class="{{ request()->is('admin/global/generalSetting/emergencyNumber/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.emergencyNumber.index') }}">
                        <span> आपतकालीन सम्पर्क नं. </span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/global/generalSetting/emergencyCategory/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.emergencyCategory.index') }}">
                        <span> आपतकालीन सेवाको वर्गहरु </span>
                    </a>
                </li>
            @endcan

            @can('branch_access')
                <li class="{{ request()->is('admin/global/generalSetting/branch*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.branch.index') }}">
                        <span> शाखा/उपशाखा थप्नुहोस्</span>
                    </a>
                </li>
            @endcan
            @can('designation_access')
                <li class="{{ request()->is('admin/global/generalSetting/designation*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.designation.index') }}">
                        <span> पद थप्नुहोस् </span>
                    </a>
                </li>
            @endcan
            @can('department_access')
                <li class="{{ request()->is('admin/globalglobal/generalSetting/department*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.department.index') }}">
                        <span> विभाग थप्नुहोस् </span>
                    </a>
                </li>
            @endcan
            @can('employee_access')
                <li class="{{ request()->is('admin/global/generalSetting/employee*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.generalSetting.employee.index') }}">
                        <span> कर्मचारीहरु</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<li
    class="{{ request()->is('admin/global/systemSetting*') || request()->is('admin/global/systemSetting*') ? 'active' : '' }}">
    <a href="#systemSetting"
        {{ request()->is('admin/global/systemSetting*') || request()->is('admin/global/systemSetting*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>प्रणाली सेटिङ </span>
        <span class="menu-arrow"><i class="fas fa-angle-right"></i></span>
    </a>
    <div class="collapse {{ request()->is('admin/global/systemSetting*') || request()->is('admin/global/systemSetting*') ? 'show' : '' }}"
        id="systemSetting">
        <ul class="nav-second-level">
            @can('officeSetting_access')
                <li class="{{ request()->is('admin/global/systemSetting/officeSetting*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.systemSetting.officeSetting.index') }}">
                        <span> कार्यालय सेटिङ </span>
                    </a>
                </li>
            @endcan
            <li class="{{ request()->is('admin/global/systemSetting/letterHead*') ? 'active' : '' }}">
                <a href="{{ route('admin.global.systemSetting.letterHead.index') }}">
                    <span> लेटर हेड </span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li
    class="{{ request()->is('admin/global/featureSetting*') || request()->is('admin/global/featureSetting*') ? 'active' : '' }}">
    <a href="#featureSetting"
        {{ request()->is('admin/global/featureSetting*') || request()->is('admin/global/featureSetting*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-key"></i>
        <span>सुविधा सेटिङ</span>
        <span class="menu-arrow"><i class="fas fa-angle-right"></i></span>
    </a>
    <div class="collapse {{ request()->is('admin/global/featureSetting*') || request()->is('admin/global/featureSetting*') ? 'show' : '' }}"
        id="featureSetting">
        <ul class="nav-second-level">
            @can('sms_access')
                <li class="{{ request()->is('admin/global/featureSetting/sms*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.featureSetting.sms-setting') }}">
                        <span>एस.एम.एस सेटअप</span>
                    </a>
                </li>
            @endcan
            @can('mail_access')
                <li class="{{ request()->is('admin/global/featureSetting/mail*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.featureSetting.mail-setting') }}">
                        <span>मेल सेटअप</span>
                    </a>
                </li>
            @endcan
            @can('feature_access')
                <li class="{{ request()->is('admin/global/featureSetting/feature*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.featureSetting.feature-activation') }}">
                        <span>सुविधा सक्रियता </span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<li class="{{ request()->is('admin/global/userManagement/*') ? 'active' : '' }}">
    <a href="#userManagement" {{ request()->is('admin/global/userManagement/*') ? 'aria-expanded=true  ' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-users-cog"></i>
        <span>प्रयोगकर्ता व्यवस्थापन</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{ request()->is('admin/global/userManagement/*') ? 'show' : '' }}" id="userManagement">
        <ul class="nav-second-level">
            @can('user_access')
                <li class="{{ request()->is('admin/global/userManagement/user*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.userManagement.user.index') }}">प्रयोगकर्ता</a>
                </li>
            @endcan
            @can('role_access')
                <li class="{{ request()->is('admin/global/userManagement/role*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.userManagement.role.index') }}">भूमिका</a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<li class="{{ request()->is('admin/global/units/*') ? 'active' : '' }}">
    <a href="#measurementUnits" {{ request()->is('admin/global/units/*') ? 'aria-expanded=true  ' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-crop-alt"></i>
        <span>मापन एकाइ</span>
        <span class="menu-arrow"><i class="fas fa-angle-right"></i></span>
    </a>
    <div class="collapse {{ request()->is('admin/global/units/*') ? 'show' : '' }}" id="measurementUnits">
        <ul class="nav-second-level">
            @can('unitType_access')
                <li class="{{ request()->is('admin/global/units/type*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.units.type.index') }}">
                        <span> प्रकार </span>
                    </a>
                </li>
            @endcan
            @can('MeasurementUnit_access')
                <li class="{{ request()->is('admin/global/units/measurementUnit*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.units.measurementUnit.index') }}">
                        <span> विविधता </span>
                    </a>
                </li>
            @endcan
            @can('unit_access')
                <li class="{{ request()->is('admin/global/units/unit*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.units.unit.index') }}">
                        <span> एकाई </span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>


<li class="{{ request()->is('admin/global/website*') || request()->is('admin/global/website*') ? 'active' : '' }}">
    <a href="#website" {{ request()->is('admin/global/website') || request()->is('admin/global/website*') ? 'aria-expanded=true' : '' }}
        data-bs-toggle="collapse">
        <i class="fa fa-crop-alt"></i>
        <span> वेबसाइट सेटिङ</span>
        <span class="menu-arrow"><i class="fas fa-angle-right"></i></span>
    </a>
    <div class="collapse {{ request()->is('admin/global/website') || request()->is('admin/global/website*') ? 'show' : '' }}" id="website">
        <ul class="nav-second-level">

            @can('slider_access')
                <li class="{{ request()->is('admin/global/website/slider/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.website.slider.index') }}">
                        <i class="fa fa-file-image"></i>
                        <span>स्लाइडर</span>
                    </a>
                </li>
            @endcan
            @can('municipalDetail_access')
                <li class="{{ request()->is('admin/global/website/municipalDetail/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.website.municipalDetail.index') }}">
                        <i class="fa fa-file"></i>
                        <span>पालिका बिबरण </span>
                    </a>
                </li>
            @endcan
            @can('importantLink_access')
                <li class="{{ request()->is('admin/global/website/importantLink/*') ? 'active' : '' }}">
                    <a href="{{ route('admin.global.website.importantLink.index') }}">
                        <i class="fa fa-link"></i>
                        <span>महत्त्वपूर्ण लिङ्क</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>



<li class="{{ request()->is('admin/mobileUser/*') ? 'active' : '' }}">
    <a href="{{ route('admin.global.mobileUser.index') }}">
        <i class="fa fa-crop-alt"></i>
        <span>सेवाग्राहीहरु</span>
    </a>
</li>
