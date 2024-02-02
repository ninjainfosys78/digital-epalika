<li class="{{request()->is('admin/listregistration/dashboard') ? 'active' : ''}}">
    <a href="{{route('admin.listRegistrations.dashboard')}}">
        <i class="fa fa-home"></i>
        <span> ड्यासबोर्ड</span>
    </a>
</li>

<li class="{{request()->is('admin/listregistration/listRegistration*') ? 'active' : ''}}">
    <a href="{{route('admin.listRegistrations.listRegistration.index')}}">
        <i class="fa fa-clipboard-check"></i>
        <span>मौजुदा सुची दर्ता</span>
    </a>
</li>

<li class="{{request()->is('admin/listregistration/report*') ? 'active' : ''}}">
    <a href="{{route('admin.listRegistrations.report.index')}}">
        <i class="fa fa-clipboard-list"></i>
        <span>रिपोर्ट</span>
    </a>
</li>
<li class="{{request()->is('admin/listregistration/files*') ? 'active' : ''}}">
    <a href="{{route('admin.listRegistrations.files.file')}}">
        <i class="fa fa-file-archive"></i>
        <span>फाईल व्यवस्थापन</span>
    </a>
</li>
