@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grievanceHandling.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grievanceHandling.grievanceUser.index') }}">प्राप्त गुनासोहरु</a>
                        </li>
                        <li class="breadcrumb-item active">नयाँ गुनासो दर्ता गर्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">प्राप्त गुनासोहरु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ गुनासो दर्ता गर्नुहोस</h4>
                        <a href="{{ route('admin.grievanceHandling.grievanceUser.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> प्राप्त गुनासोहरु
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.grievanceHandling.grievanceDetail.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="grievance_type_id" class="form-label">गुनासोको प्रकार *</label>
                                <select name="grievance_type_id" id="grievance_type_id" class="form-select">
                                    <option value=""> गुनासो प्रकार छान्नुहोस्</option>
                                    @foreach ($grievanceTypes as $grievanceType)
                                        <option value="{{ $grievanceType->id }}"
                                            {{ $grievanceType->id == old('grievance_type_id') ? 'selected' : '' }}>
                                            {{ $grievanceType->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('grievance_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="subject" class="form-label">बिषय *</label>
                                <input type="text" name="subject" value="{{ old('subject') }}"
                                    class="form-control @error('subject') is-invalid @enderror" id="subject"
                                    placeholder="बिषय " />
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">गुनासोको विवरण</label>
                                <textarea name="description" id="description" class="form-control" placeholder="गुनासोको विवरण" cols="30"
                                    rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="files" class="form-label">सम्बन्धित फाइल </label>
                                <input type="file" name="files[]"
                                    class="form-control @error('files') is-invalid @enderror" id="files" multiple />
                                @error('files')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="branch_id" class="form-label">शाखा *</label>

                                <select class="form-control @error('branch_id') is-invalid @enderror"
                                        name="branch_id" id="branch_id">
                                    <option value="">शाखा छान्नुहोस</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}" {{old('branch_id')==$branch->id ? 'selected':''}}>{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="complaint_severity" class="form-label">गुनासोको प्राथमिकता *</label>
                                <select name="complaint_severity" id="complaint_severity" class="form-select">
                                    <option value=""> छान्नुहोस्</option>
                                    @foreach (\Modules\GrievanceHandling\Enums\GrievanceComplaintSeverity::cases() as $severity)
                                        <option value="{{ $severity->value }}"
                                            {{ $severity->value == old('complaint_severity') ? 'selected' : '' }}>
                                            {{ $severity->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('complaint_severity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="is_public" class="form-label">गुनासो सार्वजनिक गर्ने ? *</label>
                                <select name="is_public" id="is_public" class="form-select">
                                    <option value="1"> हो</option>
                                    <option value="0"> होइन</option>
                                </select>
                                @error('is_public')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="grievance_medium" class="form-label">गुनासो माध्यम *</label>
                                <select name="grievance_medium" id="grievance_medium" class="form-select">
                                    <option value=""> छान्नुहोस्</option>
                                    @foreach (\Modules\GrievanceHandling\Enums\GrievanceMediumEnum::cases() as $severity)
                                        <option value="{{ $severity->value }}"
                                            {{ $severity->value == old('grievance_medium') ? 'selected' : '' }}>
                                            {{ $severity->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('grievance_medium')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <i class="fa fa-plus-circle" title="गुनासो प्रयोगकर्ता थप्नुहोस" data-bs-toggle="modal"
                                    data-bs-target="#grievance-user-modal"></i>
                                <label for="grievance_user_id" class="form-label">गुनासो प्रयोगकर्ता *</label>
                                <select name="grievance_user_id" id="grievance_user_id" data-toggle="select2"
                                    class="form-select">
                                    <option value=""> छान्नुहोस्</option>
                                    @foreach ($grievanceUsers as $grievanceUser)
                                        <option value="{{ $grievanceUser->id }}"
                                            {{ $grievanceUser->id == old('grievance_user_id') ? 'selected' : '' }}>
                                            {{ $grievanceUser->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('grievance_user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="assigned_user_id" class="form-label">गुनासो हेर्ने अधिकारी </label>
                                <select name="assigned_user_id" id="assigned_user_id" class="form-select">
                                    <option value=""> छान्नुहोस्</option>
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
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="grievance-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel">गुनासो प्रयोगकर्ता थप्नुहोस् ।</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="grievance-user-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">नाम *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="नाम" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="phone" class="form-label">फोन *</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="फोन " />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label">इमेल </label>
                                <input type="text" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="इमेल " />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="address" class="form-label">ठेगाना </label>
                                <input type="text" name="address" value="{{ old('address') }}"
                                    class="form-control @error('address') is-invalid @enderror" id="address"
                                    placeholder="ठेगाना " />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                            <button type="submit" id="grievanceUserAddBtn" class="btn btn-primary">पेश गर्नुहोस्
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                //farmer form submit
                $('#grievance-user-form').on('submit', function(e) {
                    e.preventDefault()
                    const submitBtn = $("#grievanceUserAddBtn");
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.grievanceHandling.grievanceUser.store') }}",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            submitBtn.prop('disabled', true);
                            submitBtn.html("<i class='fa fa-spinner fa-spin'></i>");
                        },
                        success: function(resp) {
                            submitBtn.prop('disabled', false);
                            submitBtn.html("पेश गर्नुहोस्");
                            $('#grievance_user_id').append("<option value=" + resp.data
                                .id + ">" + resp.data.name + "</option>")
                            toastMessage('success', resp.message)
                            $('#grievance-user-modal').modal('toggle')
                            $('#grievance-user-form').trigger('reset')
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            submitBtn.prop('disabled', false)
                            submitBtn.html("पेश गर्नुहोस्");
                            toastMessage('error', XMLHttpRequest.responseJSON.message)
                        }
                    });
                });

                function toastMessage(type, title) {
                    swal.fire({
                        title: title,
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        width: 450,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: type,
                    });
                }
            });
        </script>
    @endpush
@endsection
