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
                            <a href="{{route('admin.roaster.setting.subject.index')}}">विषय</a>
                        </li>
                        <li class="breadcrumb-item active"> विषय सम्पादन</li>
                    </ol>
                </div>
                <h4 class="page-title">विषय सम्पादन</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">विषय सम्पादन</h4>
                        <a href="{{route('admin.roaster.setting.subject.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> विषय सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.roaster.setting.subject.update',$subject)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">बिषय *</label>
                                    <input id="title" type="text" name="title" placeholder="बिषय"
                                           class="form-control @error('title') is-invalid @enderror" value="{{old('title',$subject->title)}}" required>
                                    @error('title')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="level" class="form-label">स्तर *</label>
                                    <input id="level" type="text" name="level" placeholder="स्तर"
                                           class="form-control @error('level') is-invalid @enderror" value="{{old('level',$subject->level)}}" required>
                                    @error('level')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="duration" class="form-label">अवधि *</label>
                                    <input id="duration" type="text" name="duration" placeholder="बिषय"
                                           class="form-control @error('duration') is-invalid @enderror" value="{{old('duration',$subject->duration)}}" required>
                                    @error('duration')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="content" class="form-label">बिषय सामग्री</label>
                                    <textarea id="content" name="content" placeholder="बिषय सामग्री"
                                              class="form-control @error('content') is-invalid @enderror" cols="30"
                                              rows="10">{{old('content',$subject->content)}}</textarea>
                                    @error('content')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



