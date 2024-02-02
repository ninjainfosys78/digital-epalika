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
                            <a href="{{ route('admin.businessRegistration.setting.investmentRevenue.index') }}">पुँजीगत
                                लगानी र राजस्वो </a>
                        </li>
                        <li class="breadcrumb-item active">कारोबार गर्ने वस्तु उप श्रेणी</li>
                    </ol>
                </div>
                <h4 class="page-title">कारोबार गर्ने वस्तु उप श्रेणी</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">पुँजीगत लगानी र राजस्वो सूची</h4>
                        @can('investmentRevenue_create')
                            <a href="{{ route('admin.businessRegistration.setting.investmentRevenue.create') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ पुँजीगत लगानी र राजस्वो थप्नुहोस्
                            </a>
                        @endcan

                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        @includeIf('inc.filter_form')
                        <table class="table table-sm mb-0 table-striped table-hover mt-3">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शिर्षक </th>
                                    <th>बर्ग</th>
                                    <th>नयाँ व्यवसाय दर्ता गर्दा लाग्ने
                                        शुल्क</th>
                                    <th>व्यवसाय नबिकरण दर्ता गर्दा लाग्ने शुल्क</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($investmentRevenues as $investmentRevenue)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $investmentRevenue->title }}</td>
                                        <td>{{ $investmentRevenue->objectTransaction->title ?? '' }}</td>
                                        <td>{{ $investmentRevenue->registration_amount ?? 0 }}</td>
                                        <td>{{ $investmentRevenue->renew_amount ?? 0 }}</td>
                                        <td class="d-flex gap-1">
                                            @can('investmentRevenue_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.businessRegistration.setting.investmentRevenue.edit', $investmentRevenue) }}"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="सम्पादन गर्नुहोस्">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            <form
                                                action="{{ route('admin.businessRegistration.setting.investmentRevenue.destroy', $investmentRevenue) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                @can('investmentRevenue_delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        title="मेटाउनूहोस्">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
                    <div class="mt-2">
                        {{ $investmentRevenues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
