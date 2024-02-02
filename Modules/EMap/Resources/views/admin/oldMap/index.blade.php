@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mb-0"> पुरानो नक्सा </h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
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
                        <li class="breadcrumb-item active"> पुरानो नक्सा </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">पुरानो नक्सा सूची</h4>
                        <a href="{{ route('emap.admin.oldMap.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>आर्थिक बर्ष</th>
                                    <th>दर्ता नं</th>

                                    <th>घरधनि नाम</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($oldMaps as $oldMap)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $oldMap->fiscalYear->title ?? '' }}</td>
                                        <td>{{ $oldMap->registration_no }}</td>
                                        <td>{{ $oldMap->houseOwner?->first()?->name ?? '' }}</td>
                                        <td class="d-flex">
                                            @can('oldMap_edit')
                                                <a data-bs-type="edit" href="{{ route('emap.admin.oldMap.edit', $oldMap) }}"
                                                    class="btn me-1 btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="सम्पादन गर्नुहोस">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            <form action="{{ route('emap.admin.oldMap.destroy', $oldMap) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                @can('oldMap_delete')
                                                    <button data-bs-type="delete"
                                                        class="btn me-1 btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="मेटाउनु होस्">
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
