@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $mapApply->unique_id }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ $mapApply->unique_id }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card  p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0"></h4>

                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शिर्षक</th>
                                    <th>Need From</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($forms as $form)
                                    <tr @if ($form->map_status==\Modules\EMap\Enums\DocumentStatusEnum::REJECTED) style="background-color:#d16969;" @endif>
                                        <td>{{ get_nepali_number($loop->iteration) }}</td>
                                        <td>{{ $form->title }}</td>
                                        <td>
                                            {{ $form->need_from?->label() ?? '' }}
                                            {{--                                        {{$mapApply->getCheckFormFilledAttribute($form->formDataTypes->pluck('original_type')->toArray())}} --}}
                                        </td>
                                        <td>{{$form->map_status?->label()}}</td>
                                        <td class="d-flex">

                                            @if ($form->need_from !== \Modules\EMap\Enums\EMapFormFillerTypeEnum::OFFICE)
                                                <a href="{{ route('organization.admin.formDetail', [$mapApply, $form]) }}"
                                                    class="btn me-1 btn-xs btn-outline-primary {{ $form->order == $order ? '' : 'disabled' }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                        @if($form->show_to_consultancy == 1)
                                            <a href="{{ route('organization.admin.organization.view-detail', [$mapApply, $form]) }}"
                                                class="btn me-1 btn-xs btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
