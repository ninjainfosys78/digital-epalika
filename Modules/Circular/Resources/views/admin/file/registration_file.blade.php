@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.circular.files.registration-file')}}">दर्ता फाईल </a>
                        </li>
                        <li class="breadcrumb-item active">फाईल</li>
                    </ol>
                </div>
                <h4 class="page-title">दर्ता फाईल</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="फाईल खोज्नुहोस्...">
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    @foreach(getAllFilesAndFolders('registration') as $file)
                        <h4 class="mb-2">{{collect($file)->has('label') ? \Illuminate\Support\Str::upper($file['label']) : ''}}</h4>
                        @if(collect($file)->has('children'))
                            <div class="row">
                                @foreach($file['children'] as $child)
                                    @include('admin.inc.file', ['file' => $child])
                                @endforeach
                            </div>
                        @endif
                    @endforeach

                </div> <!-- end .mt-3-->

            </div>
        </div>
    </div>
@endsection
