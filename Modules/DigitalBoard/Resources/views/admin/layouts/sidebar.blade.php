<li class="{{request()->is('admin/digitalBoard/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.digitalBoard.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड </span>
    </a>
</li>
@can('digitalBoardVideo_access')
<li class="{{request()->is('admin/digitalBoard/video*') ? 'active' : ''}}">
    <a href="{{route('admin.digitalBoard.video.index')}}">
        <i class="fa fa-video"></i>
        <span> भिडियोहरु</span>
    </a>
</li>
@endcan

{{-- <li class="{{request()->is('admin/digitalBoard/PhotoGallery/photoGallery*') ? 'active' : ''}}">
    <a href="{{route('admin.digitalBoard.photoGallery.index')}}">
        <span> फोटो ग्यालरी</span>
    </a>
</li> --}}

@can('digitalBoardNotice_access')
<li class="{{request()->is('admin/digitalBoard/Notice/notice*') ? 'active' : ''}}">
    <a href="{{route('admin.digitalBoard.notice.index','Notice')}}">
        <i class="fa fa-info-circle"></i>
        <span> सूचनाहरु </span>
    </a>
</li>
@endcan
@can('digitalBoardNews_access')
<li class="{{request()->is('admin/digitalBoard/News/notice*') ? 'active' : ''}}">
    <a href="{{route('admin.digitalBoard.notice.index','News')}}">
        <i class="fa fa-newspaper"></i>
        <span> समाचारहरु</span>
    </a>
</li>
@endcan
@can('digitalBoardNews_access')
<li class="{{request()->is('admin/digitalBoard/PopUpNotice*') ? 'active' : ''}}">
    <a href="{{route('admin.digitalBoard.popUpNotice.index')}}">
        <i class="fa fa-newspaper"></i>
        <span> Pop Up</span>
    </a>
</li>
@endcan

    <li class="{{request()->routeIs('admin.digitalBoard.service.*') ? 'active' : ''}}">
        <a href="{{route('admin.digitalBoard.service.index')}}">
            <i class="fa fa-scroll"></i>
            <span> सेवाहरु</span>
        </a>
    </li>


    <li class="{{request()->routeIs('admin.digitalBoard.citizenCharter.*') ? 'active' : ''}}">
        <a href="{{route('admin.digitalBoard.citizenCharter.index')}}">
            <i class="fa fa-scroll"></i>
            <span> नागरिक वडापत्र</span>
        </a>
    </li>


    <li class="{{request()->routeIs('admin.digitalBoard.photoGallery.*') ? 'active' : ''}}">
        <a href="{{route('admin.digitalBoard.photoGallery.index')}}">
            <i class="fa fa-scroll"></i>
            <span>  फोटो ग्यालरी</span>
        </a>
    </li>

    <li class="{{request()->routeIs('admin.digitalBoard.audio.*') ? 'active' : ''}}">
        <a href="{{route('admin.digitalBoard.audio.index')}}">
            <i class="fa fa-scroll"></i>
            <span>  अडियो</span>
        </a>
    </li>
