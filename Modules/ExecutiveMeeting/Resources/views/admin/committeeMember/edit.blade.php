@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.executiveMeeting.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.executiveMeeting.committee.committeeMember.index',$committee)}}">
                                {{$committee->committee_name}} सदस्य
                            </a>
                        </li>
                        <li class="breadcrumb-item active">समिति सदस्य सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$committee->committee_name}} सदस्य</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">समिति सदस्य सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.executiveMeeting.committee.committeeMember.index',$committee)}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> समिति सदस्य बिवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.executiveMeeting.committee.committeeMember.update',[$committee,$committeeMember])}}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                        value="{{old('name',$committeeMember->name)}}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        placeholder="नाम"
                                        required
                                    />
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="designation" class="form-label">पद *</label>
                                    <input
                                        type="text"
                                        name="designation"
                                        value="{{old('designation',$committeeMember->designation)}}"
                                        class="form-control @error('designation') is-invalid @enderror"
                                        id="designation"
                                        placeholder="पद"
                                        required
                                    />
                                    @error('designation')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">

                                    <label for="photo" class="form-label">फोटो </label>
                                    <input
                                        type="file"
                                        name="photo"
                                        class="form-control @error('photo') is-invalid @enderror"
                                        id="photo"
                                    />
                                    @error('photo')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">इमेल </label>
                                    <input
                                        type="text"
                                        name="email"
                                        value="{{old('email',$committeeMember->email)}}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        placeholder="इमेल"
                                    />
                                    @error('email')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="phone" class="form-label">फोन नम्बर * </label>
                                    <input
                                        type="text"
                                        name="phone"
                                        value="{{old('phone',$committeeMember->phone)}}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone"
                                        placeholder="फोन नम्बर"
                                        required
                                    />
                                    @error('phone')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="position" class="form-label">स्थान </label>
                                    <input
                                        type="number"
                                        name="position"
                                        value="{{old('position',$committeeMember->position)}}"
                                        class="form-control @error('position') is-invalid @enderror"
                                        id="position"
                                        placeholder="स्थान"
                                    />
                                    @error('position')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>ठेगाना</strong>
                            </legend>
                            <x-address-component :local-body-id="$committeeMember->local_body_id"
                                                 :district-id="$committeeMember->district_id"
                                                 :province-id="$committeeMember->province_id"
                                                 :ward-no="$committeeMember->ward_no"/>
                            <div class="col-md-6 mb-2">
                                <label for="tole" class="form-label">टोल </label>
                                <input
                                    type="text"
                                    name="tole"
                                    value="{{old('tole',$committeeMember->tole)}}"
                                    class="form-control @error('tole') is-invalid @enderror"
                                    id="tole"
                                    placeholder="टोल"
                                />
                                @error('tole')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
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
