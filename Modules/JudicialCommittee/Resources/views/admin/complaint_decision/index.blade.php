@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">निर्णय विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">निर्णय</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">निर्णय विवरण</h4>
                        <div class="d-flex justify-content-between gap-1">
                            <x-print-button title="निर्णय विवरण" target-element="print-content" />
                            @can('complaintDecision_edit')
                                <a href="{{ route('admin.judicialCommittee.complaintApplication.complaintDecision.create', $complaintApplication) }}"
                                    class="btn btn-sm btn-outline-warning">
                                    <i class="fa fa-edit"> सम्पादन गर्नुहोस्</i>
                                </a>
                            @endcan
                            <a href="{{ route('admin.judicialCommittee.registeredApplication') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> दर्ता भएका उजुरी
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="mx-4 p-2 border border-secondary">
                        <div id="print-content">
                            {!! $complaintApplication->complaintDecision->description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title fw-bold">
                        सम्बन्धित फोटो/फाईलहरू
                    </h4>
                    <div class="row">
                        @foreach ($complaintApplication->complaintDecision->files ?? collect() as $file)
                            <div class="col-md-4 mb-3">
                                <div class="card border border-info">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5 class="card-title">
                                            {{ $file->file_name }}
                                        </h5>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.file.download', $file) }}"
                                                class="btn btn-xs btn-outline-primary mx-1">
                                                <i class="fa fa-download"></i>
                                            </a>
                                            <form action="{{ route('admin.file.destroy', $file) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="show_confirm btn btn-sm btn-danger ml-2">
                                                    <i class="fa fa-window-close"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($file->extension === 'pdf')
                                            <iframe src="{{ $file->file_url }}" frameborder="0" width="100%"></iframe>
                                        @elseif($file->extension === 'png' or $file->extension === 'jpg' or $file->extension === 'jpeg')
                                            <img src="{{ $file->file_url }}" class="card-image" alt="Image"
                                                height=150px;" width="100%">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
