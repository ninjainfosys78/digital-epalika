@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            {{ $type == 'recommendationCategory' ? 'सिफारिस श्रेणी' : 'सिफारिस उप श्रेणी' }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ $type == 'recommendationCategory' ? 'सिफारिस श्रेणी' : 'सिफारिस उप श्रेणी' }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">
                            {{ $type == 'recommendationCategory' ? 'सिफारिस श्रेणी' : 'सिफारिस उप श्रेणी' }}
                            सूची</h4>
                        @can('recommendationCategory_create')
                            <a href="{{ route('admin.recommendation.setting.recommendationCategory.create', $type) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i>
                                नयाँ {{ $type == 'recommendationCategory' ? 'सिफारिस श्रेणी' : 'सिफारिस उप श्रेणी' }} थप्नुहोस
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    @if ($type == 'recommendationSubCategory')
                                        <th>शिर्षक</th>
                                    @endif
                                    <th> {{ $type == 'recommendationCategory' ? 'शिर्षक' : 'वर्ग' }}</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recommendationCategories as $recommendationCategory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $recommendationCategory->title ?? '' }}
                                        </td>
                                        @if ($type == 'recommendationSubCategory')
                                            <td>
                                                {{ $recommendationCategory->recommendationCategory->title ?? '' }}
                                            </td>
                                        @endif
                                        <td>
                                            @can('recommendationCategory_access')
                                                <a data-bs-type="edit" class="{{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    href="{{ route('admin.recommendation.setting.recommendationCategory.updateStatus', [$type, $recommendationCategory]) }}">
                                                    <i
                                                        class="fa fa-2x {{ $recommendationCategory->is_active ? 'fa-toggle-on ' : ' fa-toggle-off' }}"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @if (!$recommendationCategory->recommendation_categories_count)
                                                <a data-bs-type="edit"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    href="{{ route('admin.recommendation.setting.recommendationCategory.recommendationTemplate.index', [$type, $recommendationCategory]) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endif
                                            @can('recommendationCategory_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.recommendation.setting.recommendationCategory.edit', [$type, $recommendationCategory]) }}"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="फारम सम्पादन गर्नुहोस">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                            @endcan
                                            <form
                                                action="{{ route('admin.recommendation.setting.recommendationCategory.destroy', [$type, $recommendationCategory]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                @can('recommendationCategory_delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        title="मेटाउनु होस्">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
