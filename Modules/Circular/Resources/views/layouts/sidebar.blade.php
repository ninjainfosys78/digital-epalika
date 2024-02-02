<li>
    <a href="#sidebarCircular" data-bs-toggle="collapse">
        <i class="fa fa-registered"></i>
        <span>दर्ता चलानी प्रणाली</span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="{{request()->is('admin/circular/*') ?'':'collapse'}}" id="sidebarCircular">
        <ul class="nav-second-level">
            @can('registration_access')
                <li class="{{request()->routeIs('admin.circular.registration.index') ? 'active' : ''}}">
                    <a href="{{route('admin.circular.registration.index')}}">
                        <span> दर्ता प्रणाली   </span>
                    </a>
                </li>
            @endcan
            @can('dispatch_access')
                <li>
                    <a href="{{route('admin.circular.dispatch.index')}}">
                        <span> चलानी प्रणाली </span>
                    </a>
                </li>
            @endcan
            <li>
                <a href="#sidebarCircularReport" data-bs-toggle="collapse">
                    <span>रिपोर्ट</span>
                    <span class="menu-arrow">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
                <div class="collapse" id="sidebarCircularReport">
                    <ul class="nav-second-level">
                        @can('registration_access')
                            <li class="{{request()->routeIs('admin.circular.registration.report') ? 'active' : ''}}">
                                <a href="{{route('admin.circular.registration.report')}}">
                                    <span> दर्ता प्रणाली रिपोर्ट   </span>
                                </a>
                            </li>
                        @endcan
                        @can('dispatch_access')
                            <li class="{{request()->routeIs('admin.circular.dispatch.report') ? 'active' : ''}}">
                                <a href="{{route('admin.circular.dispatch.report')}}">
                                    <span> चलानी प्रणाली रिपोर्ट</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</li>

