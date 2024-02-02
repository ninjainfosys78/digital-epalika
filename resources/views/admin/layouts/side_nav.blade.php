<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <x-logged-in-user-component/>
            <ul id="side-menu">
                @if(in_array(Str::lower(Request::segment(2)),config('menus.modules')))
                    @includeIf(Str::lower(Request::segment(2)).'::admin.layouts.sidebar')
                @elseif(in_array(Str::lower(Request::segment(2)),config('menus.sidebars')))
                    @includeIf('admin.'.Str::lower(Request::segment(2)).'.layouts.sidebar')
                @else
                    @includeIf('admin.layouts.sidebar')
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
