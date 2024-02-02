@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.circular.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.circular.registration.index') }}"> दर्ता पत्र </a>
                        </li>
                        <li class="breadcrumb-item active">दर्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">दर्ता प्रणाली</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">दर्ता पत्र विवरण</h4>

                        <a href="{{ route('admin.circular.registration.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> दर्ता पत्र सूची
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-striped table-hover table-bordered">

                                    <tbody>
                                        <tr>
                                            <th>दर्ता न.</th>
                                            <td>{{ $registration->registration_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>आर्थिक वर्ष</th>
                                            <td>{{ $registration->fiscalYear->title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>दर्ता मिति</th>
                                            <td>{{ $registration->registration_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>पत्र संख्या.</th>
                                            <td>{{ $registration->letter_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>पत्रको मिति.</th>
                                            <td>{{ $registration->letter_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>पठाउने कार्यालयको नाम.</th>
                                            <td>{{ $registration->sender_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>बिषय.</th>
                                            <td>{{ $registration->subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>कैफ़ियत.</th>
                                            <td>{{ $registration->remarks }}</td>
                                        </tr>
                                        <tr>
                                            <th>बुझिलिनेको नाम</th>
                                            <td>{{ $registration->receiver_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>बुझिलिनेको सम्पर्क नम्बर.</th>
                                            <td>{{ $registration->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>बुझिलिनेको सहि.</th>
                                            <td><img src="{{ $registration->signature_image_url }}" alt=""
                                                    height="60px;"></td>
                                        </tr>
                                        <tr>
                                            <th> मिति.</th>
                                            <td>{{ $registration->date }}</td>
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
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="header-title mb-0">आवश्यक कागजातहरु</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($registration->files as $document)
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($document->extension) }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                        onclick="openFileModal('{{$document->file_name}}', '{{ $document->extension }}', '{{ $document->file_url }}')"
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
