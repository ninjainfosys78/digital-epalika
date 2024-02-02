@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.taskManagement.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">कार्यहरू</li>
                    </ol>
                </div>
                <h4 class="page-title">कार्यहरू </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">कार्यहरू अपलोड गर्नुहोस</h4>
                        <div class="d-flex flex-wrap gap-1 align-items-center">
                            <a href="{{ asset('assets/backend/files/tasks_import.xlsx') }}"
                            download="{{ asset('assets/backend/files/tasks_import.xlsx') }}"
                                class="btn btn-sm btn-outline-secondary waves-effect waves-light">
                                <i class="fa fa-file-excel mx-1"></i>EXCEL Sample</a>
                            <a href="{{ route('admin.taskManagement.activity.index') }}"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                <i class="fa fa-list mx-1"></i>कार्यहरूको सुची</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.taskManagement.activity.excel.import') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="excel_file" class="form-label">फाइल *</label>
                                <input type="file" name="excel_file"
                                    class="form-control @error('excel_file') is-invalid @enderror">
                                @error('excel_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if (auth()->user()->role->type == 'Super')
                                <div class="col-md-4 mb-2">
                                    <label for="branch_id">शाखा</label>
                                    <select name="branch_id" id="branch_id"
                                        class="form-select @error('branch_id') is-invalid @enderror">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @foreach ($branch->branches as $subBranch)
                                                <option value="{{ $subBranch->id }}">
                                                    --- {{ $subBranch->branch_name }}
                                                </option>
                                            @endforeach
                                            <option value="{{ $branch->id }}">
                                                {{ $branch->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="user_id" class="form-label">कर्मचारी</label>
                                    <select name="user_id" id="user_id"
                                        class="form-select @error('user_id') is-invalid @enderror">
                                        <option value="">- - छान्नुहोस् - -</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == old('user_id') ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
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
