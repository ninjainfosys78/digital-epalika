@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">
                            <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.grievanceHandling.grievanceDetail.index')}}">गुनासो बिबरण </a>
                    </li>
                    <li class="breadcrumb-item active">प्राप्त गुनासोहरु</li>
                </ol>
            </div>
            <h4 class="page-title">प्राप्त गुनासोहरु </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header search-card">
                <div class="d-flex align-items-center justify-content-between align-items-center">
                    <h4 class="header-title mb-0">प्राप्त गुनासोहरु</h4>
                    <div class="d-flex flex-wrap align-items-center">
                        @includeIf('inc.filter_form')
                        @can('grievanceDetail_create')
                        <a href="{{ route('admin.grievanceHandling.grievanceDetail.create') }}"
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
                                <th>टोकन</th>
                                <th>गुनासोको प्रकार</th>
                                <th> गुनासोको शिर्षक</th>
                                <th>गुनासो दाखिला गरेको मिति</th>
                                <th> गुनासो प्रकाशन मिति</th>
                                <th> गुनासोको प्राथमिकता</th>
                                <th> गुनासोको अवस्था</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grievanceDetails as $grievanceDetail)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$grievanceDetail->token}}</td>
                                <td>{{$grievanceDetail->grievanceType->title??''}}</td>
                                <td>{{$grievanceDetail->subject}}</td>
                                <td>{{$grievanceDetail->created_at->toDateString()}}</td>
                                <td>{{$grievanceDetail->created_at->toDateString()}}</td>
                                <td>
                                    {{$grievanceDetail->complaint_severity->label()}}
                                </td>
                                <td>
                                    {{$grievanceDetail->status->label()}}
                                </td>
                                <td>
                                    <a href="{{route('admin.grievanceHandling.grievanceDetail.show',$grievanceDetail)}}"
                                        class="btn btn-xs btn-outline-primary" title="थप हेर्नुहोस्">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <tr class="empty"><td></td</tr>
                            @empty
                            <tr>
                                <td class="text-center text-danger" colspan="10">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {{ $grievanceDetails->onEachSide(config('app.pagination_count'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection