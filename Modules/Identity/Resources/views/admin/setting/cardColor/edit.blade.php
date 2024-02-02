@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">कोड रङ</li>
                    </ol>
                </div>
                <h4 class="page-title">कोड रङ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> कोड रङ सम्पादन गर्नुहोस</h4>
                        <a href="{{route('identity.admin.setting.cardColor.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> कोड रङ सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('identity.admin.setting.cardColor.update',$cardColor)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title',$cardColor->title)}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="शिर्षक"
                                    required
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">कोड रङ *</label>
                                <input
                                    type="color"
                                    name="color"
                                    value="{{old('color',$cardColor->color)}}"
                                    class="form-control @error('color') is-invalid @enderror"
                                    id="color"
                                    placeholder="कोड रङ"
                                    required
                                />
                                @error('color')
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


