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

                        <li class="breadcrumb-item active">इन्धन</li>
                    </ol>
                </div>
                <h4 class="page-title">इन्धन</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">इन्धन </h4>
                        <a href="{{route('admin.plan.fuel.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>इन्धन सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.fuel.update',$fuel)}}" method="post">
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
                                        value="{{old('title',$fuel->title)}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="शिर्षक"
                                    />
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="unit_id" class="form-label">एकाई</label>
                                    <select
                                        name="unit_id"
                                        class="form-control @error('unit_id') is-invalid @enderror"
                                        id="unit_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($units as $unit)
                                            <option
                                                {{old('unit_id',$unit->id)== $fuel->unit_id? 'selected' : ''}}
                                                value="{{$unit->id}}">
                                                {{$unit->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
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
