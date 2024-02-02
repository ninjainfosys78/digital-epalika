@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.helpDesk.branch.index') }}">हेल्प डेस्क </a>
                        </li>
                        <li class="breadcrumb-item active">शाखा</li>
                    </ol>
                </div>
                <h4 class="page-title">शाखा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">शाखा सूची</h4>
                        @can('branch_create')
                            <a href="{{ route('admin.helpDesk.branch.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
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
                                    <th>शाखा नाम</th>
                                    <th>मुख्य शाखा</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($branches as $key=>$branch)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{ $branch->branch_name }}</th>
                                        <td>{{ $branch->branch->branch_name ?? '' }}</td>
                                        <td>
                                            <a data-bs-type="edit" href="{{ route('admin.helpDesk.branch.edit', $branch) }}"
                                                class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                <i class="fa fa-edit"></i> सम्पादन गर्नुहोस्
                                            </a>
                                            <form action="{{ route('admin.helpDesk.branch.destroy', $branch) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}">
                                                    <i class="fa fa-trash"></i> मेटाउनु होस्
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @foreach ($branch->branches as $subBranch)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}.
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $subBranch->branch_name }}</td>
                                            <td>{{ $subBranch->branch->branch_name ?? '' }}</td>
                                            <td>
                                                <a href="{{ route('admin.helpDesk.branch.edit', $subBranch) }}"
                                                    class="btn btn-xs btn-outline-primary">
                                                    <i class="fa fa-edit"></i> सम्पादन गर्नुहोस्
                                                </a>
                                                <form action="{{ route('admin.helpDesk.branch.destroy', $subBranch) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-xs btn-outline-danger show_confirm">
                                                        <i class="fa fa-trash"></i> मेटाउनु होस्
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
