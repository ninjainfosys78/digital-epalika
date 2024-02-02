@extends('admin.layouts.master')
@section('content')
    @push('style')
        <style>
            .form-select {
                display: block;
                width: 100%;
                padding: .375rem 2.25rem .375rem .75rem;
                -moz-padding-start: calc(0.75rem - 3px);
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                background-color: #fff;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right .75rem center;
                background-size: 16px 12px;
                border: 1px solid #ced4da;
                border-radius: .25rem;
                transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }
        </style>
    @endpush
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.roaster.dashboard')}}">
                                   <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.roaster.training.index')}}">तालिम</a>
                            </li>
                            <li class="breadcrumb-item">
                                तालिम विवरण
                            </li>
                            <li class="breadcrumb-item">
                                प्रशिक्षार्थीहरू सम्पादन
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">प्रशिक्षार्थीहरू सम्पादन</h4>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <h4>प्रशिक्षार्थीहरू विवरण</h4>
            </div>
            @livewire('roaster::trainee-livewire',['trainee'=>$trainee])

        </div>

@endsection
