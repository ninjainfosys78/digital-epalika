@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.taskManagement.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सबै कार्यहरू</li>
                    </ol>
                </div>
                <h4 class="page-title">सबै कार्यहरू </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header search-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">सबै कार्यहरू </h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>मिति</th>
                                    <th>शाखा</th>
                                    <th>User</th>
                                    <th>कार्यहरु</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $activity->date }}
                                        </td>
                                        <td>
                                            {{ $activity->branch->branch_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $activity->user->name ?? '' }}
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($activity->activityLists as $list)
                                                    <li>{{ $list->title }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @can('allTaskActivity_access')
                                                <a href="{{ route('admin.taskManagement.activity.show', $activity) }}"
                                                    title="हेर्नुहोस" class="btn btn-xs btn-outline-success">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $activities->onEachSide(config('app.pagination_count'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
