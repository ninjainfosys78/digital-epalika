@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">उपकरण</li>
                    </ol>
                </div>
                <h4 class="page-title">उपकरण</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">उपकरण </h4>
                        <a href="{{ route('admin.plan.equipment.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>उपकरण सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.equipment.store') }}" method="post">
                        @csrf

                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="शिर्षक" />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="activity" class="form-label">गतिबिधि</label>
                                    <input type="text" name="activity" value="{{ old('activity') }}"
                                        class="form-control @error('activity') is-invalid @enderror" id="activity"
                                        placeholder="गतिबिधि" />
                                    @error('activity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="capacity" class="form-label">क्षमता</label>
                                    <input type="number" name="capacity" value="{{ old('capacity') }}"
                                        class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                                        placeholder="क्षमता" />
                                    @error('capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p>Is Used For Transport *</p>

                                    <input type="radio" id="yes" name="is_used_for_transport" value="1"
                                        {{ old('is_used_for_transport') == 1 ? 'checked' : '' }}>
                                    <label for="yes">Yes</label>
                                    <input type="radio" id="no" name="is_used_for_transport" value="0"
                                        {{ old('is_used_for_transport') == 0 ? 'checked' : '' }}>
                                    <label for="no">No</label>
                                    @error('is_used_for_transport')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend> Speed Without Load </legend>
                            <div class="row">

                                <div class="col-md-4 mb-2">
                                    <label for="er" class="form-label">ER</label>
                                    <input type="number" step="any" min="0" name="er"
                                        value="{{ old('er') }}" class="form-control @error('er') is-invalid @enderror"
                                        id="er" placeholder="ER" />
                                    @error('er')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="gr" class="form-label">GR</label>
                                    <input type="number" step="any" name="gr" min="0"
                                        value="{{ old('gr') }}" class="form-control @error('gr') is-invalid @enderror"
                                        id="gr" placeholder="GR" />
                                    @error('gr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="bt" class="form-label">BT</label>
                                    <input type="number" step="any" name="bt" min="0"
                                        value="{{ old('bt') }}"
                                        class="form-control @error('bt') is-invalid @enderror" id="bt"
                                        placeholder="BT" />
                                    @error('bt')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
