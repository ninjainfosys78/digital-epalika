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
                            <a href="{{ route('admin.global.dashboard') }}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">सेवाग्राहीहरु</li>
                    </ol>
                </div>
                <h4 class="page-title">सेवाग्राहीहरुको विवरण </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header search-card">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> सेवाग्राहीहरु</h4>

                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>नाम </th>
                                    <th>ईमेल</th>
                                    <th>फोन नं </th>
                                    <th> # </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mobileUsers as $mobileUser)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $mobileUser->name }}</td>
                                        <td>{{ $mobileUser->email }}</td>
                                        <td>{{ $mobileUser->phone }}</td>
                                        <td class="d-flex flex-wrap">
                                            <a href="{{ route('admin.global.mobileUser.update-login-status', $mobileUser) }}"
                                                class="rounded-1 btn me-1 btn-xs btn-outline-{{ $mobileUser->is_active == 1 ? 'primary' : 'danger' }}"
                                                title="लग इन {{ $mobileUser->is_active == 1 ? 'गर्न मिल्छ' : 'गर्न मिल्दैन' }}">
                                                <i
                                                    class="fa  {{ $mobileUser->is_active == 1 ? ' fa-check' : 'fa-window-close' }}"></i>
                                            </a>
                                            <a href="{{ route('admin.global.mobileUser.show', $mobileUser) }}"
                                                title="हेर्नुहोस्"
                                                class="rounded-1 btn me-1 btn-xs btn-outline-primary  ">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form data-bs-type="delete"
                                                action="{{ route('admin.global.mobileUser.destroy', $mobileUser) }}"
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
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">सेवाग्राहीमा कुनै डाटा
                                            उपलब्ध छैन !!!</td>
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
