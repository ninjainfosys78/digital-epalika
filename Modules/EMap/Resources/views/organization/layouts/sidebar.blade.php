<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="{{request()->is('organization/admin/dashboard') ? 'active' : ''}}">
                    <a href="{{route('dashboard')}}">
                        <i class="fa fa-home"></i>
                        <span> ड्यासबोर्ड</span>
                    </a>
                </li>
                <li class="{{request()->is('organization/admin/mapApply') ? 'active' : ''}}">
                    <a href="{{route('organization.admin.mapApply.index')}}">
                        <i class="fa fa-map"></i>
                        <span> नक्सा</span>
                    </a>
                </li>
                
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

