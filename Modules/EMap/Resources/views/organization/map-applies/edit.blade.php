@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">फारम</li>
                    </ol>
                </div>
                <h4 class="page-title">फारम</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb_30">
                <div class="card-header p-3">
                    <div class="main-title d-flex justify-content-between">
                        <h3 class="mb-0">नक्सा दरखास्त फारम</h3>
                        <a href="#"
                           class="btn btn-primary btn-sm">
                            <i class="fa fa-list"></i> सेवाग्राही
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <livewire:emap::map-apply-livewire :mapApply="$mapApply"/>
                </div>

            </div>
        </div>
    </div>
    @push('style')
        <style>
            .font-black p {
                color: black;
            }

            .building-construction-application input[type="text"],
            .building-construction-application input[type="file"],
            .building-construction-application input[type="number"],
            .building-construction-application select,
            .building-construction-application input[type="date"] {
                border-bottom: dotted 3px black;
                border-top: none;
                border-right: none;
                border-left: none;
                margin: 0 5px;
                /*width: 60%;*/
            }

            td > input[type="text"],
            td > input[type="file"],
            td > input[type="number"],
            td > select,
            td > input[type="date"] {
                width: 100%;
            }


        </style>
    @endpush

    @push('scripts')
        {{--listener for toastr--}}
        <script>
            window.addEventListener('alert_message', event => {
                swal.fire({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                });
            });
        </script>
    @endpush
@endsection
