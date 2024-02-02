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
                            <a href="{{ route('admin.executiveMeeting.municipalCommittee.index') }}">इ-कार्यपालिका</a>
                        </li>
                        <li class="breadcrumb-item active">वडा समिति</li>
                    </ol>
                </div>
                <h4 class="page-title">वडा समिति</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">वडा समितिहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            @can('executiveWardCommittee_create')
                                <a href="{{ route('admin.executiveMeeting.wardCommittee.create') }}"
                                    class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>वडा नं.</th>
                                    <th>नाम</th>
                                    <th>फोटो</th>
                                    <th>पद</th>
                                    <th>फोन नम्बर</th>
                                    <th>इमेल</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wardCommittees as $committeeWard=>$wardCommitteeGroup)
                                    <tr>
                                        <th scope="row" rowspan="{{ $wardCommitteeGroup->count() }}"
                                            class="align-middle">{{ $loop->iteration }}</th>
                                        <td rowspan="{{ $wardCommitteeGroup->count() }}" class="align-middle">
                                            {{ $committeeWard }}</td>
                                        <td>{{ $wardCommitteeGroup->first()->name ?? '' }}</td>
                                        <td class="table-user">
                                            <img src="{{ $wardCommitteeGroup->first()->photo_url ?? '' }}"
                                                class="me-2 rounded-circle" alt="">
                                        </td>
                                        <td>{{ $wardCommitteeGroup->first()->designation ?? '' }}</td>
                                        <td>{{ $wardCommitteeGroup->first()->phone ?? '' }}</td>
                                        <td>{{ $wardCommitteeGroup->first()->email ?? '' }}</td>

                                        <td>
                                            @can('update', $wardCommitteeGroup->first())
                                                @can('executiveWardCommittee_edit')
                                                    <a data-bs-type="edit"
                                                        href="{{ route('admin.executiveMeeting.wardCommittee.edit', $wardCommitteeGroup->first() ?? '') }}"
                                                        title="सम्पादन गर्नुहोस्"
                                                        class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                            @endcan
                                            @can('delete', $wardCommitteeGroup->first())
                                                @can('executiveWardCommittee_delete')
                                                    <form
                                                        action="{{ route('admin.executiveMeeting.wardCommittee.destroy', $wardCommitteeGroup->first() ?? '') }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-bs-type="delete" type="submit"
                                                            class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                            title="मेटाउनु होस्">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            @endcan
                                        </td>
                                    </tr>
                                    @foreach ($wardCommitteeGroup->skip(1) as $wardCommittee)
                                        <tr>
                                            <td>{{ $wardCommittee->name }}</td>
                                            <td class="table-user">
                                                <img src="{{ $wardCommittee->photo_url }}" class="me-2 rounded-circle"
                                                    alt="">
                                            </td>

                                            <td>{{ $wardCommittee->designation }}</td>
                                            <td>{{ $wardCommittee->phone }}</td>
                                            <td>{{ $wardCommittee->email }}</td>

                                            <td>
                                                @can('update', $wardCommittee)
                                                    @can('executiveWardCommittee_edit')
                                                        <a data-bs-type="edit"
                                                            href="{{ route('admin.executiveMeeting.wardCommittee.edit', $wardCommittee) }}"
                                                            title="सम्पादन गर्नुहोस्"
                                                            class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                @endcan
                                                @can('delete', $wardCommittee)
                                                    @can('executiveWardCommittee_delete')
                                                        <form
                                                            action="{{ route('admin.executiveMeeting.wardCommittee.destroy', $wardCommittee) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button data-bs-type="delete" type="submit"
                                                                class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                                title="मेटाउनु होस्">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
