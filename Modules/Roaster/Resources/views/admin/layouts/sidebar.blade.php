<li class="{{request()->is('admin/roaster/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.roaster.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>

<li class="{{request()->is('admin/roaster/trainer/*') ? 'active' : ''}}">
    <a href="{{route('admin.roaster.trainer.index')}}">
        <i class="fa fa-users"></i>
        <span>प्रशिक्षकहरु</span>
    </a>
</li>
<li class="{{request()->is('admin/roaster/training/*') ? 'active' : ''}}">
    <a href="{{route('admin.roaster.training.index')}}">
        <i class="fa fa-book"></i>
        <span>तालिम</span>
    </a>
</li>
<li class="{{request()->is('admin/roaster/training/*') ? 'active' : ''}}">
    <a href="{{route('admin.roaster.report.report')}}">
        <i class="fa fa-clipboard-list"></i>
        <span>तालिम दर्ता रिपोर्ट</span>
    </a>
</li>

<li class="{{request()->is('admin/roaster/setting/*') ? 'active' : ''}}">
    <a href="#sidebarRoaster"
       {{request()->is('admin/roaster/setting/*') ? 'aria-expanded=true' : ''}}
       data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सेटिङ </span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="collapse {{request()->is('admin/roaster/setting/*') ? 'show' : ''}}"
         id="sidebarRoaster">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/roaster/setting/subject') ? 'active' : ''}}">
                <a href="{{route('admin.roaster.setting.subject.index')}}">
                    <span>विषय</span>
                </a>
            </li>
            <li class="{{request()->is('admin/roaster/setting/roasterSetting') ? 'active' : ''}}">
                <a href="{{route('admin.roaster.setting.roasterSetting.index')}}">
                    <span>सेटिङ </span>
                </a>
            </li>
        </ul>
    </div>
</li>

