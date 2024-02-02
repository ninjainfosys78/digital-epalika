@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सिफारिस</li>
                    </ol>
                </div>
                <h4 class="page-title">नयाँ सिफारिस</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">प्रयोगकर्ताको विवरण</h4>
                        <a href="{{ route('admin.recommendation.recommendationCategory.registrationDetail.index',$recommendationCategory) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सिफारिस सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <th>
                                            नाम
                                        </th>
                                        <td>
                                            {{$registrationDetail->personalDetail->name??''}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            सिफारिस
                                        </th>
                                        <td>
                                            {{$registrationDetail->recommendationCategory->title??''}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            दर्ता नं.
                                        </th>
                                        <td>
                                            {{$registrationDetail->registration_no??''}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            मिति
                                        </th>
                                        <td>
                                            {{$registrationDetail->date_ne??''}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">फाईलहरु</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($registrationDetail->files->where('type','OcFile') as $document)
                            <div class="col-xl-4 col-lg-6">
                                <div class="card shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-2 pe-0">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                          <i class="fa {{getFileIconClass($document->extension)}} font-18"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <a href="javascript:void(0);"
                                                   onclick="openFileModal('{{$document->file_name}}', '{{ $document->extension }}', '{{ $document->file_url }}')"
                                                   class="text-muted fw-medium">{{$document->file_name}}
                                                    .{{$document->extension}}</a>
                                                <p class="mb-0 font-13">{{convert_to_highest_unit($document->file_size)}}</p>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$document->getRawOriginal('file')])}}"
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
            </div>
        </div>
        @include('admin.inc.file-view')
    </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">अन्य फाईलहरु</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($registrationDetail->files->where('type','ClientFile') as $document)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <a href="{{route('admin.file-url-download', ['file_url'=>$document->getRawOriginal('file')])}}"
                                           class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <p>{{$document->file_name}}</p>
                                    </div>
                                    <div class="card-body">
                                        @if($document->extension ==='pdf')
                                            <iframe src="{{$document->file_url}}" frameborder="0"
                                                    width="100%"></iframe>
                                        @elseif(($document->extension ==='png') or ($document->extension ==='jpg') or ($document->extension ==='jpeg'))
                                            <img src="{{ $document->file_url }}" class="card-image" alt="Image"
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
    </div> --}}


    <div class="card">
        <div class="card-header">
            <h4 class="header-title mb-0">अन्य कागजातहरू</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($registrationDetail->files->where('type','ClientFile') as $document)
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                  <i class="fa {{getFileIconClass($document->extension)}} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                           onclick="openFileModal('{{$document->file_name}}', '{{ $document->extension }}', '{{ $document->file_url }}')"
                                           class="text-muted fw-medium">{{$document->file_name}}
                                            .{{$document->extension}}</a>
                                        <p class="mb-0 font-13">{{convert_to_highest_unit($document->file_size)}}</p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{route('admin.file-url-download', ['file_url'=>$document->getRawOriginal('file')])}}"
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
            </div>
        </div>
        @include('admin.inc.file-view');
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title mb-0">सिफारिस प्रिन्ट</h4>
                        <x-print-button
                            target-element="print"
                            title="{{$registrationDetail->recommendationCategory->title??''}}"
                        />
                    </div>
                </div>
                <div class="card-body">
                    <div id="print" class="p-1">
                        <style>
                            @page {
                                margin-top: 0.2px;
                            }
                        </style>
                        {!! $registrationDetail->recommendation_data !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
