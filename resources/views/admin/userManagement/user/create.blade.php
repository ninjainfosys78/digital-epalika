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
                            <a href="{{route('admin.global.userManagement.user.index')}}">प्रयोगकर्ता व्यवस्थापन</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ प्रयोगकर्ता थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रयोगकर्ता</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ प्रयोगकर्ता थप्नुहोस्</h4>
                        <a href="{{route('admin.global.userManagement.user.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> प्रयोगकर्ता सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.userManagement.user.store')}}" method="post">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>व्यक्तिगत विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label">नाम *</label>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{old('name')}}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        placeholder="नाम"
                                    />
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">इमेल *</label>
                                    <input
                                        type="text"
                                        name="email"
                                        value="{{old('email')}}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        placeholder="इमेल"
                                    />
                                    @error('email')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="phone" class="form-label">फोन नम्बर *</label>
                                    <input
                                        type="text"
                                        name="phone"
                                        value="{{old('phone')}}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone"
                                        placeholder="फोन नम्बर"
                                    />
                                    @error('phone')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="role_id" class="form-label">भूमिका *</label>
                                    <select name="role_id"
                                            class="form-select @error('role_id') is-invalid @enderror"
                                            id="role_id">
                                        <option value="">भूमिका छान्नुहोस्</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{$role->id}}" {{$role->id==old('role_id') ? 'selected' : ''}}>
                                                {{$role->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="ward_no" class="form-label">वडा नं.</label>
                                    <select name="ward_no"
                                            class="form-select @error('ward_no') is-invalid @enderror"
                                            id="ward_no">
                                        <option value="">वडा छान्नुहोस्</option>
                                        @foreach(officeSetting()->localBody->ward_no as $ward)
                                            <option value="{{$ward}}" {{$ward==old('ward_no') ? 'selected' : ''}}>
                                                {{$ward}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ward_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="branch_id" class="form-label">शाखा</label>
                                    <select name="branch_id"
                                            class="form-select @error('branch_id') is-invalid @enderror"
                                            id="branch_id">
                                        <option value="">छान्नुहोस्</option>
                                        @foreach($branches as $branch)
                                            <option
                                                value="{{$branch->id}}" {{$branch->id==old('branch_id') ? 'selected' : ''}}>
                                                {{$branch->branch_name}}
                                            </option>
                                            @foreach($branch->branches as $subBranch)
                                                <option
                                                    value="{{$subBranch->id}}" {{$subBranch->id==old('branch_id') ? 'selected' : ''}}>
                                                    --- {{$subBranch->branch_name}}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="employee_id" class="form-label">मथेल्नो तह कर्मचारी  </label>

                                    <select class="form-control @error('employee_id') is-invalid @enderror"
                                            name="employee_id" id="employee_id">
                                        <option value=""> कर्मचारी  छान्नुहोस</option>
                                        @foreach($allemployees as $allemployee)
                                            <option value="{{$allemployee->id}}" {{old('employee_id')==$allemployee->id ? 'selected':''}}>{{$allemployee->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">

                                    <input
                                        type="checkbox"
                                        name="is_dept_head"
                                        value="1"
                                        class="@error('is_dept_head') is-invalid @enderror"
                                        id="is_dept_head"
                                        {{old('is_dept_head')==1?'checked':''}}
                                    />
                                    <label for="is_dept_head" class="form-label">Is Department Head </label>

                                    @error('is_dept_head')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> पासवर्ड</strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="password" class="form-label">पासवर्ड *</label>
                                    <input
                                        type="password"
                                        name="password"
                                        value="{{old('password')}}"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        placeholder="पासवर्ड"
                                    />
                                    @error('password')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="password_confirmation" class="form-label">पासवर्ड सुनिश्चित गर्नुहोस
                                        *</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        value="{{old('password_confirmation')}}"
                                        class="form-control"
                                        id="password_confirmation"
                                        placeholder="पासवर्ड सुनिश्चित गर्नुहोस"
                                    />
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
