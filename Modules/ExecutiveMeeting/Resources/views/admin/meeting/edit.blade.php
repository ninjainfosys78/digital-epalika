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
                            <a href="{{route('admin.executiveMeeting.meeting.index')}}">बैठक विवरण </a>
                        </li>
                        <li class="breadcrumb-item active">बैठक विवरण सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">बैठक विवरण </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">बैठक विवरण सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.executiveMeeting.meeting.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> बैठक विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.executiveMeeting.meeting.update',$meeting)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="committee_id" class="form-label">समिति *</label>
                                <select
                                    name="committee_id"
                                    class="form-control @error('committee_id') is-invalid @enderror"
                                    data-toggle="select2"
                                    id="committee_id" required>
                                    <option value="" selected disabled>-- छान्नुहोस् ---</option>
                                    @foreach($committees as $committee)
                                        <option
                                            value="{{$committee->id}}"
                                            {{$committee->id==old('committee_id',$meeting->committee_id) ? 'selected' : ''}}>
                                            {{$committee->committee_name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('committee_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="meeting_name" class="form-label">बैठकको शिर्षक *</label>
                                <input
                                    type="text"
                                    name="meeting_name"
                                    value="{{old('meeting_name',$meeting->meeting_name)}}"
                                    class="form-control @error('meeting_name') is-invalid @enderror"
                                    id="meeting_name"
                                    placeholder="नाम"
                                    required
                                />
                                @error('meeting_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="start_date" labelNe="सुरू मिति *"
                                    nameEn="en_start_date" labelEn="Start Date"
                                    :getTodayDate="false"
                                    :editDateNe="$meeting->start_date"
                                    :editDateEn="$meeting->en_start_date"
                                />
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="end_date" labelNe="अन्तिम मिति"
                                    nameEn="en_end_date" labelEn="End Date"
                                    :getTodayDate="false"
                                    :editDateNe="$meeting->end_date"
                                    :editDateEn="$meeting->en_end_date"
                                />
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">विवरण *</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="विवरण"
                                    required
                                    cols="30" rows="3">{{old('description',$meeting->description)}}</textarea>
                                @error('description')
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
