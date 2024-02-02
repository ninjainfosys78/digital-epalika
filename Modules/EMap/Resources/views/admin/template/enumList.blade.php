@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('emap.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href=""> टेम्प्लेट</a>
                        </li>
                        <li class="breadcrumb-item active">टेम्प्लेट</li>
                    </ol>
                </div>
                <h4 class="page-title">टेम्प्लेट</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">टेम्प्लेट सूची</h4>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>शिर्षक</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse(\Modules\EMap\Enums\NoticeTypeEnum::cases() as $noticeTypeEnum)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$noticeTypeEnum->label() ??''}}</td>
                                    <td>
                                        @can('eMapTemplate_edit')
                                            <a data-bs-type="edit"
                                               href="{{route('emap.admin.eMapTemplate.index',$noticeTypeEnum)}}"
                                               class="btn btn-xs btn-outline-warning {{get_setting('Pin')?'confirm_pin':''}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

