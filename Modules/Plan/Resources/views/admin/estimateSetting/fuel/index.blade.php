@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">इन्धन </li>
                    </ol>
                </div>
                <h4 class="page-title">इन्धन </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header search-card">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">इन्धन सूची</h4>
                        <a href="{{ route('admin.plan.fuel.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th> शिर्षक</th>
                                    <th> एकाई</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fuels as $key=>$fuel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fuel->title }}</td>
                                        <td>
                                            {{ $fuel->unit->title ?? '' }}

                                        </td>
                                        <td>
                                            <a data-bs-type="edit" href="{{ route('admin.plan.fuel.edit', $fuel) }}"
                                                class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.plan.fuel.destroy', $fuel) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete" class="btn btn-xs btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

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
