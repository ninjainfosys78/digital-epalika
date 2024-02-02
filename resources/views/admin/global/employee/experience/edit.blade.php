@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.global.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.global.generalSetting.employee.show',$employee)}}">कार्य अनुभव </a>
                        </li>
                        <li class="breadcrumb-item active">कार्य अनुभव सम्पादन गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">कार्य अनुभव </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">कार्य अनुभव सम्पादन गर्नुहोस</h4>
                        <a href="{{route('admin.global.generalSetting.employee.show',$employee)}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> कार्य अनुभव सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.generalSetting.employee.experience.update',[$employee,$experience])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>कार्य अनुभव विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="office" class="form-label">कार्यालय/संस्था *</label>
                                    <input
                                        type="text"
                                        name="office"
                                        value="{{old('office',$experience->office)}}"
                                        class="form-control @error('office') is-invalid @enderror"
                                        id="office"
                                        placeholder="कार्यालय/संस्था"
                                    />
                                    @error('office')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="designation" class="form-label">पद *</label>
                                    <input
                                        type="text"
                                        name="designation"
                                        value="{{old('designation',$experience->designation)}}"
                                        class="form-control @error('designation') is-invalid @enderror"
                                        id="designation"
                                        placeholder="पद"

                                    />
                                    @error('designation')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="start_date" class="form-label">मिति देखि *</label>
                                    <input
                                        type="text"
                                        name="start_date"
                                        value="{{old('start_date',$experience->start_date)}}"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        id="start_date"
                                        placeholder="YYYY-MM-DD"

                                    />
                                    @error('start_date')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="end_date" class="form-label">मिति सम्म *</label>
                                    <input
                                        type="text"
                                        name="end_date"
                                        value="{{old('end_date',$experience->end_date)}}"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        id="end_date"
                                        placeholder="YYYY-MM-DD"

                                    />
                                    @error('end_date')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="responsibility" class="form-label"> मुख्य जिम्मेवारी *</label>
                                    <input
                                        type="text"
                                        name="responsibility"
                                        value="{{old('responsibility',$experience->responsibility)}}"
                                        class="form-control @error('responsibility') is-invalid @enderror"
                                        id="responsibility"
                                        placeholder="मुख्य जिम्मेवारी"

                                    />
                                    @error('responsibility')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="remarks" class="form-label">कैफियत *</label>
                                    <input
                                        type="text"
                                        name="remarks"
                                        value="{{old('remarks',$experience->remarks)}}"
                                        class="form-control @error('remarks') is-invalid @enderror"
                                        id="remarks"
                                        placeholder="कैफियत"

                                    />
                                    @error('remarks')
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

