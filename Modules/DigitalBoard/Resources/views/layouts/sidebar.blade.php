<li>
    <a href="#sidebarDigitalBoard" data-bs-toggle="collapse">
        <i class="fa fa-photo-video"></i>
        <span>नागरिक वडापत्र </span>
        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
    </a>
    <div class="{{request()->is('admin/digitalBoard/*') ?'':'collapse'}}" id="sidebarDigitalBoard">
        <ul class="nav-second-level">
            @can('registration_access')
                <li class="{{request()->routeIs('admin.digitalBoard.video.index') ? 'active' : ''}}">
                    <a href="{{route('admin.digitalBoard.video.index')}}">
                        <span> भिडियोहरु</span>
                    </a>
                </li>
            @endcan
            @can('digitalBoardNotice_access')
                <li class="{{request()->routeIs('admin.digitalBoard.notice.index','Notice') ? 'active' : ''}}">
                    <a href="{{route('admin.digitalBoard.notice.index','Notice')}}">
                        <span> सूचना </span>
                    </a>
                </li>
            @endcan
            @can('digitalBoardNotice_access')
                <li class="{{request()->routeIs('admin.digitalBoard.notice.index','News') ? 'active' : ''}}">
                    <a href="{{route('admin.digitalBoard.notice.index','News')}}">
                        <span> समाचार</span>
                    </a>
                </li>
            @endcan

            {{-- @can('digitalBoardPhotoGallery_access')
            <li class="{{request()->is('admin.digitalBoard.photoGallery.index','photoGallery') ? 'active' : ''}}">
                <a href="{{route('admin.digitalBoard.photoGallery.index')}}">
                    <span> फोटो ग्यालरी</span>
                </a>
            </li>
            @endcan --}}
        </ul>
    </div>
</li>


