@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">फारम</li>
                    </ol>
                </div>
                <h4 class="page-title">फारम</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-0">निबेदन/प्रतिबेदनको स्थिति</h4>
                <a class="btn btn-xs btn-outline-info" href="{{route('organization.admin.mapApply.index')}}">
                    <i class="fa fa-list"> नक्सा विवरण</i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">क्र.स.</th>
                    <th scope="col">निबेदन/प्रतिबेदनको किसिम</th>
                    <th>स्थिति</th>
                    <th>कारण</th>
                    <th>घरधनिको निबेदन को स्थिति</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\Modules\EMap\Enums\NoticeTypeEnum::cases() as $noticeTypeEnum)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$noticeTypeEnum->label()}}</td>
                        <td class="text-center">
                            @if($mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)->first()?->type=='Accept')
                                <i class="fas fa-check"></i>
                            @endif
                            @if($mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)->first()?->type=='Reject')
                                <i class="fas fa-times"></i>
                            @endif
                        </td>
                        <td>
                            {{$mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)->first()?->remarks??''}}
                        </td>
                        <td class="text-center">
                            @if($fileTypes->contains($noticeTypeEnum) && $noticeTypeEnum->type() === \Modules\EMap\Enums\EMapFormFillerTypeEnum::OWNER)
                                <a href="{{route('organization.admin.updateStatusOrganization',[$mapApply,$noticeTypeEnum->value])}}"
                                   class="btn {{$mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)?->first()->is_sent ? 'btn-outline-success':'btn-outline-danger'}} btn-xs">
                                    <i class="fa {{$mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)?->first()->is_sent ? 'fa-check':'fa-times'}}"></i>
                                </a>
                            @endif

                        </td>
                        <td class="text-center">
                            @if($noticeTypeEnum->type() === \Modules\EMap\Enums\EMapFormFillerTypeEnum::ORGANIZATION)
                                @if($mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)->first()?->type!=='Accept')
                                    <a href="{{route('organization.admin.getTemplateData',[$mapApply,$noticeTypeEnum->value])}}"
                                       class="btn btn-outline-primary btn-xs">
                                        <i class="fa fa-edit"></i>
                                        <span>फार्म भर्नुहोस्</span>
                                    </a>
                                @endif
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
