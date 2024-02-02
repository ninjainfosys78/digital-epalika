<li>
    <a href="{{route('admin.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> गृहपृष्ठ </span>
    </a>
</li>

<li>
    <a href="#sidebarExecutiveMeeting" data-bs-toggle="collapse">
        <i class="fa fa-photo-video"></i>
        <span>ई-कार्यपालिका </span>
        <span class="menu-arrow">
                            <i class="fas fa-angle-right"></i>
                        </span>
    </a>
    <div class="{{request()->is('admin/executiveMeeting/*') ?'':'collapse'}}"
         id="sidebarExecutiveMeeting">
        <ul class="nav-second-level">
            @can('executiveCommittee_access')
                <li class="{{request()->routeIs('admin.executiveMeeting.municipalCommittee.index') ? 'active' : ''}}">
                    <a href="{{route('admin.executiveMeeting.municipalCommittee.index')}}">
                        <span> पालिका समिति बिवरण</span>
                    </a>
                </li>
                <li class="{{request()->routeIs('admin.executiveMeeting.wardCommittee.index') ? 'active' : ''}}">
                    <a href="{{route('admin.executiveMeeting.wardCommittee.index')}}">
                        <span> वडा समिति बिवरण</span>
                    </a>
                </li>
            @endcan
            <li>
                <a href="#sidebarExecutiveMeetingMunicipal" data-bs-toggle="collapse">
                    <span>पालिका समिति बैठक</span>
                    <span class="menu-arrow">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                </a>
                <div class="collapse" id="sidebarExecutiveMeetingMunicipal">
                    <ul class="nav-second-level">
                        @can('municipalMeeting_access')
                            <li class="{{request()->routeIs('admin.executiveMeeting.municipalMeetingNotice.index') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.municipalMeetingNotice.index')}}">
                                    <span> सूचना प्रशारण </span>
                                </a>
                            </li>
                            <li class="{{request()->routeIs('admin.executiveMeeting.municipalMeetingDetails') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.municipalMeetingDetails')}}">
                                    <span> बैठक बिबरण </span>
                                </a>
                            </li>
                            <li class="{{request()->routeIs('admin.executiveMeeting.municipalMeetingDecision.index') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.municipalMeetingDecision.index')}}">
                                    <span> निर्णयहरु</span>
                                </a>
                            </li>
                            <li class="{{request()->routeIs('admin.executiveMeeting.municipalMeetingDetailsReport') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.municipalMeetingDetailsReport')}}">
                                    <span> बैठक बिबरण रिपोर्ट </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>

            <li>
                <a href="#sidebarExecutiveMeetingWard" data-bs-toggle="collapse">
                    <span>वडा समिति बैठक</span>
                    <span class="menu-arrow">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                </a>
                <div class="collapse" id="sidebarExecutiveMeetingWard">
                    <ul class="nav-second-level">
                        @can('wardMeeting_access')
                            <li class="{{request()->routeIs('admin.executiveMeeting.wardMeetingNotice.index') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.wardMeetingNotice.index')}}">
                                    <span> सूचना प्रशारण </span>
                                </a>
                            </li>
                            <li class="{{request()->routeIs('admin.executiveMeeting.wardMeetingDetails') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.wardMeetingDetails')}}">
                                    <span> बैठक बिबरण </span>
                                </a>
                            </li>
                            <li class="{{request()->routeIs('admin.executiveMeeting.wardMeetingDecision.index') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.wardMeetingDecision.index')}}">
                                    <span> निर्णयहरु</span>
                                </a>
                            </li>
                            <li class="{{request()->routeIs('admin.executiveMeeting.wardMeetingDetailsReport') ? 'active' : ''}}">
                                <a href="{{route('admin.executiveMeeting.wardMeetingDetailsReport')}}">
                                    <span> बैठक बिबरण रिपोर्ट </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#sidebarListRegistration" data-bs-toggle="collapse">
        <i class="fa fa-file-contract"></i>
        <span>सुची दर्ता प्रणालि </span>
        <span class="menu-arrow">
                            <i class="fas fa-angle-right"></i>
                        </span>
    </a>
    <div class="{{request()->is('admin/listRegistrations/*') ?'':'collapse'}}"
         id="sidebarListRegistration">
        <ul class="nav-second-level">
            @can('listRegistration_access')
                <li class="{{request()->routeIs('admin.listRegistrations.listRegistration.index') ? 'active' : ''}}">
                    <a href="{{route('admin.listRegistrations.listRegistration.index')}}">
                        <span>मौजुदा सुची दर्ता</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</li>

<li>
    <a href="#registration" data-bs-toggle="collapse">
        <i class="fa fa-users-cog"></i>
        <span>प्रयोगकर्ता र भूमिका</span>
        <span class="menu-arrow">
                            <i class="fas fa-angle-right"></i>
                        </span>
    </a>
    <div class="{{request()->is('admin/userManagement/*') ?'':'collapse'}}" id="registration">
        <ul class="nav-second-level">
            @can('user_access')
                <li class="{{request()->routeIs('admin.userManagement.user.index') ? 'active':''}}">
                    <a href="{{route('admin.userManagement.user.index')}}">प्रयोगकर्ता</a>
                </li>
            @endcan
            @can('role_access')
                <li class="{{request()->routeIs('admin.userManagement.role.index') ? 'active':''}}">
                    <a href="{{route('admin.userManagement.role.index')}}">भूमिका</a>
                </li>
            @endcan
        </ul>
    </div>
</li>
<li>
    <a href="#websiteAdmin" data-bs-toggle="collapse">
        <i class="fa fa-globe"></i>
        <span>वेबसाइट सेटिङ</span>
        <span class="menu-arrow">
                            <i class="fas fa-angle-right"></i>
                        </span>
    </a>
    <div class="{{request()->is('admin/website/*') ?'':'collapse'}}" id="websiteAdmin">
        <ul class="nav-second-level">
            <li class="{{request()->is('admin/website/slider/*') ? 'active':''}}">
                <a href="{{route('admin.website.slider.index')}}">स्लाइडर</a>
            </li>
            <li class="{{request()->is('admin/website/municipalDetail/*') ? 'active':''}}">
                <a href="{{route('admin.website.municipalDetail.index')}}">पालिका बिबरण </a>
            </li>
            <li class="{{request()->is('admin/website/importantLink/*') ? 'active':''}}">
                <a href="{{route('admin.website.importantLink.index')}}">महत्त्वपूर्ण लिङ्क </a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#setting" data-bs-toggle="collapse">
        <i class="fa fa-cogs"></i>
        <span>सेटिङ</span>
        <span class="menu-arrow">
                            <i class="fas fa-angle-right"></i>
                        </span>
    </a>
    <div class="{{request()->is('admin/setting/*') ?'':'collapse'}}" id="setting">
        <ul class="nav-second-level">
            @can('fiscalYear_access')
                <li class="{{request()->routeIs('admin.fiscalYear.*') ? 'active':''}}">
                    <a href="{{route('admin.fiscalYear.index')}}">आर्थिक बर्ष</a>
                </li>
            @endcan

            <li>
                <a href="#sidebarUnits" data-bs-toggle="collapse">
                    <span>मापन एकाइ</span>
                    <span class="menu-arrow">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                </a>
                <div class="{{request()->is('admin/setting/units/*') ?'':'collapse'}}"
                     id="sidebarUnits">
                    <ul class="nav-second-level">
                        @can('unitType_access')
                            <li class="{{request()->routeIs('admin.units.type.*') ? 'active' : ''}}">
                                <a href="{{route('admin.units.type.index')}}">
                                    <span> प्रकार </span>
                                </a>
                            </li>
                        @endcan
                        @can('MeasurementUnit_access')
                            <li class="{{request()->routeIs('admin.units.measurementUnit.*') ? 'active' : ''}}">
                                <a href="{{route('admin.units.measurementUnit.index')}}">
                                    <span> विविधता </span>
                                </a>
                            </li>
                        @endcan
                        @can('unit_access')
                            <li class="{{request()->routeIs('admin.units.unit.*') ? 'active' : ''}}">
                                <a href="{{route('admin.units.unit.index')}}">
                                    <span> एकाई </span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </div>
            </li>

            <li class="{{request()->routeIs('admin.officeSetting.index') ? 'active':''}}">
                <a href="{{route('admin.officeSetting.index')}}"> कार्यालय सेटिङ</a>
            </li>
        </ul>
    </div>
</li>
