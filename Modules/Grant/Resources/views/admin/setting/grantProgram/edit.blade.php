@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.grant.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अनुदान कार्यक्रम</li>
                    </ol>
                </div>
                <h4 class="page-title"> अनुदान कार्यक्रमहरु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ अनुदान कार्यक्रम थप्नुहोस्</h4>
                        <a href="{{route('admin.grant.setting.grantProgram.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> कार्यक्रम सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.grant.setting.grantProgram.update', $grantProgram)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">विषय *</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{old('name', $grantProgram->name)}}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    placeholder="विषय"
                                    required
                                />
                                @error('name')
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



