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
                            <a href="{{route('admin.global.units.unit.index')}}">मापन एकाइ</a>
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
                        <h4 class="header-title">नयाँ मापन एकाइ थप्नुहोस्</h4>
                        <a href="{{route('admin.global.units.unit.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> मापन एकाइ सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.units.unit.store')}}" method="post">
                        @csrf
                        @livewire('setting.measurement-unit')

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="title" class="form-label">मापन एकाइ *</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title')}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="मापन एकाइ "
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="title" class="form-label">मापन एकाइ (English) *</label>
                                <input
                                    type="text"
                                    name="title_en"
                                    value="{{old('title_en')}}"
                                    class="form-control @error('title_en') is-invalid @enderror"
                                    id="title_en"
                                    placeholder="मापन एकाइ (English)"
                                />
                                @error('title_en')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="notation" class="form-label">Notation *</label>
                                <input
                                    type="text"
                                    name="notation"
                                    value="{{old('notation')}}"
                                    class="form-control @error('notation') is-invalid @enderror"
                                    id="title"
                                    placeholder="Notation"
                                />
                                @error('notation')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="notation_ne" class="form-label">नोटेशन *</label>
                                <input
                                    type="text"
                                    name="notation_ne"
                                    value="{{old('notation_ne')}}"
                                    class="form-control @error('notation_ne') is-invalid @enderror"
                                    id="notation_ne"
                                    placeholder="नोटेशन"
                                />
                                @error('notation_ne')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="position" class="form-label">Position *</label>
                                <input
                                    type="text"
                                    name="position"
                                    value="{{old('position')}}"
                                    class="form-control @error('position') is-invalid @enderror"
                                    id="position"
                                    placeholder="मापन एकाइ "
                                />
                                @error('position')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">

                                <input
                                    type="checkbox"
                                    name="is_smallest"
                                    value="1"
                                    class="@error('is_smallest') is-invalid @enderror"
                                    id="is_smallest"
                                    {{old('is_smallest')==1?'checked':''}}
                                />
                                <label for="is_smallest" class="form-label">is smallest *</label>

                                @error('is_smallest')
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
