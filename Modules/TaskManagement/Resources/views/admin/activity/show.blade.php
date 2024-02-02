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
                        <li class="breadcrumb-item active">कार्य</li>
                    </ol>
                </div>
                <h4 class="page-title">कार्य</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title mb-0">कार्य</h4>
                <div class="d-flex flex-wrap align-items-center">
                    <a href="{{ route('admin.taskManagement.activity.index') }}"
                        class="btn btn-sm btn-outline-primary waves-effect waves-light">
                        <i class="fa fa-list"></i> कार्यहरूको सुची</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>शाखा</th>
                                    <td>{{ $activity->branch->branch_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>कार्यहरु</th>
                                    <td>
                                        <ul class="list-group list-group-numbered">
                                            @foreach ($activity->activityLists as $list)
                                                <li class="list-group-item">{{ $list->title }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>मिति</th>
                                    <td>
                                        {{ $activity->date }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end row-->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Assign Task To User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.taskManagement.activity.assignTask', $activity) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="assigned_user_id" class="form-label">Assign To</label>
                            <select name="assigned_user_id" id="assigned_user_id"
                                class="form-select @error('assigned_user_id') is-invalid @enderror">
                                <option value="">- - छान्नुहोस् - -</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == old('assigned_user_id') ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            @livewire('multiple-file')
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">Task Assignment History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Assigned To</th>
                                    <th>Created By</th>
                                    <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activity->assignedTasks as $assignedTask)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $assignedTask->assignedUser->name ?? '' }}</td>
                                        <td>{{ $assignedTask->created_by }}</td>
                                        <td>
                                            @forelse ($assignedTask->files as $file)
                                                <a href="{{ route('admin.file.download', $file) }}">
                                                    <i class="fa fa-file"> {{ $file->file_name }}</i>
                                                    {{ !$loop->last ? ',' : '' }}
                                                </a>
                                                @empty
                                                No files Uploaded
                                            @endforelse
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="header-title mb-0">कागजातहरू</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($activity->activityLists as $activityList)
                    @forelse($activityList->files as $file)
                        <div class="col-xl-4 col-lg-6">
                            <div class="card shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-2 pe-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-secondary rounded">
                                                    <i class="fa {{ getFileIconClass($file->extension) }} font-18"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <a href="javascript:void(0);"
                                                onclick="openFileModal('{{ $activityList->title }}', '{{ $file->extension }}', '{{ $file->file_url }}')"
                                                class="text-muted fw-medium"
                                                type="button">{{ $activityList->title }}.{{ $file->extension }}</a>
                                            <p class="mb-0 font-13">{{ convert_to_highest_unit($file->file_size) }}</p>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('admin.file.download', $file) }}"
                                                class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                    </div> <!-- end row -->
                                </div> <!-- end .p-2-->
                            </div> <!-- end col -->
                        </div>
                    @empty
                        <p class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</p>
                    @endforelse
                @endforeach
            </div> <!-- end row-->
        </div>
    </div>
    @include('admin.inc.file-view');
@endsection
