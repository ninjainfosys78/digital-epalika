@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.plan.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">योजनाहरु</li>
                    </ol>
                </div>
                <h4 class="page-title">योजना/कार्यक्रम म्याद थप विवरण सम्पादन गर्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">योजना/कार्यक्रम म्याद थप विवरण सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.plan.project.projectDeadlineExtension.index',$project)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> म्याद थप विवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.project.projectDeadlineExtension.update',[$project,$projectDeadlineExtension])}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="extended_date" labelNe="म्याद थप मिति *"
                                    nameEn="en_extended_date" labelEn="Extended Date"
                                    :edit-date-ne="$projectDeadlineExtension->extended_date"
                                    :edit-date-en="$projectDeadlineExtension->en_extended_date"
                                    :getTodayDate="false"
                                />
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="submitted_date" labelNe="पेश मिति *"
                                    nameEn="en_submitted_date" labelEn="Submitted Date"
                                    :edit-date-ne="$projectDeadlineExtension->submitted_date"
                                    :edit-date-en="$projectDeadlineExtension->en_submitted_date"
                                    :getTodayDate="false"
                                />
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="remarks" class="form-label">कैफियत</label>
                                <textarea
                                    name="remarks"
                                    id="remarks"
                                    class="form-control @error('remarks') is-invalid @enderror"
                                    placeholder="कैफियत"
                                    cols="30" rows="3">{{old('remarks',$projectDeadlineExtension->remarks)}}</textarea>
                                @error('remarks')
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
