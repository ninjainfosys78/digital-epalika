@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item"> निबेदन/प्रतिबेदनको स्थिति</li>
                        <li class="breadcrumb-item active"> निबेदन/प्रतिबेदनको स्थिति</li>
                    </ol>
                </div>
                <h4 class="page-title"> निबेदन/प्रतिबेदनको स्थिति </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title"> निबेदन/प्रतिबेदनको स्थिति</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                                <a href="{{route('emap.admin.map.mapApply.index',$applicationFormTypeEnum)}}" class="btn btn-sm btn-outline-success waves-effect waves-light">
                                    <i class="fas fa-list"></i> नक्सा प्रमाणित सुची</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="responsive-table-design">
                        <div class="table-rep-design">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="responsive-table" class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th>क्र.स</th>
                                        <th scope="col">निबेदन/प्रतिबेदनको किसिम</th>
                                        @foreach(\Modules\EMap\Enums\EMapFormFillerTypeEnum::cases() as $formFiller)
                                            <th scope="col">{{$formFiller->label()??''}}</th>
                                        @endforeach
                                        <th scope="col">डाटा भर्नुहोस्</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\Modules\EMap\Enums\NoticeTypeEnum::cases() as $noticeTypeEnum)
                                        @if($applicationFormTypeEnum===\Modules\EMap\Enums\ApplicationFormTypeEnum::MAP_VERIFIED)
                                            @if($noticeTypeEnum->showInMapVerification())
                                                <tr @class([
                                           "table-danger"=>!$mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum),
                                           "table-success"=>$mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum),
                                          ])>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$noticeTypeEnum->label() ?? ''}}</td>
                                                    @foreach(\Modules\EMap\Enums\EMapFormFillerTypeEnum::cases() as $formFillerData)
                                                        <td>
                                                            @if($noticeTypeEnum->type() === $formFillerData)
                                                                @if($mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum))
                                                                    <i class="fa fa-check"></i>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                    <td>
                                                        <a href="{{route('emap.admin.map.mapApply.show', [$mapApply,$applicationFormTypeEnum,$noticeTypeEnum])}}"
                                                           type="button"
                                                           class="btn btn-outline-info btn-sm {{get_setting('Pin')?'confirm_pin':''}}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr @class([
                                           "table-danger"=>!$mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum),
                                           "table-success"=>$mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum),
                                          ])>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$noticeTypeEnum->label() ?? ''}}</td>
                                                @foreach(\Modules\EMap\Enums\EMapFormFillerTypeEnum::cases() as $formFillerData)
                                                    <td>
                                                        @if($noticeTypeEnum->type() === $formFillerData)
                                                            @if($mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum))
                                                                <i class="fas fa-check-circle"></i>
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endforeach
                                                <td>
                                                    <a href="{{route('emap.admin.map.mapApply.show', [$mapApply,$applicationFormTypeEnum,$noticeTypeEnum])}}"
                                                       type="button"
                                                       class="btn btn-outline-primary btn-sm {{get_setting('Pin')?'confirm_pin':''}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

