@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.revenue.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">क्षेत्र</li>
                    </ol>
                </div>
                <h4 class="page-title">क्षेत्र</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">क्षेत्र सूची</h4>
                        @can('sector_create')
                            <a href="{{ route('admin.revenue.setting.sector.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>क्षेत्र</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sectors as $key=>$sector)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sector->title }}</td>
                                        <td>
                                            @can('sector_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.revenue.setting.sector.edit', [$sector]) }}"
                                                    class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit"></i> सम्पादन गर्नुहोस्
                                                </a>
                                            @endcan
                                            @can('sector_delete')
                                                <form action="{{ route('admin.revenue.setting.sector.destroy', [$sector]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}">
                                                        <i class="fa fa-trash"></i> मेटाउनु होस्
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
