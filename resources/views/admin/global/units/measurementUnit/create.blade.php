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
                            <a href="{{route('admin.global.units.measurementUnit.index')}}">मापन एकाइ विविधता</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ मापन एकाइ थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">मापन एकाइ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ मापन एकाइ विविधता थप्नुहोस्</h4>
                        <a href="{{route('admin.global.units.measurementUnit.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> मापन एकाइ विविधता सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.units.measurementUnit.store')}}" method="post">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>मापन एकाइ विविधता </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="type_id" class="form-label">मापन एकाई प्रकार *</label>
                                    <select
                                        name="type_id"
                                        wire:model="type_id"
                                        class="form-select @error('type_id') is-invalid @enderror"
                                        id="type_id">
                                        <option value="">मापन एकाई प्रकार छान्नुहोस्</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">
                                                {{$type->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">मापन एकाइ विविधता *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title')}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="मापन एकाइ विविधता "
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
