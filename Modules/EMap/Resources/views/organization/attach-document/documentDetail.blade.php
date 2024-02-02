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
                        <li class="breadcrumb-item active">{{$appliedDocument->form?->title}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$appliedDocument->form?->title}}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($appliedDocument->appliedMapFiles as $appliedMapFile)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">{{$appliedDocument->form?->title}}</h4>
                        <a href="{{$appliedMapFile->document_url}}" class="btn btn-primary" download="{{$appliedMapFile->document_url}}"><i class="fa fa-download"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <iframe src="{{ $appliedMapFile->document_url }}" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
        @endforeach
    </div>


@endsection
