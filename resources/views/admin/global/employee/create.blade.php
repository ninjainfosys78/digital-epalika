@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                                <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                     alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.global.generalSetting.employee.index')}}">कर्मचारी </a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ कर्मचारी थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">कर्मचारीहरु </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">कर्मचारी थप्नुहोस्</h4>
                        <a href="{{route('admin.global.generalSetting.employee.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> कर्मचारी सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                                       <form action="{{route('admin.global.generalSetting.employee.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>कर्मचारी विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="name" class="form-label">नाम *</label>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{old('name')}}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        placeholder="नाम "

                                    />
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="address" class="form-label">ठेगाना *</label>
                                    <input
                                        type="text"
                                        name="address"
                                        value="{{old('address')}}"
                                        class="form-control @error('address') is-invalid @enderror"
                                        id="address"
                                        placeholder="ठेगाना"

                                    />
                                    @error('address')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="gender" class="form-label">लिङ्ग *</label>

                                    <select class="form-control @error('gender') is-invalid @enderror"
                                            name="gender" id="gender">
                                        <option value="">लिङ्ग थप्नुहोस्</option>
                                        @foreach(\App\Enums\Gender::cases() as $case)
                                            <option
                                                value="{{$case->value}}" {{old('gender')==$case->value ? 'selected':''}}>{{$case->label()}}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component
                                        nameNe="dob" labelNe="जन्म मिति*"
                                        nameEn="dob_ad" labelEn="Birth Date"
                                        :getTodayDate="false"
                                    />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="pan_no" class="form-label">पाना नं *</label>
                                    <input
                                        type="text"
                                        name="pan_no"
                                        value="{{old('pan_no')}}"
                                        class="form-control @error('pan_no') is-invalid @enderror"
                                        id="pan_no"
                                        placeholder="पाना नं *"

                                    />
                                    @error('pan_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="ethnicity_id" class="form-label">जातियता *</label>

                                    <select class="form-control @error('ethnicity_id') is-invalid @enderror"
                                            name="ethnicity_id" id="ethnicity_id">
                                        <option value="">जातियता थप्नुहोस्</option>
                                        @foreach($ethnicities as $ethnicity)
                                            <option
                                                value="{{$ethnicity->id}}" {{old('ethnicity_id')==$ethnicity->id ? 'selected':''}}>{{$ethnicity->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('ethnicity_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="pis_no" class="form-label">Pis नम्बर</label>
                                    <input
                                        type="text"
                                        name="pis_no"
                                        value="{{old('pis_no')}}"
                                        class="form-control @error('pis_no') is-invalid @enderror"
                                        id="pis_no"
                                        placeholder="Pis नम्बर"

                                    />
                                    @error('pis_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="epf_no" class="form-label">Epf नम्बर</label>
                                    <input
                                        type="text"
                                        name="epf_no"
                                        value="{{old('epf_no')}}"
                                        class="form-control @error('epf_no') is-invalid @enderror"
                                        id="epf_no"
                                        placeholder="Epf नम्बर"

                                    />
                                    @error('epf_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="cif_no" class="form-label">Cif नम्बर</label>
                                    <input
                                        type="text"
                                        name="cif_no"
                                        value="{{old('cif_no')}}"
                                        class="form-control @error('cif_no') is-invalid @enderror"
                                        id="cif_no"
                                        placeholder="Cif नम्बर"

                                    />
                                    @error('cif_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="insurance_card_no" class="form-label">Insurance Card Number</label>
                                    <input
                                        type="text"
                                        name="insurance_card_no"
                                        value="{{old('insurance_card_no')}}"
                                        class="form-control @error('insurance_card_no') is-invalid @enderror"
                                        id="insurance_card_no"
                                        placeholder="Insurance Card Number"

                                    />
                                    @error('insurance_card_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="department" class="form-label">समूह </label>
                                    <input
                                        type="text"
                                        name="department"
                                        value="{{old('department')}}"
                                        class="form-control  @error('department') is-invalid @enderror"
                                        id="department"
                                        placeholder=" समूह"
                                    />
                                    @error('department')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="branch_id" class="form-label">शाखा *</label>

                                    <select class="form-control @error('branch_id') is-invalid @enderror"
                                            name="branch_id" id="branch_id">
                                        <option value="">शाखा छान्नुहोस</option>
                                        @foreach($branches as $branch)
                                            <option
                                                value="{{$branch->id}}" {{old('branch_id')==$branch->id ? 'selected':''}}>{{$branch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="employee_id" class="form-label">मथेल्नो तह कर्मचारी </label>

                                    <select class="form-control @error('employee_id') is-invalid @enderror"
                                            name="employee_id" id="employee_id">
                                        <option value=""> कर्मचारी छान्नुहोस</option>
                                        @foreach($allEmployees as $allEmployee)
                                            <option
                                                value="{{$allEmployee->id}}" {{old('employee_id')==$allEmployee->id ? 'selected':''}}>{{$allEmployee->name}}</option>
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
                                <div class="col-md-4 mb-2">
                                    <label for="designation" class="form-label">पद </label>
                                    <input
                                        type="text"
                                        name="designation"
                                        value="{{old('designation')}}"
                                        class="form-control  @error('designation') is-invalid @enderror"
                                        id="designation"
                                        placeholder=" पद"
                                    />
                                    @error('date')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="email" class="form-label">इमेल </label>
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{old('email')}}"
                                        class="form-control  @error('email') is-invalid @enderror"
                                        id="email"
                                        placeholder=" इमेल"
                                    />
                                    @error('email')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="phone" class="form-label">फोन </label>
                                    <input
                                        type="text"
                                        name="phone"
                                        value="{{old('phone')}}"
                                        class="form-control  @error('phone') is-invalid @enderror"
                                        id="phone"
                                        placeholder=" फोन"
                                    />
                                    @error('phone')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="photo" class="form-label">फोटो </label>
                                    <input
                                        type="file"
                                        name="photo"
                                        class="form-control  @error('photo') is-invalid @enderror"
                                        id="photo"

                                    />
                                    @error('photo')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="position" class="form-label">मर्यादाक्रम </label>
                                    <input
                                        type="text"
                                        name="position"
                                        value="{{old('position')}}"
                                        class="form-control @error('position') is-invalid @enderror"
                                        id="position"
                                        placeholder=" स्थान"
                                    />
                                    @error('position')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="is_employee" class="form-label">प्रकार छान्नुहोस *</label>

                                    <select class="form-control @error('is_employee') is-invalid @enderror"
                                            name="is_employee" id="is_employee" required>
                                        <option value="1" {{old('is_employee') == 1 ? 'selected':''}}>कर्मचारी</option>
                                        <option value="0" {{old('is_employee')==0 ? 'selected':''}}>जनप्रतिनिधि
                                        </option>
                                    </select>
                                    @error('is_employee')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="show_to_index" class="form-label">गृहपृष्ठमा देखाउनुहोस् *</label>

                                    <select class="form-control @error('show_to_index') is-invalid @enderror"
                                            name="show_to_index" id="show_to_index" required>
                                        <option value="1" {{old('show_to_index') == 1 ? 'selected':''}}>देखाउने
                                        </option>
                                        <option value="0" {{old('show_to_index')==0 ? 'selected':''}}>नदेखाउने
                                        </option>
                                    </select>
                                    @error('show_to_index')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="show_to_mobile_app" class="form-label">मोबाइलमा देखाउनुहोस् *</label>

                                    <select class="form-control @error('show_to_mobile_app') is-invalid @enderror"
                                            name="show_to_mobile_app" id="show_to_mobile_app" required>
                                        <option value="1" {{old('show_to_mobile_app') == 1 ? 'selected':''}}>देखाउने
                                        </option>
                                        <option value="0" {{old('show_to_mobile_app')==0 ? 'selected':''}}>नदेखाउने
                                        </option>
                                    </select>
                                    @error('show_to_mobile_app')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="description" class="form-label">कैफियत </label>
                                    <textarea class="form-control" id="description"
                                              name="description">{{old('description')}}</textarea>
                                    @error('description')
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

