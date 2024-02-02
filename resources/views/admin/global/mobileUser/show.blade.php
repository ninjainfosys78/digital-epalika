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
                        <li class="breadcrumb-item active">सेवाग्राही</li>
                    </ol>
                </div>
                <h4 class="page-title">सेवाग्राही विवरण </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="mt-2 text-black">{{ $mobileUser->name }}</h4>
                    <a href="{{ route('admin.global.mobileUser.update-login-status', $mobileUser) }}"
                        class="btn btn-{{ $mobileUser->is_active == 1 ? 'success' : 'danger' }} btn-xs waves-effect mb-2 waves-light"
                        title="लग इन {{ $mobileUser->is_active == 1 ? 'गर्न मिल्छ' : 'गर्न मिल्दैन' }}">
                        <i class="fa  {{ $mobileUser->is_active == 1 ? ' fa-check' : 'fa-window-close' }}"></i>
                        लग इन स्थिति
                    </a>

                    <div class="text-start mt-3">

                        <p class="text-muted mb-2 font-15"><strong>नाम :</strong> <span
                                class="ms-2">{{ $mobileUser->name }}</span>
                        </p>
                        <p class="text-muted mb-2 font-15"><strong>इमेल :</strong><span
                                class="ms-2">{{ $mobileUser->email }}</span></p>

                        <p class="text-muted mb-2 font-15"><strong>फोन :</strong> <span
                                class="ms-2">{{ $mobileUser->phone }}</span></p>

                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
