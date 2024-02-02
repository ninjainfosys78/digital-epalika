<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="{{request()->is('traineeOrganization/admin/dashboard') ? 'active' : ''}}">
                    <a href="{{route('traineeOrganization.admin.dashboard')}}">
                        <i class="fa fa-home"></i>
                        <span> ड्यासबोर्ड</span>
                    </a>
                </li>
                <li class="{{request()->is('traineeOrganization/admin/organizationTraining') ? 'active' : ''}}">
                    <a href="{{route('traineeOrganization.admin.organizationTraining.index')}}">
                        <i class="fa fa-book"></i>
                        <span>तालिम</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

