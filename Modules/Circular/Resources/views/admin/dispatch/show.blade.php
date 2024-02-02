@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.circular.dispatch.index') }}">चलानी पत्र </a>
                        </li>
                        <li class="breadcrumb-item active">चलानी</li>
                    </ol>
                </div>
                <h4 class="page-title">चलानी पत्र</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm" style="text-align: end">
            <button class="btn btn-sm btn-info"
                onclick="printJS({
                    printable: 'printData',
                    css: '{{ asset('assets/backend/css/print.css') }}',
                    type: 'html'
                    })">
                <i class="fa fa-print"></i> Print
            </button>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">चलानी पत्र विवरण</h4>

                        <a href="{{ route('admin.circular.dispatch.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> चलानी पत्र सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="printData">
                            <table class="table table-sm mb-0 table-striped table-hover table-bordered">

                                <tbody>
                                    <tr>
                                        <th>चलानी न.</th>
                                        <td>{{ $dispatch->dispatch_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>आर्थिक वर्ष</th>
                                        <td>{{ $dispatch->fiscalYear->title ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>चलानी मिति</th>
                                        <td>{{ $dispatch->dispatch_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>पत्र संख्या.</th>
                                        <td>{{ $dispatch->letter_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>पत्रको मिति.</th>
                                        <td>{{ $dispatch->letter_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>पाउने कार्यालयको नाम</th>
                                        <td>{{ $dispatch->receiver_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>पाउने कार्यालयको ठेगाना</th>
                                        <td>{{ $dispatch->receiver_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>बिषय.</th>
                                        <td>{{ $dispatch->subject }}</td>
                                    </tr>
                                    <tr>
                                        <th>हुलाक/ र.न./इमेल.</th>
                                        <td>{{ $dispatch->receiver_contact }}</td>
                                    </tr>

                                    <tr>
                                        <th>कैफ़ियत.</th>
                                        <td>{!! $dispatch->remarks !!}</td>
                                    </tr>
                                    <tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="header-title mb-0">आवश्यक कागजातहरु</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($dispatch->dispatchDetail?->files as $document)
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i class="fa {{ getFileIconClass($document->extension) }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('{{ $document->file_name }}', '{{ $document->extension }}', '{{ $document->file_url }}')"
                                            class="text-muted fw-medium">{{ $document->file_name }}
                                            .{{ $document->extension }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($document->file_size) }}</p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file.download', $document) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div> <!-- end row -->
                            </div> <!-- end .p-2-->
                        </div> <!-- end col -->
                    </div>
                @empty
                    <p class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</p>
                @endforelse
            </div> <!-- end row-->
        </div>
        @include('admin.inc.file-view');
    </div>
@endsection
