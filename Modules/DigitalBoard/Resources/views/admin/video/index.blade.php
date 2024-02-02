@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.digitalBoard.video.index') }}">डिजिटल बोर्ड</a>
                    </li>
                    <li class="breadcrumb-item active">भिडियो </li>
                </ol>
            </div>
            <h4 class="page-title">भिडियो </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header search-card">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title mb-0">भिडियोहरु</h4>
                    <div class="d-flex flex-wrap align-items-center">
                        @includeIf('inc.filter_form')
                        @can('digitalBoardVideo_create')
                        <a href="{{ route('admin.digitalBoard.video.create') }}"
                            class="btn btn-sm btn-outline-primary waves-effect waves-light">
                            <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table table-sm table-custom">
                        <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>शिर्षक </th>
                                <th>भिडियो </th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                            <tr>
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $video->title }}
                                </td>
                                <td class="align-middle">
                                    <video width="130" height="100" controls>
                                        <source src="{{ $video->video_url }}">
                                    </video>
                                </td>
                                <td class="d-flex gap-1">
                                    @can('digitalBoardVideo_edit')
                                    <a data-bs-type="edit" href="{{ route('admin.digitalBoard.video.edit', $video) }}"
                                        class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                        title="सम्पादन गर्नुहोस्">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                            </svg>
                                    </a>
                                    @endcan
                                    @can('digitalBoardVideo_delete')
                                    <form action="{{ route('admin.digitalBoard.video.destroy', $video) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button data-bs-type="delete"
                                            class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                            title="मेटाउनु होस्">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            <tr class="empty"><td></td></tr>
                            @empty
                            <tr>
                                <td class="text-danger text-center" colspan="4">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {{ $videos->onEachSide(config('app.pagination_count'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection