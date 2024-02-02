@extends('admin.layouts.master')
@section('content')
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
                        </ol>
                    </div>
                    <h4 class="page-title">तालिम विवरण</h4>
                </div>
            </div>
        </div>
        <div class="card-body card">
            <ul class="nav nav-pills nav-fill navtab-bg">
                <li class="nav-item">
                    <a href="#tab-all" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                        सबै तालिमहरु
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#tab-type1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        छनोट भएका
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#tab-type2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        छनोट नभयका
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show active" id="tab-all">
                        <x-admin-trainee-table :trainees="$trainees->filter(function ($trainee) {
                            return $trainee->select === 'Verified' || $trainee->select === 'Selected';
                        })  " :training="$training" />

                </div>
                <div class="tab-pane" id="tab-type1">
                        <x-admin-trainee-table :trainees="$trainees->where('select','Verified')" :training="$training"/>
                </div>

                <div class="tab-pane" id="tab-type2">
                        <x-admin-trainee-table :trainees="$trainees->where('select','Selected')" :training="$training"/>
                </div>

            </div>


        </div>

@endsection
