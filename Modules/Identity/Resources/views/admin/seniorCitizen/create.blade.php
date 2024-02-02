@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> जेष्ठ नागरिक</li>
                    </ol>
                </div>
                <h4 class="page-title"> जेष्ठ नागरिक</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ जेष्ठ नागरिक थप्नुहोस्</h4>
                        <div>
                            <a href="{{ route('identity.admin.seniorCitizenDetail.index') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> जेष्ठ नागरिक सुची
                            </a>
                            <a href="https://localhost:8003/mfs100" target="_blank" class="btn btn-sm btn-outline-primary">
                                Run MFS 100
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    @livewire('identity::senior-citizen-detail-livewire')
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /*progressbar*/
            .progressbar {
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
                width: 60%;
                margin: 0 auto 30px;
            }

            .progressbar li {
                list-style-type: none;
                color: white;
                text-transform: uppercase;
                font-size: 18px;
                width: 25%;
                float: left;
                position: relative;
                text-decoration: none;
            }

            .progressbar li a {
                text-decoration: none;
            }

            .progressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 50px;
                line-height: 50px;
                display: block;
                font-size: 18px;
                font-weight: bold;
                color: #333;
                background: #eeeeee;
                border-radius: 50%;
                margin: 0 auto 5px auto;
            }

            .progressbar .success:before {
                background: #5ed00f;
                color: white;
            }

            /*progressbar connectors*/
            .progressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: white;
                position: absolute;
                left: -50%;
                top: 9px;
                z-index: -1;
                /*put it behind the numbers*/
            }

            .progressbar li:first-child:after {
                /*connector not needed before the first step*/
                content: none;
            }

            /*marking active/completed steps green*/
            /*The number of the step and the connector before it = green*/
            .progressbar li.active:before,
            .progressbar li.active:after {
                background: rgb(255, 99, 71);
                color: white;
            }

            .displayNone {
                display: none;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            window.addEventListener('toast_message', event => {
                swal.fire({
                    title: event.detail.title,
                    toast: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    width: 400,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: event.detail.type,
                });
            });
        </script>
    @endpush
@endsection
