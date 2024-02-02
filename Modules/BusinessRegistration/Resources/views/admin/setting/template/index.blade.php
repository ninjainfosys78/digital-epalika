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
                            <a
                                href="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.index', $templateTypeEnum) }}">
                                टेम्प्लेट</a>
                        </li>
                        <li class="breadcrumb-item active">टेम्प्लेट</li>
                    </ol>
                </div>
                <h4 class="page-title">टेम्प्लेट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">टेम्प्लेट सूची</h4>
                        @can('businessRegistrationTemplate_create')
                            <a href="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.create', $templateTypeEnum) }}"
                                class="btn btn-sm btn-outline-primary">
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
                                    <th>बर्ग</th>
                                    <th>स्थिति</th>
                                    <th>मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($businessRegistrationTemplates as $businessRegistrationTemplate)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $businessRegistrationTemplate->title }}</td>
                                        <td>{{ $businessRegistrationTemplate->for?->label() ?? '' }}</td>
                                        <td>
                                            @can('businessRegistrationTemplate_access')
                                                <a
                                                    href="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.updateStatus', [$templateTypeEnum, $businessRegistrationTemplate]) }}">
                                                    <i
                                                        class="fa fa-2x  {{ $businessRegistrationTemplate->status === 1 ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            <x-ad-to-bs id="fbs_{{ $loop->iteration }}"
                                                adDate="{{ $businessRegistrationTemplate->created_at->toDateString() }}" />
                                        </td>
                                        <td class="d-flex flex-wrap">
                                            @can('businessRegistrationTemplate_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.edit', [$templateTypeEnum, $businessRegistrationTemplate]) }}"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="सम्पादन गर्नुहोस्">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan

                                            <form
                                                action="{{ route('admin.businessRegistration.setting.businessRegistrationTemplate.destroy', [$templateTypeEnum, $businessRegistrationTemplate]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                @can('businessRegistrationTemplate_delete')
                                                    @if ($businessRegistrationTemplate->status == 0)
                                                        <button data-bs-type="delete"
                                                            class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                            title="मेटाउनूहोस्">
                                                            <i class="fa fa-trash"></i>
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
