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
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">नक्शा दस्तुर</li>
                    </ol>
                </div>
                <h4 class="page-title">नक्शा दस्तुर </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नक्शा शुल्क सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('emap.admin.mapFee.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> नक्शा दस्तुर सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('emap.admin.mapFee.update',$mapFee)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="storey" class="form-label">तल्ला *</label>
                                <input
                                    type="text"
                                    name="storey"
                                    value="{{old('storey',$mapFee->storey)}}"
                                    class="form-control @error('storey') is-invalid @enderror"
                                    id="storey"
                                    placeholder="तल्ला"
                                />
                                @error('storey')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="rate" class="form-label">दर *</label>
                                <input
                                    type="number"
                                    name="rate"
                                    value="{{old('rate',$mapFee->rate)}}"
                                    min="0"
                                    class="form-control @error('rate') is-invalid @enderror"
                                    id="rate"
                                    placeholder="दर"
                                />
                                @error('rate')
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
