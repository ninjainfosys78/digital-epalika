@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Rename</li>
                    </ol>
                </div>
                <h4 class="page-title">Rename</h4>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($formStore->formStoreStatuses as $formStoreStatus)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0"></h4>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($formStoreStatus->data as $key => $data)
                        @if(is_array($data))
                            <x-form-array-data :formdata="$data"/>
                        @else
                            {{ $key . ': ' . $data }} @if (!$loop->last)
                                <br>
                            @endif

                        @endif
                @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>


@endsection
