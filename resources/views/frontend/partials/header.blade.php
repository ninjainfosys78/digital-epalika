{{--topbar--}}
@if(config('app.website_type') === 'website')
    <div class="top-bar">
        <div class="container-fluid">
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-outline-info mx-1">नेपाली</button>
                <button class="btn btn-sm btn-outline-primary">English</button>
            </div>
        </div>
    </div>
@endif
{{--middle header--}}
@include('frontend.partials.header_middle')
