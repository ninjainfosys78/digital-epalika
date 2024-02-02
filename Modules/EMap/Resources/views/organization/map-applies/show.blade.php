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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">फारम</h4>
                    <x-print-button
                        target-element="print"
                        title="फारम"
                    />
                </div>
            </div>
            <div class="card-body">
                @includeIf('emap::inc.map_show')
            </div>
        </div>
    </div>
@endsection
