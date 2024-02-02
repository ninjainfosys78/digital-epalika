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
                        <li class="breadcrumb-item active">फाइल व्यवस्थापन</li>
                    </ol>
                </div>
                <h4 class="page-title">फाइल व्यवस्थापन</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="mb-0">सबै फाइलहरू</h4>
            <div class="d-flex gap-2">
                <select class="form-control form-control-xs" name="sort">
                    <option value="newest">नयाँ अनुसार</option>
                    <option value="oldest">पुरानो अनुसार</option>
                    <option value="smallest">सानो अनुसार</option>
                    <option value="largest">ठूलो अनुसार</option>
                </select>
                <input type="text" class="form-control form-control-xs" name="search" placeholder="फाइलहरू खोज्नुहोस्"
                       value="">
                <button type="submit" class="btn btn-primary btn-xs">खोज्नुहोस्</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($all_uploads as $key => $file)
                <div class="col-md-3">
                    <div class="aiz-file-box">
                        <div class="dropdown-file dropstart">
                            <a class="dropdown-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">विवरण हेर्नुहोस्</a></li>
                                <li><a class="dropdown-item" href="#">डाउनलोड गर्नुहोस्</a></li>
                                <li><a class="dropdown-item" href="#">मेटाउनुहोस्</a></li>
                            </ul>
                        </div>
                        <div class="select-box">
                            <div class="aiz-checkbox-inline">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" class="check-one" name="id[]" value="1324">
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                        </div>
                        <div class="card card-file aiz-uploader-select c-default" title="{{ $file->file_name }}.{{ $file->extension }}">
                            <div class="card-file-thumb">
                                @switch(get_file_type($file->extension))
                                    @case('image')
                                        <img src="{{$file->file_url }}" class="img-fit">
                                        @break
                                    @case('PDF')
                                        <i class="fas fa-file-pdf"></i>
                                        @break
                                    @case('document')
                                        <i class="fas fa-file"></i>
                                        @break
                                    @case('audio')
                                        <i class="fas fa-file-audio"></i>
                                        @break
                                    @case('video')
                                        <i class="fas fa-file-video"></i>
                                        @break
                                    @case('archive')
                                        <i class="fas fa-file-archive"></i>
                                        @break
                                    @default
                                        <i class="fas fa-file"></i>
                                @endswitch
                            </div>
                            <div class="card-body">
                                <h6 class="d-flex mb-0">
                                    <span class="text-truncate fw-bold">{{$file->file_name}}</span>
                                    <span class="fw-bold">.{{$file->extension}}</span>
                                </h6>
                                <p>{{convert_to_highest_unit($file->file_size)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
