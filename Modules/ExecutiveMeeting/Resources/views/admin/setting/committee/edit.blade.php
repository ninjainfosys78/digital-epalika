@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.executiveMeeting.setting.committee.index') }}">
                                समिति
                            </a>
                        </li>
                        <li class="breadcrumb-item active">समिति सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">समिति</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">समिति सम्पादन गर्नुहोस्</h4>
                        <a href="{{ route('admin.executiveMeeting.setting.committee.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> समिति सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.executiveMeeting.setting.committee.update',$committee) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="committee_type_id" class="form-label">समिति प्रकार *</label>
                                <select name="committee_type_id" id="committee_type_id" class="form-select" required>
                                    <option value="">--छान्नुहोस्--</option>
                                    @foreach($committeeTypes as $committeeType)
                                        <option
                                            {{$committeeType->id==old('committee_type_id',$committee->committee_type_id) ? 'selected' : ''}}
                                            value="{{$committeeType->id}}">
                                            {{$committeeType->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('committee_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="committee_name" class="form-label">समितिको नाम *</label>
                                <input type="text" name="committee_name" value="{{ old('committee_name',$committee->committee_name) }}"
                                       class="form-control @error('committee_name') is-invalid @enderror"
                                       id="committee_name"
                                       placeholder="समितिको नाम" required/>
                                @error('committee_name')
                                <div class="invalid-feedback">{{ $message }}</div>
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
