@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.grievanceHandling.setting.grievanceSetting.index') }}">गुनासो सुन्ने
                            अधिकारी </a>
                    </li>
                    <li class="breadcrumb-item active">गुनासो सुन्ने अधिकारी</li>
                </ol>
            </div>
            <h4 class="page-title">गुनासो सुन्ने अधिकारी </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">

            <div class="card-body px-0">
                <form action="{{ route('admin.grievanceHandling.setting.grievanceSetting.update',$grievanceSetting) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="user_id" class="form-label">गुनासो सुन्ने अधिकारी *</label>
                            <select name="user_id" class="form-control" id="user_id">
                                <option>छान्नुहोस्</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $grievanceSetting->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="escalation_days" class="form-label">Auto Escalation Days</label>
                            <input type="number" id="escalation_days" class="form-control"
                                placeholder="Auto Escalation Days" name="escalation_days"
                                value="{{ old('escalation_days', $grievanceSetting->escalation_days) }}">
                            @error('escalation_days')
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
</div>
@endsection