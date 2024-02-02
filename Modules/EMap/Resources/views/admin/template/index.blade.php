@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mb-0">टेम्प्लेट</h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.eMapTemplate.index') }}"> टेम्प्लेट</a>
                        </li>
                        <li class="breadcrumb-item active">टेम्प्लेट</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">टेम्प्लेट सूची</h4>
                        @can('eMapTemplate_create')
                            <a href="{{ route('emap.admin.eMapTemplate.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ टेम्प्लेट थप्नुहोस्
                            </a>
                        @endcan

                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शिर्षक </th>
                                    <th>स्थिति</th>
                                    <th>मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($eMapTemplates as $eMapTemplate)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $eMapTemplate->title }}</td>
                                        <td>
                                            @can('eMapTemplate_access')
                                                <a href="{{ route('emap.admin.eMapTemplate.updateStatus', $eMapTemplate) }}">
                                                    <i
                                                        class="fa fa-2x  {{ $eMapTemplate->status ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            <x-ad-to-bs id="fbs_{{ $loop->iteration }}"
                                                adDate="{{ $eMapTemplate->created_at->toDateString() }}" />
                                        </td>
                                        <td class="d-flex">
                                            @can('eMapTemplate_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('emap.admin.eMapTemplate.edit', [$eMapTemplate]) }}"
                                                    class="btn btn-xs me-1 btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="सम्पादन गर्नुहोस">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan

                                            <form action="{{ route('emap.admin.eMapTemplate.destroy', [$eMapTemplate]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                @can('eMapTemplate_delete')
                                                    @if ($eMapTemplate->status == 0)
                                                        <button data-bs-type="delete"
                                                            class="btn btn-xs btn-outline-danger show_confirm">
                                                            <i class="fa fa-trash {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="मेटाउनु होस्"></i>
                                                        </button>
                                                    @endif
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
