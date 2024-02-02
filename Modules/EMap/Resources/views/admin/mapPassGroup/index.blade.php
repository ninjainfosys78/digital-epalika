@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">नक्शा पास समूह </h4>
                <div class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">नक्शा पास समूह</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">नक्शा पास समूह सूची</h4>
                        @can('mapFee_create')
                            <a href="{{ route('emap.admin.mapPassGroup.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped ">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शिर्षक</th>
                                    <th>प्रयोगकर्ता संख्या</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mapPassGroups as $mapPassGroup)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mapPassGroup->title }}</td>
                                        <td>{{ get_nepali_number($mapPassGroup->users_count) }}</td>
                                        <td>
                                          
                                                <a data-bs-type="edit" class="{{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    href="{{ route('emap.admin.mapPassGroup.updateStatus', $mapPassGroup) }}">
                                                    <i
                                                        class="fa fa-2x {{ $mapPassGroup->status == 'active' ? 'fa-toggle-on ' : ' fa-toggle-off' }}"></i>
                                                </a>
                                           
                                        </td>
                                        <td class="d-flex">
                                            @can('mapFee_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('emap.admin.mapPassGroup.edit', $mapPassGroup) }}"
                                                    class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="सम्पादन गर्नुहोस"></i>
                                                </a>
                                            @endcan

                                            @can('mapFee_delete')
                                                <form action="{{ route('emap.admin.mapPassGroup.destroy', $mapPassGroup) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs me-1 btn-outline-danger show_confirm">
                                                        <i class="fa fa-trash {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="मेटाउनु होस्"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
