@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.dashboard') }}">
                                <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                     alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{$mapApply->unique_id}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$mapApply->houseOwner?->name}}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">{{$mapApply->unique_id}}</h4>

                        <span class="d-flex justify-content-between align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    घरधनि नामसारी
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href="{{ route('emap.admin.houseOwnerArchive.index',$mapApply) }}"> House Owner before compilation of house</a></li>
                                  <li><a class="dropdown-item" href="#"> House Owner After compilation of house</a></li>
                                  <li><a class="dropdown-item" href="#"> Organization</a></li>
                                </ul>
                            </div>
                            @if(empty($mapApply->registration_no))
                            <a href="{{route('emap.admin.mapApply.register-map', $mapApply)}}" class="btn btn-success">
                                नक्सा दर्ता गर्नुहोस
                            </a>
                            @endif
                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#mapReject">
                            नक्सा अस्वीकार गर्नुहोस
                        </button>

                            <div class="modal fade" id="mapReject" tabindex="-1" aria-labelledby="statusLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mapReject">नक्सा अस्वीकार गर्नुहोस</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('emap.admin.mapApply.rejectMap',$mapApply) }}">
                                            @csrf
                                            @method('put')
                                                    <div class="mb-3">
                                                        <label for="status1" class="form-label">स्थिति</label>
                                                        <input type="text" name="status1" value="{{ Modules\EMap\Enums\DocumentStatusEnum::REJECTED->label() }}"class="form-control @error('status') is-invalid @enderror" id="status1" readonly  />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="comment" class="form-label">टिप्पणी</label>
                                                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                                                        @error('comment')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बन्द</button>
                                                        <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
                                                    </div>
                                                </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </span>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>शिर्षक</th>
                                <th>Need From </th>
                                <th>स्थिति</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($forms as $form)

                                <tr>
                                    <td>{{ get_nepali_number($loop->iteration) }}</td>
                                    <td>{{ $form->title }}</td>
                                    <td>
                                        {{$form->need_from?->label()??''}}
                                    </td>
                                    <td>{{$form->map_status?->label()}}</td>
                                    <td>
                                        @if ($form->need_from->value == \Modules\EMap\Enums\EMapFormFillerTypeEnum::OFFICE->value)
                                            @if($form->map_group_id == $form->map_pass_group_id)
                                            <a href="{{ route('emap.admin.mapApply.admin-step.fill-detail', [$mapApply, $form]) }}"
                                               class="btn btn-xs btn-outline-primary {{ $form->order == $order ? '' : 'disabled' }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @else
                                                @if($form->form_approve)
                                                    <a href="{{ route('emap.admin.mapApply.admin-step.view-detail', [$mapApply, $form]) }}"
                                                       class="btn btn-xs bn-outline-success">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('emap.admin.mapApply.admin-step.formDetail', [$mapApply, $form]) }}"
                                                       class="btn btn-xs btn-outline-primary {{ $form->order == $order ? '' : 'disabled' }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        @else
                                            <a href="{{ route('emap.admin.mapApply.admin-step.view-detail', [$mapApply, $form]) }}"
                                               class="btn btn-xs bn-outline-success">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endif
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

@endsection
