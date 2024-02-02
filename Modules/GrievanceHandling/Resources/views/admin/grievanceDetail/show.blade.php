@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grievanceHandling.grievanceDetail.index') }}">गुनासो बिबरण </a>
                        </li>
                        <li class="breadcrumb-item active">गुनासो बिबरण</li>
                    </ol>
                </div>
                <h4 class="page-title">गुनासो बिबरण </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title"> बैठक प्रतिवेदन</h4>
                        <div class="d-flex gap-1 justify-content-between">


                            <x-print-button target-element="report-table" title="गुनासो रिपोर्ट" :headerRequired="true" />
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 text-dark">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="text-decoration-underline mt-1 fw-bold">
                                गुनासोको विवरण
                            </h4>
                            <div class="row my-3">
                                <div class="col-md-5"><b>बिषय : </b></div>
                                <div class="col-md-7">{{ $grievanceDetail->subject }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5"><b>शाखा :</b></div>
                                <div class="col-md-7">{{ $grievanceDetail->branch->branch_name ?? '' }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5"><b>गुनासो हेर्ने अधिकारी : </b></div>
                                <div class="col-md-7">{{ $grievanceDetail->assignedUser->name ?? '' }}</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5"><b>प्रकाशकको ​​नाम : </b></div>
                                <div class="col-md-7">{{ $grievanceDetail->publisher->name ?? '' }}</div>
                            </div>
                            <form class="form-inline"
                                action="{{ route('admin.grievanceHandling.grievanceDetail.updateStatus', $grievanceDetail->id) }}"
                                method="post">
                                @method('put')
                                @csrf
                                <div class="row my-3">
                                    <div class="col-md-5"><b>स्थिति : </b></div>
                                    <div class="col-md-7 d-flex">
                                        <select name="status" class="form-select form-select-sm mr-1"
                                            style="height: 30px; padding: 5px 10px" id="grievanceDetailStatus">
                                            @foreach (\Modules\GrievanceHandling\Enums\GrievanceStatus::cases() as $status)
                                                <option value="{{ $status->value }}"
                                                    {{ $status == $grievanceDetail->status ? 'selected' : '' }}>
                                                    {{ $status->label() }}</option>
                                            @endforeach

                                        </select>
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-primary mx-2 px-1">Save</button>
                                    </div>
                                </div>

                            </form>
                            <div class="row my-3">
                                <div class="col-md-5"><b>दर्ता स्थिति:</b></div>
                                <div class="col-md-7">
                                    <a href="{{ route('admin.grievanceHandling.grievanceDetail.approve', $grievanceDetail) }}"
                                        @class([
                                            'mx-0',
                                            'px-1',
                                            'text-white',
                                            'btn btn-sm',
                                            'bg-success' => $grievanceDetail->is_approved == 1,
                                            'btn-danger' => $grievanceDetail->is_approved == 0,
                                        ])><i
                                            @class([
                                                'fa',
                                                'fa-check' => $grievanceDetail->is_approved == 1,
                                                'fa-window-close' => $grievanceDetail->is_approved == 0,
                                            ])></i>{{ $grievanceDetail->is_approved == 1 ? 'निसक्रिय गर्नुहोस' : 'सक्रिय गर्नुहोस' }}</a>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-5"><b>सार्वजनिक गरेको स्थिति:</b></div>
                                <div class="col-md-7">
                                    <a href="{{ route('admin.grievanceHandling.grievance-detail.show-to-public', $grievanceDetail) }}"
                                        @class([
                                            'mx-0',
                                            'px-1',
                                            'text-white',
                                            'btn btn-sm',
                                            'bg-success' => $grievanceDetail->is_public == 1,
                                            'btn-danger' => $grievanceDetail->is_public == 0,
                                        ])><i
                                            @class([
                                                'fa',
                                                'fa-check' => $grievanceDetail->is_public == 1,
                                                'fa-window-close' => $grievanceDetail->is_public == 0,
                                            ])></i>{{ $grievanceDetail->is_approved == 1 ? 'निसक्रिय गर्नुहोस' : 'सक्रिय गर्नुहोस' }}</a>

                                </div>
                            </div>
                            <div class="row">
                                @if ($grievanceDetail->status == Modules\GrievanceHandling\Enums\GrievanceStatus::UNSEEN)
                                    <div class="col-md-5">
                                        <b>गुनासो स्थानान्तरण गर्नुहोस</b>
                                    </div>
                                    <div class="col-md-7">
                                        <form
                                            action="{{ route('admin.grievanceHandling.grievanceDetail.grievanceTransfer', $grievanceDetail) }}"
                                            method="post" class="d-flex">
                                            @csrf
                                            <select name="transfer_user_id" id="transfer_user_id" class="form-select"
                                                style="height: 30px; padding: 5px 10px">
                                                <option value="">छान्नुहोस्</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-outline-primary mx-2">
                                                Save
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="col-md-4">
                            <h4 class="text-decoration-underline mt-0">
                                <b> प्रयोगकर्ता विवरण</b>
                            </h4>
                            @if (!$grievanceDetail->is_anonymous)
                                <div class="row my-3">
                                    <div class="col-md-5"><b>नाम :</b></div>
                                    <div class="col-md-7">{{ $grievanceDetail->grievanceUser->name ?? '' }}</div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-5"><b>ईमेल :</b></div>
                                    <div class="col-md-7">{{ $grievanceDetail->grievanceUser->email ?? '' }}</div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-5"><b>सम्पर्क नं
                                            :</b></div>
                                    <div class="col-md-7">{{ $grievanceDetail->grievanceUser->phone ?? '' }}</div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-5"><b>ठेगाना
                                            :</b></div>
                                    <div class="col-md-7">{{ $grievanceDetail->grievanceUser->address ?? '' }}</div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-5"><b>गुनासो प्राथमिकता
                                            :</b></div>
                                    <div class="col-md-7"><span
                                            class="text-success">{{ $grievanceDetail->complaint_severity->label() }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h4 class="text-decoration-underline mt-1 fw-bold">
                                गुनासो तोकिएको इतिहास
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-custom">
                                    <thead>
                                        <tr>
                                            <th>क्र.सं.</th>
                                            <th>मिति</th>
                                            <th>From</th>
                                            <th>To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($grievanceDetail->grievanceAssignHistories as $history)
                                            <tr>
                                                <td style="font-size: 13px;">{{ $loop->iteration }}</td>
                                                <td style="font-size: 13px;">
                                                    <x-ad-to-bs id="assigned_at{{ $loop->iteration }}" :adDate="$history->assigned_at->toDateString()" />
                                                    {{ $history->assigned_at->format('g:i A') }}
                                                </td>
                                                <td style="font-size: 13px;">{{ $history->fromUser->name ?? '' }}
                                                </td>
                                                <td style="font-size: 13px;">{{ $history->user->name ?? '' }}</td>
                                            </tr>
                                            <tr class="empty">
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                    <div class="col-md-4">
                        <form class="form-inline"
                            action="{{ route('admin.grievanceHandling.grievanceDetail.updateStatus', $grievanceDetail->id) }}"
                            method="post">
                            @method('put')
                            @csrf
                            <div class="col-md-4">
                                <label for="inputState" class="form-label text-black"><b>स्थिति</b></label>
                                <select name="status" class="form-select form-select-sm mt-1" id="grievanceDetailStatus">
                                    @foreach (\Modules\GrievanceHandling\Enums\GrievanceStatus::cases() as $status)
    <option value="{{ $status->value }}"
                                        {{ $status == $grievanceDetail->status ? 'selected' : '' }}>
                                        {{ $status->label() }}</option>
    @endforeach

                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h4 class="mt-3"><b>दर्ता स्थिति:</b> <a
                                href="{{ route('admin.grievanceHandling.grievanceDetail.approve', $grievanceDetail) }}"
                                @class([
                                    'mx-2',
                                    'px-3',
                                    'text-white',
                                    'btn btn-sm',
                                    'bg-success' => $grievanceDetail->is_approved == 1,
                                    'bg-danger' => $grievanceDetail->is_approved == 0,
                                ])><i @class([
                                    'fa',
                                    'fa-check' => $grievanceDetail->is_approved == 1,
                                    'fa-window-close' => $grievanceDetail->is_approved == 0,
                                ])></i></a>
                            {{ $grievanceDetail->is_approved == 1 ? 'निसक्रिय गर्नुहोस' : 'सक्रिय गर्नुहोस' }}
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4 class="mt-3"> <b>सार्वजनिक गरेको स्थिति:</b> <a
                                href="{{ route('admin.grievanceHandling.grievance-detail.show-to-public', $grievanceDetail) }}"
                                @class([
                                    'mx-2',
                                    'px-3',
                                    'text-white',
                                    'btn btn-sm',
                                    'bg-success' => $grievanceDetail->is_public == 1,
                                    'bg-danger' => $grievanceDetail->is_public == 0,
                                ])><i @class([
                                    'fa',
                                    'fa-check' => $grievanceDetail->is_public == 1,
                                    'fa-window-close' => $grievanceDetail->is_public == 0,
                                ])></i></a>
                            {{ $grievanceDetail->is_approved == 1 ? 'निसक्रिय गर्नुहोस' : 'सक्रिय गर्नुहोस' }}
                        </h4>
                    </div>
                </div> -->

                    <div class="row">
                        <!-- <div class="col-md-5">
                            @if ($grievanceDetail->status == Modules\GrievanceHandling\Enums\GrievanceStatus::UNSEEN)
    <h4 class="text-decoration-underline mt-3 mb-0 fw-bold">
                                गुनासो स्थानान्तरण गर्नुहोस
                            </h4>
                            <form
                                action="{{ route('admin.grievanceHandling.grievanceDetail.grievanceTransfer', $grievanceDetail) }}"
                                method="post">
                                @csrf
                                <label for="transfer_user_id" class="form-label">Transfer to user</label>
                                <select name="transfer_user_id" id="transfer_user_id" class="form-select">
                                    <option value="">छान्नुहोस्</option>
                                    @foreach ($users as $user)
    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">
                                    पेश गर्नुहोस
                                </button>
                            </form>
    @endif

                        </div> -->
                        <div class="dropdown dropup gunaso-message">
                            <button class="btn bg-grey btn-box border-1 border-grey dropdown-toggle shadow" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-image">
                                    <img class="order-2" src="{{ $grievanceDetail->grievanceUser->avatar ?? '' }}"
                                        alt="avatar 1" height="40">
                                </div>
                                <div class="user-info mx-2" style="position: relative; top: 5px">
                                    <p class="text-dark" style="font-size: 18px">
                                        {{ $grievanceDetail->grievanceUser->name ?? '' }}
                                    </p>
                                    <p class="small text-dark d-flex justify-content-start"
                                        style="opacity: 0.7; font-weight: 500; top: -5px">
                                        {{ $grievanceDetail->created_at?->calendar() }}
                                    </p>
                                </div>
                            </button>
                            <ul class="dropdown-menu">
                                <div class="row">
                                    <div
                                        class="grievanceChat mt-2 border border-grey rounded h-50 overflow-auto bg-white p-0 my-chatbox">
                                        <div id="chat">
                                            <div class="my-2 p-2" style="height:300px;overflow-y:scroll;">
                                                <div class="">
                                                    <div class="d-flex flex-column align-items-end">
                                                        <h6 class="p-2  mb-1 mr-0 rounded bg-light">
                                                            {{ $grievanceDetail->description }}</h6>
                                                        @foreach ($grievanceDetail->files as $file)
                                                            <a class="me-3 btn btn-primary btn-sm"
                                                                href="{{ $file->file_url }}"
                                                                download="{{ $file->file_url }}">
                                                                {{ $file->file_name }} <i class="fa fa-download"></i>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($grievanceDetail->grievanceDetails as $detail)
                                                    @if (!empty($detail->user_id))
                                                        <div class="border rounded p-2">
                                                            <div
                                                                class="d-flex justify-content-start my-3 border p-2 rounded">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <img class="order-1"
                                                                        src="{{ $detail->user->avatar ?? '' }}"
                                                                        alt="avatar 1" height="50">
                                                                    <div class="order-2">
                                                                        <p class="small">
                                                                            {{ $detail->user->name ?? '' }}</p>
                                                                        <p class="small text-muted">
                                                                            {{ $detail->created_at?->calendar() }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-start">
                                                                <h6 class="p-2 ms-3 mb-1 rounded bg-light">
                                                                    {{ $detail->description }}</h6>
                                                                @foreach ($detail->files as $detailFile)
                                                                    <a class="me-3 btn btn-primary btn-sm"
                                                                        href="{{ $detailFile->file_url }}"
                                                                        download="{{ $detailFile->file_url }}">
                                                                        {{ $detailFile->file_name }} <i
                                                                            class="fa fa-download"></i>
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="border rounded p-2">
                                                            <div
                                                                class="d-flex justify-content-end my-3 border p-2 rounded">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <img class="order-2"
                                                                        src="{{ $detail->grievanceUser->avatar ?? '' }}"
                                                                        alt="avatar 1" height="50">
                                                                    <div class="order-1">
                                                                        <p class="small">
                                                                            {{ $detail->grievanceUser->name ?? '' }}
                                                                        </p>
                                                                        <p class="small text-muted">
                                                                            {{ $detail->created_at?->calendar() }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-end">
                                                                <h6 class="p-2 me-3 mb-1 rounded bg-light">
                                                                    {{ $detail->description }}</h6>
                                                                @foreach ($detail->files as $detailFile)
                                                                    <a class="me-3 btn btn-primary btn-sm"
                                                                        href="{{ $detailFile->file_url }}"
                                                                        download="{{ $detailFile->file_url }}">
                                                                        {{ $detailFile->file_name }} <i
                                                                            class="fa fa-download"></i>
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (!$loop->last)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <form enctype="multipart/form-data"
                                            action="{{ route('admin.grievanceHandling.grievanceDetail.replyGrievance', $grievanceDetail->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-start align-items-center p-2"
                                                style="margin-top: 25px">
                                                <input type="text" class="form-control flex-shrink-1"
                                                    name="description" id="description" placeholder="Type message">
                                                <div class="flex-shrink-0 text-center d-flex align-items-center gap-2">

                                                    <div style="width: 35px">
                                                        <input type="file" id="upload" name="files[]" multiple
                                                            hidden />
                                                        <label class="ms-1 text-muted atach-label" for="upload"><i
                                                                class="fas fa-paperclip"></i></label>

                                                    </div>

                                                    <button type="submit" class="btn bg-grey text-dark h-100"
                                                        style="height: 49px !important;
    width: 50px;"
                                                        href="#"><i class="fas fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        @error('files.*')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        @error('files')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="col-md-7 mt-3">
                            <div class="d-flex justify-content-center">
                                <div class="col-md-12 mx-10">

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

    @push('style')
        <style>
            .message {
                border: 2px solid #dedede;
                background-color: #f1f1f1;
                border-radius: 5px;
                /*width: 70%;*/
                padding: 10px;
                margin: 10px 0;
                height: 200px;
            }


            label {
                display: inline-block;
                font-family: sans-serif;
                border-radius: 0.3rem;
                cursor: pointer;
                margin-top: 1rem;
            }



            .darker {
                border-color: #ccc;
                background-color: #ddd;
            }

            .message::after {
                content: "";
                clear: both;
                display: table;
            }

            .message img {
                float: left;
                max-width: 60px;
                width: 100%;
                margin-right: 20px;
                border-radius: 50%;
            }

            .message img.right {
                float: right;
                margin-left: 20px;
                margin-right: 0;
            }

            .time-right {
                float: right;
                color: #aaa;
            }

            .time-left {
                float: left;
                color: #999;
            }
        </style>
    @endpush
@endsection
