@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.plan.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.plan.project.index')}}">
                                योजनाहरु
                            </a>
                        </li>
                        <li class="breadcrumb-item active">योजना संग सम्बन्धित फोटो/फाईलहरू थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">योजना संग सम्बन्धित फोटो/फाईलहरू थप्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">योजना संग सम्बन्धित फोटो/फाईलहरू</h4>
                        <a href="{{route('admin.plan.project.show',$project)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.project.uploadFile',$project)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="file_name" class="form-label">फाइल नाम </label>
                                <input
                                    type="text"
                                    name="file_name"
                                    value="{{old('file_name')}}"
                                    class="form-control @error('file_name') is-invalid @enderror"
                                    id="file_name"
                                    placeholder="फाइल नाम"
                                />
                                @error('file_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="files" class="form-label">फाइल (Multiple) * </label>
                                <input
                                    type="file"
                                    name="files[]"
                                    multiple
                                    class="form-control @error('files') is-invalid @enderror"
                                    id="files"
                                />
                                @error('files')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                @error('files.*')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
