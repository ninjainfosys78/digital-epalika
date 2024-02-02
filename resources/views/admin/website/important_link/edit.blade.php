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
                            <a href="">महत्त्वपूर्ण लिङ्क</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ महत्त्वपूर्ण लिङ्क थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">महत्त्वपूर्ण लिङ्क</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ महत्त्वपूर्ण लिङ्क थप्नुहोस्</h4>
                        <a href="{{route('admin.global.website.importantLink.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> महत्त्वपूर्ण लिङ्क सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.website.importantLink.update',$importantLink)}}"
                          enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="link_title" class="form-label"> शीर्षक</label>
                                <input
                                    type="text"
                                    name="link_title"
                                    value="{{old('link_title',$importantLink->link_title)}}"
                                    class="form-control @error('link_title') is-invalid @enderror"
                                    id="link_title"
                                    placeholder="शीर्षक"
                                />
                                @error('link_title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="link_url" class="form-label">लिंक </label>
                                <input
                                    type="text"
                                    name="link_url"
                                    value="{{old('link_url',$importantLink->link_url)}}"
                                    class="form-control @error('link_url') is-invalid @enderror"
                                    id="link_url"
                                    placeholder="लिंक"
                                />
                                @error('link_url')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
