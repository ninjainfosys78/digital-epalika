@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mb-0">
                    {{ $applicationFormTypeEnum->value == \Modules\EMap\Enums\ApplicationFormTypeEnum::MAP_REGISTRATION->value ? 'नक्सा दर्ता' : 'नक्सा प्रमाणित' }}
                </h4>
                <div class="">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">नक्सा दर्ता/प्रमाणित</li>
                        <li class="breadcrumb-item active">
                            {{ $applicationFormTypeEnum->value == \Modules\EMap\Enums\ApplicationFormTypeEnum::MAP_REGISTRATION->value ? 'नक्सा दर्ता' : 'नक्सा प्रमाणित' }}
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title mb-0">
                    {{ $applicationFormTypeEnum->value == \Modules\EMap\Enums\ApplicationFormTypeEnum::MAP_REGISTRATION->value ? 'नक्सा दर्ता' : 'नक्सा प्रमाणित' }}
                </h4>
                <div class="d-flex flex-wrap align-items-center">
                    @includeIf('inc.filter_form')
                </div>
            </div>
        </div>
        <div class="card-body px-0">
            <ul class="nav nav-pills nav-fill navtab-bg">
                <li class="nav-item">
                    <a href="#tab-all" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                        सबै ({{count($maps)}})
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#tab-type1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                        प्रक्रियामा ({{count($maps->where('sent_to_organization','processing'))}})
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#tab-type3" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        सम्पन्न ({{count($maps->where('sent_to_organization','done'))}})
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-type4" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        अस्वीकार ({{count($maps->where('sent_to_organization','rejected'))}})
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-type2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        बाकी ({{count($maps->where('sent_to_organization','pending'))}})
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane " id="tab-all">
                        <x-map-apply-component :maps="$maps" :application="$applicationFormTypeEnum" />

                </div>
                <div class="tab-pane show active" id="tab-type1">
                    <x-map-apply-component :maps="$maps->where('sent_to_organization','processing')" :application="$applicationFormTypeEnum" />
                </div>

                <div class="tab-pane" id="tab-type3">
                    <x-map-apply-component :maps="$maps->where('sent_to_organization','done')" :application="$applicationFormTypeEnum" />
                </div>

                <div class="tab-pane" id="tab-type4">
                    <x-map-apply-component :maps="$maps->where('sent_to_organization','rejected')" :application="$applicationFormTypeEnum" />
                </div>
                <div class="tab-pane" id="tab-type2">
                    <x-map-apply-component :maps="$maps->where('sent_to_organization','pending')" :application="$applicationFormTypeEnum" />
                </div>

            </div>


        </div>
        <div class="mt-2">
            {{ $maps->onEachSide(config('app.pagination_count'))->links() }}
        </div>
    </div>
@endsection
