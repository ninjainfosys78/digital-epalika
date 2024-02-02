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

                        <li class="breadcrumb-item active">सामग्री प्रकार</li>
                    </ol>
                </div>
                <h4 class="page-title">सामग्री प्रकार</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">सामग्री प्रकार </h4>
                        <a href="{{route('admin.plan.materialType.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>सामग्री प्रकार सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.materialType.update',$materialType)}}" method="post">
                        @csrf
                        @method('put')

                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title',$materialType->title)}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="शिर्षक"
                                    />
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>


                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
