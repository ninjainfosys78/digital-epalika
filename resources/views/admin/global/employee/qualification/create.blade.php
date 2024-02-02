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
                            <a href="{{route('admin.global.generalSetting.employee.show',$employee)}}">शैक्षिक योग्यता </a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ शैक्षिक योग्यता</li>
                    </ol>
                </div>
                <h4 class="page-title">शैक्षिक योग्यता </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ शैक्षिक योग्यता</h4>
                        <a href="{{route('admin.global.generalSetting.employee.show',$employee)}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> शैक्षिक योग्यता सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.generalSetting.employee.qualification.store',$employee)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>शैक्षिक योग्यता विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="achievement" class="form-label">शैक्षिक तह *</label>
                                    <input
                                        type="text"
                                        name="achievement"
                                        value="{{old('achievement')}}"
                                        class="form-control @error('achievement') is-invalid @enderror"
                                        id="achievement"
                                        placeholder="शैक्षिक तह "
                                    />
                                    @error('achievement')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="major_subject" class="form-label">मुख्य विषय *</label>
                                    <input
                                        type="text"
                                        name="major_subject"
                                        value="{{old('major_subject')}}"
                                        class="form-control @error('major_subject') is-invalid @enderror"
                                        id="major_subject"
                                        placeholder="मुख्य विषय"

                                    />
                                    @error('major_subject')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="institute" class="form-label">विश्वविद्यालय/शैक्षिक संस्था *</label>
                                    <input
                                        type="text"
                                        name="institute"
                                        value="{{old('institute')}}"
                                        class="form-control @error('institute') is-invalid @enderror"
                                        id="institute"
                                        placeholder="विश्वविद्यालय/शैक्षिक संस्था"

                                    />
                                    @error('institute')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="passed_year" class="form-label">सम्पन्न वर्ष *</label>
                                    <input
                                        type="text"
                                        name="passed_year"
                                        value="{{old('passed_year')}}"
                                        class="form-control @error('passed_year') is-invalid @enderror"
                                        id="passed_year"
                                        placeholder="सम्पन्न वर्ष"

                                    />
                                    @error('passed_year')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="remarks" class="form-label">कैफियत *</label>
                                    <input
                                        type="text"
                                        name="remarks"
                                        value="{{old('remarks')}}"
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

