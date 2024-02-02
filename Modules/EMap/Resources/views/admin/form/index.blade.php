@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">नक्शा पास मर्यादाक्रम </h4>
                <div class="">
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
                        <li class="breadcrumb-item active">नक्शा पास मर्यादाक्रम</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="mt-1">
            <div class="card  p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">नक्शा पास फारम सूची</h4>
                        @can('mapFee_create')
                            <a href="{{ route('emap.admin.form.create') }}" class="btn btn-sm btn-outline-primary">
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
                                    <th>क्रम स्थान</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($forms as $form)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $form->title }}</td>
                                        <td>{{ $form->order }}</td>
                                        <td>
                                           
                                                <a data-bs-type="edit" class="{{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    href="{{ route('emap.admin.form.updateStatus', $form) }}">
                                                    <i
                                                        class="fa fa-2x {{ $form->status == 'active' ? 'fa-toggle-on ' : ' fa-toggle-off' }}"></i>
                                                </a>
                                         
                                        </td>
                                        <td class="d-flex">
                                            @can('mapFee_edit')
                                                <a data-bs-type="edit" href="{{ route('emap.admin.form.edit', $form) }}"
                                                    class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="सम्पादन गर्नुहोस"></i>
                                                </a>
                                            @endcan

                                            <form action="{{ route('emap.admin.form.destroy', $form) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                @can('mapFee_delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs me-1 btn-outline-danger show_confirm">
                                                        <i class="fa fa-trash {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="मेटाउनु होस्"></i>
                                                    </button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
