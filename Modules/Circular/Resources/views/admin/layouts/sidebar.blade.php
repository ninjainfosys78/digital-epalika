<li class="{{request()->is('admin/circular/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.circular.dashboard')}}">
        <i class="lnr lnr-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>
@can('registration_access')
    <li class="{{request()->is('admin/circular/registration*') ? 'active' : ''}}">
        <a href="{{route('admin.circular.registration.index')}}">
            <i class="lnr lnr-plus-circle"></i>
            <span> दर्ता</span>
        </a>
    </li>
@endcan
@can('dispatch_access')
    <li class="{{request()->is('admin/circular/dispatch*') ? 'active' : ''}}">
        <a href="{{route('admin.circular.dispatch.index')}}">
            <i class="lnr lnr-file-add"></i>
            <span> चलानी</span>
        </a>
    </li>
@endcan
<li class="{{request()->is('admin/circular/report/*') ? 'active' : ''}}">
    <a href="#sidebarCircularReport"
       {{request()->is('admin/circular/report/*') ? 'aria-expanded=true  ' : ''}}
       data-bs-toggle="collapse">
        <i class="lnr lnr-chart-bars"></i>
        <span>रिपोर्ट</span>
        <span class="menu-arrow">
                        <i class="fa fa-angle-right"></i>
                    </span>
    </a>
    <div class="collapse {{request()->is('admin/circular/report/*') ? 'show' : ''}}"
         id="sidebarCircularReport">
        <ul class="nav-second-level">
            @can('registration_access')
                <li class="{{request()->is('admin/circular/report/registration') ? 'active' : ''}}">
                    <a href="{{route('admin.circular.report.registration.index')}}">
                        <span> दर्ता रिपोर्ट   </span>
                    </a>
                </li>
            @endcan
            @can('dispatch_access')
                <li class="{{request()->is('admin/circular/report/dispatch') ? 'active' : ''}}">
                    <a href="{{route('admin.circular.report.dispatch.index')}}">
                        <span> चलानी रिपोर्ट</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>
@can('registration_access')
    <li class="{{request()->is('admin/circular/registration*') ? 'active' : ''}}">
        <a href="{{route('admin.circular.circularSetting.index')}}">
            <i class="lnr lnr-cog"></i>
            <span> सेटिङ</span>
        </a>
    </li>
@endcan
<li class="{{request()->is('admin/circular/files/*') ? 'active' : ''}}">
    <a href="#sidebarCircularFile"
       {{request()->is('admin/circular/files/*') ? 'aria-expanded=true  ' : ''}}
       data-bs-toggle="collapse">
        <i class="lnr lnr-layers"></i>
        <span>फाईल व्यवस्थापन</span>
        <span class="menu-arrow">
                        <i class="fa fa-angle-right"></i>
                    </span>
    </a>
    <div class="collapse {{request()->is('admin/circular/files/*') ? 'show' : ''}}"
         id="sidebarCircularFile">
        <ul class="nav-second-level">
                <li class="{{request()->is('admin/circular/files/registration-file') ? 'active' : ''}}">
                    <a href="{{route('admin.circular.files.registration-file')}}">
                        <span> दर्ता फाईल</span>
                    </a>
                </li>
                <li class="{{request()->is('admin/circular/files/dispatch-file') ? 'active' : ''}}">
                    <a href="{{route('admin.circular.files.dispatch-file')}}">
                        <span> चलानी फाईल</span>
                    </a>
                </li>
        </ul>
    </div>
</li>

