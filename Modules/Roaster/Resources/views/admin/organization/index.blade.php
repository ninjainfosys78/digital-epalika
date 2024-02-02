@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mb-0">दर्ता भएका संगठनहरु </h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">संगठन</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-0">
        <div class="">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title mb-0">दर्ता भएका संगठनहरु</h4>
                <div class="d-flex flex-wrap align-items-center">
                    @includeIf('inc.filter_form')
                </div>
            </div>
        </div>
        <div class="card-body px-0">
            <div class="responsive-table-design">
                <div class="table-rep-design">
                    <div id="responsive-table" class="table-responsive" data-pattern="priority-columns">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>क्र.स</th>
                                        <th>संगठनको नाम</th>
                                        <th>ठेगाना</th>
                                        <th>संस्थापकको नाम</th>
                                        <th>इमेल</th>
                                        <th>फोन</th>


                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($organizations as $organization)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $organization->traineeUserDetail->org_name_ne ?? '' }}</td>
                                            <td>{{ $organization->traineeUserDetail->province->province ?? '' }},
                                                {{ $organization->traineeUserDetail->district->district ?? '' }}</td>
                                            <td>{{ $organization->name }}</td>
                                            <td>{{ $organization->email }}</td>
                                            <td>{{ $organization->phone }}</td>

                                            <td class="d-flex flex-wrap">

                                                <a href="{{ route('admin.roaster.organization.update-login-status', $organization) }}"
                                                    class="rounded-1 btn me-1 btn-xs btn-outline-{{ $organization->is_active == 1 ? 'primary' : 'danger' }}"
                                                    title="लग इन {{ $organization->is_active == 1 ? 'गर्न मिल्छ' : 'गर्न मिल्दैन' }}">
                                                    <i
                                                        class="fa  {{ $organization->is_active == 1 ? ' fa-check' : 'fa-window-close' }}"></i>
                                                </a>

                                                <a href="{{ route('admin.roaster.organization.show', $organization) }}"
                                                    title="हेर्नुहोस्"
                                                    class="rounded-1 btn me-1 btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <form data-bs-type="delete"
                                                    action="{{ route('admin.roaster.organization.destroy', $organization) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        class="rounded-1 btn btn-xs btn-outline-danger show_confirm {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        title="मेटाउनु होस्">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="8">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2">
                            {{ $organizations->onEachSide(config('app.pagination_count'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
